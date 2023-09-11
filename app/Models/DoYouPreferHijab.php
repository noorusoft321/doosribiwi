<?php

namespace App\Models;

class DoYouPreferHijab extends CoreModel
{
    protected $table = 'shaadi_do_you_prefer_hijabs';

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
