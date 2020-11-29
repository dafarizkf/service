<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
    	'kd_transaksi','nama_pemesan','no_hp','alamat','barang','totals','bayar','kembali','jumlah_barang','inti_kerusakan','deskripsi','waktu_pemesanan','waktu_perbaikan'
       
    ];
}
