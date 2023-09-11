<?php

namespace App\Models;

class Blog extends CoreModel
{
    protected $table = 'shaadi_blogs';

    protected $fillable =[
        'title',
        'meta_description',
        'slug',
        'categoryId',
        'main_image',
        'desc',
        'status',
        'deleted',
        'created_by',
        'updated_by',
    ];

    protected $appends = ['faker_id','arr_category'];

    public function getArrCategoryAttribute()
    {
        if (!empty($this->categoryId)) {
            return explode(",",$this->categoryId);
        }
        return [];
    }

}
