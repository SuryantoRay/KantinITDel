<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuangKantinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruang_kantin', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('ruangan');
            $table->date('tanggal_Penggunaan');
            $table->string('aksi')->default("menunggu");
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
        Schema::dropIfExists('ruang_kantin');
    }
}
