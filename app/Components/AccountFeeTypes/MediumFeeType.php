<?php


namespace App\Components\AccountFeeTypes;


/**
 *
 * Class MediumFeeType
 * @package App\Components\AccountFeeTypes
 */
class MediumFeeType extends BaseFeeType
{
    public function condition()
    {
        return round($this->amount, 2) >= 1000.00 && round($this->amount, 2) <= 10000.00;
    }

    public function calculateFee()
    {
        return round($this->amount * 0.06,  2);
    }
}
