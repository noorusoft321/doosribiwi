<?php

namespace App\Models;

class SpecialGuest extends CoreModel
{
    protected $table = 'shaadi_special_guests';

    protected $fillable =[
        'title',
        'main_image',
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
