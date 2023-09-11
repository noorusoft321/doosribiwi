<?php

namespace App\Models;

class HomeHeader extends CoreModel
{
    protected $table = 'shaadi_home_headers';

    protected $fillable =[
        'title',
        'sub_title',
        'short_desc',
        'long_desc',
        'order_at',
        'main_image',
        'other_logo',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
