<?php

namespace Paydapter\Paydapter\Transactions\Status;

use Paydapter\Paydapter\Interfaces\TransactionStatusInterface;
use Paydapter\Paydapter\Transactions\Transaction;
use Paydapter\Paydapter\Transactions\Status\SuccessStatus;

class PendingStatus implements TransactionStatusInterface{

    public function next(Transaction $transaction): void {
        $transaction->setStatus(new SuccessStatus());
    }

    public function prev(Transaction $transaction): void {
        // Logic for moving to the previous state if applicable
    }
}