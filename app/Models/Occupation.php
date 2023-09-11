<?php

namespace App\Models;

class Occupation extends CoreModel
{
    protected $table = 'shaadi_occupations';

    protected $fillable =[
        'title',
        'slug',
        'order_at',
        'status',
        'home_status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
