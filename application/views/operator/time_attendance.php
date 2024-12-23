<!-- Begin Page Content -->
<div class="container-fluid dashboard-atas">

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary "><?= $title ?></h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-6">
					<?= $this->session->flashdata('message'); ?>
				</div>
			</div>

			<!-- ============================ Display Only On Desktop Mode ============================ -->
			<div class="d-none d-lg-block">
			<div class="row">
				<div class="col-md-4 mb-2">
					<a href='#' class="btn btn-primary" data-toggle="modal" data-target="#addTime"> <i class="fas fa-plus-circle"></i> Tambah Jam </a>
				</div>
			</div>
			</div>

			<!-- ============================ Display Only On Mobile Mode ============================ -->
			<div class="d-lg-none">
			<div class="row">
				<div class="col-md-12 mb-2">
					<a href='#' class="btn btn-primary form-control" data-toggle="modal" data-target="#addTime"> <i class="fas fa-plus-circle"></i> Tambah Jam </a>
				</div>
			</div>
			</div>

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table-time_attendance" style="width:100%;">
					<thead class="text-primary">
						<tr>
							<th>No</th>
							<th>Keterangan</th>
							<th>Jam Buka</th>
							<th>Jam Tutup</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<!-- <tfoot class="text-primary">
						<tr>
							<th>No</th>
							<th>Keterangan</th>
							<th>Jam Buka</th>
							<th>Jam Tutup</th>
							<th>Aksi</th>
						</tr>
					</tfoot> -->
					<tbody>
						<?php
						$num = 1;
						foreach ($jam_absen as $jam) : ?>
							</tr>
							<td><?= $num++ ?></td>
							<td><?= $jam['time_schedule'] ?></td>
							<td><?= $jam['time_start'] ?></td>
							<td><?= $jam['time_end'] ?></td>
							<td>
								<a href="<?= base_url('absensi/editTime/') . $jam['id']; ?>" class="btn btn-warning mt-2">Update</a>
								<a href="<?= base_url('absensi/deleteTime/') . $jam['id']; ?>" onclick=" return confirm('Yakin Mau dihapus  ?');" class=" btn btn-danger mt-2">Delete</a>

							</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="addTime" tabindex="-1" aria-labelledby="addRoleModelLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addRoleModelLabel">Tambah Jam Absen </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('Absensi/addTime') ?>" method="POST">
				<div class="modal-body">

					<div class="form-group">
						<input type="text" class="form-control" id="time_schedule" name="time_schedule" placeholder="Masukan Keterangan">
					</div>

					<div class="form-group">
						<input type="text" class="form-control" id="time_start" maxlength="8" name="time_start" placeholder="jam:menit:detik">
					</div>

					<div class="form-group">
						<input type="text" class="form-control" id="time_end" maxlength="8" name="time_end" placeholder="jam:menit:detik">
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Tambah Jam</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$("#table-time_attendance").DataTable({
			rowReorder: {
				selector: "td:nth-child(2)",
			},
			// responsive: true,
						"ScrollX": true,
		});
	});
</script>

