<?php

namespace Panic\Payments;

class Payment
{
    public function charge(PaymentData $data)
    {
        $paymentCharger = $data->getCharger();

        $payment = new $paymentCharger;

        $payment->charge($data);
    }
}