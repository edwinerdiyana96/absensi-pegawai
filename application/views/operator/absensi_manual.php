<!-- Begin Page Content -->
<div class="container-fluid dashboard-atas">
	<h1 class="h3 mb-4  text-gray-800"><?= $title ?>(<?= strtoupper(tgl_indo(date('Y-m-d'))) ?>)</h1>
	<div class="row gutters-sm">
		<div class="col-xl-12 col-md-12 ">

			<div class="card shadow mb-4">
				<!-- KONFIRMASI IZIN / SAKIT -->
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary ">
						<li>Konfirmasi Yang Izin / Sakit / Off (Dari Pegawai Langsung)</li>
					</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="table-ketidakhadiran" style="width: 100%;">
							<thead class="text-primary">
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Status</th>
									<th>Keterangan</th>
									<th>Foto/Document</th>
									<th>Konfirmasi</th>
								</tr>
							</thead>
							<!-- <tfoot class="text-primary"></tfoot> -->
							<tbody>
								<!-- < ?php foreach ($data_ketidakhadiran as $key => $dk) : ?>
									<tr>
										<td>< ?php echo $key + 1; ?></td>
										<td>< ?php echo $dk['name']; ?></td>
										<td>< ?php echo $dk['status']; ?></td>
										<td>< ?php echo $dk['keterangan']; ?></td>
										<td>
											<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#editDataAbsensiHadir" href="" data-status_hadir="1" data-attendance_id="< ?= $ua['attendance_id'] ?>" data-name="< ?= $ua['name'] ?>">HADIR</a>
											<a type="button" class="btn btn-success" href="< ?= base_url('operator/ketidakhadiran/terima/') . $dk['id_tidakhadir']; ?>">TERIMA</a>
											<a type="button" class="btn btn-danger" href="< ?= base_url('operator/ketidakhadiran/tolak/') . $dk['id_tidakhadir']; ?>">TOLAK</a>
										</td>
									</tr>
								< ?php endforeach; ?> -->
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<!-- Content Datatables Ketidakhadiran -->
			<script>
				var tabel = null;
				$(document).ready(function() {
					tabel = $('#table-ketidakhadiran').DataTable({
						"processing": true,
						// "responsive": true,
						"ScrollX": true,
						"serverSide": true,
						"ordering": true, // Set true agar bisa di sorting
						"order": [
							[0, 'asc']
						], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
						"ajax": {
							"url": "<?= base_url('operator/data_ketidakhadiran'); ?>", // URL file untuk proses select datanya
							"type": "POST"
						},
						"deferRender": true,
						"aLengthMenu": [
							[10, 50, 100],
							[10, 50, 100]
						], // Combobox Limit
						"columns": [{
								"data": 'id_tidakhadir',
								"sortable": false,
								render: function(data, type, row, meta) {
									return meta.row + meta.settings._iDisplayStart + 1;
								}
							},
							{
								"data": "name"
							},
							{
								"data": "status"
							},
							{
								"data": "keterangan"
							},
							{
								"data": "document",
								"render": function(data, type, row, meta) {
									var terima = "confirm('Apakah Anda Yakin Untuk Meng-ACC Kehadiran Ini?')";
									var tolak = "confirm('Apakah Anda Yakin Untuk Menolak Kehadiran Ini?')";
									if(data == '-'){
										return '-';
									}else{
										return '<a href="' + '<?= base_url(); ?>' + data + '" class="btn btn-danger" download>Download</a>';
									}
								}
							},
							{
								"data": "id_tidakhadir",
								"render": function(data, type, row, meta) {
									var terima = "confirm('Apakah Anda Yakin Untuk Meng-ACC Kehadiran Ini?')";
									var tolak = "confirm('Apakah Anda Yakin Untuk Menolak Kehadiran Ini?')";
									return '' +
										'<a href="' + '<?= base_url('operator/ketidakhadiran/terima/'); ?>' + data + '" class="btn btn-success" onclick="return ' + terima + '">TERIMA</a>' +
										'<a href="' + '<?= base_url('operator/ketidakhadiran/tolak/'); ?>' + data + '" class="btn btn-danger" onclick="return ' + tolak + '">TOLAK</a>';
								}
							},
						],
					});
				});
			</script>

			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="mb-0 font-weight-bold text-primary ">
						<li>Input Konfirmasi Izin / Sakit / Off (Jika Pegawai Tidak Mengirim Langsung)</li>
					</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="table-input_ketidakhadiran" style="width: 100%;">
							<thead class="text-primary">
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<!-- <tfoot class="text-primary"></tfoot> -->
							<tbody>
								<?php foreach ($user_attendance as $key => $ua) : ?>
									<tr>
										<td><?php echo $key + 1; ?></td>
										<td><?php echo $ua['name']; ?></td>
										<td>
											<!-- <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#editDataAbsensiHadir" href="" data-status_hadir="1" data-attendance_id="< ?= $ua['attendance_id'] ?>" data-name="< ?= $ua['name'] ?>">HADIR</a> -->
											<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#editDataAbsensiSakit" href="" data-status_sakit="3" data-attendance_id="<?= $ua['attendance_id'] ?>" data-name="<?= $ua['name'] ?>" data-description="Masukan Detail / Keterangan">SAKIT</a>
											<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#editDataAbsensiIzin" href="" data-status_izin="4" data-attendance_id="<?= $ua['attendance_id'] ?>" data-name="<?= $ua['name'] ?>" data-description="Masukan Detail / Keterangan">IZIN</a>
											<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#editDataAbsensiOff" href="" data-status_off="5" data-attendance_id="<?= $ua['attendance_id'] ?>" data-name="<?= $ua['name'] ?>">OFF</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- Datatables Content -->
				<script>
					$(document).ready(function() {
						$("#table-input_ketidakhadiran").DataTable({
							rowReorder: {
								selector: "td:nth-child(2)",
							},
							// responsive: true,
						"ScrollX": true,
						});
					});
				</script>

				<!-- ABSENSI MANUAL - HADIR -->
				<div class="modal fade" id="editDataAbsensiHadir" tabindex="-1" role="dialog" aria-labelledby="editDataAbsensiHadirLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="editDataAbsensiHadirLabel">KONFIRMASI</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action='<?= base_url('operator/updateuserabsensihadir'); ?>' method="POST">
									<div class="form-group">
										<label for="status_hadir" class="col-form-label" hidden>Data Absensi</label>
										<input type="text" class="form-control status_hadir" name="status_hadir" id="status_hadir" hidden>
										<input type="text" class="form-control attendance_id" name="attendance_id" id="attendance_id" hidden>
									</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
								<button type="submit" class="btn btn-primary">HADIRKAN</button>
							</div>
							</form>
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
								<form action='<?= base_url('operator/updateuserabsensisakit'); ?>' method="POST">
									<div class="form-group">
										<label for="status_sakit" class="col-form-label" hidden>Data Absensi</label>
										<input type="text" class="form-control status_sakit" name="status_sakit" id="status_sakit" hidden>
										<input type="text" class="form-control attendance_id" name="attendance_id" id="attendance_id" hidden>
										<input type="text" class="form-control description" name="description" id="description">
									</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
								<button type="submit" class="btn btn-primary">SAKITKAN</button>
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
								<form action='<?= base_url('operator/updateuserabsensiizin'); ?>' method="POST">
									<div class="form-group">
										<label for="status_izin" class="col-form-label" hidden>Data Absensi</label>
										<input type="text" class="form-control status_izin" name="status_izin" id="status_izin" hidden>
										<input type="text" class="form-control attendance_id" name="attendance_id" id="attendance_id" hidden>
										<input type="text" class="form-control description" name="description" id="description">
									</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
								<button type="submit" class="btn btn-primary">IZINKAN</button>
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
								<form action='<?= base_url('operator/updateuserabsensioff'); ?>' method="POST">
									<div class="form-group">
										<label for="status_off" class="col-form-label" hidden>Data Absensi</label>
										<input type="text" class="form-control status_off" name="status_off" id="status_off" hidden>
										<input type="text" class="form-control attendance_id" name="attendance_id" id="attendance_id" hidden>
										<!-- <input type="text" class="form-control description" name="description" id="description"> -->
									</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
								<button type="submit" class="btn btn-primary">OFFKAN</button>
							</div>
							</form>
						</div>
					</div>
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

		$('#editDataAbsensiOff').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var status_off = button.data('status_off') // Extract info from data-* attributes
			var attendance_id = button.data('attendance_id') // Extract info from data-* attributes
			var name = button.data('name');
			// var description = button.data('description');
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Konfirmasi Kehadiran Atas Nama ' + name)
			modal.find('.status_off').val(status_off)
			modal.find('.attendance_id').val(attendance_id)
			// modal.find('.description').val(description)
		})
	});
</script>
</div>
</div>
