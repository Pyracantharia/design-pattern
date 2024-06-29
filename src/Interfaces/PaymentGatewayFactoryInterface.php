<?php

namespace Paydapter\Paydapter\Interfaces;

interface PaymentGatewayFactoryInterface{
    public function createPaymentGateway(): PaymentGatewayInterface;
}