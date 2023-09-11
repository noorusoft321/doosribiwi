<?php

namespace App\Models;

class CustomerSaved extends CoreModel
{
    protected $table = 'shaadi_customer_saveds';

    protected $fillable =[
        'save_to',
        'save_by',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
