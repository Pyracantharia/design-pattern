<?php

namespace PaymentLibrary\PaymentGateways;

class ExamplePaymentGateway extends AbstractPaymentGateway
{
    public function initialize(array $config): void
    {
        $this->apiKey = $config['api_key'];
    }

    public function createTransaction(float $amount, string $currency, string $description): array
    {
        return ['transactionId' => 'example_txn_12345'];
    }

    public function executeTransaction(array $transactionDetails): array
    {
        return ['status' => 'success'];
    }

    public function cancelTransaction(string $transactionId): array
    {
        return ['status' => 'canceled'];
    }

    public function getTransactionStatus(string $transactionId): array
    {
        return ['status' => 'success'];
    }
}
?>
