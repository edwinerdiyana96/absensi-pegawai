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
                        <a href='#' class="btn btn-primary" data-toggle="modal" data-target="#addTime"> <i class="fas fa-plus-circle"></i> Tambah Jarak </a>
                    </div>
                </div>
            </div>

            <!-- ============================ Display Only On Mobile Mode ============================ -->
            <div class="d-lg-none">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <a href='#' class="btn btn-primary form-control" data-toggle="modal" data-target="#addTime"> <i class="fas fa-plus-circle"></i> Tambah Jarak </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table-time_attendance" style="width:100%;">
              
                    <thead class="text-primary">
                        <tr>
                            <th>No</th>
                            <th>Jarak (m)</th>
                            <th>Status</th>
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
                        foreach ($jarak_absen as $ja) : ?>
                            </tr>
                            <td><?= $num++ ?></td>
                            <td><?= $ja['jarak'] ?></td>
                            <td> <?php if ($ja['status'] == '1') {
                                        echo '<div class="alert alert-success" role="alert"> Aktif </div>';
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert"> Non Aktif </div>';
                                    } ?>
                            </td>
                            <td>
                                <a href="<?= base_url('absensi/editJarak/') . $ja['id']; ?>" class="btn btn-warning mt-2">Update</a>
                                <a href="<?= base_url('absensi/deleteJarak/') . $ja['id']; ?>" onclick=" return confirm('Yakin Mau dihapus  ?');" class=" btn btn-danger mt-2">Delete</a>

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
                <h5 class="modal-title" id="addRoleModelLabel">Tambah Jam Jarak </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Absensi/addJarak') ?>" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" id="jarak" name="jarak" placeholder="Masukan Jarak">
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="status">
                            <option value="1"> Aktif </option>
                            <option value="0"> Non Aktif </option>
                        </select>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah Jarak</button>
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