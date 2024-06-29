<?php

use Paydapter\Paydapter\Factories\StripeGatewayFactory;

require_once "./vendor/autoload.php";

$stripeFactory = new StripeGatewayFactory();
$stripe = $stripeFactory->createPaymentGateway(["API_KEY" => "secret_api_key"]); //remplacer secret_api_key par la vrai clé d'API sur son compte stripe
$stripeTransaction = $stripe->createTransaction(0.50, "EUR", "test");
echo $stripeTransaction->getId();
$stripe->executeTransaction($stripeTransaction);