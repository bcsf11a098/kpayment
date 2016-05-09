<?php


namespace Panic\Payments;

class BaseProcessor
{
    protected $user;
    protected $amount;
    protected $data;

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

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

}