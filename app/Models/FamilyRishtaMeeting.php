<?php

namespace App\Models;

class FamilyRishtaMeeting extends CoreModel
{
    protected $table = 'shaadi_family_rishta_meetings';

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
