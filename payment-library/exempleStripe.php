<?php

require 'vendor/autoload.php';

use PaymentLibrary\PaymentGateways\StripePaymentGateway;

$stripe = new StripePaymentGateway();
$stripe->initialize(['api_key' => 'your_stripe_api_key']);

$transaction = $stripe->createTransaction(100.0, 'USD', 'Test Payment');
$result = $stripe->executeTransaction($transaction);

print_r($result);
