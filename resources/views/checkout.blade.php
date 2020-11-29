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
          <li class="nav-item">
            <a class="nav-link" href="login.html">
              <i class="ni ni-single-copy-04 text-info"></i>
              <span class="nav-link-text">Laporan</span>
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
        <div class="col-lg-6 col-5 text-right">
          <a href="#" class="btn btn-sm btn-neutral">New</a>
          <a href="#" class="btn btn-sm btn-neutral">Filters</a>
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
          <h3 class="mb-0">Checkout Barang</h3>
          <br>
          <table cellpadding="3" cellspacing="3">
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td>{{ $pemilik->nama_pemesan }}</td>
            </tr>
            <tr>
              <td>No HP</td>
              <td>:</td>
              <td>{{ $pemilik->no_hp }}</td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td>{{ $pemilik->alamat }}</td>
            </tr>
          </table>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort">No</th>
                <th scope="col" class="sort">Barang</th>
                <th scope="col" class="sort">Jumlah Barang</th>
                <th scope="col" class="sort">Kerusakan</th>
                <th scope="col" class="sort">Deskripsi</th>
                <th scope="col" class="sort">Waktu Pemesanan</th>
                <th scope="col" class="sort">Waktu Perbaikan</th>
                <th scope="col" class="sort">Keterangan</th>
                <th scope="col" class="sort">Pekerja</th>
                <th scope="col" class="sort">Total</th>
              </tr>
            </thead>
            <tbody class="list">
                @foreach ($pengembalians as $pengembalian)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $pengembalian->barang }}</td>
                  <td>{{ $pengembalian->jumlah_barang }}</td>
                  <td>{{ $pengembalian->inti_kerusakan }}</td>
                  <td>{{ $pengembalian->deskripsi }}</td>
                  <td>{{ $pengembalian->waktu_pemesanan }}</td>
                  <td>{{ $pengembalian->waktu_perbaikan }}</td>
                  <td>{{ $pengembalian->keterangan }}</td>
                  <td>{{ $pengembalian->nama_pekerja }}</td>
                  <td>Rp.{{ number_format($pengembalian->totals,2,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-12 p-4" align="right">
            <table cellspacing="2" cellpadding="4" class="text-right">
              <form method="POST" action="{{ url('/bayar',$pengembalian->id) }}">
                @csrf
                <tr>
                  <th>Subtotal</th>
                  <th>:</th>
                  <th>
                    <input class="form-control form-control-sm" type="text" value="Rp.{{ $subtotal }},00" readonly="" ></th>
                    <input type="text" id="subtotal_input" value="{{ $subtotal }}" name="subtotal" hidden="">
                </tr>
                <tr>
                  <td>Bayar</td>
                  <td>:</td>
                  <td>
                    <input class="form-control form-control-sm" type="number" name="bayar" id="bayar_input" required="">
                  </td>
                </tr>
                <tr>
                  <td>Kembalian</td>
                  <td>:</td>
                  <td>
                    <input class="form-control form-control-sm" type="text" id="kembali_input" readonly="">
                    <input type="hidden" id="kembalian" name="kembali">
                  </td>
                </tr>
                <tr>
                  <td>
                    <input class="form-control form-control-sm" type="text" name="kd_transaksi" readonly="" hidden="" value="{{ $max_code }}">
                    <input type="text" name="nama" hidden="" value="{{ $pengembalian->nama_pemesan }}">
                    <input type="text" name="hp" hidden="" value="{{ $pengembalian->no_hp }}">
                    <input type="text" name="alamat" hidden="" value="{{ $pengembalian->alamat }}">
                    <input type="text" name="barang" hidden="" value="{{ $pengembalian->barang }}">
                    <input type="text" name="pekerja" hidden="" value="{{ $pengembalian->nama_pekerja }}">
                    <input type="text" name="total" hidden="" value="{{ $pengembalian->totals }}">
                    <input type="text" name="jumlah_barang" hidden="" value="{{ $pengembalian->jumlah_barang }}">
                    <input type="text" name="inti_kerusakan" hidden="" value="{{ $pengembalian->inti_kerusakan }}">
                    <input type="text" name="deskripsi" hidden="" value="{{ $pengembalian->deskripsi }}">    
                    <input type="text" name="waktu_pemesanan" hidden="" value="{{ $pengembalian->waktu_pemesanan }}">
                    <input type="text" name="waktu_perbaikan" hidden="" value="{{ $pengembalian->waktu_perbaikan }}">             
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <input type="text" name="pemilik" value="{{ $pemilik->kd_pengembalian }}" hidden="">
                    <button type="submit" class="btn btn-success btn-block">Bayar</button>
                  </td>
                </tr>
              </form>
            </table>
          </div>
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
@section('script')
 <script src="{{ asset('assets/js/jquery-3.2.1.slim.min.js') }}" ></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}" ></script>
  <script src="{{ asset('assets/js/jquery-3.4.1.js') }}"></script>
<script type="text/javascript">
  $('#bayar_input').on('keyup', function() {
    var subtotal = $('#subtotal_input').val();
    var bayar = $(this).val();
    var kembali = bayar - subtotal;
    $('#kembali_input').val('Rp. '+kembali+',00');
    $('#kembalian').val(kembali)
  });

  $('#bayar_input').on('change', function() {
    var subtotal = $('#subtotal_input').val();
    var bayar = $(this).val();
    var kembali = bayar - subtotal;
    $('#kembali_input').val('Rp. '+kembali+',00');
    $('#kembalian').val(kembali)
  });
</script>
@endsection