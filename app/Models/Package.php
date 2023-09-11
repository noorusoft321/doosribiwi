<?php

namespace App\Models;

class Package extends CoreModel
{
    protected $table = 'shaadi_packages';

    protected $fillable = [
        'package_name',
        'direct_messages',
        'duration',
        'profile_status',
        'profile_status_urdu',
        'price',
        'background_color',
        'color',
        'vip_status',
        'vip_status_urdu',
        'status'
    ];

}
