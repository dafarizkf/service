@extends('template')
@section('menu')
<meta charset="utf-8" http-equiv="refresh">
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
            <a class="nav-link active" href="{{ url('/daftar_pesanan') }}">
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
        <div class="col-lg-6 col-5 text-right">
          <button type="button" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#exampleModal">
            Buat Pesanan
          </button>
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
            <h5 class="modal-title" id="exampleModalLabel">Buat Pesanan Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" id="simpan_form" action="{{ url('/simpan_pemesanan') }}">
            @csrf
            <div class="modal-body">
              <div class="form-row">
                <div class="col-12 mb-4">
                  <input class="form-control" required="" type="text" placeholder="Kode Pemesanan" readonly="" value="{{ $max_code }}" name="kd_pemesanan">
                </div>
                <div class="col-12 mb-4">
                  <input class="form-control" required="" type="text" placeholder="Nama" name="nama">
                </div>
                <div class="col-12 mb-4">
                  <input class="form-control" required="" type="text" placeholder="No HP" name="no_hp">
                </div>
                <div class="col-12 mb-4">
                  <textarea class="form-control" required="" placeholder="Alamat" rows="3" name="alamat"></textarea>
                </div>
                <div class="col-12 mb-4">
                  <div class="row">
                    <div class="col-8">
                      <input class="form-control" required="" type="text" placeholder="Barang" name="barang">
                    </div>
                    <div class="col-4">
                      <input class="form-control" required="" type="number" placeholder="Jumlah" name="jumlah_barang">
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <input class="form-control" required="" type="date" name="waktu_pemesanan">
                </div>
              </div>
            </div>
            <div class="modal-footer">
             {{--  <button type="button" class="btn btn-secondary tutup-modal" data-dismiss="modal">Close</button> --}}
              <button type="submit" class="btn btn-primary" >Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Pesanan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" id="edit_form"> {{-- action="{{ url('/edit_pemesanan') }}" --}}
            @csrf
            <input type="hidden" name="edit-id" id="edit-id">
            <div class="modal-body">
              <div class="form-row">
                <div class="col-12 mb-4">
                  <input class="form-control" type="text"  readonly="" id="kd_pemesanan_edit" name="kd_pemesanan">
                </div>
                <div class="col-12 mb-4">
                  <input class="form-control" required="" type="text" id="nama_edit" name="nama">
                </div>
                <div class="col-12 mb-4">
                  <input class="form-control" required="" type="text" placeholder="No HP" id="no_hp_edit" name="no_hp">
                </div>
                <div class="col-12 mb-4">
                  <textarea class="form-control" required="" placeholder="Alamat" id="alamat_edit" rows="3" name="alamat"></textarea>
                </div>
                <div class="col-12 mb-4">
                  <div class="row">
                    <div class="col-8">
                      <input class="form-control" required="" type="text" placeholder="Barang" id="barang_edit" name="barang">
                    </div>
                    <div class="col-4">
                      <input class="form-control" required="" type="text" placeholder="Jumlah" id="jumlah_edit" name="jumlah_barang">
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <input class="form-control" required="" type="date" name="waktu_pemesanan" id="waktu_edit">
                </div>
              </div>
            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-secondary tutup-modal" data-dismiss="modal" hidden="">Close</button>
              <button type="submit" class="btn btn-success" >Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- Modal Cetak --}}
  <div class="modal fade" id="cetakModal" tabindex="-1" role="dialog" aria-labelledby="cetakModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <img src="{{ asset('icons/logo.png') }}" class="d-block" alt="...">
            <h3>Electronic Arts</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form  id="form_cetak"> {{-- action="{{ url('/edit_pemesanan') }}" --}}
            @csrf
            <input type="hidden" name="cetak-id" id="cetak-id">
            <div class="modal-body">
              <div class="form-row"> 
                <div class="row">
                  <div class="col-lg-6">
                    <table cellspacing="3" cellpadding="3">
                      <tr>
                        <td>Kode</td>
                        <td>:</td>
                        <td id="kd_pemesanan_cetak"></td>
                      </tr>
                      <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td id="nama_cetak"></td>
                      </tr>
                      <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td id="no_hp_cetak"></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td id="alamat_cetak"></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-lg-6">
                    <table cellspacing="3" cellpadding="3">
                      <tr>
                        <td>Barang</td>
                        <td>:</td>
                        <td id="barang_cetak"></td>
                      </tr>
                      <tr>
                        <td>Waktu</td>
                        <td>:</td>
                        <td id="waktu_cetak"></td>
                      </tr>
                    </table>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal" hidden>Close</button>
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
          <h3 class="mb-0">Daftar Pemesanan</h3>
        </div>
        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" >
          <button type="button" class="close tutup-alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{ session('status') }}
        </div>
        @endif
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light text-center">
              <tr>
                <th scope="col" class="sort">No</th>
                <th scope="col" class="sort">Kode Pemesanan</th>
                <th scope="col" class="sort">Nama</th>
                <th scope="col" class="sort">No HP</th>
                <th scope="col" class="sort">Alamat</th>
                <th scope="col" class="sort">Barang</th>
                <th scope="col" class="sort">Jumlah</th>
                <th scope="col" class="sort">Waktu Pemesanan</th>
                <th scope="col"></th>
                <th scope="col">Kartu</th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach($pemesanans as $pemesanan)
              <tr>
                <th>{{ $loop->iteration }}</th>
                <th scope="row">{{ $pemesanan->kd_pemesanan }}</th>
                <td>{{ $pemesanan->nama }}</td>
                <td>{{ $pemesanan->no_hp }}</td>
                <td>{{ $pemesanan->alamat }}</td>
                <td>{{ $pemesanan->barang }}</td>
                <td>{{ $pemesanan->jumlah_barang }}</td>
                <td>{{ $pemesanan->waktu_pemesanan }}</td>
                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="{{ url('/perbaiki_barang/'. $pemesanan->id) }}">Perbaiki</a>
                      <a class="dropdown-item"  id="{{ $pemesanan->id }}">Hapus</a>
                      <a class="dropdown-item  edit-btn" data-toggle="modal" data-target="#editModal" id="{{ $pemesanan->id }}">Edit</a>
                    </div>
                  </div>
                </td>
                <td>
                  <button type="submit" class="btn btn-success cetak-btn" data-toggle="modal" data-target="#cetakModal" 
                  id="{{ $pemesanan->id }}">Cetak Kartu</button>
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

$(document).on('click','.cetak-btn',function(e){
e.preventDefault();
var id = $(this).attr('id');
$.ajax({
  method: "GET",
  url: "{{ url('/cetak_pemesanan') }}/" + id,
  success:function(response)
  { 
    $('#cetak-id').val(response.pemesanans.id);
    $('#kd_pemesanan_cetak').html(response.pemesanans.kd_pemesanan);
    $('#nama_cetak').html(response.pemesanans.nama);
    $('#no_hp_cetak').html(response.pemesanans.no_hp);
    $('#alamat_cetak').html(response.pemesanans.alamat);
    $('#barang_cetak').html(response.pemesanans.barang);
    $('#jumlah_cetak').html(response.pemesanans.jumlah_barang);
    $('#waktu_cetak').html(response.pemesanans.waktu_pemesanan);
    window.print()
    }

});
});


$(document).on('click','.edit-btn',function(e){
e.preventDefault();
var id = $(this).attr('id');
$.ajax({
  method: "GET",
  url: "{{ url('/edit_pemesanan') }}/" + id,
  success:function(response)
  {
    $('#edit-id').val(response.pemesanans.id);
    $('#kd_pemesanan_edit').val(response.pemesanans.kd_pemesanan);
    $('#nama_edit').val(response.pemesanans.nama);
    $('#no_hp_edit').val(response.pemesanans.no_hp);
    $('#alamat_edit').val(response.pemesanans.alamat);
    $('#barang_edit').val(response.pemesanans.barang);
    $('#jumlah_edit').val(response.pemesanans.jumlah_barang);
    $('#waktu_edit').val(response.pemesanans.waktu_pemesanan);

  }
});
});


$('#edit_form').submit(function(e){
  e.preventDefault();
  var id = $('#edit-id').val();
  var request = new FormData(this);
  $.ajax({
    method: "POST",
    url: "{{ url('/update_pemesanan') }}/"+ id,
    data: request,
    contentType: false,
    processData: false,
    success:function(data)
    {

      Swal.fire({
        positionkey: 'center',
        icon: 'success',
        text: 'Data Berhasil diUpdate',
        showConfirmButton: false,
        timer: 1500
      });

       $('.tutup-modal').click();
    }
  });
});
$('.tutup-alert').click();
</script>
@endsection
{{-- <script type="text/javascript">
  function asw() {
       Swal.fire({
              position:'center',
        icon: 'success',
        text: 'Pesan Berhasil Terkirim',
        showConfirmButton: false,
        timer: 1500
      });
     }
  $('#simpan_form').submit(function(e){
    e.preventDefault();
    var request = new FormData(this);
      $.ajax({ // Perintah ajax
      method: "POST",
      url: "{{ url('/simpan_pemesanan') }}",
      data: request,
      contentType: false,
      processData: false,
      success:function(data){
        $('.tutup-modal').click();
        asw();
        window.load('/daftar_pesanan');
      }
  });
});

  
</script> --}}

