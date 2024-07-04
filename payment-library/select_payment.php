<?php
require_once "./vendor/autoload.php";

use PaymentLibrary\PaymentGatewayManager;
use PaymentLibrary\Factories\PaypalGatewayFactory;
use PaymentLibrary\Factories\StripeGatewayFactory;

$paymentGatewayManager = new PaymentGatewayManager();
$paypalFactory = new PaypalGatewayFactory();
$stripeFactory = new StripeGatewayFactory();
$paymentGatewayManager->registerFactory('paypal', $paypalFactory);
$paymentGatewayManager->registerFactory('stripe', $stripeFactory);

$gateways = ['paypal', 'stripe'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir un moyen de paiement</title>
</head>
<body>
    <h1>Choisir un moyen de paiement</h1>
    <form action="process_payment.php" method="post">
        <label for="gateway">Sélectionner un moyen de paiement :</label>
        <select name="gateway" id="gateway">
            <?php foreach ($gateways as $gateway): ?>
                <option value="<?= $gateway ?>"><?= ucfirst($gateway) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Payer</button>
    </form>
</body>
</html>
