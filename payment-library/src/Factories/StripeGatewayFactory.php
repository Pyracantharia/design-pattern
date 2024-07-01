<?php

namespace PaymentLibrary\Factories;

use PaymentLibrary\Interfaces\PaymentGatewayFactoryInterface;
use PaymentLibrary\Interfaces\PaymentGatewayInterface;
use PaymentLibrary\PaymentGateways\StripeGateway;

class StripeGatewayFactory implements PaymentGatewayFactoryInterface{
    public function createPaymentGateway(array $credentials): PaymentGatewayInterface{
        return new StripeGateway($credentials);
    }
}