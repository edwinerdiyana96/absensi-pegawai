<!-- Begin Page Content -->
<div class="container-fluid dashboard-atas">
<h1 class="h3 mb-4  text-gray-800"><?= $title ?></h1>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary ">Daftar Pegawai Masuk di Hari Libur</h6>
		</div>

		<?= $this->session->flashdata('message'); ?>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table-holiday_attendance" width="100%">
					<thead class="text-primary">
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Tanggal</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<!-- <tfoot class="text-primary"></tfoot> -->
					<tbody>
						<?php foreach ($user_attendance as $key => $ua) : ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo $ua['name']; ?></td>
								<td><?php echo $ua['date']; ?></td>
								<td>
									<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#konfirmasihadir" href="" data-status_sakit="1" data-attendance_id="<?= $ua['attendance_id'] ?>" data-name="<?= $ua['name'] ?>" data-description="Masukan Detail / Keterangan">Konfirmasi Kehadiran</a>
									<a type="button" class="btn btn-danger" data-toggle="modal" data-target="#tolakhadir" href="" data-status_izin="2" data-attendance_id="<?= $ua['attendance_id'] ?>" data-name="<?= $ua['name'] ?>" data-description="Masukan Detail / Keterangan">Tolak Kehadiran</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- ABSENSI MANUAL - SAKIT -->
		<div class="modal fade" id="konfirmasihadir" tabindex="-1" role="dialog" aria-labelledby="konfirmasihadir" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="konfirmasihadir">KONFIRMASI <?= $ua['name'] ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action='<?= base_url('operator/libur/hadir'); ?>' method="POST">
							<div class="form-group">
								<label for="status_sakit" class="col-form-label" hidden>Data Absensi</label>

								<input type="text" class="form-control attendance_id" value="<?= $ua['attendance_id'] ?>" hidden name='attendance_id'>
								<input type="text" class="form-control description" name="description" id="description" placeholder="Masukkan keterangan">
							</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
						<button type="submit" class="btn btn-primary">Konfirmasi Kehadiran</button>
					</div>
					</form>
				</div>
			</div>
		</div>

		<!-- ABSENSI MANUAL - IZIN -->
		<div class="modal fade" id="tolakhadir" tabindex="-1" role="dialog" aria-labelledby="tolakhadir" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="konfirmasihadir">KONFIRMASI <?= $ua['name'] ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action='<?= base_url('operator/libur/tolak'); ?>' method="POST">
							<div class="form-group">
								<label for="status_izin" class="col-form-label" hidden>Data Absensi</label>
								<input type="text" class="form-control attendance_id" value="<?= $ua['attendance_id'] ?>" hidden name='attendance_id'>
								<input type="text" class="form-control description" name="description" id="description" placeholder="Masukkan keterangan">
							</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
						<button type="submit" class="btn btn-danger">Tolak Kehadiran</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-12 col-md-12 ">

		<div class="card shadow mb-4">

			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary ">Data Tanggal / Hari Libur</h6>
			</div>

			<div class="card-body">
				<!-- <div class="table-responsive"> -->
				<button class="btn btn-primary" data-toggle="modal" data-target="#libur">Tetapkan hari Libur</button>
				<br>
				<br>
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="table-holiday" width="100%">
						<thead class="text-primary">
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<!-- <tfoot class="text-primary"></tfoot> -->
						<tbody>
							<?php foreach ($data_holiday as $key => $ua) : ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><?php echo tgl_indo($ua['date']); ?></td>
									<td><?php echo $ua['description']; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="libur" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header no-bd">
					<h5 class="modal-title">
						<span class="fw-mediumbold">
							Tetapkan</span>
						<span class="fw-light">
							Hari Libur
						</span>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('operator/delete_date_attendance') ?>" method="POST">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Tanggal Awal Libur</label>
									<input type="date" class="form-control" name="awal" required value="<?= date('Y-m-d') ?>">
								</div>
								
								<div class="form-group form-group-default">
									<label>Tanggal Akhir Libur</label>
									<input type="date" class="form-control" name="akhir" required value="<?= date('Y-m-d') ?>">
								</div>
								<div class="form-group form-group-default">
									<label>Keterangan</label>
									<input type="text" class="form-control" placeholder="Masukkan Keterangan" name="description" required>
								</div>
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary form-control">Tetapkan Hari Libur</button>
					<!-- <button type="button" class="btn " data-dismiss="modal">Close</button> -->
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>

<script>
	$(document).ready(function() {
		$('#editDataAbsensiHadir').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var status_hadir = button.data('status_hadir') // Extract info from data-* attributes
			var attendance_id = button.data('attendance_id') // Extract info from data-* attributes
			var name = button.data('name');
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Konfirmasi Kehadiran Atas Nama ' + name)
			modal.find('.status_hadir').val(status_hadir)
			modal.find('.attendance_id').val(attendance_id)
		})

		$('#editDataAbsensiSakit').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var status_sakit = button.data('status_sakit') // Extract info from data-* attributes
			var attendance_id = button.data('attendance_id') // Extract info from data-* attributes
			var name = button.data('name');
			var description = button.data('description');
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Konfirmasi Kehadiran Atas Nama ' + name)
			modal.find('.status_sakit').val(status_sakit)
			modal.find('.attendance_id').val(attendance_id)
			modal.find('.description').val(description)
		})

		$('#editDataAbsensiIzin').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var status_izin = button.data('status_izin') // Extract info from data-* attributes
			var attendance_id = button.data('attendance_id') // Extract info from data-* attributes
			var name = button.data('name');
			var description = button.data('description');
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Konfirmasi Kehadiran Atas Nama ' + name)
			modal.find('.status_izin').val(status_izin)
			modal.find('.attendance_id').val(attendance_id)
			modal.find('.description').val(description)
		})
	});
</script>

<!-- </div>
	</div> -->

<script>
	$(document).ready(function() {
		$("#table-holiday_attendance").DataTable({
			rowReorder: {
				selector: "td:nth-child(2)",
			},
			// responsive: true,
			"ScrollX": true,
		});
	});
</script>

<script>
	$(document).ready(function() {
		$("#table-holiday").DataTable({
			rowReorder: {
				selector: "td:nth-child(2)",
			},
			// responsive: true,
			"ScrollX": true,
		});
	});
</script>
