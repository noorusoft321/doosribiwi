<?php

namespace App\Models;

class HairColor extends CoreModel
{
    protected $table = 'shaadi_hair_colors';

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
