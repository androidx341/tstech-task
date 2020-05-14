<?php


namespace App\Components\AccountFeeTypes;


abstract class BaseFeeType
{
    /**
     * @var float $amount
     */
    protected $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    abstract public function condition();
    abstract public function calculateFee();
}
