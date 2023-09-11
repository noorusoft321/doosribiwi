<?php

namespace App\Models;

class Disability extends CoreModel
{
    protected $table = 'shaadi_disabilities';

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
