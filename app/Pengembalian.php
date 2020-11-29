<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengembalian extends Model
{
	use SoftDeletes;

    protected $fillable = [
    	'kd_pengembalian','id_pekerja','nama_pemesan','no_hp','alamat','barang','jumlah_barang','totals','inti_kerusakan','deskripsi','waktu_pemesanan','waktu_perbaikan','keterangan'
       
    ];
  
}
