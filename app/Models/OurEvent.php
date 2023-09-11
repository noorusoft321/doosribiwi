<?php

namespace App\Models;

class OurEvent extends CoreModel
{
    protected $table = 'shaadi_our_events';

    protected $fillable =[
        'title',
        'main_image',
        'event_date',
        'slug',
        'order_at',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
