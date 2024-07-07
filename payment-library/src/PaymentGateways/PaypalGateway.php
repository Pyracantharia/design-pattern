<?php

namespace PaymentLibrary\PaymentGateways;

use PaymentLibrary\Interfaces\PaymentGatewayInterface;
use PaymentLibrary\Interfaces\TransactionStatusInterface;
use PaymentLibrary\Transactions\Status\PendingStatus;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payment as PaypalPayment;
use PaymentLibrary\Core\Utils;
use Exception;
use PaymentLibrary\Transactions\Status\SuccessStatus;
use PaymentLibrary\Transactions\Transaction;

class PaypalGateway implements PaymentGatewayInterface
{
    private $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    public function createTransaction($amount, $currency, $description): Transaction
    {
        $transaction = new Transaction($amount, $currency, $description);
        return $transaction;
    }

    public function executeTransaction(Transaction $transaction): void
    {
        // Implement transaction execution logic here
        // Simulate a pending status for now
       $transaction->setStatus(new SuccessStatus());
    }

    public function cancelTransaction(Transaction $transaction): void
    {
        // $apiContext = new \PayPal\Rest\ApiContext(
        //     new \PayPal\Auth\OAuthTokenCredential(
        //         $this->credentials['client_id'],
        //         $this->credentials['client_secret']
        //     )
        // );
 
        // $payment = new \PayPal\Api\Payment();
        // $payment->setId($transactionId);

        // try {
        //     $payment->cancel($apiContext);
        //     return true;
        // } catch (\PayPal\Exception\PayPalConnectionException $ex) {
        //     return false;
        // }
    }

    public function getTransactionStatus(Transaction $transaction): TransactionStatusInterface
    {
        return $transaction->getStatus();
    }
}
