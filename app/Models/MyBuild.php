<?php

namespace App\Models;

class MyBuild extends CoreModel
{
    protected $table = 'shaadi_my_builds';

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
