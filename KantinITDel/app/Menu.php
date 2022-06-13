<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    protected $fillable = [
        'isi','user_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
