<?php

namespace App\Models;

class CustomerOtherInfo extends CoreModel
{
    protected $table = 'shaadi_customer_other_infos';

    protected $fillable =[
        'RegistrationID',
        'gender',
        'country_id',
        'state_id',
        'city_id',
        'area_id',
        'ResidenceAreaID',
        'ReligionsID',
        'SectID',
        'dob_date',
        'dob_month',
        'dob_year',
        'DOB',
        'age',
        'RegistrationsReasonsID',
        'WhereDidYouHearAboutUsID',
        'MaritalStatusID',
        'childrenQuantity',
        'divorceReason',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
        'EducationID',
        'OccupationID',
        'MyFirstLanguageMotherTonguesID',
        'MySecondLanguageMotherTonguesID',
        'address',
        'post_zip_code',
        'persona_note',
        'personal_note_approve',
        'hobbiesAndInterest',
    ];
}
