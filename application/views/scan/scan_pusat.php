<!-- <div id="content-wrapper" class="d-flex flex-column"> -->
<!-- <div id="content"> -->
<?= $this->session->flashdata('message'); ?>
<style type="text/css">
	.text-justify {
		text-align: justify;
	}
</style>

<div class="col-md-6">
	<div class="card border-primary shadow" style="margin-top: 2%; padding-bottom: 25px; width: 100%;">
		<div class="card-body" style="width: 100%;">
			<div class="row no-gutters align-items-center" style="width: 100%;">
				<div class="well" style="width: 100%;">
					<div class="alert alert-success" role="alert" style="margin-top: -10px; text-align: center; width: 100%;">
						ARAHKAN QR CODE ANDA KE KAMERA UNTUK MELAKUKAN ABSENSI
					</div>
					<div id="sourceSelectPanel" hidden>
						<select id="sourceSelect" class="form-control"
							style="display: inline-block; text-align: center; text-align-last: center;">
						</select>
					</div>
					<div style="width: 100%;">
						<video id="video" width="100%" height="100%" style="object-fit: cover;"></video>
					</div>
				</div>
				<form id='form_absen' action="<?= base_url('operator/absen_pusat/cek') ?>" method="post">
					<input type='hidden' name="user_id" id='user_id' value="<?= $user['id'] ?>">
					<input type='hidden' id='qr' value='' name='qr'>
					<button hidden type="submit" class="btn btn-primary">Absen</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="card border-primary shadow" style="margin-top: 2%; width: 100%;">
		<div class="card-body" style="width: 100%;">
			<div class="row no-gutters align-items-center" style="width: 100%;">
				<div class="well" style="width: 100%;">
					<div class="alert alert-success" role="alert" style="margin-top: -10px; text-align: center; width: 100%;">
						DATA ABSENSI HARI INI (<?php setlocale(LC_ALL, 'id_ID'); echo strftime("%A, %e %B %G"); ?>)
					</div>
					<div class="table-responsive" style="width: 100%;">
						<table class="table table-striped table-bordered" id="table-absensi_pusat" style="width:100%;">
							<thead class="text-primary">
								<tr>
									<!-- <th>No</th> -->
									<th>Nama</th>
									<th>Foto</th>
									<th>Jam Masuk</th>
									<th>Jam Pulang</th>
									<th>Status</th>
								</tr>
							</thead>
							<!-- <tfoot class="text-primary"></tfoot> -->
							<tbody>
								<?php
								$num = 1;
								foreach ($laporan as $laporan):
									$data_user = $this->db->query("SELECT * FROM user WHERE id = '" . $laporan['user_id'] . "'")->row_array();
									?>
									</tr>
									<!-- <td>
										< ?= $num++ ?>
									</td> -->
									<td>
										<?= $data_user['name'] ?>
									</td>
									<td>
										<img class="zoom  img-thumbnail img-responsive  "
											style="width: 100px; height: 100px;"
											src="<?= base_url('uploads/' . $laporan['image']) ?>">
									</td>
									<td>
										<?= $laporan['time_in'] ?>
									</td>
									<td>
										<?= $laporan['time_out'] ?>
									</td>
									<td>
										<?php if ($laporan['status'] == 1): {
											echo '<span class="badge badge-pill badge-success">TEPAT WAKTU</span>';
										}
									elseif ($laporan['status'] == 2): {
											echo '<span class="badge badge-pill badge-secondary">TERLAMBAT</span>';
										}
									elseif ($laporan['status'] == 3): {
											echo '<span class="badge badge-pill badge-primary">SAKIT</span>';
										}
									elseif ($laporan['status'] == 4): {
											echo '<span class="badge badge-pill badge-primary">IZIN</span>';
										}
									elseif ($laporan['status'] == 5): {
											echo '<span class="badge badge-pill badge-warning">OFF</span>';
										}
									elseif ($laporan['status'] == 0): {
											if ($laporan['time_in'] < '11:00:00' && $laporan['date'] == date('Y-m-d')) {
												echo '<span class="badge badge-pill badge-info">BELUM HADIR</span>';
											} else {
												echo '<span class="badge badge-pill badge-danger">ALFA</span>';
											}
										}
										?>
										<?php endif; ?>
									</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$("#table-absensi_pusat").DataTable({
			rowReorder: {
				selector: "td:nth-child(2)",
			},
			// responsive: true,
			"ScrollX": true,
		});
	});
</script>

<script type="text/javascript" src="<?= base_url('assets/'); ?>js/index.min.js"></script>
<script type="text/javascript">
	function decodeOnce(codeReader, selectedDeviceId) {
		codeReader.decodeFromInputVideoDevice(selectedDeviceId, 'video').then((result) => {
			var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
			let audio = new Audio('<?= base_url("/assets/sound/beep2.mp3") ?>');
			var text = document.getElementById('qr').textContent = result.text;
			audio.play(), 400;
			$('#qr').val(text);
			document.getElementById("form_absen").submit();
		}).catch((err) => {
			console.error(err)
		})
	}

	function decodeContinuously(codeReader, selectedDeviceId) {
		codeReader.decodeFromInputVideoDeviceContinuously(selectedDeviceId, 'video', (result, err) => {
			if (result) {
				let audio = new Audio('<?= base_url("/assets/sound/beep2.mp3") ?>');
				var text = document.getElementById("qr").innerHTML = result.text;
				audio.play(), 1000;
				$('#qr').val(text);
				document.getElementById("form_absen").submit();
			}

			if (err) {
				if (err instanceof ZXing.NotFoundException) {
					console.log('No QR code found.')
				}
				if (err instanceof ZXing.ChecksumException) {
					console.log('A code was found, but it\'s read value was not valid.')
				}
				if (err instanceof ZXing.FormatException) {
					console.log('A code was found, but it was in a invalid format.')
				}
			}
		})
	}

	window.addEventListener('load', function () {
		let selectedDeviceId;
		const codeReader = new ZXing.BrowserQRCodeReader()
		console.log('ZXing code reader initialized')
		codeReader.getVideoInputDevices()
			.then((videoInputDevices) => {
				const sourceSelect = document.getElementById('sourceSelect')
				selectedDeviceId = videoInputDevices[0].deviceId
				if (videoInputDevices.length >= 1) {
					videoInputDevices.forEach((element) => {
						const sourceOption = document.createElement('option')
						sourceOption.text = element.label
						sourceOption.value = element.deviceId
						sourceSelect.appendChild(sourceOption)
					})
					sourceSelect.onchange = () => {
						selectedDeviceId = sourceSelect.value;
						decodeOnce(codeReader, selectedDeviceId);
					};
					const sourceSelectPanel = document.getElementById('sourceSelectPanel')
					sourceSelectPanel.style.display = 'block'
				}
				var delayInMilliseconds = 1000;
				setTimeout(function () {
					decodeOnce(codeReader, selectedDeviceId);
				}, delayInMilliseconds);
				document.getElementById('resetButton').addEventListener('click', () => {
					codeReader.reset()
					document.getElementById('result').textContent = '';
					console.log('Reset.')
				})
			})
			.catch((err) => {
				console.error(err)
			})
	})
</script>
<!-- </div> -->
<!-- </div> -->