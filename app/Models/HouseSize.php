<?php

namespace App\Models;

class HouseSize extends CoreModel
{
    protected $table = 'shaadi_house_sizes';

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
