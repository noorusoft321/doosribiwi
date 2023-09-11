<?php

namespace App\Models;

class University extends CoreModel
{
    protected $table = 'shaadi_universities';

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
