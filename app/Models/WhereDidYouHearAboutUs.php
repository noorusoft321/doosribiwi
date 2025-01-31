<?php

namespace App\Models;

class WhereDidYouHearAboutUs extends CoreModel
{
    protected $table = 'shaadi_where_did_you_hear_about_us';

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
