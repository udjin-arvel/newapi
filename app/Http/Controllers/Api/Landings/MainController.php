<?php

namespace App\Http\Controllers\Api\Landings;

use App\Http\Controllers\Controller;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Http\HttpClientOptions;
use Illuminate\Support\Facades\Http;
use Log;

/**
 * Class MainController
 * @package App\Http\Controllers\Api\Landings
 */
class MainController extends Controller
{
    protected $rk_login;

    protected $rk_password1;

    protected $rk_password2;

    public function addRequest(Request $request)
    {
        // Валидация
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'details' => 'nullable|string|max:255',
        ]);

        $message = "Заявка на обратую связь!\n"
            . "👤 Клиент: {$validated['name']}\n"
            . "📞 Телефон: {$validated['phone']}\n"
            . "📧 Коментарий: {$validated['details']}";

        // Отправка в Телеграм
        $this->sendToTelegram($message);

        // Генерация уникального ID заявки
        $requestId = md5(time() . uniqid());

        // Отправка в Firebase
        $this->saveToFirebase("requests/{$requestId}", $request->all());

        return response()->json(['success' => true]);
    }

    public function handleRobokassaWebhook(Request $request)
    {
        if (!$this->rk_password2) {
            Log::error('Invalid credentials data', $request->all());
            return response()->json(['error' => 'Invalid credentials data'], 401);
        }

        // Проверка подписи
        $signature = strtolower($request->SignatureValue);
        $validSignature = md5(
            $request->OutSum . ':' .
            $request->InvId . ':' .
            $this->rk_password2 . ':' .
            'shp_order_id=' . $request->shp_order_id
        );

        if ($signature !== $validSignature) {
            Log::error('Invalid Robokassa signature', $request->all());
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        // Извлечение order_id
        $orderId = $request->shp_order_id;

        // Обновление статуса в Firebase
        try {
            $firebase = $this->initFirebase();
            $db = $firebase->createDatabase();
            $ref = $db->getReference("orders/{$orderId}");

            // Проверяем существование записи
            if (!$ref->getSnapshot()->exists()) {
                Log::error('Payment record not found in Firebase', ['order_id' => $orderId]);
                return response()->json(['error' => 'Record not found'], 404);
            }

            // Обновляем статус
            $ref->update([
                'status' => 'completed',
                'paid_at' => time(),
                'robokassa_inv_id' => $request->InvId,
            ]);

            // Отправка уведомления в Telegram
            $this->sendToTelegram($this->getTelegramMessageByData($ref->getValue()));

            return response()->json(['OK' => $request->InvId]);

        } catch (\Exception $e) {
            Log::error('Error processing Robokassa webhook', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);

            return response()->json(['error' => 'Server error'], 500);
        }
    }

    protected function generateRobokassaUrl(string $orderId, int $amount, string $desc = ''): string
    {
        // Формирование подписи
        $signature = md5("{$this->rk_login}:{$amount}:0:{$this->rk_password1}:shp_order_id={$orderId}");

        $params = [
            'MerchantLogin' => $this->rk_login,
            'OutSum' => $amount,
            'InvId' => 0, // 0 - для автоматической генерации номера
            'Description' => $desc,
            'SignatureValue' => $signature,
            'shp_order_id' => $orderId,
            'Culture' => 'ru',
            'Encoding' => 'utf-8',
            'IsTest' => config('app.env') === 'production' ? 0 : 1,
        ];

        return 'https://auth.robokassa.ru/Merchant/Index.aspx?' . http_build_query($params);
    }

    protected function sendToTelegram(string $message): void
    {
        $botToken = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');

        $response = Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown'
        ]);

        if (!$response->successful()) {
            Log::error('Telegram notification failed', ['response' => $response->json()]);
        }
    }

    protected function getTelegramMessageByData($data): string
    {
        Log::info('The method for receiving a telegram message was not implemented: ', $data);
        return 'Warning! No implemented method!';
    }

    protected function saveToFirebase(string $table, array $data)
    {
        $firebase = $this->initFirebase();
        $database = $firebase->createDatabase();
        $result = $database->getReference($table)->set(array_merge($data, ['timestamp' => time()]));

        Log::info('Data saved to Firebase', ['key' => $result->getKey()]);

        return $result;
    }

    protected function initFirebase()
    {
        $httpClientOptions = HttpClientOptions::default()->withGuzzleConfigOption(RequestOptions::VERIFY, false);
        return (new Factory)
            ->withServiceAccount(config('firebase'))
            ->withDatabaseUri(config('firebase.database_url'))
            ->withHttpClientOptions($httpClientOptions);
    }
}
