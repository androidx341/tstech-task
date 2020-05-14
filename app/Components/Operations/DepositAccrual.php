<?php


namespace App\Components\Operations;


use App\Account;

class DepositAccrual extends BaseOperation
{
    public const NAME = 'DEPOSIT_ACCRUAL';

    public function prepareAccount(): Account
    {
        $this->account->value = $this->account->value + $this->getAmount();

        return $this->account;
    }

    public function calculateAmount(): float
    {
        return round ($this->account->value * $this->account->depositRate / 100, 2);
    }

    public function getOperationName(): string
    {
        return self::NAME;
    }
}
