<?php

namespace Paydapter\Paydapter\Interfaces;

use Paydapter\Paydapter\Transactions\Transaction;

interface PaymentGatewayInterface{
    public function initialize(array $credentials): void;
    public function createTransaction(float $amount, string $currency, string $description): Transaction;
    public function executeTransaction(Transaction $transaction): array;
    public function cancelTransaction(Transaction $transaction): bool;
    public function getTransactionStatus(Transaction $transaction): TransactionStatusInterface;
}