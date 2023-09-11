<?php

namespace App\Models;

class OurOffice extends CoreModel
{
    protected $table = 'shaadi_our_offices';

    protected $fillable =[
        'title',
        'main_image',
        'slug',
        'order_at',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
