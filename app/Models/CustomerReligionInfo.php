<?php

namespace App\Models;

class CustomerReligionInfo extends CoreModel
{
    protected $table = 'shaadi_customer_religion_infos';

    protected $fillable =[
        'CustomerID',
        'Religions',
        'Sects',
        'DoYouPreferHijabs',
        'DoYouHaveBeards',
        'AreYouReverts',
        'DoYouKeepHalal',
        'DoYouPerformSalaah',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
