<?php

namespace App\Models;

class CustomerCareerInfo extends CoreModel
{
    protected $table = 'shaadi_customer_career_infos';

    protected $fillable =[
        'CustomerID',
        'Qualification',
        'major_course_id',
        'University',
        'Profession',
        'JobPost',
        'MonthlyIncome',
        'FuturePlans',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
