<?php

namespace App\Models;

class RegistrationsReason extends CoreModel
{
    protected $table = 'shaadi_registrations_reasons';

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
}
