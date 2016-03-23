<?php

namespace Panic\Payments\KNET;

use Panic\Notifications\PaymentData;
use Illuminate\Support\Facades\Validator;

class KNETData extends PaymentData
{
    protected $charger = KNETCharger::class;

    function __construct()
    {

    }
}