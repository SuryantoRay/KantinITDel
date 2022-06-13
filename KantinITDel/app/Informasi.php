<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $table = 'informasi';

    protected $fillable = [
        'judul','kategori','gambar_if','isi','user_id', 'status'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
