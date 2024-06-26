<?php

namespace PaymentLibrary\PaymentGateways;

abstract class AbstractPaymentGateway
{
    protected string $apiKey;

    abstract public function initialize(array $config): void;

    abstract public function createTransaction(float $amount, string $currency, string $description): array;

    abstract public function executeTransaction(array $transactionDetails): array;

    abstract public function cancelTransaction(string $transactionId): array;

    abstract public function getTransactionStatus(string $transactionId): array;
}
?>
