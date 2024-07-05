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

$gateways = ['paypal', 'stripe'];
$transactions = json_decode(file_get_contents('payments.json'), true);

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
                <th>Payment ID</th>
                <th>Currency</th>
                <th>Description</th>
                <th>Payer ID</th>
                <th>Payment Status</th>
                <th>Approval URL</th>
                <th>Created At</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction) { ?>
                <tr>
                    <td><?= $transaction['payment_id'] ?></td>
                    <td><?= $transaction['currency'] ?></td>
                    <td><?= $transaction['description'] ?></td>
                    <td><?= $transaction['payer_id'] ?></td>
                    <td><?= $transaction['payment_status'] ?></td>
                    <td><?= $transaction['approval_url'] ?></td>
                    <td><?= $transaction['created_at'] ?></td>
                    <td>
                        <form action="execute_payment.php" method="post">
                            <input name="payment_id" value="<?= $transaction['payment_id'] ?>">
                            <input name="payer_id" value="<?= $transaction['payer_id'] ?>">
                            <button type="submit">Approuver le paiement</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>