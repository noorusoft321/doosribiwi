<?php

namespace App\Models;

class ReasonForRegistration extends CoreModel
{
    protected $table = 'shaadi_reason_for_registrations';

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
