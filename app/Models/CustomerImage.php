<?php

namespace App\Models;

class CustomerImage extends CoreModel
{
    protected $table = 'shaadi_customer_images';

    protected $fillable =[
        'CustomerID',
        'image',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];

    protected $appends = ['faker_id', 'imageFullPath'];

    public function getImageFullPathAttribute()
    {
        if (file_exists(public_path('customer-images/'.$this->image))) {
            return env('APP_URL').'/customer-images/'.$this->image;
        }
        return env('APP_URL').'/customer-images/default-user.png';
    }
}
