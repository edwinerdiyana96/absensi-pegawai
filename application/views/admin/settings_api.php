<!-- Begin Page Content -->
<div class="container-fluid dashboard-atas">
<?= $this->session->flashdata('message'); ?>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary "><?= $title ?></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">

				<!--<button class="btn btn-primary" data-toggle="modal" data-target="#libur">Tambah <?= $title ?></button>-->
				<!--<br>-->
				<!--<br>-->
				<table class="table table-striped table-bordered" id="table-geolocation">
					<thead class="text-primary">
						<tr>
							<th>No Whatsapp Bot</th>
							<th>Kode Group Penerima</th>
							<th>Nomor Whatsapp Penerima</th>
							<th>Bot Telegram</th>
							<th>Token Telegram</th>
                            <th>Chat Id Telegram</th>
							<th>Metode Laporan</th>
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
						<?php 
						$settings = $this->db->get('settings')->row_array(); ?>
							<tr>
								<td><?php echo $settings['phone']; ?></td>
								<td><?php echo $settings['kode_group']; ?></td>
								<td><?php echo $settings['wa_target']; ?></td>
								<td><?php echo $settings['bot_telegram']; ?></td>
								<td><?php echo $settings['token_telegram']; ?></td>
								<td><?php echo $settings['chat_id_telegram']; ?></td>
								<td><?php echo $settings['metode_laporan']; ?></td>
								<td>
									<a data-toggle="modal" data-target="#edit">
										<button class="btn btn-primary">Edit Data</button></a>

								</td>
							</tr>

							<!-- Modal -->
							<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
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
											<form action="<?= base_url('admin/settings_api/edit/') ?>" method="POST" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group form-group-default">
															<label>Wa Bot</label>
															<input type="number" class="form-control" placeholder="Wa Bot" name="phone" required value="<?= $settings['phone'] ?>">
														</div>

														<div class="form-group form-group-default">
															<label>Kode Group Penerima</label>
															<input type="text" class="form-control" placeholder="Kode Group Whatsapp" name="kode_group" required value="<?= $settings['kode_group'] ?>">
														</div>
														<div class="form-group form-group-default">
															<label>Nomor Whatsapp Penerima</label>
															<input type="text" class="form-control" placeholder="Whatsapp Laporan" name="wa_target" required value="<?= $settings['wa_target'] ?>">
														</div>
                                                        <div class="form-group form-group-default">
															<label>Bot Telegram</label>
															<input type="text" class="form-control" placeholder="Bot Telegram" name="bot_telegram" required value="<?= $settings['bot_telegram'] ?>">
														</div>
                                                        <div class="form-group form-group-default">
															<label>Token Telegram</label>
															<input type="text" class="form-control" placeholder="Token Telegram" name="token_telegram" required value="<?= $settings['token_telegram'] ?>">
														</div>
                                                        <div class="form-group form-group-default">
															<label>Chat Id Telegram</label>
															<input type="text" class="form-control" placeholder="Chat Id Telegram" name="chat_id_telegram" required value="<?= $settings['chat_id_telegram'] ?>">
														</div>
														<div class="form-group form-group-default">
															<label>Metode Laporan</label>
															<select name="metode_laporan" id="" class="form-control">
																<?php
																if ($settings['metode_laporan'] == 'Whatsapp Group') {
																	echo '
																	<option value="Whatsapp Group" selected>Whatsapp Group</option>
																	<option value="Whatsapp Pribadi">Whatsapp Pribadi</option>
																	<option value="Whatsapp Group-Pribadi">Whatsapp Group + Pribadi</option>
																	<option value="Telegram">Telegram</option>';
																}elseif($settings['metode_laporan'] == 'Whatsapp Pribadi') {
																	echo '
																	<option value="Whatsapp Group">Whatsapp Group</option>
																	<option value="Whatsapp Pribadi" selected>Whatsapp Pribadi</option>
																	<option value="Whatsapp Group-Pribadi">Whatsapp Group + Pribadi</option>
																	<option value="Telegram">Telegram</option>';
																}elseif($settings['metode_laporan'] == 'Whatsapp Group-Pribadi'){
																	echo '
																	<option value="Whatsapp Group">Whatsapp Group</option>
																	<option value="Whatsapp Pribadi">Whatsapp Pribadi</option>
																	<option value="Whatsapp Group-Pribadi" selected>Whatsapp Group + Pribadi</option>
																	<option value="Telegram">Telegram</option>';
																}
																else{
																	echo '
																	<option value="Whatsapp Group">Whatsapp Group</option>
																	<option value="Whatsapp Pribadi">Whatsapp Pribadi</option>
																	<option value="Whatsapp Group-Pribadi">Whatsapp Group + Pribadi</option>
																	<option value="Telegram" selected>Telegram</option>';
																}
																?>
															</select>
															<!-- <input type="text" class="form-control" placeholder="Masukkan Langitude Sekolah" name="langitude" required value="<?= $settings['langitude'] ?>"> -->
														</div>
														<!-- <div class="form-group form-group-default">
															<label>Logo Sekolah</label>
															<input type="file" class="form-control" placeholder="Masukkan Place Id" name="upload" required">
														</div> -->
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





					</tbody>
				</table>
			</div>
		</div>


	


	</div>

</div>
</div>

<!-- <script>
	$(document).ready(function() {
		$("#table-geolocation").DataTable({
			rowReorder: {
				selector: "td:nth-child(2)",
			},
			responsive: true,
		});
	});
</script> -->


<script>
			var tabel = null;
			$(document).ready(function() {
				tabel = $('#table-geolocation').DataTable({
					"ScrollX": true,
					// "processing": true,
					// "responsive": true,
				});
			});
		</script>
