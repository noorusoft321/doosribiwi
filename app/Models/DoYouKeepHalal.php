<?php

namespace App\Models;

class DoYouKeepHalal extends CoreModel
{
    protected $table = 'shaadi_do_you_keep_halals';

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
