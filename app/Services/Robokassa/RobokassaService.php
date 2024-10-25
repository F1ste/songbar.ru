<?php

namespace App\Services\Robokassa;
use App\Services\Robokassa\Contracts\ServiceContract;

class RobokassaService implements ServiceContract
{
    public function __construct(private RobokassaClient $client) {
        
    }

    public function makePay(float $outSum, string $description, int $invId): string {
        $body = ['OutSum' => $outSum, 'Description' => $description, 'InvId' => $invId];
        $response = $this->client->connect($body);

        return $response;
    }
}