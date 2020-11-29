<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pengembalian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kd_pengembalian');
            $table->integer('id_pekerja');
            $table->string('nama_pemesan');
            $table->bigInteger('no_hp');
            $table->string('alamat');
            $table->string('barang');
            $table->integer('jumlah_barang');
            $table->bigInteger('totals');
            $table->string('inti_kerusakan');
            $table->string('deskripsi');
            $table->date('waktu_pemesanan');
            $table->date('waktu_perbaikan');
            $table->string('keterangan');
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
        Schema::dropIfExists('pengembalians');
    }
}
