<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'judul', 'user_id', 'isi', 'gambar_p', 'kepada', 'status'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
