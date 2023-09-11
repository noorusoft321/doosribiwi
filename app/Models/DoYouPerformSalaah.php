<?php

namespace App\Models;

class DoYouPerformSalaah extends CoreModel
{
    protected $table = 'shaadi_do_you_perform_salaahs';

    protected $fillable =[
        'title',
        'slug',
        'order_at',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
