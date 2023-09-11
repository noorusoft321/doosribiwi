<?php

namespace App\Models;

class GovermentRegisteredMarraigeBureau extends CoreModel
{
    protected $table = 'shaadi_goverment_registered_marraige_bureaus';

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
