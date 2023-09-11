<?php

namespace App\Models;

class UserOtherInfo extends CoreModel
{
    protected $table = 'shaadi_user_other_infos';

    protected $fillable =[
        'gender',
        'country_id',
        'state_id',
        'city_id',
        'ReligionsID',
        'SectID',
        'dob_date',
        'dob_month',
        'dob_year',
        'DOB',
        'RegistrationsReasonsID',
        'WhereDidYouHearAboutUsID',
        'RegistrationID',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
