<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alergi extends Model
{
    protected $table = 'alergi';

    protected $fillable = [
        'alergi','gambar_ar','status','user_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
