<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use Log;

/**
 * Class LandingController
 * @package App\Http\Controllers\Api
 */
class LandingController extends Controller
{
    public function addCallbackRequest(Request $request)
    {
        // Валидация
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'details' => 'nullable|string|max:255',
        ]);

        $name = $request->name;
        $phone = $request->phone;

        $tgMessage = "<b>Main. Заявка.</b>\n________________________\n<b>Имя:</b> $name\n<b>Телефон:</b> $phone\n";
        $additionalFiels = ['email' => 'Почта', 'type' => 'Тип услуги', 'details' => 'Коментарий'];
        foreach($additionalFiels as $field => $fieldValue) {
            if ($value = $request->{$field}) {
                $tgMessage .= "<b>$fieldValue:</b>$value\n";
            }
        }

        // Отправка в Телеграм
        $this->sendToTelegram($tgMessage);

        // Отправка в Firebase
        $this->saveToFirebase('callbackRequests', $request->all());

        return response()->json(['success' => true]);
    }

    public function addGostRequest(Request $request)
    {
        // Валидация
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'gost' => 'required|string',
            'file' => 'required|file|max:20480|mimes:doc,docx',
        ]);

        // Сохранение файла
        $filePath = $request->file('file')->store('requests', 'public');
        $fileUrl = Storage::disk('public')->url($filePath);

        $tgMessage = "
            <b>ToGOST. Заявка.</b>\n
            <b>Имя:</b> $request->name\n
            <b>Способ связи:</b> $request->contact\n
            <b>ГОСТ:</b> $request->gost\n
            <b>Ссылка на файл:</b> $fileUrl\n
        ";

        // Отправка в Телеграм
        $this->sendToTelegram($tgMessage);

        // Отправка в Firebase
        $this->saveToFirebase('toGostRequests', array_merge($request->all(), ['file' => $fileUrl]));

        return response()->json(['success' => true]);
    }

    public function addGentRequest(Request $request)
    {
        // Валидация
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'weight' => 'required|numeric|min:30|max:300', // кг
            'height' => 'required|numeric|min:100|max:250', // см
            'age' => 'required|integer|min:18|max:100',
            'activity' => 'required|numeric|min:1.2|max:2.5',
            'diet' => 'nullable|string|max:1024',
            'expenses' => 'nullable|numeric',
        ]);

        $tgMessage = "
            <b>BeGent. Заявка. $request->service</b>\n
            <b>Имя:</b> $request->name\n
            <b>Цена:</b> $request->price\n
        ";
        if ($request->diet) {
            $tgMessage .= "<b>Питание:</b> $request->diet\n";
        }

        // Отправка в Телеграм
        $this->sendToTelegram($tgMessage);

        // Отправка в Firebase
        $this->saveToFirebase('beGentRequests', $request->all());

        // Расчет по формуле Миффлина-Сан Жеора
        if ($data['gender'] === 'male') {
            $bmr = (10 * $data['weight']) + (6.25 * $data['height']) - (5 * $data['age']) + 5;
        } else {
            $bmr = (10 * $data['weight']) + (6.25 * $data['height']) - (5 * $data['age']) - 161;
        }

        $totalCalories = round($bmr * $data['activity']);

        // Генерация PDF
        $pdf = PDF::loadView('pdf.begent', [
            'bmr' => round($bmr),
            'totalCalories' => $totalCalories,
        ]);

        return $pdf->download('be-gent.pdf');
    }

    private function sendToTelegram(string $message): void
    {
        $client = new Client();
        $tgToken = env('TELEGRAM_BOT_TOKEN', '');
        $tgChatId = env('TELEGRAM_CHAT_ID', '');

        if (!$tgToken || !$tgChatId) {
            Log::error('Отсутствует конфигурация telegram!');
            return;
        }

        $client->post("https://api.telegram.org/bot$tgToken/sendMessage", [
            'form_params' => [
                'chat_id' => $tgChatId,
                'text' => $message,
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => false,
            ]
        ]);

        Log::info('Message sent to Telegram', ['message' => $message]);
    }

    private function saveToFirebase(string $table, array $data)
    {
        $firebase = (new Factory)
            ->withServiceAccount(config('firebase'))
            ->withDatabaseUri('https://arvelov-1f937-default-rtdb.europe-west1.firebasedatabase.app');

        $database = $firebase->createDatabase();
        $result = $database->getReference($table)->push(array_merge($data, ['timestamp' => time()]));
        Log::info('Data saved to Firebase', ['key' => $result->getKey()]);
    }
}
