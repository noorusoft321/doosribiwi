<?php

namespace App\Models;

class CustomerSearch extends CoreModel
{
    protected $table = 'shaadi_customer_searches';

    protected $fillable =[
        'customerID',
        'title',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
