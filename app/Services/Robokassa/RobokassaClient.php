<?php

namespace App\Services\Robokassa;
use App\Helpers\PaymentServiceHelper;
use App\Services\Robokassa\Contracts\ClientContract;
use \Illuminate\Support\Facades\Http;

class RobokassaClient implements ClientContract
{
    public function connect(array $body) {
        $merchantLogin = config('robokassa.login');
        $body['OutSum'] = strval($body['OutSum']);
        $params = ['MerchantLogin' => $merchantLogin, 'OutSum' => $body['OutSum'], 'InvId' => $body['InvId'], 'password' => config('robokassa.test_password1')];
        
        $signatureValue = PaymentServiceHelper::getHashValue($params);

        $response = Http::withHeaders(['Content-Type' => 'application/x-www-form-urlencoded'])->asForm()->post(
            config('robokassa.url'), 
            $body +['MerchantLogin' => $merchantLogin, 'SignatureValue' => $signatureValue, 'IsTest' =>config('robokassa.is_test')]
        );

        if ($response['errorCode'] !== 0) {
            return 'fail';
        }

        return config('robokassa.payment_url').$response['invoiceID'];
    }
} 