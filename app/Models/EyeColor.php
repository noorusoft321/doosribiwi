<?php

namespace App\Models;

class EyeColor extends CoreModel
{
    protected $table = 'shaadi_eye_colors';

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
