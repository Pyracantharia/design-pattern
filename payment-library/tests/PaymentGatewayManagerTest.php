<?php

use PHPUnit\Framework\TestCase;
use PaymentLibrary\PaymentGatewayManager;
use PaymentLibrary\PaymentGateways\StripePaymentGateway;

use PaymentLibrary\PaymentGateways\PayPalPaymentGatewayConcrete;

class PaymentGatewayManagerTest extends TestCase
{
    protected $manager;

    protected function setUp(): void
    {
        $this->manager = new PaymentGatewayManager(); // Initialize the manager
    }

    public function testAddAndRetrieveGateways()
    {

        // Create and add a PayPal gateway
        $paypalGateway = new PayPalPaymentGatewayConcrete();
        $this->manager->addGateway('paypal', $paypalGateway);
        
        // Create and add a Stripe gateway
        $stripeGateway = new StripePaymentGateway();
        $this->manager->addGateway('stripe', $stripeGateway);

        // Assertions
        $retrievedPayPalGateway = $this->manager->getGateway('paypal');
        $this->assertInstanceOf(PayPalPaymentGatewayConcrete::class, $retrievedPayPalGateway);

        $retrievedStripeGateway = $this->manager->getGateway('stripe');
        $this->assertInstanceOf(StripePaymentGateway::class, $retrievedStripeGateway);
    }


    public function testRemoveGateway()
    {
        $this->manager->removeGateway('stripe');
        $this->assertNull($this->manager->getGateway('stripe'));
    }
}
