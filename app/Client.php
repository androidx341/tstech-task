<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public const GENDER_MALE = 'male';
    public const GENDER_FEMALE = 'female';

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accounts()
    {
        return $this->hasMany(Account::class, 'clientId', 'id');
    }
}
