<?php

namespace App\Models;

class CustomPage extends CoreModel
{
    protected $table = 'shaadi_custom_pages';

    protected $fillable =[
        'title',
        'sub_title',
        'long_desc',
        'short_desc',
        'main_image',
        'slug',
        'order_at',
        'meta_description',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
