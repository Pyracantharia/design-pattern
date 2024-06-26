<?php

use PHPUnit\Framework\TestCase;
use PaymentLibrary\PaymentGateways\StripePaymentGateway;

class StripePaymentGatewayTest extends TestCase
{
    public function testCreateTransaction()
    {
        $stripe = new StripePaymentGateway();
        $stripe->initialize(['api_key' => 'test_api_key']);

        $transaction = $stripe->createTransaction(100.0, 'USD', 'Test Payment');
        $this->assertArrayHasKey('transactionId', $transaction);
    }

    // on ajoutera au fur et à mesure les autres testscl

}
?>
