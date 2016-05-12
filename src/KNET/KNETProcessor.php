<?php

namespace Panic\Payments\KNET;

use Panic\Payments\PaymentProcessorInterface;
use Panic\Payments\BaseProcessor;
use Config;
use Panic\Payments\KNET\Lib\PaymentPipe;


class KNETProcessor extends BaseProcessor implements PaymentProcessorInterface
{
    public function charge()
    {
        $Pipe = new PaymentPipe();

        $Pipe->setAction(Config::get('payments.KNET.action'));
        $Pipe->setCurrency(Config::get('payments.KNET.currency'));
        $Pipe->setLanguage("ENG"); //change it to "ARA" for arabic language
        $Pipe->setResponseURL(Config::get('payments.KNET.response_url')); // set your respone page URL
        $Pipe->setErrorURL(Config::get('payments.KNET.error_url')); //set your error page URL
        $Pipe->setAmt($this->amount); //set the amount for the transaction
        $Pipe->setResourcePath(Config::get('payments.KNET.resource_path')); //change the path where your resource file is
        $Pipe->setAlias(Config::get('payments.KNET.alias')); //set your alias name here
        $Pipe->setTrackId($this->data['orderId']);//generate the random number here

//        $Pipe->setUdf1("UDF 1"); //set User defined value
//        $Pipe->setUdf2("UDF 2"); //set User defined value
//        $Pipe->setUdf3("UDF 3"); //set User defined value
//        $Pipe->setUdf4("UDF 4"); //set User defined value
//        $Pipe->setUdf5("UDF 5"); //set User defined value


        //get results
        if($Pipe->performPaymentInitialization() != $Pipe->SUCCESS) {
            return array('success' => false , 'result' => $Pipe->SUCCESS, 'error' => $Pipe->getErrorMsg(), 'debug' => $Pipe->getDebugMsg());
        } else {
            $payID = $Pipe->getPaymentId();
            $payURL = $Pipe->getPaymentPage();
            $Pipe->getDebugMsg();
            $responseUrl = $payURL . '?PaymentID=' . $payID;
            
            return array('success' => true , 'payment_url' => $responseUrl, 'debug' => $Pipe->getDebugMsg());
        }
    }
}