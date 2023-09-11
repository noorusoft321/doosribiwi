<?php

namespace App\Models;

class CustomerResidentialInfo extends CoreModel
{
    protected $table = 'shaadi_customer_residential_infos';

    protected $fillable =[
        'CustomerID',
        'ResidenceStatus',
        'HouseSize',
        'ResidenceArea',
        'ResidenceCity',
        'Nationality',
        'FamilyValues',
        'CompleteAddress',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
