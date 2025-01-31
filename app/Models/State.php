<?php

namespace App\Models;

class State extends CoreModel
{
    protected $table = 'shaadi_states';

    protected $fillable =[
        'country_id',
        'title',
        'slug',
        'order_at',
        'status',
        'deleted',
        'deleted_by',
        'created_by',
        'updated_by',
    ];

    protected $hidden = ['laravel_through_key'];

    public function getCities()
    {
        return $this->hasMany(City::class, 'state_id');
    }

}
