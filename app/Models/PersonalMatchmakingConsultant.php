<?php

namespace App\Models;

class PersonalMatchmakingConsultant extends CoreModel
{
    protected $table = 'shaadi_personal_matchmaking_consultants';

    protected $fillable =[
        'title',
        'country',
        'number_type',
        'number',
        'slug',
        'order_at',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
