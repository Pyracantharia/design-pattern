<?php

namespace Paydapter\Paydapter\Transactions\Status;

use Paydapter\Paydapter\Interfaces\TransactionStatusInterface;
use Paydapter\Paydapter\Transactions\Transaction;
use Paydapter\Paydapter\Transactions\Status\PendingStatus;

class SuccessStatus implements TransactionStatusInterface{
    
    public function next(Transaction $transaction): void {
        //already in final state
    }

    public function prev(Transaction $transaction): void {
        $transaction->setStatus(new PendingStatus());
    }
}