<?php

namespace PaymentLibrary;

use PaymentLibrary\Interfaces\PaymentGatewayFactoryInterface;
use PaymentLibrary\Interfaces\PaymentGatewayInterface;


class PaymentGatewayManager
{
    private $factories = [];

    public function registerFactory(string $name, PaymentGatewayFactoryInterface $factory)
    {
        $this->factories[$name] = $factory;
    }

    public function getGateway(string $name, array $config): PaymentGatewayInterface
    {
        if (!isset($this->factories[$name])) {
            throw new \Exception("Payment gateway factory for $name not found.");
        }
        return $this->factories[$name]->create($config);
    }

}