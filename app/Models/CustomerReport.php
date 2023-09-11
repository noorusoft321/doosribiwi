<?php

namespace App\Models;

use App\helpers\FakerURL;

class CustomerReport extends CoreModel
{
    protected $table = 'shaadi_customer_reports';

    protected $fillable =[
        'reportBy',
        'reportTo',
        'desc',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];

    protected $appends = ['report_by_name','report_to_name','faker_report_by','faker_report_to'];

    public function getReportBy()
    {
        return $this->belongsTo(Customer::class, 'reportBy','id');
    }

    public function getReportTo()
    {
        return $this->belongsTo(Customer::class, 'reportTo','id');
    }

    public function getReportByNameAttribute()
    {
        if (!empty($this->getReportBy()->first())) {
            return $this->getReportBy()->first()->full_name;
        }
        return $this->reportBy;
    }

    public function getReportToNameAttribute()
    {
        if (!empty($this->getReportTo()->first())) {
            return $this->getReportTo()->first()->full_name;
        }
        return $this->reportTo;
    }

    public function getFakerReportByAttribute()
    {
        return FakerURL::id_e($this->reportBy);
    }

    public function getFakerReportToAttribute()
    {
        return FakerURL::id_e($this->reportTo);
    }

}
