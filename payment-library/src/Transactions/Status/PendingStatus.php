<?php

namespace PaymentLibrary\Transactions\Status;

use PaymentLibrary\Interfaces\TransactionStatusInterface;
use PaymentLibrary\Transactions\Transaction;
use PaymentLibrary\Transactions\Status\SuccessStatus;

class PendingStatus implements TransactionStatusInterface{
    private $transactionId;
    private $paymentMethod;

    public function setTransactionId(string $transactionId): self {
        $this->transactionId = $transactionId;
        return $this;
    }

    public function getTransactionId(): string {
        return $this->transactionId;
    }

    public function setPaymentMethod(string $paymentMethod): self {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getPaymentMethod(): string {
        return $this->paymentMethod;
    }

    public function getStatus(): string {
        return 'pending';
    }


    public function next(Transaction $transaction): void {
        $transaction->setStatus(new SuccessStatus());
    }

    public function prev(Transaction $transaction): void {
        // Logic for moving to the previous state if applicable
    }
}