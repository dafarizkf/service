<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Bukti Pembayaran</title>
  <link rel="icon" href="{{ asset('icons/logo.png') }}" type="image/png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/css/argon.css?v=1.2.0') }}" type="text/css">
</head>
<body>
	<div class="row">
	    <div class="col-6">
	      <div class="card">
			<div class="row">
				<div class="col-12" align="center">
		        		<img src="{{ asset('icons/logo.png') }}" class="navbar-brand-img" alt="...">
		       			<a href="{{ url('/daftar_pengembalian') }}" style="color: black;">Electronic Arts</a>
				</div>
				<div class="col-12">
					<div class="row">
	                  <div class="col-lg-6">
	                    <table cellspacing="3" cellpadding="3">
	                    	<script type="text/javascript">
								window.print()
							</script>
	                    	@foreach($pemiliks as $struk)
	                      <tr>
	                        <td>Kode</td>
	                        <td>:</td>
	                        <td >{{ $struk->kd_pengembalian }}</td>
	                      </tr>
	                      <tr>
	                        <td>Barang</td>
	                        <td>:</td>
	                        <td>{{ $struk->barang }}</td>
	                      </tr>
	                      <tr>
	                        <td>Pemilik</td>
	                        <td>:</td>
	                        <td>{{ $struk->nama_pemesan }}</td>
	                      </tr>
	                      <tr>
	                        <td>Kerusakan</td>
	                        <td>:</td>
	                        <td>{{ $struk->inti_kerusakan }}</td>
	                      </tr>
	                      <tr>
	                        <td>jumlah</td>
	                        <td>:</td>
	                        <td>{{ $struk->jumlah_barang }}</td>
	                      </tr>
	                    </table>
	                  </div>
	                  <div class="col-lg-6">
	                    <table cellspacing="3" cellpadding="3">
	                      <tr>
	                        <td>Pemesanan</td>
	                        <td>:</td>
	                        <td>{{ $struk->waktu_pemesanan }}</td>
	                      </tr>
	                      <tr>
	                        <td>Total</td>
	                        <td>:</td>
	                        <td>{{ $struk->totals }}</td>
	                      </tr>
	                       <tr>
	                        <td>Bayar</td>
	                        <td>:</td>
	                        <td>{{ $pemiliks = $bayar }}</td>
	                      </tr>
	                      <tr>
	                        <td>Kembali</td>
	                        <td>:</td>
	                        <td>{{ $pemiliks = $kembali }}</td>
	                      </tr>
	                      @endforeach
	                    </table>
	                 </div>
              	  </div>
				</div>
			</div>
		</div>
	</div>
	<a href="" hidden="">Selesai</a>
</div>
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <script src="{{ asset('assets/js/argon.js?v=1.2.0') }}"></script>

</body>
</html>