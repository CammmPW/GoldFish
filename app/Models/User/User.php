<?php

namespace App\Models\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User\Permissions;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'username', 'mail', 'password','last_login', 'ip_register', 'ip_current', 'account_created', 'motto', 'rank'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'mail_verified' => 'datetime',
    ];
    public function diamonds()
    {
        return $this->hasOne('App\Models\User\User_Currency', 'user_id', 'id')->where('type', '5');
    }
    public function duckets()
    {
        return $this->hasOne('App\Models\User\User_Currency', 'user_id', 'id')->where('type', '0');
    }
    public function getRouteKeyName()
    {
        return 'username';
    }
    public function rank_name()
    {
        return $this->belongsTo(Permissions::class, 'rank');
    }
}
