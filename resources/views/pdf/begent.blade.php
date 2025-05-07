<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .result { font-size: 24px; color: #2B6CB0; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td { padding: 10px; border: 1px solid #E2E8F0; }
    </style>
</head>
<body>
<div class="header">
    <h1>Ваш персональный расчет</h1>
    <p>Сервис BeGent</p>
</div>

<h2>Результаты расчета:</h2>

<table>
    <tr>
        <td>Формула</td>
        <td>Миффлина-Сан Жеора</td>
    </tr>
    <tr>
        <td>Базовый метаболизм</td>
        <td class="result">{{ $bmr }} ккал/день</td>
    </tr>
    <tr>
        <td>С учетом активности</td>
        <td>{{ $totalCalories }} ккал/день</td>
    </tr>
</table>

<div class="recommendations" style="margin-top: 30px;">
    <h3>Рекомендации:</h3>
    <p>Для здорового похудения рекомендуется дефицит 15-20% от общей калорийности</p>
</div>
</body>
</html>
