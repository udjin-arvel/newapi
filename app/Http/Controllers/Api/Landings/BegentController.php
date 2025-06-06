<?php

namespace App\Http\Controllers\Api\Landings;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Log;

/**
 * Class BegentController
 * @package App\Http\Controllers\Api\Landings
 */
class BegentController extends MainController
{
    public function __construct()
    {
        $this->rk_login     = config('services.robokassa.begent.login');
        $this->rk_password1 = config('services.robokassa.begent.password1');
        $this->rk_password2 = config('services.robokassa.begent.password2');
    }

    public function addRequest(Request $request)
    {
        // Валидация
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'weight' => 'required|numeric|min:30|max:300', // кг
            'height' => 'required|numeric|min:100|max:250', // см
            'age' => 'required|integer|min:18|max:100',
            'activity' => 'required|numeric|min:1.2|max:2.5',
            'activityTitle' => 'required',
            'price' => 'required',
            'nutritionOnly' => 'boolean',
            'contact' => 'nullable|string|max:255',
            'diet' => 'nullable|string|min:128|max:2048',
            'expenses' => 'nullable|string',
        ]);

        // Генерация уникального ID заказа
        $orderId = md5(time() . uniqid());

        // Отправка в Firebase
        $this->saveToFirebase("orders/{$this->rk_login}_{$orderId}", [
            'status' => 'pending',
            'created_at' => time(),
            'user_data' => $validated,
            'service' => $this->rk_login,
        ]);

        $paymentUrl = $this->generateRobokassaUrl($orderId, $validated['price'], 'Оплата заказа с сервиса BeGent');

        return response()->json([
            'order_id' => $orderId,
            'payment_url' => $paymentUrl,
        ]);
    }

    protected function getTelegramMessageByData($data): string
    {
        $message = "✅ Сервис BeGent. Успешная оплата!\n"
            . "💰 Сумма: {$data['user_data']['price']} руб.\n"
            . "👤 Клиент: {$data['user_data']['name']}\n"
            . "📧 Тариф: {$data['user_data']['service']}";

        if (!empty($data['user_data']['contact'])) {
            $message .= "\n📞 Способ связи: {$data['user_data']['contact']}";
        }
        if (!empty($data['user_data']['diet'])) {
            $message .= "\n📎 Рацион: {$data['user_data']['diet']}";
        }

        return $message;
    }

    public function generatePdf($orderId)
    {
        $firebase = $this->initFirebase();
        $db = $firebase->createDatabase();
        $orderData = $db->getReference("orders/{$this->rk_login}_{$orderId}")->getValue();

        // Проверяем наличие данных
        if (empty($orderData['user_data'])) {
            Log::error('Firebase order data not found! OrderId: ' . $orderId);
            return response()->json(['error' => 'Data not found'], 404);
        }

        // Проверяем статус оплаты
        if ($orderData['status'] !== 'completed') {
            return response()->json(['error' => 'Payment not completed'], 403);
        }

        $data = $orderData['user_data'];

        // Расчет по формуле Миффлина-Сан Жеора
        if ($data['gender'] === 'male') {
            $bmr = (10 * $data['weight']) + (6.25 * $data['height']) - (5 * $data['age']) + 5;
        } else {
            $bmr = (10 * $data['weight']) + (6.25 * $data['height']) - (5 * $data['age']) - 161;
        }

        $totalCalories = round($bmr * $data['activity']);
        $proteinsMin = round(1.5 * $data['weight']);
        $proteinsMax = round(2.5 * $data['weight']);
        $fatsMin = round(0.8 * $data['weight']);
        $fatsMax = $proteinsMin;
        $carbohydratesMin = round(($totalCalories - ($proteinsMax * 4 + $fatsMax * 9)) / 4);
        $carbohydratesMax = round(($totalCalories - ($proteinsMin * 4 + $fatsMin * 9)) / 4);
        $targetCalories = $data['nutritionOnly'] ? $totalCalories : $totalCalories - 500;

        // Генерация PDF
        $pdf = PDF::loadView('pdf.begent', array_merge([
            'bmr' => round($bmr),
            'totalCalories' => $totalCalories,
            'targetCalories' => $targetCalories,
            'proteinsMin' => $proteinsMin,
            'proteinsMax' => $proteinsMax,
            'fatsMin' => $fatsMin,
            'fatsMax' => $fatsMax,
            'carbohydratesMin' => $carbohydratesMin,
            'carbohydratesMax' => $carbohydratesMax,
            'oneIngestion' => round($targetCalories / 3),
        ], $data));

        return $pdf->download("be-gent-{$orderId}.pdf");
    }
}
