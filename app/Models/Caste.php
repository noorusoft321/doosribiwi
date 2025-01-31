<?php

namespace App\Models;

class Caste extends CoreModel
{
    protected $table = 'shaadi_castes';

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
