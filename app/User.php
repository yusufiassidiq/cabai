<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role', 'status','fotosk'
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
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function lokasi(){
        return $this->hasOne('App\Lokasi');
    }

    public function praProduksi(){
        return $this->hasMany('App\PraProduksi');
    }

    public function kemitraan(){
        return $this->hasMany('App\Kemitraan');
    }
    public function transaksi(){
        return $this->hasMany('App\Transaksi');
    }
    public function inventaris(){
        return $this->hasOne('App\Inventaris');
    }
}
