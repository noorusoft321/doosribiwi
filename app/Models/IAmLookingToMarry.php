<?php

namespace App\Models;

class IAmLookingToMarry extends CoreModel
{
    protected $table = 'shaadi_i_am_looking_to_marries';

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
