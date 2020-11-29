<?php

namespace App\Http\Controllers;

use App\User;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;


class KelolaLaporan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::all();
        $users = User::all();
        // select('users.role')->where('pekerja');

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
                        $pemesan = Transaksi::where('transaksis.nama_pemesan')->sum('nama_pemesan');
        }
        
        return view('administrator.laporan',compact('transaksis','total','data','pemesan','users'));
        //JIKA START DATE & END DATE TERISI
    if (!empty($request->start_date) && !empty($request->end_date)) {
        //MAKA DI VALIDASI DIMANA FORMATNYA HARUS DATE
        $this->validate($request, [
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date'
        ]);
        
        //START & END DATE DI RE-FORMAT MENJADI Y-m-d H:i:s
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01';
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59';

 
        //DITAMBAHKAN WHEREBETWEEN CONDITION UNTUK MENGAMBIL DATA DENGAN RANGE
        $transaksis = $transaksis->whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
        //JIKA START DATE & END DATE KOSONG, MAKA DI-LOAD 10 DATA TERBARU
        $transaksis = $transaksis->take(10)->skip(0)->get();
    }

 
    // MENAMPILKAN KE VIEW
    // return view('administrator.laporan', [
    //     'transaksis' => $transaksis,
    //     'sold' => $this->countItem($transaksis),
    //     'total' => $this->countTotal($transaksis),
    //     'total_customer' => $this->countpemesan($transaksis)
    // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

//     private function countpemesan($transaksis)
//     {
//         //ARRAY KOSONG DIDEFINISIKAN
//         $nama_pemesan = [];
//         //JIKA TERDAPAT DATA YANG AKAN DITAMPILKAN
//         if ($transaksis->count() > 0) {
//             //DI-LOOPING UNTUK MENYIMPAN EMAIL KE DALAM ARRAY
//             foreach ($transaksis as $row) {
//                 $nama_pemesan[] = $row->transaksis->nama_pemesan;
//             }
//         }
//         //MENGHITUNG TOTAL DATA YANG ADA DI DALAM ARRAY
//         //DIMANA DATA YANG DUPLICATE AKAN DIHAPUS MENGGUNAKAN ARRAY_UNIQUE
//         return count(array_unique($nama_pemesan));
//     }

// private function countTotal($transaksis)
//     {
//         //DEFAULT TOTAL BERNILAI 0
//         $totals = 0;
//         //JIKA DATA ADA
//         if ($transaksis->count() > 0) {
//             //MENGAMBIL VALUE DARI TOTAL -> PLUCK() AKAN MENGUBAHNYA MENJADI ARRAY
//             $sub_total = $transaksis->pluck('totals')->all();
//             //KEMUDIAN DATA YANG ADA DIDALAM ARRAY DIJUMLAHKAN
//             $total = array_sum($sub_total);
//         }
//         return $total;
//     }

// private function countItem($transaksis)
//     {
//         //DEFAULT DATA 0
//         $data = 0;
//         //JIKA DATA TERSEDIA
//         if ($transaksi->count() > 0) {
//             //DI-LOOPING
//             foreach ($transaksi as $row) {
//                 //UNTUK MENGAMBIL QTY 
//                 $jumlah_barang = $row->transaksis->pluck('jumlah_barang')->all();
//                 //KEMUDIAN QTY DIJUMLAHKAN
//                 $val = array_sum($jumlah_barang);
//                 $data += $val;
//             }
//         } 
//         return $data;
//     }
}
