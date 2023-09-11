<?php

namespace App\Models;

class CustomerProfileView extends CoreModel
{
    protected $table = 'shaadi_customer_profile_views';

    protected $fillable =[
        'view_to',
        'view_by',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
