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
		       			Electronic Arts
				</div>
				<div class="col-12">
					<div class="row">
	                  <div class="col-lg-6">
	                    <table cellspacing="3" cellpadding="3">
	                    	<script type="text/javascript">
								window.print()
							</script>
	                    	@foreach($pemesanans as $kartu)
	                      <tr>
	                        <td>Kode</td>
	                        <td>:</td>
	                        <td id="kd_pemesanan_cetak">{{ $kartu->kd_pemesanan }}</td>
	                      </tr>
	                      <tr>
	                        <td>Nama</td>
	                        <td>:</td>
	                        <td id="nama_cetak">{{ $kartu->nama }}</td>
	                      </tr>
	                      <tr>
	                        <td>No HP</td>
	                        <td>:</td>
	                        <td id="no_hp_cetak">{{ $kartu->no_hp }}</td>
	                      </tr>
	                      <tr>
	                        <td>Alamat</td>
	                        <td>:</td>
	                        <td id="alamat_cetak">{{ $kartu->alamat }}</td>
	                      </tr>
	                    </table>
	                  </div>
	                  <div class="col-lg-6">
	                    <table cellspacing="3" cellpadding="3">
	                      <tr>
	                        <td>Barang</td>
	                        <td>:</td>
	                        <td id="barang_cetak">{{ $kartu->barang }}</td>
	                      </tr>
	                      <tr>
	                        <td>Waktu</td>
	                        <td>:</td>
	                        <td id="waktu_cetak">{{ $kartu->$waktu }}</td>
	                      </tr>
	                      @endforeach
	                    </table>
	                 </div>
              	  </div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <script src="{{ asset('assets/js/argon.js?v=1.2.0') }}"></script>
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
    }
});
}); 
  </script>

</body>
</html>