<?php

namespace App\Models;

class CustomerChatting extends CoreModel
{
    protected $table = 'shaadi_customer_chattings';

    protected $fillable =[
        'sender_id',
        'receiver_id',
        'both_id',
        'message',
        'message_status',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];

    public function getReceiverCustomer()
    {
        return $this->belongsTo(Customer::class, 'receiver_id','id');
    }

    public function getSenderCustomer()
    {
        return $this->belongsTo(Customer::class, 'sender_id','id');
    }
}
