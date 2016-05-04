<?php


namespace Panic\Payments;

class BaseProcessor
{
    protected $user;
    protected $amount;
    protected $transactionID;

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }


    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setTransactionID($transactionID)
    {
        $this->transactionID = $transactionID;
        return $this;
    }

}