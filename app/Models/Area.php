<?php

namespace App\Models;

class Area extends CoreModel
{
    protected $table = 'shaadi_areas';

    protected $fillable =[
        'title',
        'slug',
        'order_at',
        'country_id',
        'state_id',
        'city_id'
    ];

    protected $hidden = ['laravel_through_key'];
}
