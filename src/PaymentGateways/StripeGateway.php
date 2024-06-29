<?php

namespace Paydapter\Paydapter\PaymentGateways;

use Paydapter\Paydapter\Interfaces\PaymentGatewayInterface;
use Paydapter\Paydapter\Interfaces\TransactionStatusInterface;
use Paydapter\Paydapter\Transactions\Status\CancelledStatus;
use Paydapter\Paydapter\Transactions\Status\SuccessStatus;
use Paydapter\Paydapter\Transactions\Transaction;

class StripeGateway implements PaymentGatewayInterface{
    private $credentials;
    public function __construct()
    {
    }
    
    public function initialize(array $credentials): void {
        $this->credentials = $credentials;
    }
    public function createTransaction(float $amount, string $currency, string $description): Transaction {
        return new Transaction($amount, $currency, $description);
    }
    public function executeTransaction(Transaction $transaction): array {
        // Code pour exécuter la transaction via l'API Stripe
        $key = $this->credentials["API_KEY"];
        $stripeClient = new \Stripe\StripeClient($key);
        $transaction->setId(1);
        echo "{$transaction->getAmount()}, {$transaction->getCurrency()}";
        $transaction->setStatus(new SuccessStatus());
        return ['status' => 'success', 'transaction_id' => $transaction->getId()];
    }
    public function cancelTransaction(Transaction $transaction): bool {
        // Code pour annuler la transaction via l'API Stripe
        $transaction->setStatus(new CancelledStatus());
        return true;
    }
    public function getTransactionStatus(Transaction $transaction): TransactionStatusInterface {
        return $transaction->getStatus();
    }

    public function getCredentials(){
        return $this->credentials;
    }

    public function showCredentials(){
        $credentials = $this->getCredentials();

        foreach ($credentials as $credentialkey => $credentialValue) {
            echo "$credentialkey => $credentialValue\n";
        }
    }
}