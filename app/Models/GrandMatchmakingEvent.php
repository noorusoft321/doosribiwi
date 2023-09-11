<?php

namespace App\Models;

class GrandMatchmakingEvent extends CoreModel
{
    protected $table = 'shaadi_grand_matchmaking_events';

    protected $fillable =[
        'title',
        'main_image',
        'slug',
        'order_at',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
