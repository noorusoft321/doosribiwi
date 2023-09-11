<?php

namespace App\Models;

class CustomerNotExist extends CoreModel
{
    protected $table = 'shaadi_customer_not_exists';

    protected $fillable =[
        'email',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
