<?php

namespace App\Models;

class Weight extends CoreModel
{
    protected $table = 'shaadi_weights';

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
