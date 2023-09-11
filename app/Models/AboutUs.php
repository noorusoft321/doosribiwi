<?php

namespace App\Models;

class AboutUs extends CoreModel
{
    protected $table = 'shaadi_about_us';

    protected $fillable = [
        'title',
        'sub_title',
        'short_desc',
        'long_desc',
        'order_at',
        'main_image',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];

}
