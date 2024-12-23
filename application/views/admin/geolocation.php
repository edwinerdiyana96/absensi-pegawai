<!-- Begin Page Content -->
<div class="container-fluid dashboard-atas">



	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary "><?= $title ?></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">

				<button class="btn btn-primary" data-toggle="modal" data-target="#libur">Tambah <?= $title ?></button>
				<br>
				<br>
				<table class="table table-striped table-bordered" id="table-geolocation" width="100%">
					<thead class="text-primary">
						<tr>
							<th>No</th>
							<th>Nama Lokasi</th>
							<th>Place ID</th>
							<th>Tanggal Dibuat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<!-- <tfoot class="text-primary">
                        <tr>
                            <th style="width:fit-content;">No</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                        </tr>
                    </tfoot> -->
					<tbody>
						<!-- < ?php
                    $date = new DateTime("now");
                    $curr_date = $date->format('Y-m-d');
                    ?> -->
						<?php foreach ($geolocation as $key => $ua) : ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo $ua['name']; ?></td>
								<td><?php echo $ua['place_id']; ?></td>
								<td><?php echo tgl_indo($ua['date_create']); ?></td>
								<td>
									<a data-toggle="modal" data-target="#edit<?= $ua['id'] ?>">
										<button class="btn btn-primary">Edit Data</button></a>
									<a href="<?= base_url('admin/geolocation/hapus/' . $ua['id']) ?>" onclick="return confirm('Apakah anda yakin?')">
										<button class="btn btn-danger">Hapus Data</button></a>
								</td>
							</tr>

							<!-- Modal -->
							<div class="modal fade" id="edit<?= $ua['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h5 class="modal-title">
												<span class="fw-mediumbold">
													Edit</span>
												<span class="fw-light">
													<?= $title ?>
												</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?= base_url('admin/geolocation/edit/' . $ua['id']) ?>" method="POST">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group form-group-default">
															<label>Lokasi</label>
															<input type="text" class="form-control" placeholder="Masukkan Nama Lokasi" name="nama" required value="<?= $ua['name'] ?>">
														</div>
														<div class="form-group form-group-default">
															<label>Place ID</label>
															<input type="text" class="form-control" placeholder="Masukkan Place Id" name="place_id" required value="<?= $ua['place_id'] ?>">
														</div>
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary form-control">Update Data</button>
											<!-- <button type="button" class="btn " data-dismiss="modal">Close</button> -->
										</div>
										</form>
									</div>
								</div>
							</div>




						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="libur" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header no-bd">
						<h5 class="modal-title">
							<span class="fw-mediumbold">
								Tambah</span>
							<span class="fw-light">
								<?= $title ?>
							</span>
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url('admin/geolocation/add') ?>" method="POST">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group form-group-default">
										<label>Lokasi</label>
										<input type="text" class="form-control" placeholder="Masukkan Nama Lokasi" name="nama" required>
									</div>
									<div class="form-group form-group-default">
										<label>Place ID</label>
										<input type="text" class="form-control" placeholder="Masukkan Place Id" name="place_id" required>
									</div>
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary form-control">Tambah Data</button>
						<!-- <button type="button" class="btn " data-dismiss="modal">Close</button> -->
					</div>
					</form>
				</div>
			</div>
		</div>


	</div>

</div>
</div>

<script>
	$(document).ready(function() {
		$("#table-geolocation").DataTable({
			"ScrollX": true,
			rowReorder: {
				selector: "td:nth-child(2)",
			},
			// responsive: true,
		});
	});
</script>
