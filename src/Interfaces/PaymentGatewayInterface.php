<?php

namespace Paydapter\Paydapter\Interfaces;

use Paydapter\Paydapter\Transactions\Transaction;

interface PaymentGatewayInterface{
    public function createTransaction(float $amount, string $currency, string $description): Transaction;
    public function executeTransaction(Transaction $transaction): void;
    public function cancelTransaction(Transaction $transaction): void;
    public function getTransactionStatus(Transaction $transaction): TransactionStatusInterface;
}