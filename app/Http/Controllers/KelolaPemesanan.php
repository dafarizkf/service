<?php

namespace App\Http\Controllers;

use App\Pemesanan;
use App\Perbaikan;
use Illuminate\Http\Request;

class KelolaPemesanan extends Controller
{
    public function ViewPemesanan()
    {
    	$max = Pemesanan::max('kd_pemesanan');
        $check_max = Pemesanan::select('pemesanans.kd_pemesanan')->count();
        if($check_max == null){
            $max_code = "P0001";
        }else{
            $max_code = $max[1].$max[2].$max[3].$max[4];        
            $max_code++;
            if($max_code <= 9){
                $max_code = "P000".$max_code;
            }elseif ($max_code <= 99) {
                $max_code = "P00".$max_code;
            }elseif ($max_code <= 999) {
                $max_code = "P0".$max_code;
            }elseif ($max_code <= 99) {
                $max_code = "P".$max_code;
            }
        }
    	$pemesanans = Pemesanan::all();

    	return view('daftar_pesanan', compact('pemesanans', 'max_code'));
    }

    public function SimpanPemesanan(Request $request)
    {
    	$pemesanans = new Pemesanan;
    	$pemesanans->kd_pemesanan = $request->kd_pemesanan;
    	$pemesanans->nama = $request->nama;
    	$pemesanans->no_hp = $request->no_hp;
    	$pemesanans->alamat = $request->alamat;
    	$pemesanans->barang = $request->barang;
    	$pemesanans->jumlah_barang = $request->jumlah_barang;
    	$pemesanans->waktu_pemesanan = $request->waktu_pemesanan;
    	$pemesanans->save();

        return redirect('/daftar_pesanan')->with('status','Data Berhasil Ditambahkan');
    	// return redirect()->back();
    }

    public function HapusPemesanan($id)
    {
    	Pemesanan::destroy($id);

    	return redirect()->back();
    }


    public function PerbaikiBarang($id)
    {
    	$pemesanans = Pemesanan::find($id);
    	$max = Perbaikan::max('kd_perbaikan');
        $check_max = Perbaikan::select('perbaikans.kd_perbaikan')->count();
        if($check_max == null){
            $max_code = "K0001";
        }else{
            $max_code = $max[1].$max[2].$max[3].$max[4];        
            $max_code++;
            if($max_code <= 9){
                $max_code = "K000".$max_code;
            }elseif ($max_code <= 99) {
                $max_code = "K00".$max_code;
            }elseif ($max_code <= 999) {
                $max_code = "K0".$max_code;
            }elseif ($max_code <= 99) {
                $max_code = "K".$max_code;
            }
        }
        $perbaikans = new Perbaikan;
        $perbaikans->kd_perbaikan = $max_code;
        $perbaikans->kd_pemesanan = $pemesanans->kd_pemesanan;
        $perbaikans->nama = $pemesanans->nama;
        $perbaikans->no_hp = $pemesanans->no_hp;
        $perbaikans->alamat = $pemesanans->alamat;
        $perbaikans->barang = $pemesanans->barang;
        $perbaikans->jumlah_barang = $pemesanans->jumlah_barang;
        $perbaikans->waktu_pemesanan = $pemesanans->waktu_pemesanan;
        $perbaikans->status = 'Belum Diperbaiki';
        $perbaikans->save();
        Pemesanan::destroy($id);

        return redirect()->back();
    }

    public function edit($id)
    {
        $pemesanans = pemesanan::find($id);

        return response()->json(['pemesanans' => $pemesanans]);
    }

    public function Kartu($id){
        $pemesanans = pemesanan::find($id);
        return view('card',compact('pemesanans'));
    }

     public function Cetak($id)
    {
        $pemesanans = pemesanan::find($id);
         return response()->json(['pemesanans' => $pemesanans]);
    }

     public function UpdatePesanan(Request $request, $id)
    {
        //
        $pemesanans = pemesanan::find($id);    
        $pemesanans->kd_pemesanan = $request->kd_pemesanan;
        $pemesanans->nama = $request->nama;
        $pemesanans->no_hp = $request->no_hp;
        $pemesanans->alamat = $request->alamat;
        $pemesanans->barang = $request->barang;
        $pemesanans->jumlah_barang = $request->jumlah_barang;
        $pemesanans->waktu_pemesanan = $request->waktu_pemesanan;
        $pemesanans->save();
    }

}
