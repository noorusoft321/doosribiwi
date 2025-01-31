<?php

namespace App\Models;

class AreYouRevert extends CoreModel
{
    protected $table = 'shaadi_are_you_reverts';

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
