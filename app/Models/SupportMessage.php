<?php

namespace App\Models;

class SupportMessage extends CoreModel
{
    protected $table = 'shaadi_support_messages';

    protected $fillable = [
        'customer_id',
        'full_name',
        'mobile_number',
        'discussion',
        'issue',
        'ip_address'
    ];

    protected $appends = ['faker_id','last_message'];

    public function getLastMessageAttribute()
    {
        $discussionsArray = explode("|||",$this->discussion);
        return end($discussionsArray);
    }

    public function getCustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_id','id');
    }

}
