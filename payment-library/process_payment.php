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
use PayPal\Api\PayerInfo;

class PaymentProcessor
{
    private $paymentGatewayManager;
    private $config;

    public function __construct(PaymentGatewayManager $paymentGatewayManager, array $config)
    {
        $this->paymentGatewayManager = $paymentGatewayManager;
        $this->config = $config;
    }

    public function processPayment($gateway, $amount, $currency, $description)
    {
        try {
            $paymentGateway = $this->paymentGatewayManager->getGateway($gateway, $this->getConfigForGateway($gateway));
            $transaction = $paymentGateway->createTransaction($amount, $currency, $description);
            $result = $paymentGateway->executeTransaction($transaction);

            if ($result->getStatus() === 'pending') {
                return $this->createPayPalPayment($amount, $currency, $description);
            } else {
                echo "Paiement échoué.";
            }
        } catch (Exception $e) {
            echo "Erreur: " . $e->getMessage();
        }
    }

    private function getConfigForGateway($gateway)
    {
        if ($gateway === 'paypal') {
            return [
                'client_id' => Utils::env('PAYPAL_CLIENT_ID'),
                'client_secret' => Utils::env('PAYPAL_CLIENT_SECRET')
            ];
        } elseif ($gateway === 'stripe') {
            return [
                'api_key' => getenv('STRIPE_API_KEY')
            ];
        }
        return []; // Return an empty array if no config is found
    }

    private function createPayPalPayment($amount, $currency, $description)
    {
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $this->config['client_id'],
                $this->config['client_secret']
            )
        );

        $apiContext->setConfig(['mode' => 'sandbox', 'debug' => true]);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Set the payer information
        $payerInfo = new PayerInfo();
        $payerInfo->setPayerId('payer-1234567890'); // Replace with the actual payer ID
        $payer->setPayerInfo($payerInfo);

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

        $payment->create($apiContext);

        $paymentData = [
            'payment_id' => $payment->getId(),
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'payer_id' => $payer->getPayerInfo()->getPayerId(),
            'payment_status' => $payment->getState(),
            'approval_url' => $payment->getApprovalLink(),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $paymentsJson = json_decode(file_get_contents('payments.json'), true);
        $paymentsJson[] = $paymentData;
        file_put_contents('payments.json', json_encode($paymentsJson, JSON_PRETTY_PRINT));
        $approvalUrl = $payment->getApprovalLink();

        header("Location: $approvalUrl");
        exit;
    }


}

$paymentGatewayManager = new PaymentGatewayManager();
$paypalFactory = new PaypalGatewayFactory();
$stripeFactory = new StripeGatewayFactory();
$paymentGatewayManager->registerFactory('paypal', $paypalFactory);
$paymentGatewayManager->registerFactory('stripe', $stripeFactory);

$config = [
    'client_id' => Utils::env('PAYPAL_CLIENT_ID'),
    'client_secret' => Utils::env('PAYPAL_CLIENT_SECRET')
];
$gateway = $_POST['gateway'];
$amount = 0.01;
$currency = 'USD';
$description = 'Achat d\'un produit exemple';

$paymentProcessor = new PaymentProcessor($paymentGatewayManager, $config);
$paymentProcessor->processPayment($gateway, $amount, $currency, $description);
