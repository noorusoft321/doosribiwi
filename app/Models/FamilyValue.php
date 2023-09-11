<?php

namespace App\Models;

class FamilyValue extends CoreModel
{
    protected $table = 'shaadi_family_values';

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
