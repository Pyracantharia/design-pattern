<?php

use Paydapter\Paydapter\Factories\StripeGatewayFactory;

require_once "./vendor/autoload.php";

$stripeFactory = new StripeGatewayFactory();
$stripe = $stripeFactory->createPaymentGateway();
$stripe->initialize(["name" => "Jonathan"]);
$stripeTransaction = $stripe->createTransaction(10.50, "euros", "test");