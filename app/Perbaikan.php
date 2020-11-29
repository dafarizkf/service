<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    protected $fillable = [
        'kd_perbaikan', 'kd_pemesanan', 'nama', 'no_hp', 'alamat', 'barang', 'jumlah_barang', 'waktu_pemesanan', 'status'
    ];
}