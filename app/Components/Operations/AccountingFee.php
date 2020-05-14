<?php


namespace App\Components\Operations;

use App\Account;
use App\Components\AccountFeeTypes\BaseFeeType;
use App\Components\AccountFeeTypes\HighFeeType;
use App\Components\AccountFeeTypes\MediumFeeType;
use App\Components\AccountFeeTypes\MinimalFeeType;

class AccountingFee extends BaseOperation
{
    public const NAME = 'ACCOUNTING_FEE';

    public function prepareAccount(): Account
    {
        $this->account->value = $this->account->value - $this->getAmount();

        return $this->account;
    }

    protected function getFeeTypes()
    {
        return [
            new MinimalFeeType($this->account->value),
            new MediumFeeType($this->account->value),
            new HighFeeType($this->account->value),
        ];
    }

    public function calculateAmount(): float
    {
        $fee = 0;

        /** @var BaseFeeType $feeType */
        foreach ($this->getFeeTypes() as $feeType) {
            if ($feeType->condition()) {
                $fee = $feeType->calculateFee();
                break;
            }
        }

        if ($this->account->getAccountAge()->m == 0) {
            return round(($this->account->getAccountAge()->d / 31) * $fee, 2);
        }

        return $fee;
    }

    public function getOperationName(): string
    {
        return self::NAME;
    }
}
