<?php

namespace Paydapter\Paydapter\Transactions;

use Paydapter\Paydapter\Interfaces\TransactionStatusInterface;

class Transaction {
    private $id;
    private $amount;
    private $currency;
    private $description;
    private $status;

    public function __construct(float $amount, string $currency, string $description) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->description = $description;
        $this->status = 'pending';
    }

    public function getId(){
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getAmount(){
        return $this->amount;
    }

    public function setAmount(float $amount){
       $this->amount = $amount;
    }

    public function getCurrency(){
        return $this->currency;
    }

    public function setCurrency(string $currency){
        $this->currency = $currency;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus(TransactionStatusInterface $status){
        $this->status = $status;
    }
}