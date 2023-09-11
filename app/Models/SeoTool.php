<?php

namespace App\Models;

class SeoTool extends CoreModel
{
    protected $table = 'shaadi_seo_tools';

    protected $fillable =[
        'type',
        'page_url',
        'customer_id',
        'title',
        'description',
        'site_name',
        'image',
        'schema_script'
    ];

}
