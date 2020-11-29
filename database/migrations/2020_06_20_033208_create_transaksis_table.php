<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kd_transaksi');
            $table->string('nama_pemesan');
            $table->char('no_hp');
            $table->string('alamat');
            $table->string('barang');
            $table->bigInteger('totals');
            $table->bigInteger('bayar');
            $table->bigInteger('kembali');
            $table->integer('jumlah_barang');
            $table->string('inti_kerusakan');
            $table->string('deskripsi');
            $table->date('waktu_pemesanan');
            $table->date('waktu_perbaikan');
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
        Schema::dropIfExists('transaksis');
    }
}
