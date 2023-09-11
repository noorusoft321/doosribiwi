<?php

namespace App\Models;

class UserRole extends CoreModel
{
    protected $table = 'shaadi_user_roles';

    protected $fillable =[
        'title',
        'status',
        'deleted',
        'deleted_by',
        'created_by',
        'updated_by',
    ];
}
