<?php

use PHPUnit\Framework\TestCase;
use PaymentLibrary\PaymentGateways\PayPalPaymentGateway;
use PaymentLibrary\PaymentGateways\PayPalPaymentGatewayConcrete;

class PayPalPaymentGatewayTest extends TestCase
{
    protected $paypal;

    protected function setUp(): void
    {
        $paypalGateway = new PayPalPaymentGatewayConcrete();
        $this->paypal = $paypalGateway;
        $this->paypal->initialize(['api_key' => 'test_api_key']);
    }


    public function testCreateTransaction()
    {
        $gateway = new PayPalPaymentGatewayConcrete();

        $gateway->initialize(['api_key' => 'test_api_key']);

        $montant = 100.0;
        $devise = 'USD';
        $description = 'Transaction de test';

        $transaction = $gateway->createTransaction($montant, $devise, $description);

        $this->assertArrayHasKey('transaction_id', $transaction);
    }

    public function testExecuteTransaction()
    {
        $transactionDetails = ['transactionId' => 'paypal_txn_12345'];
        $result = $this->paypal->executeTransaction($transactionDetails);
        $this->assertEquals('success', $result['status']);
    }

    public function testCancelTransaction()
    {
        $result = $this->paypal->cancelTransaction('paypal_txn_12345');
        $this->assertEquals('canceled', $result['status']);
    }

    public function testGetTransactionStatus()
    {
        $result = $this->paypal->getTransactionStatus('paypal_txn_12345');
        $this->assertEquals('success', $result['status']);
    }
}
