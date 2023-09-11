<?php

namespace App\Models;

class WillingToRelocate extends CoreModel
{
    protected $table = 'shaadi_willing_to_relocates';

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
