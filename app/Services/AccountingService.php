<?php


namespace App\Services;

use App\Components\Operations\BaseOperation;
use Illuminate\Support\Facades\DB;

class AccountingService
{
    public static function doOperation(BaseOperation $operation)
    {
        DB::transaction(function () use ($operation) {
            $account = $operation->prepareAccount();

            $account->save();

            $account->transactions()->create([
                'amount' => $operation->getAmount(),
                'name' => $operation->getOperationName()
            ]);
        });
    }
}
