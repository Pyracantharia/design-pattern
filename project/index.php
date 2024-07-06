<?php
require_once "./../payment-library/vendor/autoload.php";

use PaymentLibrary\Core\Utils;
use PaymentLibrary\Factories\PaymentGatewayFactory;
use PaymentLibrary\Strategies\PaymentGatewayStrategy;

$factory = new PaymentGatewayFactory();
$paymentGateway = $factory->createPaymentGateway("stripe",["API_KEY" => Utils::env("API_KEY")]); //Renseigner sa clé d'API dans le .env
$paymentStrategy = new PaymentGatewayStrategy($paymentGateway);
//essayer d'implémenter des services tiers avec observer
$transaction = $paymentStrategy->createTransaction(0.50, "EUR", "test");
$paymentStrategy->executeTransaction($transaction);