<?php

namespace App\Models;

class DoYouHaveBeard extends CoreModel
{
    protected $table = 'shaadi_do_you_have_beards';

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

    protected $hidden = ['laravel_through_key'];
}
