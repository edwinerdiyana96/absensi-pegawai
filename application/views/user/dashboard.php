<?php
$tanggal_awal = date('Y-m-01');
$tanggal_akhir = date('Y-m-t',time());

$hadir = $this->Absensi_model->getHadirBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
$khusus = $this->Absensi_model->getHadirKhususBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
$telat = $this->Absensi_model->getTelatBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
$sakit = $this->Absensi_model->getSakitBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
$izin = $this->Absensi_model->getIzinBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
$alpha = $this->Absensi_model->getAlphaBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
$settings = $this->db->get_where('settings')->row_array();
?>

<div class="container-fluid">
	<div class="row text-center mt-2">
		<div class="col-md-12">
			<?= $this->session->flashdata('message_absen'); ?>
		</div>
	</div>

	<?php
	date_default_timezone_set("Asia/Jakarta");
	if ($user['is_flexible'] == 0 && $cek_absen_khusus == 1 && date('H:i:s') > '08:00:00' ) { ?>

		<div class="alert alert-primary" role="alert">
			<!-- ============================ Display Only On Desktop Mode ============================ -->
			<!-- <div class="d-none d-lg-block"> -->
				<!-- <a href="< ?php echo base_url('pegawai/scan_khusus'); ?>" class="alert-link"><button type="button" class="btn btn-primary"> ABSEN KHUSUS </button></a> -->
				<!-- <form id='form_maps' action="< ?= base_url('pegawai/scan_khusus') ?>" method="post"> -->
					<!-- <input hidden type='text' name="lat1" id='lat1' value=''> -->
					<!-- <input hidden type='text' name="long1" id='long1' value=''> -->
					<!-- Pilih Tombol di Samping Ini Untuk Absen Khusus Pegawai! &ensp;&ensp;<button type="submit" class="btn btn-primary">ABSEN KHUSUS</button> -->
				<!-- </form> -->
			<!-- </div> -->
			<!-- ============================ Display Only On Mobile Mode ============================ -->
			<div class="d-lg-none text-center">
				====== Klik Tombol di Bawah Ini Untuk Absen Di Jam Tertentu ====== <br><br>
				<!-- <a href="< ?php echo base_url('pegawai/scan_khusus'); ?>">
					<button type="button" class="btn btn-primary form-control"> ABSEN KHUSUS </button></a> -->

				<form id='form_maps1' action="<?= base_url('pegawai/scan_khusus') ?>" method="post" class="">
					<input hidden type='text' name="lat" id='lat1' value='khusus'>
					<input hidden type='text' name="long" id='long1' value='khusus'>
					<button type="submit" class="btn btn-primary form-control">ABSEN KHUSUS</button>
				</form>

			</div>
		</div>



		<!-- <script type="text/javascript">
			navigator.geolocation.getCurrentPosition(getLatLon);

			function getLatLon(position) {
				var latitude = position.coords.latitude;
				var longitude = position.coords.longitude;
				console.log("Latitude adalah " + latitude);
				console.log("Longitude adalah " + longitude);
				$(document).ready(function() {
					// $('#kirim1').click(function() {
					var txtLat1 = document.getElementById("lat1").innerHTML = latitude;
					var txtLong1 = document.getElementById("long1").innerHTML = longitude;
					$('#lat1').val(txtLat1);
					$('#long1').val(txtLong1);
					// document.getElementById("form_maps").submit();
				});
				// });
			}
		</script> -->

	<?php } ?>

    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Kehadiran Bulan <?= bulan_indo(date('m')); ?> </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"> <?= $hadir + $telat + $khusus; ?></div>
                            <pre>Detail:<br>- Hadir (Absensi Normal): <?= $hadir; ?><br>- Hadir (Absensi Khusus): <?= $khusus; ?><br>- Hadir (Terlambat): <?= $telat; ?>
                            </pre>
                        </div>
                        <div class="col-auto">
                            <span style="color: Mediumslateblue;">
                                <i class="far fa-thumbs-up fa-3x"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--<div class="col-xl-3 col-md-6 mb-4">-->
        <!--    <div class="card border-left-primary shadow h-100 py-2">-->
        <!--        <div class="card-body">-->
        <!--            <div class="row no-gutters align-items-center">-->
        <!--                <div class="col mr-2">-->
        <!--                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">-->
        <!--                        Total Kehadiran (Khusus) Bulan < ?= bulan_indo(date('m')); ?> </div>-->
        <!--                    <div class="h4 mb-0 font-weight-bold text-gray-800"> < ?= $hadir + $telat; ?></div>-->
        <!--                </div>-->
        <!--                <div class="col-auto">-->
        <!--                    <span style="color: Mediumslateblue;">-->
        <!--                        <i class="far fa-thumbs-up fa-3x"></i>-->
        <!--                    </span>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Sakit Bulan <?= bulan_indo(date('m')); ?> </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $sakit; ?></div>
                        </div>
                        <div class="col-auto">
                            <span style="color: Mediumslateblue;">
                                <i class="fas fa-viruses fa-3x"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Izin Bulan <?= bulan_indo(date('m')); ?> </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $izin; ?></div>
                        </div>
                        <div class="col-auto">
                            <span style="color: Mediumslateblue;">
                                <i class="far fa-calendar-times fa-3x"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Belum / Tidak Hadir Bulan <?= bulan_indo(date('m')); ?> </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $alpha; ?></div>
                        </div>
                        <div class="col-auto">
                            <span style="color: Mediumslateblue;">
                                <i class="fas fa-times-circle fa-3x"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




	<div class="row gutters-sm">
		
		<!-- Donut Chart -->
		<div class="col-xl-12 col-md-6">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Persentase Kehadiran Bulan <?= bulan_indo(date('m')); ?></h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="col-md-12">
						<div class="chart-area">
							<canvas id="grafik_perhari"></canvas>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>


	

	<div class="row gutters-sm">
		<!-- Donut Chart -->
		<div class="col-xl-12 col-md-6">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Lokasi <?= $settings['name'] ?></h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="col-md-12">
					<div id="map" style="width: 100%; height: 500px;"></div> 
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
</div>
</div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
<script type="text/javascript">
function initialize() 
{
	// put latitude and longitude data here
   var latinfo = new google.maps.LatLng(<?= $settings['langitude'] ?>,<?= $settings['longitude'] ?>);
   var map = new google.maps.Map(document.getElementById('map'), {
      center: latinfo,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latinfo,
      draggable: false,
      animation: google.maps.Animation.BOUNCE,
      anchorPoint: new google.maps.Point(0, -29)
   });
    var infowindow = new google.maps.InfoWindow();   
    google.maps.event.addListener(marker, 'click', function() 
    {
      var iwContent = '<div id="pop_window">' + '<div><b>Location</b> : <?= $settings['name'] ?></div></div>';
      // put content to the infowindow
      infowindow.setContent(iwContent);
      // show infowindow in the google map and at the current marker location
      infowindow.open(map, marker);
    });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>



<script>
	var tabel = null;
	$(document).ready(function() {
		tabel = $('#rekap-bulanan').DataTable({
			"processing": true,
			// "responsive": true,
						"ScrollX": true,
			"serverSide": true,
			"ordering": true, // Set true agar bisa di sorting
			"order": [
				[0, 'asc']
			], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
			"ajax": {
				"url": "<?= base_url('user/data_rekap_bulanan/'); ?>", // URL file untuk proses select datanya
				"type": "POST"
			},
			"deferRender": true,
			"aLengthMenu": [
				[10, 50, 100],
				[10, 50, 100]
			], // Combobox Limit
			"columns": [{
					"data": "name"
				},
				// {
				//  "data": "name"
				// }, 
				{
					"data": "view_sakit"
				},
				{
					"data": "view_izin"
				},
				{
					"data": "view_alpha"
				},
				{
					"data": "view_hadir"
				},
				{
					"data": "view_tidak_hadir"
				},
				{
					"data": "view_persentase"
				},

			],
		});
	});
</script>





<!-- Modal Add Role -->
<div class="modal fade" id="export" tabindex="-1" aria-labelledby="addRoleModelLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addRoleModelLabel">Export Laporan Kehadiran Pegawai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php
			$bulan_sekarang = bulan_indo(date('m')); ?>
			<form action="<?= base_url('user/export') ?>" method="POST">
				<div class="modal-body">
					<div class="row">

						<div class="col-sm-12">
							<div class="form-group form-group-default">
								<label>Pilih Bulan</label>
								<select id="bulan" name="bulan" class="form-control">
									<option value=""> Pilih Semua Bulan</option>
									<option value="Januari">Januari</option>
									<option value="Februari">Februari</option>
									<option value="Maret">Maret</option>
									<option value="April">April</option>
									<option value="Mei">Mei</option>
									<option value="Juni">Juni</option>
									<option value="Juli">Juli</option>
									<option value="Agustus">Agustus</option>
									<option value="September">September</option>
									<option value="Oktober">Oktober</option>
									<option value="November">November</option>
									<option value="Desember">Desember</option>
								</select>
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary form-control">Export Laporan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	jQuery(document).ready(function($) {
		$('bulan').find('option[value=Maret]').attr('selected', 'selected');
	});
</script>
