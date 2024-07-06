<?php

namespace PaymentLibrary\Interfaces;

interface PaymentGatewayFactoryInterface{
    public function createPaymentGateway(string $name, array $credentials): PaymentGatewayInterface;
   
    // pour faire marche paypal  public function create(array $credentials): PaymentGatewayInterface;
}
