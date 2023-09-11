<?php

namespace App\Models;

class BlogCategory extends CoreModel
{
    protected $table = 'shaadi_blog_categories';

    protected $fillable =[
        'title',
        'slug',
        'status',
        'deleted',
        'created_by',
        'updated_by',
    ];
}
