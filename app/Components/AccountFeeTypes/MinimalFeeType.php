<?php


namespace App\Components\AccountFeeTypes;

/**
 * Class MinimalFeeType
 * @package App\Components\AccountFeeTypes
 */
class MinimalFeeType extends BaseFeeType
{
    public function condition()
    {
        return round($this->amount, 2) >= 0 && round($this->amount, 2) <= 1000.00;
    }

    public function calculateFee()
    {
        $fee = round($this->amount * 0.05,  2);
        return $fee > 50 ? $fee : 50;
    }
}
