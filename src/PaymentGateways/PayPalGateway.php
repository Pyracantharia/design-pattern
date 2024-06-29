<?php

namespace Paydapter\Paydapter\PaymentGateways;

use Paydapter\Paydapter\Interfaces\PaymentGatewayInterface;
use Paydapter\Paydapter\Transactions\Status\CancelledStatus;
use Paydapter\Paydapter\Transactions\Status\SuccessStatus;
use Paydapter\Paydapter\Transactions\Transaction;

class PaypalGateway implements PaymentGatewayInterface{
    private $credentials;

    public function __construct() {
        
    }
    
    public function initialize(array $credentials): void {
        $this->credentials = $credentials;
    }
    public function createTransaction(float $amount, string $currency, string $description): Transaction {
        return new Transaction($amount, $currency, $description);
    }
    public function executeTransaction(Transaction $transaction): array {
        // Code pour exécuter la transaction via l'API paypal
        $transaction->setStatus(new SuccessStatus());
        return ['status' => 'success', 'transaction_id' => $transaction->getId()];
    }
    public function cancelTransaction(Transaction $transaction): bool {
        // Code pour annuler la transaction via l'API paypal
        $transaction->setStatus(new CancelledStatus());
        return true;
    }
    public function getTransactionStatus(Transaction $transaction): string {
        return $transaction->getStatus();
    }
}