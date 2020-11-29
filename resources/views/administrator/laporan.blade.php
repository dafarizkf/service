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
          <li class="nav-item">
            <a class="nav-link active" href="{{ url('/kelola_akun') }}">
              <i class="ni ni-badge text-orange"></i>
              <span class="nav-link-text">Kelola Akun</span>
            </a>
          </li>
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
          <a href="#" class="btn btn-sm btn-neutral">New</a>
          <a href="#" class="btn btn-sm btn-neutral">Filters</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--6">
  <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Filter Form</h3>
                </div>
                <div class="col-4 text-right">
          
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="get" action="{{ url('/laporan')}}">
                <h6 class="heading-small text-muted mb-4">Filter Laporan</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Tanggal Mulai</label>
                        <input class="form-control {{ $errors->has('start_date') ? 'is-invalid':'' }}" name="start_date" id="start_date" placeholder="Select date" type="date">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Tanggal Akhir</label>
                        <input class="form-control {{ $errors->has('end_date') ? 'is-invalid':'' }}" name="end_date" id="end_date" placeholder="Select date" type="date">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Pekerja</label>
                        <select class="form-control">
                          <option class="form-control">-- Pilih --</option>
                          @foreach($users as $user)
                          <option value="{{ $user->name }}" >{{ $user->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Filter</button>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
              </form>
            </div>
            <div class="col-md-12">
              <div class="card">
                Data Transaksi
                <br><br><br><br><br><br><br><br>
              </div>
          </div>
        </div>


  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Light table</h3>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">Invoice</th>
                <th scope="col" class="sort" data-sort="budget">Pelanggan</th>
                <th scope="col" class="sort" data-sort="status">No Telp</th>
                <th scope="col">Total Belanja</th>
                <th scope="col">Pekerja</th>
                <th scope="col" class="sort" data-sort="completion">Tanggal Transaksi</th>
                <th scope="col">Cetak</th>
              </tr>
            </thead>
            <tbody class="list">
              @forelse($transaksis as $laporan)
              <tr>
              <td><strong>{{ $laporan->kd_transaksi}}</strong></td>
              <td>{{ $laporan->nama_pemesan }}</td>
              <td>{{ $laporan->no_hp }}</td>
              <td>{{ $laporan->totals }}</td>
              <td>{{ $laporan->kasir }}</td>
              <td>{{ $laporan->created_at->format('d-m-Y H:i:s') }}</td>
              <td>
               {{--  <a href="{{ route('.pdf', $laporan->kd_transaksi) }}"  target="_blank" class="btn btn-primary btn-sm"><i class="ni ni-single-copy-04"></i></a>
                                                <a href="{{ route('order.excel', $laporan->kd_transaksi) }}"  target="_blank"  class="btn btn-info btn-sm"><i class="ni ni-bullet-list-67"></i></a> --}}
            </td>
              </tr>
               @empty
               <tr>
                <td class="text-center" colspan="7">Tidak ada data transaksi</td>
               </tr>
              @endforelse
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
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    $('start_date').datepicker({
      autoclose: true;
      format: 'yyyy-mm-dd';
    });
     $('end_date').datepicker({
      autoclose: true;
      format: 'yyyy-mm-dd';
    });


</script>
@endsection