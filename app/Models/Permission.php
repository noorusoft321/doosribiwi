<?php

namespace App\Models;

class Permission extends CoreModel
{
    protected $table = 'shaadi_permissions';

    protected $fillable =[
        'role_id',
        'modules',
        'deleted'
    ];

    protected $appends = ['decodedModules'];

    function role(){
        return $this->belongsTo(UserRole::class,'role_id', 'id');
    }

    public function getDecodedModulesAttribute(){
        return json_decode($this->modules);
    }
}
