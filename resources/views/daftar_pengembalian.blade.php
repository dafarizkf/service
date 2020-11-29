@extends('template')
@section('menu')
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <div class="sidenav-header  align-items-center">
      <a class="navbar-brand" href="javascript:void(0)">
        <img src="{{ asset('icons/logo.png') }}" class="navbar-brand-img" alt="...">
        Electronic Arts
      </a>
    </div>
    <div class="navbar-inner">
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard') }}">
              <i class="ni ni-tv-2 text-primary"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
          @if(auth()->user()->role == 'admin')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/kelola_akun') }}">
              <i class="ni ni-badge text-orange"></i>
              <span class="nav-link-text">Kelola Akun</span>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/daftar_pesanan') }}">
              <i class="ni ni-bullet-list-67 text-primary"></i>
              <span class="nav-link-text">Daftar Pesanan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/daftar_perbaikan') }}">
              <i class="ni ni-settings text-yellow"></i>
              <span class="nav-link-text">Daftar Perbaikan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ url('/daftar_pengembalian') }}">
              <i class="ni ni-delivery-fast text-default"></i>
              <span class="nav-link-text">Daftar Pengambilan</span>
            </a>
          </li>
          @if(auth()->user()->role == 'admin')
          <li class="nav-item">
            <a class="nav-link" href="login.html">
              <i class="ni ni-single-copy-04 text-info"></i>
              <span class="nav-link-text">Laporan</span>
              @endif
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
@endsection
@section('konten')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#">Tables</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tables</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Daftar Pengembalian</h3>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort">No</th>
                <th scope="col" class="sort">Nama Pemilik</th>
                <th scope="col" class="sort">Jumlah Barang</th>
                <th scope="col" class="sort">Kerusakan</th>
                <th scope="col" class="sort">Sub Total</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach($pengembalians as $pengembalian)
              @php
                $barangs = \App\Pengembalian::where('nama_pemesan', $pengembalian->nama_pemesan)
                ->sum('jumlah_barang');
                $kd_pengembalian = \App\Pengembalian::select('pengembalians.kd_pengembalian')
                ->where('pengembalians.nama_pemesan', $pengembalian->nama_pemesan)
                ->first();
                $totals = \App\Pengembalian::where('nama_pemesan', $pengembalian->nama_pemesan)
                ->sum('totals');
                $querys = \App\Pengembalian::select('pengembalians.inti_kerusakan')
                ->where('nama_pemesan', $pengembalian->nama_pemesan)
                ->get();
              @endphp
              <tr>
                <th>{{ $loop->iteration }}</th>
                <th>{{ $pengembalian->nama_pemesan }}</th>
                <td>{{ $barangs }}</td>
                <td>
                  @foreach($querys as $query)
                  *{{ $query->inti_kerusakan }}<br>
                  @endforeach
                </td>
                <td>Rp.{{ number_format($totals,2,',','.') }}</td>
                <td>
                  <a href="{{ url('/proses_pembayaran').'/'.$kd_pengembalian->kd_pengembalian }}" class="btn btn-primary btn-sm">Proses</a>
                </td>
                {{-- <td>
                  @if()
                  <a href="{{ url('/proses_pembayaran').'/'.$kd_pengembalian->kd_pengembalian }}" class="btn btn-success btn-sm">Proses</a>
                </td>
                @endif --}}
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- Card footer -->
        <div class="card-footer py-4">
          <nav aria-label="...">
            <ul class="pagination justify-content-end mb-0">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                  <i class="fas fa-angle-left"></i>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">
                  <i class="fas fa-angle-right"></i>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer pt-0">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6">
        <div class="copyright text-center  text-lg-left  text-muted">
          &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
          <li class="nav-item">
            <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
          </li>
          <li class="nav-item">
            <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
          </li>
          <li class="nav-item">
            <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
</div>
@endsection