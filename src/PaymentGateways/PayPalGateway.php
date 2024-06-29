<?php

namespace Paydapter\Paydapter\PaymentGateways;

use Paydapter\Paydapter\Interfaces\PaymentGatewayInterface;
use Paydapter\Paydapter\Interfaces\TransactionStatusInterface;
use Paydapter\Paydapter\Transactions\Status\CancelledStatus;
use Paydapter\Paydapter\Transactions\Status\SuccessStatus;
use Paydapter\Paydapter\Transactions\Transaction;

class PaypalGateway implements PaymentGatewayInterface{
    private $credentials;

    public function __construct() {
        
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