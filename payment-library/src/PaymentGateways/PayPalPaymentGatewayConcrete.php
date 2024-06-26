<?php

namespace PaymentLibrary\PaymentGateways;

use PaymentLibrary\PaymentGateways\PaymentGatewayInterface;

class PayPalPaymentGatewayConcrete extends PayPalPaymentGateway implements PaymentGatewayInterface
{
    protected $api_key;

    public function generate_transaction_id()
    {
        return 'txn_' . uniqid();
    }

    public function initialize(array $config): void
    {
        $this->api_key = $config['api_key'];
    }

    public function createTransaction(float $amount, string $currency, string $description): array
    {
        $transactionId = $this->generate_transaction_id();
        return ['transaction_id' => $transactionId];
    }

    public function executeTransaction(array $transactionDetails): array
    {
        return [
            'transaction_id' => $transactionDetails['transaction_id'],
            'status' => 'success',
            'transaction_details' => $transactionDetails,
        ];
    }

    public function cancelTransaction(string $transactionId): array
    {
        return [
            'transaction_id' => $transactionId,
            'status' => 'canceled',
        ];
    }

    public function getTransactionStatus(string $transactionId): array
    {
        return [
            'transaction_id' => $transactionId,
            'status' => 'success',
        ];
    }
}
