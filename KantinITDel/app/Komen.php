<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komen extends Model
{
    protected $table = 'komen';

    protected $fillable = [
        'komen','status','nama','user_id','menu_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
