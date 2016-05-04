<?php

namespace Panic\Payments;

interface PaymentProcessorInterface
{
    public function charge();
}