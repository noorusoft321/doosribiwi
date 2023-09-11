<?php

namespace App\Models;

class CallHistory extends CoreModel
{
    protected $table = 'shaadi_calls_history';

    protected $fillable =[
        'type',
        'user_id',
        'customer_id',
        'comment'
    ];

    protected $appends = ['user_name'];

    public function getUserNameAttribute()
    {
        if (!empty($this->getUser()->first())) {
            return $this->getUser()->first()->name;
        }
        return null;
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
