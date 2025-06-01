<?php

namespace App\Http\Controllers\Api\Landings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class TogostController
 * @package App\Http\Controllers\Api
 */
class TogostController extends MainController
{
    public function __construct()
    {
        $this->rk_login     = config('services.robokassa.togost.login');
        $this->rk_password1 = config('services.robokassa.togost.password1');
        $this->rk_password2 = config('services.robokassa.togost.password2');
    }

    public function addRequest(Request $request)
    {
        // Валидация
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'contact' => 'required|string|max:255',
            'gost' => 'required|string',
            'file' => 'required|file|max:20480|mimes:doc,docx',
        ]);

        // Сохранение файла
        $filePath = $request->file('file')->store('requests', 'public');
        $fileUrl = Storage::disk('public')->url($filePath);
        $orderId = md5(time() . uniqid());

        $paymentData = [
            'order_id' => $orderId,
            'status' => 'pending', // ожидает оплаты
            'user_data' => $validated,
            'amount' => 250, // сумма в копейках
            'file' => $fileUrl,
            'service' => $this->rk_login,
        ];

        // Отправка в Firebase
        $this->saveToFirebase("orders/{$this->rk_login}_{$orderId}", $paymentData);

        $paymentUrl = $this->generateRobokassaUrl($orderId, $paymentData['amount'], 'Оплата заказа с сервиса ToGOST');

        return response()->json([
            'order_id' => $orderId,
            'payment_url' => $paymentUrl
        ]);
    }

    protected function getTelegramMessageByData($data): string
    {
        return "✅ Сервис ToGOST. Успешная оплата!\n"
            . "💰 Сумма: {$data['amount']} руб.\n"
            . "👤 Клиент: {$data['user_data']['name']}\n"
            . "📞 Способ связи: {$data['user_data']['contact']}\n"
            . "📧 ГОСТ: {$data['user_data']['gost']}\n"
            . "📎 Файл: {$data['file']}";
    }
}
