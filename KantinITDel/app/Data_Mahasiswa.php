<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data_Mahasiswa extends Model
{
    protected $table = 'data_mahasiswa';

    protected $fillable = [
        'jumlah_mahasiswa','laki_laki','perempuan'
    ];
}
