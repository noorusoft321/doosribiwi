<?php

namespace App\Models;

class ResidenceArea extends CoreModel
{
    protected $table = 'shaadi_residence_areas';

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
