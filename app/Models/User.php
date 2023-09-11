<?php

namespace App\Models;

use App\helpers\FakerURL;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $table = 'shaadi_users';
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'supervisor_id',
        'authy_approval_id',
        'authy_approval_status',
        'deleted'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['faker_id','role_name','supervisor_name'];

    public function getFakerIdAttribute()
    {
        return FakerURL::id_e($this->id);
    }

    public function getRoleNameAttribute()
    {
        if (!empty($this->getRole()->first())) {
            return $this->getRole()->first()->title;
        }
        return 'N/A';
    }

    public function getSupervisorNameAttribute()
    {
        if (!empty($this->getSupervisor()->first())) {
            return $this->getSupervisor()->first()->name;
        }
        return null;
    }

    public function getRole()
    {
        return $this->belongsTo(UserRole::class, 'role_id','id');
    }

    public function getSupervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id','id');
    }

}
