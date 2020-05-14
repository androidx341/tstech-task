<?php

namespace App\Console\Commands;

use App\Account;
use App\Components\Operations\DepositAccrual;
use App\Services\AccountingService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class AccountingAccrual extends Command
{
    /**
     * @var string
     */
    protected $signature = 'accounting:accrual';

    /**
     * @var string
     */
    protected $description = 'Deposit accrual';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = new \DateTime();
        $isLastDayOfMonth = $now->diff(new \DateTime('last day of this month'))->d === 0;

        $collection = Account::query()
            ->whereDay('createDate', '=', $now)
            ->when($isLastDayOfMonth, function (Builder $query) {
                $query->orWhereDay('createDate', '=', 31);
            })
            ->whereDoesntHave('transactions', function (Builder $query) use ($now){
                $query
                    ->where('name', '=', DepositAccrual::NAME)
                    ->whereMonth('created_at', '<', $now)
                    ->whereYear('created_at', '<', $now);
            })
            ->get();

        foreach ($collection as $account) {
            AccountingService::doOperation(new DepositAccrual($account));
        }
    }
}
