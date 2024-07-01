<?php

namespace PaymentLibrary\PaymentGateways;

use PaymentLibrary\Interfaces\PaymentGatewayInterface;
use PaymentLibrary\Interfaces\TransactionStatusInterface;
use PaymentLibrary\Transactions\Status\CancelledStatus;
use PaymentLibrary\Transactions\Status\SuccessStatus;
use PaymentLibrary\Transactions\Transaction;

class PaypalGateway implements PaymentGatewayInterface{
    private $credentials;
    private $api_key;

    public function __construct(array $credentials) {
        $this->credentials = $credentials;
        $this->api_key = $credentials["API_KEY"];
    }

    public function createTransaction(float $amount, string $currency, string $description): Transaction {
        return new Transaction($amount, $currency, $description);
    }
    public function executeTransaction(Transaction $transaction): void {
        // Code pour exécuter la transaction via l'API paypal
        $transaction->setStatus(new SuccessStatus());
        
    }
    public function cancelTransaction(Transaction $transaction): void {
        // Code pour annuler la transaction via l'API paypal
        $transaction->setStatus(new CancelledStatus());
    }
    public function getTransactionStatus(Transaction $transaction): TransactionStatusInterface {
        return $transaction->getStatus();
    }
}