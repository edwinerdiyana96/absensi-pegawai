<!-- Begin Page Content -->
<div class="container-fluid dashboard-atas">
	<h1 class="h3 mb-4  text-gray-800"><?= $title ?></h1>
	<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary ">PER HARI INI (<?= date('d-m-Y') ?>)</h6>
		</div>

		<div class="card-body">
			<?= $this->session->flashdata('message'); ?>

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table-rank_attendance" style="width:100%;">
					<thead>
						<tr>
							<th scope="col">Urutan</th>
							<th scope="col">Nama</th>
							<th scope="col">Tanggal</th>
							<th scope="col">Waktu</th>
							<th scope="col">Status</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>

		</div>

		<!-- <div class="card-body"> -->
			<!-- ============================ Display Only On Desktop Mode ============================ -->
			<!-- <div class="d-none d-lg-block">
				<div class="row">
					<div class="col-md-12 mb-2">
						<a href='< ?= base_url('rank/insertdataattendancerank/'); ?>'>
							<button class="btn btn-info form-control" data-toggle="modal" data-target="#addNewUser">
								<span class="icon text-white-50">
									<i class="fas fa-plus"></i>
								</span>
								<span class="text">UPDATE DATA</span>
							</button>
						</a>
					</div>
				</div>
			</div> -->

			<!-- ============================ Display Only On Mobile Mode ============================ -->
			<!-- <div class="d-lg-none">
				<div class="row">
					<div class="col-md-12 mb-2">
						<a href='< ?= base_url('rank/insertdataattendancerank/'); ?>'>
							<button class="btn btn-info form-control" data-toggle="modal" data-target="#addNewUser">
								<span class="icon text-white-50">
									<i class="fas fa-plus"></i>
								</span>
								<span class="text">UPDATE DATA</span>
							</button>
						</a>
					</div>
				</div>
			</div> -->
		<!-- </div> -->
	</div>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary ">DATA ABSENSI KESELURUHAN</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table-attendance_rank" style="width:100%;">
					<thead class="text-primary text-center">
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Nama</th>
							<th scope="col">Jumlah Raihan Kehadiran Terbaik</th>
						</tr>
					</thead>
					<tbody class="text-center">
						<?php
						$num = 1;
						foreach ($rank as $rank) :
							$nilai = $this->db->query("SELECT * FROM rank_attendance WHERE user_id = '" . $rank['id'] . "'")->num_rows();
						?>
							</tr>
							<td><?= $num++ ?></td>
							<td><?= $rank['name'] ?></td>
							<td><?= $nilai ?></td>
							<!-- <td>< ?= $jam['time_end'] ?></td> -->
							<!-- <td>
								<a href="< ?= base_url('absensi/editTime/') . $jam['id']; ?>" class="btn btn-warning mt-2">Update</a>
								<a href="< ?= base_url('absensi/deleteTime/') . $jam['id']; ?>" onclick=" return confirm('Yakin Mau dihapus  ?');" class=" btn btn-danger mt-2">Delete</a>

							</td> -->
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>

<script>
	$(document).ready(function () {
		$("#table-attendance_rank").DataTable({
			rowReorder: {
				selector: "td:nth-child(2)",
			},
			// responsive: true,
						"ScrollX": true,
		});
	});
</script>

<!-- DataTable Content -->
<script>
	var tabel = null;
	$(document).ready(function() {
		tabel = $('#table-rank_attendance').DataTable({
			"processing": true,
			// "responsive": true,
						"ScrollX": true,
			"serverSide": true,
			"ordering": true, // Set true agar bisa di sorting
			"order": [
				[3, 'asc']
			],
			// Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
			"ajax": {
				"url": "<?= base_url('rank/data_rekap_harian_rank'); ?>", // URL file untuk proses select datanya
				"type": "POST"
			},
			"deferRender": true,
			"aLengthMenu": [
				[3],
				[3]
			], // Combobox Limit
			"columns": [{
					"data": 'attendance_id',
					"sortable": false,
					render: function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{
					"data": "name"
				}, // Tampilkan kategori
				{
					"data": "date"
				}, // Tampilkan nama sub kategori
				{
					"data": "time_in"
				},
				{
					"data": "status",
					"render": function(data, type, row, meta) {
						if (data == '0') {
							return '<span class="badge badge-pill badge-danger">Belum Absen</span>';
						} else if (data == '1') {
							return '<span class="badge badge-pill badge-success">Hadir Tepat Waktu</span>';
						} else if (data == '2') {
							return '<span class="badge badge-pill badge-warning">Hadir Terlambat</span>';
						} else if (data == '3') {
							return '<span class="badge badge-pill badge-info">Sakit</span>';
						} else if (data == '4') {
							return '<span class="badge badge-pill badge-primary">Izin</span>';
						} else {
							return '<span class="badge badge-pill badge-danger">Alfa</span>';
						}
					}
				},

			],
		});
	});
</script>
