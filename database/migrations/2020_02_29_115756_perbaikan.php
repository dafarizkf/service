<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Perbaikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kd_pemesanan');
            $table->string('kd_perbaikan');
            $table->string('nama');
            $table->char('no_hp');
            $table->string('alamat');
            $table->string('barang');
            $table->integer('jumlah_barang');
            $table->date('waktu_pemesanan');
            $table->string('status');
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
        Schema::dropIfExists('perbaikans');
    }
}