<div class="container-fluid">
	<div class="row text-center mt-2">
		<div class="col-md-12">
			<?= $this->session->flashdata('message_absen'); ?>
		</div>
	</div>

	<?php
	date_default_timezone_set("Asia/Jakarta");
	if ($user['is_flexible'] == 0 && $cek_absen_khusus == 1 && date('H:i:s') > '07:10:00' ) { ?>

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
					<input hidden type='text' name="lat1" id='lat1' value=''>
					<input hidden type='text' name="long1" id='long1' value=''>
					<button type="submit" class="btn btn-primary form-control">ABSEN KHUSUS</button>
				</form>

			</div>
		</div>

		<script type="text/javascript">
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
		</script>

	<?php } ?>

	<div class="row gutters-sm">
		<div class="col-xl-6 col-md-6 ">
			<!-- Area Chart -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Profil Pengguna</h6>
				</div>
				<div class="card-body">
					<!-- <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Profile</a>
              <a class="nav-link" id="nav-pass-tab" data-toggle="tab" href="#nav-pass" role="tab" aria-controls="nav-pass" aria-selected="false">Update Password</a>
            </div>
          </nav> -->

					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

							<div class="row gutters-sm">

								<div class="col-md-4">
									<div class="card mb-0">
										<div class="card-body mb-4">
											<div class="d-flex flex-column align-items-center text-center">
												<img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" alt="Profile Photo" class="rounded-circle" width="150" height="150">

												<div class="mt-2">
													<h5><?= $user['name'] ?></h5>
													<hr>
													<h6 class="text-muted font-size-sm align-items-center text-center" style="color:black; display: inline-block; text-align:center;"><?= $user['department'] ?></h6>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div class="card mb-0">
										<div class="card-body">
											<div class="row">
												<div class="col-sm-4">
													<h6 class="mt-1">Email:</h6>
												</div>
												<div class="col-sm-8 text-secondary">
													<?= $user['email'] ?>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-sm-4">
													<h6 class="mt-1">Gender:</h6>
												</div>
												<div class="col-sm-8 text-secondary">
													<?php if ($user['gender'] == 'L') {
														echo 'Laki-Laki';
													} else {
														echo 'Perempuan';
													} ?>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-sm-4">
													<h6 class="mt-0">HP:</h6>
												</div>
												<div class="col-sm-8 text-secondary">
													<?= $user['phone'] ?>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-sm-4">
													<h6 class="mt-0">Alamat:</h6>
												</div>
												<div class="col-sm-8 text-secondary">
													<?= $user['address'] ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>





		<!-- Donut Chart -->
		<div class="col-xl-6 col-md-6">
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

</div>
</div>
</div>



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
