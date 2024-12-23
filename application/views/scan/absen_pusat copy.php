<!-- Content Wrapper -->
<!-- <div id="content-wrapper" class="d-flex flex-column"> -->

<!-- Main Content -->
<!-- <div id="content"> -->
<br>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

<style>
	#camera_wrapper,
	#show_saved_img {
		float: left;
		width: 640px;
	}
</style>

<script type="text/javascript" src="<?= base_url('assets/js/') ?>webcam.js"></script>
<script>
	$(function () {
		//give the php file path
		webcam.set_api_url('saveimage.php');
		webcam.set_swf_url('scripts/webcam.swf');
		webcam.set_quality(100); // Image quality (1 - 100)
		webcam.set_shutter_sound(true); // play shutter click sound

		var camera = $('#camera');
		camera.html(webcam.get_html(640, 480));

		$('#capture_btn').click(function () {
			//take snap
			webcam.snap();
		});

		//after taking snap call show image
		webcam.set_hook('onComplete', function (img) {
			$('#show_saved_img').html('<img src="' + img + '">');
			//reset camera for next shot
			webcam.reset();
		});

	});
</script>

<!-- CAPTURE CAMERA -->
<!-- CSS Camera-->
<style>
	#my_camera {

		width: 640px;
		height: 480px;

		border: 2px solid white;
		vertical-align: middle;
		border-radius: 10px 10px 10px 10px;
	}
</style>

<!-- <div class="container-fluid"> -->
<div class="row text-center mt-2">
	<div class="col-md-12">
		<?= $this->session->flashdata('message_absen'); ?>
	</div>
</div>

<div class="row gutters-sm">
	<div class="col-xl-6 col-md-6 ">
		<!-- Area Chart -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Profil Absensi</h6>
			</div>
			<div class="card-body">
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
						aria-labelledby="nav-profile-tab">

						<div class="row gutters-sm">

							<div class="col-md-4">
								<div class="card mb-0">
									<div class="card-body mb-4">
										<div class="d-flex flex-column align-items-center text-center">
											<img src="<?= base_url('assets/img/profile/') . $user['image'] ?>"
												alt="Profile Photo" class="rounded-circle" width="150" height="150">

											<div class="mt-2">
												<h5>
													<?= $user['name'] ?>
												</h5>
												<hr>
												<h6 class="text-muted font-size-sm align-items-center text-center"
													style="color:black; display: inline-block; text-align:center;">
													<?= $user['department'] ?>
												</h6>
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
										<hr>
										<div class="row">
											<?php
											$data_attendance = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '" . $user_id . "' AND date = '" . date('Y-m-d') . "'")->row_array();
											$jam_masuk = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Masuk'")->row_array();
											$jam_telat = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Telat'")->row_array();

											if ($data_attendance['time_in'] != '00:00:00') {
												echo '<div class="btn badge-success form-control text-white">Absensi Pulang</div>';
											} else {
												if (date('H:i:s') > $jam_masuk['time_start'] && date('H:i:s') <= $jam_masuk['time_end']) {
													echo '<div class="btn badge-success form-control text-white">Absen Tepat Waktu</div>';
												} else {
													echo '<div class="btn badge-warning form-control text-white">Absen Telat</div>';
												}
											}
											?>

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

	<div class="col-xl-6 col-md-6">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Kamera</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="col-md-12">
					<div class="chart-area">
						<!-- camera screen -->
						<div id="my_camera"></div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<!-- </div> -->
<!-- </div> -->
<!-- </div> -->

<script src="<?= base_url('assets/js/webcam.js') ?>"></script>
<script language="JavaScript">
	Webcam.set({
		width: 640,
		height: 480,
		image_format: 'jpeg',
		jpeg_quality: 100,
		flip_horiz: false,
		crop_width: 640,
		crop_height: 480
	});
	Webcam.attach('#my_camera');
</script>

<script type="text/javascript">
	function capture_foto() {
		var image = '';
		Webcam.snap(function (data_uri) {
			//image = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
			image = data_uri;
		});

		$.ajax({
			url: "<?= base_url('absensi/save_capture') ?>",
			type: 'POST',
			dataType: 'json',
			data: {
				image: image
			},
		});
		/*.done(function(data) {
			if (data > 0) {
				alert('insert data sukses');
				//$('#register')[0].reset();
				//$('.capture_foto')[0].reset();
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});*/
	}

	window.onload = function () {
		setTimeout(function () {

			var image = '';
			Webcam.snap(function (data_uri) {
				//image = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
				image = data_uri;
			});

			$.ajax({
				url: "<?= base_url('absensi/save_capture/' . $user_id) ?>",
				type: 'POST',
				dataType: 'json',
				data: {
					image: image
				},
			});
			window.location.href = "<?= base_url('operator/absen/' . $user_id) ?>";
		}, 3000 //3 Detik
		);
	};
</script>