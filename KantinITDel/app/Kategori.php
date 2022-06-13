<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'kode', 'kategori', 'user_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
