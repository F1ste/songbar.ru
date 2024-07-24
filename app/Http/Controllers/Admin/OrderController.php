<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        // Получение суммы из запроса
        $amount = $request->input('amount');
        $description = $request->input('description');
        $user_id = Auth::id();

        // Если сумма не указана, использовать значение по умолчанию
        if (!$amount) {
            $amount = 1; // Здесь можно использовать любую другую сумму по умолчанию
        }

        // Создание уникального идентификатора заказа
        $order_number = Str::uuid();

        // Сохранение заказа в базе данных
        $order = new Order();
        $order->user_id = $user_id;
        $order->order_number= $order_number;
        $order->description= $description;
        $order->amount = $amount; // Сохранение суммы в заказе
        $order->save();

        // Формирование ссылки на оплату через Robokassa
        $payment_link = route('payment', ['order_id' => $order->id]);

       // Перенаправление пользователя на страницу оплаты
       return redirect()->away($payment_link);
    }
}
