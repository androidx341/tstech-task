<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateInterval;
use Exception;
use DateTime;

/**
 * Class Account
 * @property int $id
 * @property float $value
 * @property float $depositRate
 * @property string $createDate
 * @package App
 */
class Account extends Model
{
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'accountId', 'id');
    }

    /**
     * @return DateInterval
     * @throws Exception
     */
    public function getAccountAge(): DateInterval
    {
        return (new DateTime())->diff(new DateTime($this->createDate));
    }
}
