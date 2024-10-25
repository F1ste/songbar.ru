<?php

namespace App\Services\Robokassa\Contracts;

interface ClientContract
{
    public function connect(array $body);
}