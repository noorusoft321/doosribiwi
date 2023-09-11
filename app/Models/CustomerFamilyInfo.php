<?php

namespace App\Models;

class CustomerFamilyInfo extends CoreModel
{
    protected $table = 'shaadi_customer_family_infos';

    protected $fillable =[
        'CustomerID',
        'fatherName',
        'fatherProfession',
        'motherName',
        'motherProfession',
        'totalNoOfSisters',
        'totalNoOfBrothers',
        'marriedSisters',
        'marriedBrothers',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
