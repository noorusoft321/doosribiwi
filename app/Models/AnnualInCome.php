<?php

namespace App\Models;

class AnnualInCome extends CoreModel
{
    protected $table = 'shaadi_annual_in_comes';

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
