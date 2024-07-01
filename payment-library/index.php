<?php

use PaymentLibrary\Core\Utils;
use PaymentLibrary\Factories\StripeGatewayFactory;

require_once "./vendor/autoload.php";

$stripeFactory = new StripeGatewayFactory();
$stripe = $stripeFactory->createPaymentGateway(["API_KEY" => Utils::env("API_KEY")]); //Renseigner sa clé d'API dans le .env
$stripeTransaction = $stripe->createTransaction(0.50, "EUR", "test");
$stripe->executeTransaction($stripeTransaction);