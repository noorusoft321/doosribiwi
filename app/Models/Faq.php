<?php

namespace App\Models;

class Faq extends CoreModel
{
    protected $table = 'shaadi_faqs';

    protected $fillable =[
        'title',
        'long_desc',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
