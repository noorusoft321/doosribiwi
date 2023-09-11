<?php

namespace App\Models;

class FuturePlan extends CoreModel
{
    protected $table = 'shaadi_future_plans';

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
