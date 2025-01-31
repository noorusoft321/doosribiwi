<?php

namespace App\Models;

class HobbiesAndInterest extends CoreModel
{
    protected $table = 'shaadi_hobbies_and_interests';

    protected $fillable =[
        'title',
        'slug',
        'order_at',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by'
    ];

    protected $hidden = ['laravel_through_key'];
}
