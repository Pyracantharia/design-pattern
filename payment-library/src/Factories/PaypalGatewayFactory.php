<?php

namespace PaymentLibrary\Factories;

use PaymentLibrary\Interfaces\PaymentGatewayFactoryInterface;
use PaymentLibrary\Interfaces\PaymentGatewayInterface;
use PaymentLibrary\PaymentGateways\PaypalGateway;
use PaymentLibrary\Transactions\Status\PendingStatus;
use PaymentLibrary\Interfaces\TransactionStatusInterface;



class PaypalGatewayFactory implements PaymentGatewayFactoryInterface
{
    public function create(array $config): PaymentGatewayInterface
    {

        return new PaypalGateway($config);
    }
    public function executeTransaction($transaction): TransactionStatusInterface
    {
        // Implement transaction execution logic here
        // Simulate a pending status for now
        $transactionStatus = new PendingStatus();
        $transactionStatus->setTransactionId('TX123456789'); // Set a transaction ID
        $transactionStatus->setPaymentMethod('PayPal'); // Set the payment method
        return $transactionStatus;
    }
}


