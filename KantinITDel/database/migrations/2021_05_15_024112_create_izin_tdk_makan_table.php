<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinTdkMakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izin_tdk_makan', function (Blueprint $table) {
            $table->id();
            $table->string("user_id");
            $table->date("tanggal");
            $table->string('waktu');
            $table->string('alasan');
            $table->string('status')->default("menunggu");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('izin_tdk_makan');
    }
}
