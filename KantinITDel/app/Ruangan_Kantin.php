<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan_Kantin extends Model
{
    protected $table = 'ruang_kantin';

    protected $fillable = [
        'aksi','ruangan','tanggal_Penggunaan','user_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
