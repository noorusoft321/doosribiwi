<?php

namespace App\Models;

class CustomerPersonalInfo extends CoreModel
{
    protected $table = 'shaadi_customer_personal_infos';

    protected $fillable =[
        'CustomerID',
        'CountryOfOrigin',
        'StateOfOrigin',
        'CityOfOrigin',
        'WillingToRelocate',
        'MyIncome',
        'IAmLookingToMarry',
        'MaritalStatus',
        'MyLivingArrangements',
        'Heights',
        'MyBuilds',
        'HairColors',
        'EyeColors',
        'Smokes',
        'Disabilities',
        'Weights',
        'Complexions',
        'Caste',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
