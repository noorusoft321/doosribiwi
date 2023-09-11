<?php

namespace App\Models;

class Religion extends CoreModel
{
    protected $table = 'shaadi_religions';

    protected $fillable =[
        'title',
        'slug',
        'order_at',
        'status',
        'deleted',
        'deleted_by',
        'created_by',
        'updated_by',
    ];
}
