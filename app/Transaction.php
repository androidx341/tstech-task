<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @property $createAt
 * @package App
 */
class Transaction extends Model
{
//    public $timestamps = false;

    protected $fillable = [
        'amount',
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
