<?php


namespace App\Components\AccountFeeTypes;


class HighFeeType extends BaseFeeType
{
    public function condition()
    {
        return round($this->amount, 2) >= 10000.00;
    }

    public function calculateFee()
    {
        $fee = round($this->amount * 0.07,  2);
        return $fee > 5000 ? 5000 : $fee;
    }
}
