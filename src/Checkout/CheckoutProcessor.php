<?php

namespace Panic\Payments\Checkout;


include(base_path() . '/vendor/checkout/checkout-php-api/autoload.php');
use com\checkout;

use Panic\Payments\BaseProcessor;
use Config;
use Log;
use Exception;
use Carbon;
use com\checkout\ApiServices\Charges\RequestModels\CardTokenChargeCreate;
use com\checkout\ApiServices\SharedModels\Address;
use com\checkout\ApiServices\SharedModels\Phone;
use com\checkout\ApiClient;
use com\checkout\ApiServices\Cards\RequestModels\CardCreate;
use com\checkout\ApiServices\Cards\RequestModels\BaseCardCreate;
use com\checkout\ApiServices\Customers\RequestModels\CustomerCreate;
use com\checkout\ApiServices\Charges\RequestModels\CardIdChargeCreate;
use com\checkout\ApiServices\Charges\ResponseModels\Charge;
use Panic\Payments\PaymentProcessorInterface;

class CheckoutProcessor extends BaseProcessor implements PaymentProcessorInterface
{
    public function createCustomer()
    {
        $apiClient = new ApiClient(Config::get('payments.key.Checkout'));
        $customerService = $apiClient->customerService();

        $customerCreateObject = new CustomerCreate();

        $baseCardCreateObject = new BaseCardCreate();

        $billingDetails = new Address();
        $phone = new Phone();

        $phone->setNumber('203 583 44 55');
        $phone->setCountryCode('44');

        $customerCreateObject->setEmail('ficko@cloudhorizon.com');
        $customerCreateObject->setName('Filip');
        $customerCreateObject->setCustomerName('filip');
        $customerCreateObject->setDescription('developer');
        $customerCreateObject->setMetadata('');
        $customerCreateObject->setPhoneNumber($phone);

        $billingDetails->setAddressLine1('1 Glading Fields"');
        $billingDetails->setPostcode('N16 2BR');
        $billingDetails->setCountry('GB');
        $billingDetails->setCity('London');
        $billingDetails->setPhone($phone);

        $baseCardCreateObject->setNumber('4242424242424242');
        $baseCardCreateObject->setName('Test Name');
        $baseCardCreateObject->setExpiryMonth('06');
        $baseCardCreateObject->setExpiryYear('2018');
        $baseCardCreateObject->setCvv('100');
        $baseCardCreateObject->setBillingDetails($billingDetails);

        $customerCreateObject->setBaseCardCreate($baseCardCreateObject);

        try {
            /** @var CustomerCreate $customerResponse * */
            $customerResponse = $customerService->createCustomer($customerCreateObject);
            dd($customerResponse);

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function createCard()
    {
        $apiClient = new ApiClient(Config::get('payments.key.Checkout'));
        $cardService = $apiClient->cardService();
        $cardsRequestModel = new CardCreate();

        $baseCardCreateObject = new BaseCardCreate();

        $billingDetails = new Address();
        $phone = new Phone();

        $phone->setNumber('203 583 44 55');
        $phone->setCountryCode('44');

        $billingDetails->setAddressLine1('1 Glading Fields"');
        $billingDetails->setPostcode('N16 2BR');
        $billingDetails->setCountry('GB');
        $billingDetails->setCity('London');
        $billingDetails->setPhone($phone);

        $baseCardCreateObject->setNumber('4242424242424242');
        $baseCardCreateObject->setName('Test Name');
        $baseCardCreateObject->setExpiryMonth('06');
        $baseCardCreateObject->setExpiryYear('2018');
        $baseCardCreateObject->setCvv('100');
        $baseCardCreateObject->setBillingDetails($billingDetails);
        $cardsRequestModel->setBaseCardCreate($baseCardCreateObject);
        $cardsRequestModel->setCustomerId('cust_DC1618B9-48B6-4032-A53D-3C6AB4B27E14');


        try {
            /** @var CardCreate $cardResponse * */
            $cardResponse = $cardService->createCard($cardsRequestModel);
            dd($cardResponse);

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function chargeByCardToken()
    {
        $apiClient = new ApiClient(Config::get('payments.key.Checkout'));
        $charge = $apiClient->chargeService();

        // create an instance of CardTokenChargeCreate Model
        $CardTokenChargePayload = new CardTokenChargeCreate();
        //initializing model to generate payload
        $billingDetails = new Address();
        $phone = new Phone();
        $phone->setNumber("203 583 44 55");
        $phone->setCountryCode("44");

        $billingDetails->setAddressLine1('1 Glading Fields"');
        $billingDetails->setPostcode('N16 2BR');
        $billingDetails->setCountry('GB');
        $billingDetails->setCity('London');
        $billingDetails->setPhone($phone);


        $CardTokenChargePayload->setEmail('demo@checkout.com');
        $CardTokenChargePayload->setAutoCapture('N');
        $CardTokenChargePayload->setAutoCapTime('0');
        $CardTokenChargePayload->setValue('100');
        $CardTokenChargePayload->setCurrency('usd');
        $CardTokenChargePayload->setTrackId('Demo-0001');
        $CardTokenChargePayload->setCardToken('pay_tok_78EC3AD2-0976-4458-9751-F665A55C6448');

        try {
            /** @var CardTokenChargeCreate $CardTokenChargePayload * */
            $ChargeResponse = $charge->chargeWithCardToken($CardTokenChargePayload);
            dd($ChargeResponse);

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }
    // charge by card id
    public function charge()
    {
        $apiClient = new ApiClient(Config::get('payments.key.Checkout'));
        $charge = $apiClient->chargeService();

        // create an instance of CardIdChargeCreate Model
        $cardChargeIdPayload = new CardIdChargeCreate();

        //initializing model to generate payload

        $cardChargeIdPayload->setEmail($this->user->email);
        $cardChargeIdPayload->setAutoCapture('N');
        $cardChargeIdPayload->setAutoCapTime('0');
        $cardChargeIdPayload->setValue($this->amount);
        $cardChargeIdPayload->setCurrency('usd');
        $cardChargeIdPayload->setTrackId('Demo-0001');
        $cardChargeIdPayload->setCardId($this->user->payment_info()->where('payment_provider', Config::get('payments.processor.Checkout'))->first()->payment_token);

        try {
            /**  @var Charge $ChargeResponse * */
            $ChargeResponse = $charge->chargeWithCardId($cardChargeIdPayload);

            return $ChargeResponse;

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }
}