<?php
namespace Panic\Payments;

use Panic\Payments\KNET\KNETCharger;

abstract class PaymentData
{
    protected $charger = KNETCharger::class;

    public function getCharger()
    {
        return $this->charger;
    }

}