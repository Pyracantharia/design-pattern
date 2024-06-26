<?php

use PHPUnit\Framework\TestCase;
use PaymentLibrary\PaymentGateways\ExamplePaymentGateway;

class ExamplePaymentGatewayTest extends TestCase
{
    protected ExamplePaymentGateway $gateway;

    protected function setUp(): void
    {
        $this->gateway = new ExamplePaymentGateway();
        $this->gateway->initialize(['api_key' => 'test_api_key']);
    }

    public function testCreateTransaction()
    {
        $transaction = $this->gateway->createTransaction(100.0, 'USD', 'Test Payment');
        $this->assertArrayHasKey('transactionId', $transaction);
    }

    public function testExecuteTransaction()
    {
        $transactionDetails = ['transactionId' => 'example_txn_12345'];
        $result = $this->gateway->executeTransaction($transactionDetails);
        $this->assertEquals('success', $result['status']);
    }

    public function testCancelTransaction()
    {
        $result = $this->gateway->cancelTransaction('example_txn_12345');
        $this->assertEquals('canceled', $result['status']);
    }

    public function testGetTransactionStatus()
    {
        $result = $this->gateway->getTransactionStatus('example_txn_12345');
        $this->assertEquals('success', $result['status']);
    }
}
?>
