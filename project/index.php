<?php
require_once "./../payment-library/vendor/autoload.php";
use PaymentLibrary\Factories\PaymentGatewayFactory;

$factory = new PaymentGatewayFactory();
$stripeGateway = $factory->createPaymentGateway("stripe", ["API_KEY" => "test"]);
var_dump($stripeGateway);