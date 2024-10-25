<?php

namespace App\Helpers;

class PaymentServiceHelper 
{
    public static function getHashValue(array $params, $merchantLogin = null) : string {
        if ($merchantLogin !== null) {
            return md5($merchantLogin.':'.$params['OutSum'].':'.$params['InvId'].':'.$params['password']);
        }
        
        return md5($params['OutSum'].':'.$params['InvId'].':'.$params['password']);
    }
}
