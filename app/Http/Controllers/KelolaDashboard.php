<?php

namespace App\Http\Controllers;


use App\Transaksi;
use Illuminate\Http\Request;

class KelolaDashboard extends Controller
{
    public function ViewDashboard()
    {
    	$transaksis = Transaksi::all();

        // LOOPING TOTAL!
         $totals = 0;
        //JIKA DATA ADA
        if ($transaksis->count() > 0) {
            //MENGAMBIL VALUE DARI TOTAL -> PLUCK() AKAN MENGUBAHNYA MENJADI ARRAY
            $sub_total = $transaksis->pluck('totals')->all();
            //KEMUDIAN DATA YANG ADA DIDALAM ARRAY DIJUMLAHKAN
            $total = array_sum($sub_total);
                //LOOPING JUMLAH
                    $data = 0;
                    if ($transaksis->count() > 0) {
                    //DI-LOOPING
                    foreach ($transaksis as $row) {
                        //UNTUK MENGAMBIL QTY 
                        $jumlah_barang = $transaksis->pluck('jumlah_barang')->all();
                        //KEMUDIAN QTY DIJUMLAHKAN
                        $val = array_sum($jumlah_barang);
                        $data += $val;
                 } 
             }
                        //JML PEMESAN
                        $pemesan = Transaksi::select('transaksis.nama_pemesan')->count('nama_pemesan');
        }
    	return view('dashboard',compact('total','pemesan','data'));
    }

   
}
