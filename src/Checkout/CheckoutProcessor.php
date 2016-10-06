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
        $apiClient = new ApiClient(Config::get('payments.Checkout.key'));
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
        $apiClient = new ApiClient(Config::get('payments.Checkout.key'));
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

    // charge by card token
    public function charge()
    {
        $apiClient = new ApiClient(Config::get('payments.Checkout.key'), Config::get('payments.Checkout.mode'));
        $charge = $apiClient->chargeService();

        // create an instance of CardTokenChargeCreate Model
        $CardTokenChargePayload = new CardTokenChargeCreate();
        //initializing model to generate payload

        $CardTokenChargePayload->setEmail($this->user->email);
        $CardTokenChargePayload->setAutoCapture(Config::get('payments.Checkout.auto_capture'));
        $CardTokenChargePayload->setAutoCapTime(Config::get('payments.Checkout.auto_cap_time'));
        $CardTokenChargePayload->setValue($this->amount);
        $CardTokenChargePayload->setCurrency(Config::get('payments.Checkout.currency'));
        $CardTokenChargePayload->setTrackId($this->data['orderId']);
        $CardTokenChargePayload->setCardToken($this->user->payment_info()->where('payment_provider', Config::get('payments.Checkout.processor'))->first()->payment_token);

        try {
            /** @var CardTokenChargeCreate $CardTokenChargePayload * */
            $ChargeResponse = $charge->chargeWithCardToken($CardTokenChargePayload);

            $response = array('success' => true , 'data' => $ChargeResponse->json);

        } catch (Exception $e) {
            return array('success' => false , 'error' => 'Caught exception: ' . $e->getErrorMessage());
        }

        return $response;
    }
    // charge by card id
    public function chargeByCardId()
    {
        $apiClient = new ApiClient(Config::get('payments.Checkout.key'));
        $charge = $apiClient->chargeService();

        // create an instance of CardIdChargeCreate Model
        $cardChargeIdPayload = new CardIdChargeCreate();

        //initializing model to generate payload
        $cardChargeIdPayload->setEmail($this->user->email);
        $cardChargeIdPayload->setAutoCapture(Config::get('payments.Checkout.auto_capture'));
        $cardChargeIdPayload->setAutoCapTime(Config::get('payments.Checkout.auto_cap_time'));
        $cardChargeIdPayload->setValue($this->amount);
        $cardChargeIdPayload->setCurrency(Config::get('payments.Checkout.currency'));
        $cardChargeIdPayload->setTrackId($this->data['orderId']);
        $cardChargeIdPayload->setCardId($this->user->payment_info()->where('payment_provider', Config::get('payments.Checkout.processor'))->first()->payment_token);

        try {
            /**  @var Charge $ChargeResponse * */
            $ChargeResponse = $charge->chargeWithCardId($cardChargeIdPayload);

            $response = array('success' => true , 'data' => $ChargeResponse->json);

        } catch (Exception $e) {
            return array('success' => false , 'error' => 'Caught exception: ' . $e->getErrorMessage());
        }

        return $response;
    }
}