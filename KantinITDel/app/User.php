<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'tanggal_Lahir', 'email', 'password', 'level', 'tingkat', 'jenis_Kelamin', 'alamat', 'kedudukan'
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

    public function kategori(){
    	return $this->hasMany('App\Kategori');
    }

    public function informasi(){
    	return $this->hasMany('App\Informasi');
    }

    public function pengumuman(){
    	return $this->hasMany('App\Pengumuman');
    }

    public function ruangan_kantin(){
    	return $this->hasMany('App\Ruangan_Kantin');
    }

    public function alergi(){
    	return $this->hasMany('App\Alergi');
    }

    public function izin_tdkMakan(){
    	return $this->hasMany('App\Izin_tdkMakan');
    }

    public function menu(){
    	return $this->hasMany('App\Menu');
    }

    public function komen(){
    	return $this->hasMany('App\Komen');
    }

    public function piket(){
    	return $this->hasMany('App\Piket');
    }
}
