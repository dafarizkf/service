<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'kd_pemesanan', 'nama', 'no_hp', 'alamat', 'barang', 'jumlah_barang', 'waktu_pemesanan'
    ];
}
