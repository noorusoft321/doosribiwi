<?php

namespace App\Models;

class CustomerImage extends CoreModel
{
    protected $table = 'shaadi_customer_images';

    protected $fillable =[
        'CustomerID',
        'image',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
