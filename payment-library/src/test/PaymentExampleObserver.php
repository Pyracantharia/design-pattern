
<?php 


use PaymentLibrary\Core\Utils;
use PaymentLibrary\Factories\PaymentGatewayFactory;
use PaymentLibrary\Strategies\PaymentGatewayStrategy;
use Test\Observers\BillingServiceObserver;


require_once "../../vendor/autoload.php";



$factory = new PaymentGatewayFactory();
$paymentGateway = $factory->createPaymentGateway("stripe",["API_KEY" => Utils::env("API_KEY")]); //Renseigner sa clé d'API dans le .env
$paymentStrategy = new PaymentGatewayStrategy($paymentGateway);
//essayer d'implémenter des services tiers avec observer
$billingservice = new BillingServiceObserver();
$transaction = $paymentStrategy->createTransaction(0.50, "EUR", "test");

$transaction->attach($billingservice);
$paymentStrategy->executeTransaction($transaction);