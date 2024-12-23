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
					<!--< ?php print_r($this->session->flashdata('message')); ?>-->
					<!--< ?php var_dump($this->session->flashdata('message')); ?>-->
				</div>
			</div>

			<!-- ============================ Display Only On Desktop Mode ============================ -->
			<div class="d-none d-lg-block">
				<div class="row">
					<div class="col-md-4 mb-2">
						<a href='<?= base_url('operator/qr/add') ?>' class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Generate QR Code Baru</a>
					</div>
				</div>
			</div>
			<!-- ============================ Display Only On Mobile Mode ============================ -->
			<div class="d-lg-none">
				<div class="row">
					<div class="col-md-12 mb-2">
						<a href='<?= base_url('operator/qr/add') ?>' class="btn btn-primary form-control"> <i class="fas fa-plus-circle"></i> Generate QR Code Baru</a>
					</div>
				</div>
			</div>
			<br>
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table-generate_qrcode" style="width:100%;">
					<thead class="text-primary">
						<tr>
							<th>No</th>
							<th>Code</th>
							<th>PNG</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<!-- <tfoot class="text-primary">
						<tr>
							<th>No</th>
							<th>Code</th>
							<th>PNG</th>
							<th>Aksi</th>
						</tr>
					</tfoot> -->
					<tbody>
						<?php
						$num = 1;
						foreach ($qr as $qr) : ?>
							</tr>
							<td><?= $num++ ?></td>
							<td><?= $qr['qr_token']; ?></td>
							<td>
								<a href="<?= base_url('assets/qr/' . $qr['qr_token'] . '.png') ?>" download class="btn btn-primary mt-2 zoom ">
									<i class="fa fa-download "></i>&ensp;
									<img class="img-thumbnail img-responsive" style="width: 100px; height: 100px;" src="<?= base_url('assets/qr/') . $qr['qr_token'] . '.png'; ?>">
								</a>
							</td>

							<td>
								<a href="<?= base_url('operator/qr/delete/') . $qr['id']; ?>" onclick=" return confirm('Yakin Mau dihapus  ?');" class=" btn btn-danger btn-block mt-2">Delete</a>
								<a href="<?= base_url('operator/qr/cetak/') . $qr['id']; ?>" class=" btn btn-info btn-block mt-2">Cetak</a>
							</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>

<script>
	$(document).ready(function() {
		$("#table-generate_qrcode").DataTable({
			rowReorder: {
				selector: "td:nth-child(2)",
			},
			// responsive: true,
						"ScrollX": true,
		});
	});
</script>
