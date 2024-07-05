<?php
require_once "./vendor/autoload.php";

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

$clientId = 'YOUR_CLIENT_ID';
$clientSecret = 'YOUR_CLIENT_SECRET';

$paymentId = $_POST['payment_id'];
$payerId = $_POST['payer_id'];
var_dump($paymentId. '<br>');
var_dump($payerId. '<br><br>');
var_dump($clientId. '<br>');
var_dump($clientSecret. '<br>');

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential($clientId, $clientSecret)
);

try {
    $payment = Payment::get($paymentId, $apiContext);
    if ($payment->getState()!== 'pending') {
        throw new Exception("Payment is not in pending state");
    }

    $execution = new PaymentExecution();
    $execution->setPayerId($payerId);

    $result = $payment->execute($execution, $apiContext);
    // Payment executed successfully

    // Update payment status in payments.json
    $transactions = json_decode(file_get_contents('payments.json'), true);
    foreach ($transactions as &$transaction) {
        if ($transaction['payment_id'] == $paymentId) {
            $transaction['payment_status'] = 'approved';
            break;
        }
    }
    file_put_contents('payments.json', json_encode($transactions));

    header('Location: listing.php');
    exit;
} catch (\PayPal\Exception\PayPalConnectionException $ex) {
    error_log("PayPal connection error: ". $ex->getMessage());
    // Display error message to user
    echo "Error executing payment: ". $ex->getMessage();
} catch (Exception $ex) {
    error_log("Error executing payment: ". $ex->getMessage());
    // Display error message to user
    echo "Error executing payment: ". $ex->getMessage();
}