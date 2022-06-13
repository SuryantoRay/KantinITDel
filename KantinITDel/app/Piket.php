<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piket extends Model
{
    protected $table = 'piket';

    protected $fillable = [
        'isi','user_id', 'keterangan'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
