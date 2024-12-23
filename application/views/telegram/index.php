<!-- Begin Page Content -->
<div class="container-fluid dashboard-atas">
	<h1 class="h3 mb-4  text-gray-800"><?= $title ?></h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">AUTO INSERT DATA ATTENDANCE</h6>
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
						<a href='<?= base_url('telegram/insertdataattendance/'); ?>'>
							<button class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#addNewUser">
								<span class="icon text-white-50">
									<i class="fas fa-plus"></i>
								</span>
								<span class="text">INSERT</span>
							</button>
						</a>
					</div>
				</div>
			</div>

			<!-- ============================ Display Only On Mobile Mode ============================ -->
			<div class="d-lg-none">
				<div class="row">
					<div class="col-md-12 mb-2">
						<a href='<?= base_url('telegram/insertdataattendance/'); ?>'>
							<button class="btn btn-info form-control" data-toggle="modal" data-target="#addNewUser">
								<span class="icon text-white-50">
									<i class="fas fa-plus"></i>
								</span>
								<span class="text">INSERT</span>
							</button>
						</a>
					</div>
				</div>
			</div>

			<br>

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table-autoinsert" style="width:100%;">
					<thead class="text-primary">
						<tr>
							<th>No.</th>
							<th>Nama</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>

		<!-- DataTable Content -->
		<script>
			var tabel = null;
			$(document).ready(function() {
				tabel = $('#table-autoinsert').DataTable({
					"processing": true,
					// "responsive": true,
						"ScrollX": true,
					"serverSide": true,
					"ordering": true, // Set true agar bisa di sorting
					"order": [
						[0, 'asc']
					], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
					"ajax": {
						"url": "<?= base_url('telegram/data_attendance'); ?>", // URL file untuk proses select datanya
						"type": "POST"
					},
					"deferRender": true,
					"aLengthMenu": [
						[10, 50, 100],
						[10, 50, 100]
					], // Combobox Limit
					"columns": [{
							"data": 'id',
							"sortable": false,
							render: function(data, type, row, meta) {
								return meta.row + meta.settings._iDisplayStart + 1;
							}
						},
						{
							"data": "name"
						}
					],
				});
			});
		</script>

	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">REKAP DATA ATTENDANCE</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-6">
					<?= $this->session->flashdata('message'); ?>
				</div>
			</div>
			<ul>
				<li>
					<h6 class="m-0 font-weight-bold text-primary">Total Yang Hadir: <?= $total_hadir_hari_ini; ?> Orang</h6>
				</li>
				<li>
					<h6 class="m-0 font-weight-bold text-primary">Total Yang Terlambat: <?= $total_terlambat; ?> Orang</h6>
				</li>
				<li>
					<h6 class="m-0 font-weight-bold text-primary">Total Yang Tidak Hadir: <?= $total_tidak_hadir_hari_ini; ?> Orang</h6>
				</li>
			</ul>
			<!-- ============================ Display Only On Desktop Mode ============================ -->
			<div class="d-none d-lg-block">
				<div class="row">
					<div class="col-md-12 mb-2">
						<a href='<?= base_url('telegram/sendRekapTelegram/'); ?>'><button class="btn btn-info form-control">KIRIM REKAP KE TELEGRAM</button></a>
					</div>
				</div>
			</div>
			<!-- ============================ Display Only On Mobile Mode ============================ -->
			<div class="d-lg-none">
				<div class="row">
					<div class="col-md-12 mb-2">
						<a href='<?= base_url('telegram/sendRekapTelegram/'); ?>'><button class="btn btn-info form-control">KIRIM REKAP KE TELEGRAM</button></a>
					</div>
				</div>
			</div>
			<br>
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table-telegram" style="width:100%;">
					<thead class="text-primary">
						<tr>
							<th>No.</th>
							<th>Nama</th>
							<th>Jabatan</th>
							<th>Tanggal</th>
							<th>Jam Masuk</th>
							<th>Jam Istirahat</th>
							<th>Jam Pulang</th>
							<th>Keterangan</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($tidak_hadir_hari_ini as $key1 => $thhi) : ?>
							<tr>
								<td><?php echo $key1 + 1; ?></td>
								<td><?php echo $thhi['name']; ?> </a></td>
								<td><?php echo $thhi['department']; ?></td>
								<td><?php echo $thhi['date']; ?></td>
								<td><?php echo $thhi['time_in']; ?></td>
								<td><?php echo $thhi['time_break']; ?></td>
								<td><?php echo $thhi['time_out']; ?></td>
								<td>

									<?php if ($thhi['status'] == 1) : {
											echo '<span class="badge badge-pill badge-success">Hadir Tepat Waktu</span>';
										}

									elseif ($thhi['status'] == 2) : {
											echo '<span class="badge badge-pill badge-secondary">Hadir Telambat</span>';
										}

									elseif ($thhi['status'] == 3) : {
											echo '<span class="badge badge-pill badge-primary">Sakit</span>';
										}
									elseif ($thhi['status'] == 4) : {
											echo '<span class="badge badge-pill badge-primary">Izin</span>';
										}

									elseif ($thhi['status'] == 0) : {
											if ($thhi['time_in'] < '14:00:00' && $thhi['date'] == date('Y-m-d')) {
												echo '<span class="badge badge-pill badge-info">Belum Hadir</span>';
											} else {
												echo '<span class="badge badge-pill badge-danger">Alpha</span>';
											}
										}                                                       ?>
									<?php endif; ?>

								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<br>
			<br>

			<!-- ============================ Display Only On Desktop Mode ============================ -->
			<div class="d-none d-lg-block">
				<div class="row">
					<div class="col-md-12 mb-2">
						<a href='<?= base_url('telegram/sendTerlambatTelegram/'); ?>'><button class="btn btn-info form-control">KIRIM DATA TERLAMBAT KE TELEGRAM</button></a>
					</div>
				</div>
			</div>
			<!-- ============================ Display Only On Mobile Mode ============================ -->
			<div class="d-lg-none">
				<div class="row">
					<div class="col-md-12 mb-2">
						<a href='<?= base_url('telegram/sendTerlambatTelegram/'); ?>'><button class="btn btn-info form-control">KIRIM DATA TERLAMBAT KE TELEGRAM</button></a>
					</div>
				</div>
			</div>
			<br>
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table-telegram" style="width:100%;">
					<thead class="text-primary">
						<tr>
							<th>No.</th>
							<th>Nama</th>
							<th>Jam Hadir</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($terlambat as $key2 => $trlmbt) : ?>
							<tr>
								<td><?php echo $key2 + 1; ?></td>
								<td><?php echo $trlmbt['name']; ?> </a></td>
								<td><?php echo $trlmbt['time_in']; ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
	$(document).ready(function() {
		$("#table-telegram").DataTable({
			rowReorder: {
				selector: "td:nth-child(2)",
			},
			// responsive: true,
			"ScrollX": true,
		});
	});
</script>
