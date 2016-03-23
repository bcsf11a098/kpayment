<?php

namespace Panic\Payments\Checkout;

use Panic\Payments\PaymentData;
use Illuminate\Support\Facades\Validator;

class CheckoutData extends PaymentData
{
    protected $token;

    protected $charger = CheckoutCharger::class;

    function __construct($token)
    {
        $this->token = $token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }
}