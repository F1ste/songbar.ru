<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Unetway\LaravelRobokassa\Robokassa;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        // Обработка запроса от Robokassa и сохранение платежа в базу данных
        $payment = Payment::create([
            'invoice_id' => $request->input('invoice_id'),
            'status' => $request->input('status'),
            'amount' => $request->input('amount'),
            'description' => $request->input('description'),
        ]);

        // Дополнительная логика, если необходимо

        return response()->json(['message' => 'Payment processed successfully'], 200);
    }

    public function success(Request $request)
    {
        // Получение параметров об оплате от Robokassa
        $order_number = $request->input('InvoiceID'); // или любой другой параметр, который используете для передачи уникального идентификатора заказа
        $amount = $request->input('OutSum'); // сумма оплаты
        // Другие необходимые параметры...

        // Поиск заказа в базе данных
        $order = Order::where('order_number', $order_number)->first();

        if ($order) {
            // Обновление статуса заказа или другая логика, связанная с успешной оплатой
            $order->status = 'paid';
            $order->save();

            // Редирект на страницу подтверждения заказа или благодарности за оплату
            return redirect()->route('order.success');
        } else {
            // Если заказ не найден, обработка ошибки
            return redirect()->route('order.fail')->with('error', 'Заказ не найден');
        }
    }

    public function fail(Request $request)
    {
        // Получение параметров об оплате от Robokassa
        $order_number = $request->input('InvoiceID'); // или другой параметр, используемый для передачи уникального идентификатора заказа

        // Поиск заказа в базе данных
        $order = Order::where('order_number', $order_number)->first();

        if ($order) {
            // Обновление статуса заказа или другая логика, связанная с неудачной оплатой
            $order->status = 'failed';
            $order->save();

            // Редирект на страницу с сообщением об ошибке или повторной попыткой оплаты
            return redirect()->route('order.fail')->with('error', 'Ошибка оплаты');
        } else {
            // Если заказ не найден, обработка ошибки
            return redirect()->route('order.fail')->with('error', 'Заказ не найден');
        }
    }

    public function index()
    {
        echo 'helloworld';
    }

    public function show($id)
    {
        // Показать информацию о платеже по его идентификатору
        $payment = Payment::findOrFail($id);

        return response()->json($payment, 200);
    }


    public function pay(Request $request, $order_id)
    {
        
        // Получение заказа по его уникальному идентификатору
        $order = Order::findOrFail($order_id);
        
        $robokassa = new Robokassa();

        $payment_link = $robokassa->generateLink([
            'OutSum' => $order->amount,
            'Description' => $order->description,
            'InvoiceID' => $order->order_number,
            'IsTest' => 1
            ]);       

        return redirect()->away($payment_link);
    }
}
