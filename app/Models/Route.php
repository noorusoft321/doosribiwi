<?php

namespace App\Models;

class Route extends CoreModel
{
    protected $table = 'shaadi_routes';

    protected $fillable =[
        'route_name',
        'route_views',
        'deleted'
    ];
}
