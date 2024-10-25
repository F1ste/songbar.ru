<?php

namespace App\Helpers;

class PaymentServiceHelper 
{
    public static function getHashValue(array $params) : string {
        return md5($params['MerchantLogin'].':'.$params['OutSum'].':'.$params['InvId'].':'.$params['password']);
    }
}
