<?php

namespace Paydapter\Paydapter\Interfaces;

use Paydapter\Paydapter\Transactions\Transaction;
//use State pattern
interface TransactionStatusInterface{
    public function next(Transaction $transaction): void;
    public function prev(Transaction $transaction): void;
}