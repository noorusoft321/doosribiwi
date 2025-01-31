<?php

namespace App\Models;

class MotherTongue extends CoreModel
{
    protected $table = 'shaadi_mother_tongues';

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
