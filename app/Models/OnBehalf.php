<?php

namespace App\Models;

class OnBehalf extends CoreModel
{
    protected $table = 'shaadi_on_behalfs';

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

    protected $hidden = ['laravel_through_key'];
}
