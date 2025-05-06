<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Kreait\Firebase\Factory;
use Log;

/**
 * Class MainLandingController
 * @package App\Http\Controllers\Api
 */
class MainLandingController extends Controller
{
    public function addCallbackRequest(Request $request)
    {
        // Валидация
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'gost' => 'required|string',
        ]);

        return response()->json(['success' => json_encode($request->all())]);

        // Отправка в Телеграм
        $this->sendToTelegram(
            $request->name,
            $request->contact,
            $request->gost,
        );

        // Отправка в Firebase
        $this->saveToFirebase(
            $request->name,
            $request->contact,
            $request->gost,
        );

        return response()->json(['success' => true]);
    }

    private function sendToTelegram($name, $contact, $gost)
    {
        $client = new Client();
        $message = "Новая заявка:\nИмя: $name\nКонтакт: $contact\nГОСТ: $gost\n";
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
            ]
        ]);
    }

    private function saveToFirebase($name, $contact, $gost)
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__.'/../../../config/firebase_credentials.json');

        $database = $firebase->createDatabase();

        $database->getReference('requests')
            ->push([
                'name' => $name,
                'contact' => $contact,
                'gost' => $gost,
                'timestamp' => time(),
            ]);
    }
}
