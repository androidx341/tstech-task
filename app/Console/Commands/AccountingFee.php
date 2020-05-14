<?php

namespace App\Console\Commands;

use App\Account;
use App\Components\Operations\AccountingFee as ActingFeeOperation;
use App\Services\AccountingService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class AccountingFee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accounting:fee';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Account maintenance fee';

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

        $collection = Account::query()
            ->whereDate('createDate', '<', $now)
            ->whereDate('createDate', '>=', (clone $now)->modify('-1 month'))
            ->whereDoesntHave('transactions', function (Builder $query) use ($now) {
                $query
                    ->where('name', '=', ActingFeeOperation::NAME)
                    ->whereMonth('created_at', '<=', $now)
                    ->whereYear('created_at', '<=', $now);
            })
            ->get();

        foreach ($collection as $account) {
            AccountingService::doOperation(new ActingFeeOperation($account));
        }
    }
}
