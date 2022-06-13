<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Izin_tdkMakan extends Model
{
    protected $table = 'izin_tdk_makan';

    protected $fillable = [
        'user_id','tanggal','waktu','alasan','status'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
