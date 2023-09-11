<?php

namespace App\Models;

class City extends CoreModel
{
    protected $table = 'shaadi_cities';

    protected $fillable =[
        'title',
        'slug',
        'order_at',
        'country_id',
        'state_id',
        'status',
        'deleted',
        'deleted_by',
        'created_by',
        'updated_by',
    ];
}
