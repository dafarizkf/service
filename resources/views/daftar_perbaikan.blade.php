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
            <a class="nav-link active" href="{{ url('/daftar_perbaikan') }}">
              <i class="ni ni-settings text-yellow"></i>
              <span class="nav-link-text">Daftar Perbaikan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/daftar_pengembalian') }}">
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
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--6">
  <div class="row">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Perbaiki Barang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{ url('/proses_perbaikan') }}">
            <div class="modal-body">
                @csrf
                <div class="row">
                  <div class="col-lg-6">
                    <table cellspacing="3" cellpadding="3">
                      <tr>
                        <td>Kode</td>
                        <td>:</td>
                        <td id="kd_perbaikan_tb"></td>
                      </tr>
                      <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td id="nama_pemilik_tb"></td>
                      </tr>
                      <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td id="no_hp_tb"></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td id="alamat_tb"></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-lg-6">
                    <table cellspacing="3" cellpadding="3">
                      <tr>
                        <td>Barang</td>
                        <td>:</td>
                        <td id="nama_barang_tb"></td>
                      </tr>
                      <tr>
                        <td>Jumlah</td>
                        <td>:</td>
                        <td id="jml_barang_tb"></td>
                      </tr>
                      <tr>
                        <td>Waktu</td>
                        <td>:</td>
                        <td id="waktu_pemesanan_tb"></td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td id="status_tb"></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 mb-3 mt-3">
                    <input type="text" class="form-control" placeholder="Inti Kerusakan" name="inti" required="">
                    <input type="text" id="id_perbaikan" name="id_perbaikan" hidden="">
                  </div>
                  <div class="col-12 mb-3">
                    <textarea class="form-control" required="" placeholder="Deskripsi Kerusakan" rows="3" name="deskripsi"></textarea>
                  </div>
                  <div class="col-12 mb-3">
                    <div class="row">
                      <div class="col-8">
                        <input type="number" class="form-control" id="input_biaya" name="biaya" placeholder="Biaya Kerusakan">
                      </div>
                      <div class="col-4">
                        <label class="col-form-label"> / Jumlah</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 mb-3">
                    <input type="text" class="form-control" readonly="" id="total_bayar">
                    <input type="text" name="total" id="total_insert" hidden="">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Perbaiki</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Daftar Perbaikan</h3>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light text-center">
              <tr>
                <th scope="col" class="sort">No</th>
                <th scope="col" class="sort">Kode Perbaikan</th>
                <th scope="col" class="sort">Kode Pemesanan</th>
                <th scope="col" class="sort">Nama</th>
                <th scope="col" class="sort">No HP</th>
                <th scope="col" class="sort">Alamat</th>
                <th scope="col" class="sort">Barang</th>
                <th scope="col" class="sort">Jumlah</th>
                <th scope="col" class="sort">Waktu Pemesanan</th>
                <th scope="col" class="sort">Status</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach($perbaikans as $perbaikan)
              <tr>
                <th>{{ $loop->iteration }}</th>
                <th scope="row">{{ $perbaikan->kd_perbaikan }}</th>
                <td>{{ $perbaikan->kd_pemesanan }}</td>
                <td>{{ $perbaikan->nama }}</td>
                <td>{{ $perbaikan->no_hp }}</td>
                <td>{{ $perbaikan->alamat }}</td>
                <td>{{ $perbaikan->barang }}</td>
                <td>{{ $perbaikan->jumlah_barang }}</td>
                <td>{{ $perbaikan->waktu_pemesanan }}</td>
                <td>
                  <span class="badge badge-dot mr-4">
                    <i class="bg-warning"></i>
                    <span class="status">{{ $perbaikan->status }}</span>
                  </span>
                </td>
                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      @if(auth()->user()->role == 'pekerja')
                      <a class="dropdown-item selesai-btn" href="#" data-selesai="{{ $perbaikan->id }}" data-toggle="modal" data-target="#exampleModal">Selesai</a>
                      @endif
                      <a class="dropdown-item" href="{{ url('/hapus_perbaikan/'. $perbaikan->id) }}">Hapus</a>
                    </div>
                  </div>
                </td>
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
@section('script')
 <script src="{{ asset('assets/js/jquery-3.2.1.slim.min.js') }}" ></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}" ></script>
  <script src="{{ asset('assets/js/jquery-3.4.1.js') }}"></script>
<script type="text/javascript">

  $(document).on('click', '.selesai-btn', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-selesai');
    $.ajax({
      method: "GET",
      url: "{{ url('/selesai_show') }}/" + id,
      success:function(response){
        $('#id_perbaikan').val(response.perbaikans.id);
        $('#waktu_pemesanan_tb').html(response.perbaikans.waktu_pemesanan);
        $('#jml_barang_tb').html(response.perbaikans.jumlah_barang);
        $('#nama_barang_tb').html(response.perbaikans.barang);
        $('#no_hp_tb').html(response.perbaikans.no_hp);
        $('#kd_perbaikan_tb').html(response.perbaikans.kd_perbaikan);
        $('#alamat_tb').html(response.perbaikans.alamat);
        $('#status_tb').html(response.perbaikans.status);
        $('#nama_pemilik_tb').html(response.perbaikans.nama);
      }
    });
  });

  $('#input_biaya').on('change', function(){
    var jml = $('#jml_barang_tb').html();
    var total = $(this).val() * jml;
    $('#total_bayar').val('Total Rp. '+total+',00');
    $('#total_insert').val(total);
  });

  $('#input_biaya').on('keyup', function(){
    var jml = $('#jml_barang_tb').html();
    var total = $(this).val() * jml;
    $('#total_bayar').val('Total Rp. '+total+',00');
    $('#total_insert').val(total);
  });
</script>
@endsection