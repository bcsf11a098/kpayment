<?php

namespace Panic\Payments;

interface PaymentChargerInterface {

    public function charge($data);

}