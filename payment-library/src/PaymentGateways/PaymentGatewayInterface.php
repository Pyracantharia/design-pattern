<?php

namespace PaymentLibrary\PaymentGateways;

interface PaymentGatewayInterface
{
    public function initialize(array $config): void;
    public function createTransaction(float $amount, string $currency, string $description): array;
    public function executeTransaction(array $transactionDetails): array;
    public function cancelTransaction(string $transactionId): array;
    public function getTransactionStatus(string $transactionId): array;
}
