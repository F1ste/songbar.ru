<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\PaymentServiceHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\SuccessPayRequest;
use App\Models\Order;
use App\Services\Robokassa\RobokassaService;
use Auth;
use Carbon\Carbon;


class PaymentController extends Controller
{
    public function __construct(private RobokassaService $service) {
        
    }

    public function pay(PaymentRequest $request) {
        $order = Order::create($request->except('role')+['user_id' => Auth::user()->id]);

        $resultPay = $this->service->makePay($request->amount, $order->description, $order->id);

        if ($resultPay === 'fail') {
            return redirect()->route('payment.fail');
        }

        if ($resultPay !== 'fail') {
            $order->update(['status' => 'pending']);
            return redirect()->away($resultPay);
        }
        
        $order->update(['status' => 'fail']);
        return;
    }

    public function resultPay(SuccessPayRequest $request){
        $params = ['OutSum' => $request->OutSum, 'InvId' => $request->InvId, 'password' => config('robokassa.password2')];

        $signatureValue = PaymentServiceHelper::getHashValue($params);

        if (strtolower($signatureValue) !== strtolower($request->SignatureValue)) {
            return redirect()->route('payment.fail');
        }

        $order = Order::find($request->InvId);

        if ($order->status === 'success') {
            return redirect()->route('payment.fail');
        }

        $order->update(['status' => 'success']);

        $description = explode('/', $order->description);

        $role = strtolower($description[0]);
        

        $user = $order->user;

        $user->assignRole($role);

        if ($description[1] === 'Месяц') {
            $user->tarifs()->create([
                'tarif_name' => $role,
                'tarif_start' => Carbon::now(),
                'tarif_end' => Carbon::now()->addMonth(),
            ]);
        }

        if ($description[1] === '12Месяц') {
            $user->tarifs()->create([
                'tarif_name' => $role,
                'tarif_start' => Carbon::now(),
                'tarif_end' => Carbon::now()->addYear(),
            ]);
        }

        return 'OK'.$request->InvId;
    }

    public function successPay() {
        
        return view('success_payment');
    }

    public function failPay() {
        
        return view('fail_payment');
    }
}
