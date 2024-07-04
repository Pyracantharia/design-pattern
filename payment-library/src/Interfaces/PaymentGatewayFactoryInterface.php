<?php

namespace PaymentLibrary\Interfaces;

interface PaymentGatewayFactoryInterface {
    public function create(array $config): PaymentGatewayInterface;
}
