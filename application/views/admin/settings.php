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
							<th>Nama Sekolah</th>
							<th>Alamat</th>
							<th>Longitude</th>
							<th>Latitude</th>
							<th>Logo</th>
							<th>Foto Sampul</th>
							<th>Status Map</th>
							<th>UUid</th>
							<th>Url Dashboard Admin</th>
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
								<td><?php echo $settings['name']; ?></td>
								<td><?php echo $settings['address']; ?></td>
								<td><?php echo $settings['langitude']; ?></td>
								<td><?php echo $settings['longitude']; ?></td>
								<td>
									<a data-toggle="modal" data-target="#logo">
										<button class="btn btn-primary">Lihat Logo</button></a>
								</td>
								<td>
									<a data-toggle="modal" data-target="#sampul">
										<button class="btn btn-primary">Lihat Foto Sampul</button></a>
								</td>
								<td>
								    <!-- < ?php
								    if($settings['maps_enabled'] == '1'){ ?>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked  onclick="return confirm('Apakah Anda Yakin?')"/>
                                          <label class="form-check-label" for="inlineRadio1">Aktif</label>
                                        </div>
                                        
                                        <div class="form-check form-check-inline">
                                         <form action="<?= base_url()?>" method="POST">
                                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" onclick="return confirm('Apakah Anda Yakin?')" />
                                         </form>
                                          <label class="form-check-label" for="inlineRadio2">Tidak Aktif</label>
                                        </div>
                                    < ?php }else{ ?>
                                        
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option1" onclick="return confirm('Apakah Anda Yakin?')" />
                                          <label class="form-check-label" for="inlineRadio3">Aktif</label>
                                        </div>
                                        
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option2" onclick="return confirm('Apakah Anda Yakin?')" checked />
                                          <label class="form-check-label" for="inlineRadio4">Tidak Aktif</label>
                                        </div>
                                    < ?php }?> -->
										<style>
											*,
*:before,
*:after {
  box-sizing: border-box;
}

body {
  font-family: -apple-system, ".SFNSText-Regular", "Helvetica Neue", "Roboto", "Segoe UI", sans-serif;
}

.toggle {
  cursor: pointer;
  display: inline-block;
}

.toggle-switch {
  display: inline-block;
  background: #ccc;
  border-radius: 16px;
  width: 58px;
  height: 32px;
  position: relative;
  vertical-align: middle;
  transition: background 0.25s;
}
.toggle-switch:before, .toggle-switch:after {
  content: "";
}
.toggle-switch:before {
  display: block;
  background: linear-gradient(to bottom, #fff 0%, #eee 100%);
  border-radius: 50%;
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.25);
  width: 24px;
  height: 24px;
  position: absolute;
  top: 4px;
  left: 4px;
  transition: left 0.25s;
}
.toggle:hover .toggle-switch:before {
  background: linear-gradient(to bottom, #fff 0%, #fff 100%);
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.5);
}
.toggle-checkbox:checked + .toggle-switch {
  background: #56c080;
}
.toggle-checkbox:checked + .toggle-switch:before {
  left: 30px;
}

.toggle-checkbox {
  position: absolute;
  visibility: hidden;
}

.toggle-label {
  margin-left: 5px;
  position: relative;
  top: 2px;
}
										</style>
										<label class="toggle">
										<?php if($settings['maps_enabled'] == '1'){ ?>
											<input class="toggle-checkbox" type="checkbox" checked id="aktif">
										<?php }else{ ?>
											<input class="toggle-checkbox" type="checkbox" id="nonaktif">
										<?php } ?>
											<div class="toggle-switch"></div>
										</label>
										
                                        
                                        <script type="text/javascript">
                                                document.getElementById("aktif").onclick = function () {
                                                     var ask = window.confirm("Apakah Anda Yakin?");
                                                        if (ask) {
                                                            window.location.href = "<?= base_url('operator/change_maps_enabled/0')?>";
                                                        }
                                                };
                                        </script>
                                        
                                        <script type="text/javascript">
                                                document.getElementById("nonaktif").onclick = function () {
                                                     var ask = window.confirm("Apakah Anda Yakin?");
                                                        if (ask) {
                                                            window.location.href = "<?= base_url('operator/change_maps_enabled/1')?>";
                                                    
                                                        }
                                                };
                                        </script>
								</td>
								<td>
										<label class="toggle">
										<?php if($settings['uuid_enabled'] == '1'){ ?>
											<input class="toggle-checkbox" type="checkbox" checked id="aktif_uuid">
										<?php }else{ ?>
											<input class="toggle-checkbox" type="checkbox" id="nonaktif_uuid">
										<?php } ?>
											<div class="toggle-switch"></div>
										</label>
										
                                        
                                        <script type="text/javascript">
                                                document.getElementById("aktif_uuid").onclick = function () {
                                                     var ask = window.confirm("Apakah Anda Yakin?");
                                                        if (ask) {
                                                            window.location.href = "<?= base_url('operator/change_uuid_enabled/0')?>";
                                                        }
                                                };
                                        </script>
                                        
                                        <script type="text/javascript">
                                                document.getElementById("nonaktif_uuid").onclick = function () {
                                                     var ask = window.confirm("Apakah Anda Yakin?");
                                                        if (ask) {
                                                            window.location.href = "<?= base_url('operator/change_uuid_enabled/1')?>";
                                                    
                                                        }
                                                };
                                        </script>
								</td>
								<td><?php echo $settings['url']; ?></td>
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
											<form action="<?= base_url('admin/settings/edit/') ?>" method="POST" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group form-group-default">
															<label>Nama Sekolah</label>
															<input type="text" class="form-control" placeholder="Masukkan Nama Sekolah" name="nama" required value="<?= $settings['name'] ?>">
														</div>
														<div class="form-group form-group-default">
															<label>Alamat Sekolah</label>
															<input type="text" class="form-control" placeholder="Masukkan Alamat Sekolah" name="address" required value="<?= $settings['address'] ?>">
														</div>
														
														<div class="form-group form-group-default">
															<label>Longitude</label>
															<input type="text" class="form-control" placeholder="Masukkan Longitude Sekolah" name="longitude" required value="<?= $settings['longitude'] ?>">
														</div>
														
														<div class="form-group form-group-default">
															<label>Latitude</label>
															<input type="text" class="form-control" placeholder="Masukkan Langitude Sekolah" name="langitude" required value="<?= $settings['langitude'] ?>">
														</div>
														<div class="form-group form-group-default">
															<label>Url Dashboard Admin</label>
															<input type="text" class="form-control" placeholder="Masukkan URL Dashboard Admin" name="url" required value="<?= $settings['url'] ?>">
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






							

							<!-- Modal -->
							<div class="modal fade" id="logo" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h5 class="modal-title">
												<span class="fw-mediumbold">
													Edit</span>
												<span class="fw-light">
													Logo
												</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?= base_url('admin/settings/logo/') ?>" method="POST" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-12">
														<center>
															<img src="<?= base_url($settings['logo'])?>" alt="" width="100%">
														</center>
													</div>
													<div class="col-md-12 mt-2">
														<div class="form-group form-group-default">
															<label>Logo Sekolah</label>
															<input type="file" class="form-control" placeholder="Masukkan Place Id" name="upload" required">
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





							

							<!-- Modal -->
							<div class="modal fade" id="sampul" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h5 class="modal-title">
												<span class="fw-mediumbold">
													Edit</span>
												<span class="fw-light">
													Foto Sampul
												</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?= base_url('admin/settings/sampul/') ?>" method="POST" enctype="multipart/form-data">
												<div class="row">
													
													<div class="col-md-12">
														<center>
															<img src="<?= base_url($settings['sampul'])?>" alt="" width="100%">
														</center>
													</div><br><br>
													<div class="col-md-12 mt-2">
														<div class="form-group form-group-default">
															<label>Foto Sampul</label>
															<input type="file" class="form-control" placeholder="Masukkan Place Id" name="upload" required>
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
