<?php
require_once "./vendor/autoload.php";

use PaymentLibrary\Core\Utils;
use PaymentLibrary\PaymentGatewayManager;
use PaymentLibrary\Factories\PaypalGatewayFactory;
use PaymentLibrary\Factories\StripeGatewayFactory;
use PayPal\Api\Payment;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;



$gateway = $_POST['gateway']; // Nom de la passerelle de paiement
$amount = 100.00; // Montant de la transaction
$currency = 'USD'; // Devise
$description = 'Achat d\'un produit exemple';

$paymentGatewayManager = new PaymentGatewayManager();
$paypalFactory = new PaypalGatewayFactory();
$stripeFactory = new StripeGatewayFactory();
$paymentGatewayManager->registerFactory('paypal', $paypalFactory);
$paymentGatewayManager->registerFactory('stripe', $stripeFactory);

try {
    $config = [];
    if ($gateway === 'paypal') {
        $config = [
            'client_id' => Utils::env('PAYPAL_CLIENT_ID'), // Identifiant client
            'client_secret' => Utils::env('PAYPAL_CLIENT_SECRET') // Clé secrète
        ];
    } elseif ($gateway === 'stripe') {
        $config = [
            'api_key' => getenv('STRIPE_API_KEY')
        ];
    }

    $paymentGateway = $paymentGatewayManager->getGateway($gateway, $config);
    $transaction = $paymentGateway->createTransaction($amount, $currency, $description);
    $result = $paymentGateway->executeTransaction($transaction);

    if ($result->getStatus() === 'pending') {
        // Create a PayPal payment object
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $config['client_id'],
                $config['client_secret']
            )
        );

        $apiContext->setConfig(['mode' => 'sandbox', 'debug' => true]);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://example.com/your_redirect_url_here")
            ->setCancelUrl("http://example.com/your_cancel_url_here");


        $payment = new Payment();
        $payment->setIntent('authorize')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([
                [
                    'amount' => [
                        'currency' => $currency,
                        'total' => $amount
                    ],
                    'description' => $description
                ]
            ]);

        // Create the payment
        $payment->create($apiContext);

        // Get the approval URL
        $approvalUrl = $payment->getApprovalLink();

        // Redirect the user to the approval URL
        header("Location: $approvalUrl");
        exit;
    } else {
        echo "Paiement échoué.";
    }
} catch (Exception $e) {
    echo "Erreur: " .
        $e->getMessage();
}

// Cancel transaction
if (isset($_POST['cancel'])) {
    $transactionId = $_POST['transaction_id'];
    $paymentGateway->cancelTransaction($transactionId);
    echo "Transaction cancelled.";
}

// Check transaction status
if (isset($_GET['transaction_id'])) {
    $transactionId = $_GET['transaction_id'];
    $result = $paymentGateway->getTransactionStatus($transactionId);
    if ($result->getStatus() === 'approved') {
        echo "Paiement approuvé.";
    } elseif ($result->getStatus() === 'cancelled') {
        echo "Paiement annulé.";
    } else {
        echo "Paiement en attente...";
    }
}
