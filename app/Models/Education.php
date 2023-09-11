<?php

namespace App\Models;

class Education extends CoreModel
{
    protected $table = 'shaadi_educations';

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
