<?php

namespace App\Services\Robokassa\Contracts;

interface ServiceContract
{
    public function makePay(float $outSum, string $description, int $invId) : string;
}