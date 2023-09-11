<?php

namespace App\Models;

use App\helpers\FakerURL;

class CustomerBlock extends CoreModel
{
    protected $table = 'shaadi_customer_blocks';

    protected $fillable =[
        'blockBy',
        'blockTo',
        'desc',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];

    protected $appends = ['block_by_name','block_to_name','faker_block_by','faker_block_to'];

    public function getBlockBy()
    {
        return $this->belongsTo(Customer::class, 'blockBy','id');
    }

    public function getBlockTo()
    {
        return $this->belongsTo(Customer::class, 'blockTo','id');
    }

    public function getBlockByNameAttribute()
    {
        if (!empty($this->getBlockBy()->first())) {
            return $this->getBlockBy()->first()->full_name;
        }
        return $this->blockBy;
    }

    public function getBlockToNameAttribute()
    {
        if (!empty($this->getBlockTo()->first())) {
            return $this->getBlockTo()->first()->full_name;
        }
        return $this->blockTo;
    }

    public function getFakerBlockByAttribute()
    {
        return FakerURL::id_e($this->blockBy);
    }

    public function getFakerBlockToAttribute()
    {
        return FakerURL::id_e($this->blockTo);
    }

}
