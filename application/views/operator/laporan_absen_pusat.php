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

            <br>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table-generate_qrcode" style="width:100%;">
                    <thead class="text-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Foto</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Status</th>
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
                        foreach ($laporan as $laporan) :
                            $data_user = $this->db->query("SELECT * FROM user WHERE id = '" . $laporan['user_id'] . "'")->row_array();
                        ?>
                            </tr>
                            <td><?= $num++ ?></td>
                            <td><?= $data_user['name'] ?></td>
                            <td>
                                <img class="zoom  img-thumbnail img-responsive  " style="width: 100px; height: 100px;" src="<?= base_url('uploads/' . $laporan['image']) ?>">
                            </td>
                            <td><?= $laporan['time_in'] ?></td>
                            <td><?= $laporan['time_out'] ?></td>
                            <td>

                                <?php if ($laporan['status'] == 1) : {
                                        echo '<span class="badge badge-pill badge-success">Hadir Tepat Waktu</span>';
                                    }

                                elseif ($laporan['status'] == 2) : {
                                        echo '<span class="badge badge-pill badge-secondary">Hadir Telambat</span>';
                                    }

                                elseif ($laporan['status'] == 3) : {
                                        echo '<span class="badge badge-pill badge-primary">Sakit</span>';
                                    }

                                elseif ($laporan['status'] == 4) : {
                                        echo '<span class="badge badge-pill badge-primary">Izin</span>';
                                    }

                                elseif ($laporan['status'] == 5) : {
                                        echo '<span class="badge badge-pill badge-warning">OFF</span>';
                                    }

                                elseif ($laporan['status'] == 0) : {
                                        if ($laporan['time_in'] < '11:00:00' && $laporan['date'] == date('Y-m-d')) {
                                            echo '<span class="badge badge-pill badge-info">Belum Hadir</span>';
                                        } else {
                                            echo '<span class="badge badge-pill badge-danger">Alpha</span>';
                                        }
                                    }
                                ?>
                                <?php endif; ?>
                            </td>

                            </tr>
                        <?php endforeach;  ?>
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