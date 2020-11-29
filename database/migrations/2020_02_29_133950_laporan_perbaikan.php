<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaporanPerbaikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kd_perbaikan');
            $table->integer('id_pekerja');
            $table->string('nama_pemesan');
            $table->char('no_hp');
            $table->string('alamat');
            $table->string('barang');
            $table->integer('jumlah_barang');
            $table->date('waktu_pemesanan');
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
        Schema::dropIfExists('laporans');
    }
}
