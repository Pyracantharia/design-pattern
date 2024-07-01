<?php

namespace PaymentLibrary\Factories;

use PaymentLibrary\Interfaces\PaymentGatewayFactoryInterface;
use PaymentLibrary\Interfaces\PaymentGatewayInterface;
use PaymentLibrary\PaymentGateways\PaypalGateway;

class paypalGatewayFactory implements PaymentGatewayFactoryInterface{
    public function createPaymentGateway(array $credentials): PaymentGatewayInterface{
        return new PaypalGateway($credentials);
    }
}