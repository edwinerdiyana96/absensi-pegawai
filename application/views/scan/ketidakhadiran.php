<!-- <link href="< ?= base_url('assets/'); ?>css/style.css" rel="stylesheet"> -->
<!-- <link href="< ?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <link rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet';this.onload=null" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic"> -->
<!-- <link href="< ?= base_url('assets/'); ?>css/normalize.css" rel="stylesheet"> -->
<!-- <link href="< ?= base_url('assets/'); ?>css/milligram.min.css" rel="stylesheet"> -->


<style type="text/css">
	.text-justify {
		text-align: justify;
	}
</style>

<div class="container-fluid dashboard-atas">
	<!-- <h1 class="h3 mb-4  text-gray-800"><?= $title ?></h1> -->
	<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary ">KONFIRMASI KETIDAKHADIRAN</h6>
		</div>

		<div class="alert alert-success" role="alert" style="margin: 10px;">
			<h4 class="alert-heading">PERHATIAN!</h4>
			<p class="text-justify" style="text-align: justify; display:inline-block;">
				Jika tidak hadir baik itu sakit, izin atau off, harap untuk memberikan keterangan dengan menekan salah satu tombol SAKIT atau IZIN atau OFF dibawah ini,
				kemudian berikan alasan atau keterangan dari ketidakhadiran tersebut, agar bisa di ACC oleh operator atau Wakil Kepala Sekolah.
			</p>
			<hr>
			<p class="mb-0">Jika Ada Kendala atau Pertanyaan Silahkan Hubungi Administrator!</p>
		</div>

		<div style="margin: 10px;">
			<?php if (!$cek_data) : {
			?>
					<a type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editDataAbsensiSakit" href="" data-status_sakit="3" data-user_id="<?= $user['id'] ?>" data-tanggal="<?= $tanggal ?>" data-description="Masukan Detail / Keterangan">SAKIT</a>
					<a type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editDataAbsensiIzin" href="" data-status_izin="4" data-user_id="<?= $user['id'] ?>" data-tanggal="<?= $tanggal ?>" data-description="Masukan Detail / Keterangan">IZIN</a>
					<a type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editDataAbsensiOff" href="" data-status_izin="5" data-user_id="<?= $user['id'] ?>" data-tanggal="<?= $tanggal ?>" data-description="Masukan Detail / Keterangan">OFF</a>
				<?php
				}
				?>
				<?php else : {
				?>
					<a hidden type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editDataAbsensiSakit" href="" data-status_sakit="3" data-user_id="<?= $user['id'] ?>" data-tanggal="<?= $tanggal ?>" data-description="Masukan Detail / Keterangan">SAKIT</a>
					<a hidden type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editDataAbsensiIzin" href="" data-status_izin="4" data-user_id="<?= $user['id'] ?>" data-tanggal="<?= $tanggal ?>" data-description="Masukan Detail / Keterangan">IZIN</a>
					<a hidden type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editDataAbsensiOff" href="" data-status_izin="5" data-user_id="<?= $user['id'] ?>" data-tanggal="<?= $tanggal ?>" data-description="Masukan Detail / Keterangan">OFF</a>
				<?php
				}
				?>
			<?php endif; ?>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<form action="<?= base_url('pegawai/ketidakhadiran/filter') ?>" method="POST">
					<input type="date" name="filter" class="btn btn-primary" value="<?= $filter ?>">
					<button class="btn btn-primary">Filter Tanggal</button>
				</form><br>
				<table class="table table-striped table-bordered" id="table-ketidakhadiran" style="width:100%;">
					<thead class="text-primary text-center">
						<tr>
							<th>No.</th>
							<th>Tanggal</th>
							<th>Keterangan</th>
							<th>Status</th>
						</tr>
					</thead>

					<tbody class="text-center">
						<?php
						$num = 1;
						foreach ($data_ketidakhadiran as $key => $kh) : ?>
							<tr>
								<td><?= $num++ ?></td>
								<td><?php echo $kh['tanggal']; ?></td>
								<td><?php echo $kh['keterangan']; ?></td>
								<td>
									<?php $kh['is_active']; ?>
									<?php
									if ($kh['is_active'] == 0) {
										echo "<span class='badge badge-warning'>PENDING</span>";
									} elseif ($kh['is_active'] == 1) {
										echo "<span class='badge badge-success'>DITERIMA</span>";
									} elseif ($kh['is_active'] == 2) {
										echo "<span class='badge badge-danger'>DITOLAK</span>";
									} ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- ABSENSI MANUAL - SAKIT -->
	<div class="modal fade" id="editDataAbsensiSakit" tabindex="-1" role="dialog" aria-labelledby="editDataAbsensiSakitLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editDataAbsensiSakitLabel">KONFIRMASI</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action='<?= base_url('pegawai/insertuserabsensisakit'); ?>' method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Keterangan</label>
							<label for="status_sakit" class="col-form-label" hidden>Data Absensi</label>
							<input type="text" class="form-control status_sakit" name="status_sakit" id="status_sakit" hidden>
							<input type="text" class="form-control user_id" name="user_id" id="user_id" hidden>
							<input type="text" class="form-control description" name="description" id="description">
						</div>

						<div class="form-group form-group-default">
							<label>Document/Foto Pendukung</label>
							<input type="file" class="form-control" name="upload">
						</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
					<button type="submit" class="btn btn-primary">KIRIM</button>
				</div>
				</form>
			</div>
		</div>
	</div>

	<!-- ABSENSI MANUAL - IZIN -->
	<div class="modal fade" id="editDataAbsensiIzin" tabindex="-1" role="dialog" aria-labelledby="editDataAbsensiLabelIzin" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editDataAbsensiIzinLabel">KONFIRMASI</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action='<?= base_url('pegawai/insertuserabsensiizin'); ?>' method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Keterangan</label>
							<label for="status_izin" class="col-form-label" hidden>Data Absensi</label>
							<input type="text" class="form-control status_izin" name="status_izin" id="status_izin" hidden>
							<input type="text" class="form-control user_id" name="user_id" id="user_id" hidden>
							<input type="text" class="form-control description" name="description" id="description">
						</div>

						<div class="form-group form-group-default">
							<label>Document/Foto Pendukung</label>
							<input type="file" class="form-control" name="upload">
						</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
					<button type="submit" class="btn btn-primary">KIRIM</button>
				</div>
				</form>
			</div>
		</div>
	</div>

	<!-- ABSENSI MANUAL - OFF -->
	<div class="modal fade" id="editDataAbsensiOff" tabindex="-1" role="dialog" aria-labelledby="editDataAbsensiLabelOff" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editDataAbsensiOffLabel">KONFIRMASI</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action='<?= base_url('pegawai/insertuserabsensioff'); ?>' method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Keterangan</label>
							<label for="status_off" class="col-form-label" hidden>Data Absensi</label>
							<input type="text" class="form-control status_off" name="status_off" id="status_off" hidden>
							<input type="text" class="form-control user_id" name="user_id" id="user_id" hidden>
							<input type="text" class="form-control description" name="description" id="description">
						</div>

						<div class="form-group form-group-default">
							<label>Document/Foto Pendukung</label>
							<input type="file" class="form-control" name="upload">
						</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
					<button type="submit" class="btn btn-primary">KIRIM</button>
				</div>
				</form>
			</div>
		</div>
	</div>

	<!-- <form id='form_absen' action="< ?= base_url('pegawai/absen/' . $user['id']) ?>" method="post"> -->
	<!-- <input type='hidden' name="user_id" id='user_id' value="< ?= $user['id'] ?>"> -->
	<!-- <input type='hidden' name="attendance_id" id='attendance_id' value="< ?= $attendance['attendance_id'] ?>"> -->
	<!-- <input type='hidden' id='qr' value='' name='qr'> -->
	<!-- <button hidden type="submit" class="btn btn-primary">SAKIT</button> -->
	<!-- </form> -->

</div>
</div>

</div>
</div>

<script>
	$(document).ready(function() {
		$('#editDataAbsensiSakit').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var status_sakit = button.data('status_sakit') // Extract info from data-* attributes
			var user_id = button.data('user_id') // Extract info from data-* attributes
			var tanggal = button.data('tanggal');
			var description = button.data('description');
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Konfirmasi Status Sakit Pada Tanggal ' + tanggal)
			modal.find('.status_sakit').val(status_sakit)
			modal.find('.user_id').val(user_id)
			modal.find('.description').val(description)
		})

		$('#editDataAbsensiIzin').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var status_izin = button.data('status_izin') // Extract info from data-* attributes
			var user_id = button.data('user_id') // Extract info from data-* attributes
			var tanggal = button.data('tanggal');
			var description = button.data('description');
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Konfirmasi Status Izin Pada Tanggal ' + tanggal)
			modal.find('.status_izin').val(status_izin)
			modal.find('.user_id').val(user_id)
			modal.find('.description').val(description)
		})

		$('#editDataAbsensiOff').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var status_off = button.data('status_off') // Extract info from data-* attributes
			var user_id = button.data('user_id') // Extract info from data-* attributes
			var tanggal = button.data('tanggal');
			var description = button.data('description');
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Konfirmasi Status Off Pada Tanggal ' + tanggal)
			modal.find('.status_off').val(status_off)
			modal.find('.user_id').val(user_id)
			modal.find('.description').val(description)
		})
	});
</script>

<script>
	$(document).ready(function() {
		$("#table-ketidakhadiran").DataTable({
			rowReorder: {
				selector: "td:nth-child(2)",
			},
			// responsive: true,
			"ScrollX": true,
		});
	});
</script>