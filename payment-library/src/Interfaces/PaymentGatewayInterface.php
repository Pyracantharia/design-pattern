<?php

namespace PaymentLibrary\Interfaces;

interface PaymentGatewayInterface {
    public function createTransaction($amount, $currency, $description);
    public function executeTransaction($transaction);
}
