<?php


namespace App\Components\Operations;


use App\Account;

abstract class BaseOperation
{
    /** @var Account $account */
    protected $account;

    /** @var float $amount */
    protected $amount = null;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * Get Operation amount
     * @return float
     */
    public function getAmount(): float
    {
        if (empty($this->amount)) {
            $this->amount = $this->calculateAmount();
        }

        return $this->amount;
    }

    abstract public function prepareAccount(): Account;

    abstract public function calculateAmount(): float;

    abstract public function getOperationName(): string;
}
