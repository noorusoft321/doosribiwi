<?php

namespace App\Models;

class MaritalStatus extends CoreModel
{
    protected $table = 'shaadi_marital_statuses';

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
