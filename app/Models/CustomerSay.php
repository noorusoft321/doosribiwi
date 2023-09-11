<?php

namespace App\Models;

class CustomerSay extends CoreModel
{
    protected $table = 'shaadi_customer_says';

    protected $fillable =[
        'name',
        'designation',
        'stars',
        'review',
        'main_image',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
