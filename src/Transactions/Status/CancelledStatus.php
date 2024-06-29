<?php

namespace Paydapter\Paydapter\Transactions\Status;

use Paydapter\Paydapter\Interfaces\TransactionStatusInterface;
use Paydapter\Paydapter\Transactions\Transaction;
use Paydapter\Paydapter\Transactions\Status\SuccessStatus;

class CancelledStatus implements TransactionStatusInterface{

    public function next(Transaction $transaction): void {
        $transaction->setStatus(new FailedStatus());
    }

    public function prev(Transaction $transaction): void {
        $transaction->setStatus(new PendingStatus());
    }
}