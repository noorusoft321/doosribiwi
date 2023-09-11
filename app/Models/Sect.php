<?php

namespace App\Models;

class Sect extends CoreModel
{
    protected $table = 'shaadi_sects';

    protected $fillable =[
        'title',
        'slug',
        'religions_id',
        'order_at',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
