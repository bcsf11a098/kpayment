<?php


namespace Panic\Payments;

use Config;
use Exception;
use Panic\Payments\Checkout\CheckoutProcessor;
use Panic\Payments\KNET\KNETProcessor;

class PaymentProcessor implements PaymentProcessorInterface
{

    protected $processor;

    public function setAmount($amount)
    {
        $this->processor->setAmount($amount);
        return $this;
    }


    public function setUser($user)
    {
        $this->processor->setUser($user);
        return $this;
    }

    public function setData($data)
    {
        $this->processor->setData($data);
        return $this;
    }


    public function charge()
    {
        return $this->processor->charge();
    }

    public function setProcessor($processorFlag)
    {

        switch ($processorFlag) {

            case Config::get('payments.Checkout.processor') :
                $this->processor = new CheckoutProcessor;
                break;

            case Config::get('payments.KNET.processor') :
                $this->processor = new KNETProcessor;
                break;

            default :
                throw new Exception('Invalid payment processor');

        }

        return $this;
    }


}