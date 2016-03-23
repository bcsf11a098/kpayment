<?php

namespace Panic\Payments\Checkout;


include(__DIR__.'/../../vendor/checkout/checkout-php-api/autoload.php');
use com\checkout;

use Panic\Payments\PaymentChargerInterface;
use Illuminate\Support\Facades\Config;
use Log;
use Carbon;


class CheckoutCharger implements PaymentChargerInterface
{
    public function charge($data)
    {
        $apiClient = new checkout\ApiClient('sk_test_bb53b0b7-2711-4c37-a78f-549ac994ea45');

        // create a charge serive
        $charge = $apiClient->chargeService();

        try {
            /**  @var checkout\ApiServices\Charges\ResponseModels\Charge  $ChargeRespons **/
            $ChargeResponse = $charge->verifyCharge('pay_tok_B15F0DF8-5DAE-4902-BDB1-5C176B1815B1');

        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

        //create an instance of a token service
        $tokenService = $apiClient->tokenService();
        //initializing the request models
        $tokenPayload = new checkout\ApiServices\Tokens\RequestModels\PaymentTokenCreate();
        $metaData = array('key'=>'value');
        $product = new checkout\ApiServices\SharedModels\Product();
        //initializing models to generate payload
        $shippingDetails = new checkout\ApiServices\SharedModels\Address();
        $phone = new checkout\ApiServices\SharedModels\Phone();

        $product->setName('A4 office paper');
        $product->setDescription('a4 white copy paper');
        $product->setQuantity(1);
        $product->setShippingCost(10);
        $product->setSku('ABC123');
        $product->setTrackingUrl('http://www.tracker.com');

        $phone->setNumber("203 583 44 55");
        $phone->setCountryCode("44");

        $shippingDetails->setAddressLine1('1 Glading Fields"');
        $shippingDetails->setPostcode('N16 2BR');
        $shippingDetails->setCountry('GB');
        $shippingDetails->setCity('London');
        $shippingDetails->setPhone($phone);

        $tokenPayload->setCurrency("GBP");
        $tokenPayload->setAutoCapture("N");
        $tokenPayload->setValue("100");
        $tokenPayload->setCustomerIp("88.216.3.135");
        $tokenPayload->setDescription("test");
        $tokenPayload->setEmail("test@test.com");

        $tokenPayload->setMetadata($metaData);
        $tokenPayload->setProducts($product);


        try {
            /** @var checkout\ApiServices\Tokens\ResponseModels\PaymentToken $paymentToken  **/
            $paymentToken = $tokenService->createPaymentToken($tokenPayload);

        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}