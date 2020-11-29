<?php

namespace App\Http\Controllers;

use Auth;
use App\Perbaikan;
use App\Pengembalian;
use Illuminate\Http\Request;

class KelolaPerbaikan extends Controller
{
    public function ViewPerbaikan()
    {
    	$perbaikans = Perbaikan::all();

    	return view('daftar_perbaikan', compact('perbaikans'));
    }

    public function SelesaiShow($id)
    {
    	$perbaikans = Perbaikan::find($id);

    	return response()->json(['perbaikans' => $perbaikans]);
    }

    public function ProsesPerbaikan(Request $request)
    {
    	$currentDate = \Carbon\Carbon::now();
    	$max = Pengembalian::max('kd_pengembalian');
        $check_max = Pengembalian::select('pengembalians.kd_pengembalian')->count();
        if($check_max == null){
            $max_code = "R0001";
        }else{
            $max_code = $max[1].$max[2].$max[3].$max[4];        
            $max_code++;
            if($max_code <= 9){
                $max_code = "R000".$max_code;
            }elseif ($max_code <= 99) {
                $max_code = "R00".$max_code;
            }elseif ($max_code <= 999) {
                $max_code = "R0".$max_code;
            }elseif ($max_code <= 99) {
                $max_code = "R".$max_code;
            }
        }
    	$perbaikans = Perbaikan::find($request->id_perbaikan);
    	$pengembalians = new Pengembalian;
    	$pengembalians->kd_pengembalian = $max_code;
    	$pengembalians->id_pekerja = Auth::id();
    	$pengembalians->nama_pemesan = $perbaikans->nama;
    	$pengembalians->no_hp = $perbaikans->no_hp;
    	$pengembalians->alamat = $perbaikans->alamat;
    	$pengembalians->barang = $perbaikans->barang;
    	$pengembalians->jumlah_barang = $perbaikans->jumlah_barang;
    	$pengembalians->waktu_pemesanan = $perbaikans->waktu_pemesanan;
    	$pengembalians->waktu_perbaikan = $currentDate->isoFormat('Y-M-D');
    	$pengembalians->totals = $request->total;
    	$pengembalians->inti_kerusakan = $request->inti;
    	$pengembalians->deskripsi = $request->deskripsi;
    	$pengembalians->keterangan = 'Diperbaiki';
    	$pengembalians->save();
    	Perbaikan::destroy($request->id_perbaikan);

    	return redirect()->back();
    }
}
