<?php

namespace App\Models;

class CheckReq extends CoreModel
{
    protected $table = 'shaadi_check_req';

    protected $fillable =[
        'check_method',
        'check_url',
    ];
}
