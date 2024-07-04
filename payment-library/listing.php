<?php
require_once "./vendor/autoload.php";

use PaymentLibrary\PaymentGatewayManager;
use PaymentLibrary\PaymentGateways\PaypalGateway;
use PaymentLibrary\PaymentGateways\StripeGateway;
use PaymentLibrary\Factories\PaypalGatewayFactory;
use PaymentLibrary\Factories\StripeGatewayFactory;

$paymentGatewayManager = new PaymentGatewayManager();
$paypalGateway = new PaypalGateway([
    'client_id' => 'YOUR_CLIENT_ID',
    'client_secret' => 'YOUR_CLIENT_SECRET',
]);

$paypalFactory = new PaypalGatewayFactory();
$stripeFactory = new StripeGatewayFactory();

$paymentGatewayManager->registerFactory('paypal', $paypalFactory);
$paymentGatewayManager->registerFactory('stripe', $stripeFactory);

$gateways = ['paypal', 'tripe'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Listing</title>
</head>
<body>
    <h1>Transaction Listing</h1>
    <table>
        <thead>
            <tr>
                <th>Gateway</th>
                <th>Transaction ID</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gateways as $gateway):?>
                <?php
                $paymentGateway = $paymentGatewayManager->getGateway($gateway, []);
                $transactions = $paymentGateway->getTransactions();
                foreach ($transactions as $transaction) {
                   ?>
                    <tr>
                        <td><?= ucfirst($gateway)?></td>
                        <td><?php //$transaction->getId()?></td>
                        <td><?php //$transaction->getStatus()->getName()?></td>
                    </tr>
                <?php }?>
            <?php endforeach;?>
        </tbody>
    </table>
</body>
</html>