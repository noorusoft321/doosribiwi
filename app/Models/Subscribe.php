<?php

namespace App\Models;

class Subscribe extends CoreModel
{
    protected $table = 'shaadi_subscribes';

    protected $fillable =[
        'subscribeEmail',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
