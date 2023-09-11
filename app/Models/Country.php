<?php

namespace App\Models;

class Country extends CoreModel
{
    protected $table = 'shaadi_countries';

    protected $fillable =[
        'iso',
        'slug',
        'order_at',
        'name',
        'nicename',
        'iso3',
        'numcode',
        'phonecode',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];

    public function getStates()
    {
        return $this->hasMany(State::class, 'country_id');
    }

}
