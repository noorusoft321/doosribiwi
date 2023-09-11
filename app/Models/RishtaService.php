<?php

namespace App\Models;

class RishtaService extends CoreModel
{
    protected $table = 'shaadi_rishta_services';

    protected $fillable =[
        'title',
        'short_desc',
        'order_at',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
