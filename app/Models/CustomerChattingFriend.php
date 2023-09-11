<?php

namespace App\Models;

class CustomerChattingFriend extends CoreModel
{
    protected $table = 'shaadi_customer_chatting_friends';

    protected $fillable =[
        'sender_id',
        'receiver_id',
        'message'
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
