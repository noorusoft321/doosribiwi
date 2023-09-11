<?php

namespace App\Models;

class ResidenceStatus extends CoreModel
{
    protected $table = 'shaadi_residence_statuses';

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
