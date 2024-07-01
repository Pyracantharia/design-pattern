<?php

namespace PaymentLibrary;

use PaymentLibrary\Interfaces\PaymentGatewayInterface;

class PaymentGatewayManager
{
    protected $gateways = [];

    public function addGateway(string $name, PaymentGatewayInterface $gateway): void
    {
        $this->gateways[$name] = $gateway;
    }

    public function removeGateway(string $name): void
    {
        unset($this->gateways[$name]);
    }

    public function getGateway(string $name): ?PaymentGatewayInterface
    {
        return $this->gateways[$name] ?? null;
    }

    
}
?>
