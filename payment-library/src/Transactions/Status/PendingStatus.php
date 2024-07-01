<?php

namespace PaymentLibrary\Transactions\Status;

use PaymentLibrary\Interfaces\TransactionStatusInterface;
use PaymentLibrary\Transactions\Transaction;
use PaymentLibrary\Transactions\Status\SuccessStatus;

class PendingStatus implements TransactionStatusInterface{

    public function next(Transaction $transaction): void {
        $transaction->setStatus(new SuccessStatus());
    }

    public function prev(Transaction $transaction): void {
        // Logic for moving to the previous state if applicable
    }
}