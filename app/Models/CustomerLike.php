<?php

namespace App\Models;

class CustomerLike extends CoreModel
{
    protected $table = 'shaadi_customer_likes';

    protected $fillable =[
        'like_to',
        'like_by',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
