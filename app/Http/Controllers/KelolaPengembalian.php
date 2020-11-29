<?php

namespace App\Http\Controllers;

use App\Pengembalian;
use App\Transaksi;
use Illuminate\Http\Request;

class KelolaPengembalian extends Controller
{
    public function ViewPengembalian()
    {
    	$pengembalians = Pengembalian::distinct()->get(['nama_pemesan']);
        

    	return view('daftar_pengembalian', compact('pengembalians'));
    }

    public function ProsesPembayaran($id)
    {
    	$pemilik = Pengembalian::where('pengembalians.kd_pengembalian', $id)
    	->first();
    	$pengembalians = Pengembalian::join('users', 'users.id', '=', 'pengembalians.id_pekerja')
    	->where('nama_pemesan', $pemilik->nama_pemesan)
    	->select('pengembalians.*', 'users.name as nama_pekerja')
    	->get();
    	$subtotal = Pengembalian::where('pengembalians.nama_pemesan', $pemilik->nama_pemesan)
    	->sum('totals');

        $max = Transaksi::max('kd_transaksi');
        $check_max = Transaksi::select('transakis.kd_transaksi')->count();
        if($check_max == null){
            $max_code = "T0001";
        }else{
            $max_code = $max[1].$max[2].$max[3].$max[4];        
            $max_code++;
            if($max_code <= 9){
                $max_code = "T000".$max_code;
            }elseif ($max_code <= 99) {
                $max_code = "T00".$max_code;
            }elseif ($max_code <= 999) {
                $max_code = "T0".$max_code;
            }elseif ($max_code <= 99) {
                $max_code = "T".$max_code;
            }
        }
        $transakis = Transaksi::all();

    	return view('checkout', compact('pemilik', 'pengembalians', 'subtotal', 'max_code'));
    }

    public function Bayar(Request $request,$id)
    {
    	if($request->bayar < $request->subtotal)
    	{
    		return redirect()->back();
    	}else{
            $pengembalians = Pengembalian::find($id);
    		$pemilik = Pengembalian::select('pengembalians.*')
    		->where('kd_pengembalian', $request->pemilik)
    		->first();
    		$pemiliks = Pengembalian::select('pengembalians.*')
    		->where('nama_pemesan', $pemilik->nama_pemesan)
    		->get();
    		$bayar = $request->bayar;
    		$subtotal = $request->subtotal;
    		$kembali = $request->kembali;

            //menyimpan history transaksi
            $transakis = new Transaksi;
            $transakis->kd_transaksi = $request->kd_transaksi;
            $transakis->nama_pemesan = $request->nama;
            $transakis->no_hp = $request->hp;
            $transakis->alamat = $request->alamat;
            $transakis->barang = $request->barang;
            $transakis->totals = $request->total;
            $transakis->bayar = $request->bayar;
            $transakis->kembali = $request->kembali;
            $transakis->kasir = $request->pekerja;
            $transakis->jumlah_barang = $request->jumlah_barang;
            $transakis->inti_kerusakan = $request->inti_kerusakan;
            $transakis->deskripsi = $request->deskripsi;
            $transakis->waktu_pemesanan = $request->waktu_pemesanan;
            $transakis->waktu_perbaikan = $request->waktu_perbaikan;
            $transakis->save();
            Pengembalian::destroy($id);

    		return view('struk', compact('pemiliks', 'bayar','subtotal','kembali'));
    	}
    }
}


//untuk menampilkan trash
/*
    $flights = App\Flight::withTrashed()
    ->where('')
    ->get();
*/

