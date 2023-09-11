<?php

namespace App\Models;

class MyLivingArrangement extends CoreModel
{
    protected $table = 'shaadi_my_living_arrangements';

    protected $fillable =[
        'title',
        'slug',
        'order_at',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
