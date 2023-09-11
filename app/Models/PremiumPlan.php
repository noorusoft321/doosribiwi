<?php

namespace App\Models;

class PremiumPlan extends CoreModel
{
    protected $table = 'shaadi_premium_plans';

    protected $fillable =[
        'title',
        'long_desc',
        'main_image',
        'price',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
