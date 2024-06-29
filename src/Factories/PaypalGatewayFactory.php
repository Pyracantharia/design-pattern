<?php

namespace Paydapter\Paydapter\Factories;

use Paydapter\Paydapter\Interfaces\PaymentGatewayFactoryInterface;
use Paydapter\Paydapter\Interfaces\PaymentGatewayInterface;
use Paydapter\Paydapter\PaymentGateways\PaypalGateway;

class paypalGatewayFactory implements PaymentGatewayFactoryInterface{
    public function createPaymentGateway(array $credentials): PaymentGatewayInterface{
        return new PaypalGateway($credentials);
    }
}