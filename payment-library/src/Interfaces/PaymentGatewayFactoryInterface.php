<?php

namespace PaymentLibrary\Interfaces;

interface PaymentGatewayFactoryInterface{
    public function createPaymentGateway(array $credentials): PaymentGatewayInterface;
}