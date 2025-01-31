<?php

namespace App\Models;

class MajorCourse extends CoreModel
{
    protected $table = 'shaadi_major_courses';

    protected $fillable =[
        'education_id',
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
