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



class PaypalGateway implements PaymentGatewayInterface
{
    private $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    public function createTransaction($amount, $currency, $description)
    {
        // Implement transaction creation logic here
        return [
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'status' => 'pending'
        ];
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

    public function cancelTransaction($transactionId)
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->config['client_id'],
                $this->config['client_secret']
            )
        );

        $payment = new \PayPal\Api\Payment();
        $payment->setId($transactionId);

        try {
            $payment->cancel($apiContext);
            return true;
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            return false;
        }
    }
    public function getTransactions()
    {
    }
    public function testEcho()
    {
        echo "Test echo from PaypalGateway";
    }
}
