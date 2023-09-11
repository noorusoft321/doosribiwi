<?php

namespace App\Models;

class CustomerDocument extends CoreModel
{
    protected $table = 'shaadi_customer_documents';

    protected $fillable =[
        'CustomerID',
        'bankSlip',
        'nic_front',
        'nic_back',
        'salary_slip',
        'electric_bill',
        'gas_bill',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
