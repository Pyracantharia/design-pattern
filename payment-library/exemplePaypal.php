<?php
require 'vendor/autoload.php';

use PaymentLibrary\PaymentGateways\PayPalPaymentGateway;

$paypal = new PayPalPaymentGateway();
$paypal->initialize(['api_key' => 'your_paypal_api_key']);

$transaction = $paypal->createTransaction(100.0, 'USD', 'Test Payment');
$result = $paypal->executeTransaction($transaction);

print_r($result);
