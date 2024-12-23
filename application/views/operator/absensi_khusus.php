<!-- Begin Page Content -->
<div class="container-fluid dashboard-atas">
	<h1 class="h3 mb-4  text-gray-800"><?= $title ?>(<?= strtoupper(tgl_indo(date('Y-m-d'))) ?>)</h1>
	<div class="row gutters-sm">
		<div class="col-xl-12 col-md-12 ">

			<div class="card shadow mb-4">
				<!-- KONFIRMASI IZIN / SAKIT -->
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary ">
						<li>Konfirmasi Absensi Khusus Pegawai</li>
					</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="table-ketidakhadiran" style="width: 100%;">
							<thead class="text-primary">
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Jam Masuk</th>
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
							"url": "<?= base_url('operator/data_absen_khusus'); ?>", // URL file untuk proses select datanya
							"type": "POST"
						},
						"deferRender": true,
						"aLengthMenu": [
							[10, 50, 100],
							[10, 50, 100]
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
							},
							{
								"data": "time_in"
							},
							// {
							// 	"data": "qr_token",
							// 	"render": function(data, type, row, meta) {
							// 		return '<a href="< ?= base_url('assets/qr/ruangan/') ?>'+data+'.png" download class="btn btn-primary mt-2 zoom "><i class="fa fa-download "></i>&ensp;<img class="zoom  img-thumbnail img-responsive  " style="width: 100px; height: 100px;" src="<?= base_url('assets/qr/ruangan/') ?>'+data+'.png"></a>';
							// 	}
							// },
							{
								"data": "attendance_id",
								"render": function(data, type, row, meta) {
									var terima = "confirm('Apakah Anda Yakin Untuk Meng-ACC Kehadiran Ini?')";
									var tolak = "confirm('Apakah Anda Yakin Untuk Menolak Kehadiran Ini?')";
									return '' +
										'<a href="' + '<?= base_url('operator/absen_khusus/terima/'); ?>' + data + '" class="btn btn-success" onclick="return ' + terima + '">TERIMA</a>' +
										'<a href="' + '<?= base_url('operator/absen_khusus/tolak/'); ?>' + data + '" class="btn btn-danger" onclick="return ' + tolak + '">TOLAK</a>';
								}
							},
						],
					});
				});
			</script>

			
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
