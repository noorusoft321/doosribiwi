<?php

namespace App\Models;
use App\helpers\FakerURL;
use Illuminate\Database\Eloquent\Model;

class CoreModel extends Model
{
    protected $appends = ['faker_id'];

    public function getFakerIdAttribute()
    {
        return FakerURL::id_e($this->id);
    }

}
