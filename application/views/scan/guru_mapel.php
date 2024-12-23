<?php
$total_siswa = $this->db->query("SELECT * FROM user where class_name = '" . $pembelajaran['class'] . "' and role_id = '6'")->num_rows();
$data_lessons = $this->db->query("SELECT *  FROM student_lessons WHERE mapel_id = '" . $pembelajaran['lesson_id'] . "'")->row_array();
$data_kelas = $this->db->query("SELECT *  FROM student_class WHERE class = '" . $pembelajaran['class'] . "'")->row_array();
$data_room = $this->db->query("SELECT *  FROM student_room WHERE room_id = '" . $pembelajaran['room_id'] . "'")->row_array();
// $mapel = $this->db->query("SELECT * FROM `teacher_lessons` JOIN `student_lessons` ON `teacher_lessons`.`lessons_id` = `student_lessons`.`mapel_id` WHERE `user_id` = '".$user['id']."'")->result_array();
$mapel = $this->db->get('student_lessons')->result_array();

$hadir = $this->db->query("SELECT * FROM student_room_absent WHERE room_history_id = '" . $pembelajaran['id'] . "' AND status = '1'")->num_rows();
$telat = $this->db->query("SELECT * FROM student_room_absent WHERE room_history_id = '" . $pembelajaran['id'] . "' AND status = '2'")->num_rows();
$sakit = $this->db->query("SELECT * FROM student_room_absent WHERE room_history_id = '" . $pembelajaran['id'] . "' AND status = '3'")->num_rows();
$izin = $this->db->query("SELECT * FROM student_room_absent WHERE room_history_id = '" . $pembelajaran['id'] . "' AND status = '4'")->num_rows();
$alpha = $this->db->query("SELECT * FROM student_room_absent WHERE room_history_id = '" . $pembelajaran['id'] . "' AND status = '0' AND description != 'PKL/OJT'")->num_rows();
$pkl = $this->db->query("SELECT * FROM student_room_absent WHERE room_history_id = '" . $pembelajaran['id'] . "' AND status = '0' AND description = 'PKL/OJT'")->num_rows();

?>

<!-- Select2 Files -->
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<!-- Begin Page Content -->
<div class="container-fluid dashboard-atas">
    <!-- Page Heading -->
    <h1 class="h3 mb-4  text-gray-800"><?= $title ?></h1>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->

        <div class="col-xl-3 col-md-3 mb-2">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Siswa</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"> <?= $total_siswa ?></div>
                            <br>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <br>
                            </div>
                        </div>
                        <div class="col-auto">
                            <span style="color: Mediumslateblue;">
                                <i class="fa fa-users fa-3x" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-3 mb-2">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                Kelas</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"> <?= $pembelajaran['class'] ?></div>
                            <br>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <br>
                            </div>
                        </div>
                        <div class="col-auto">
                            <span style="color: Mediumslateblue;">
                                <i class="fa fa-university fa-3x" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-3 col-md-3 mb-2">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                Ruangan</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"> <?= $data_room['description'] ?></div>
                            <br>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <br>
                            </div>
                        </div>
                        <div class="col-auto">
                            <span style="color: Mediumslateblue;">
                                <i class="fa fa-home fa-3x" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-3 mb-2">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                Mata Pelajaran </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">
                                <?php
                                if ($pembelajaran['lesson_id'] != 0) {
                                    echo $data_lessons['lessons'];
                                } else {
                                    echo "-";
                                }
                                ?>
                            </div>
                            <br>
                            <div class="text-xs font-weight-bold text-uppercase p-1" style="color: white;">
                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addNewUser">
                                    Pilih Mata Pelajaran <i class="fa fa-long-arrow-left arrow2" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <span style="color: Mediumslateblue;">
                                <i class="fas fa-book fa-3x"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if ($pembelajaran['is_done'] == '0') { ?>
        <div class="col-md-12 col-xl-12  col-sm-12"><br>
            <a data-toggle="modal" data-target="#endpembelajaran">
                <button class="form-control btn btn-danger">AKHIRI PEMBELAJARAN</button>
            </a>

            <br>
        </div>
    <?php } ?>
    <br>


    <!-- Modal Akhiri Pembelajaran -->
    <div class="modal fade" id="endpembelajaran" tabindex="-1" aria-labelledby="addRoleModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModelLabel">Akhiri Proses Pembelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <a href="<?= base_url('guru/end_pembelajaran/' . $pembelajaran['id']) ?>" onclick="confirm('Apakah Anda Yakin Keluar Ruangan?')">
                            <button type="submit" class="btn btn-danger form-control">Akhiri Dan Keluar Dari Ruangan</button>
                        </a>
                    </div>


                    <div class="form-group">
                        <a href="<?= base_url('guru/start_pembelajaran/' . $pembelajaran['id'] . '/' . $data_room['room_id']) ?>" onclick="confirm('Apakah Anda Yakin Membuka Pembelajarna Baru di Ruangan yang Sama?')">
                            <button type="submit" class="btn btn-primary form-control">Buka Pembelajaran Baru di Ruangan</button>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Begin Page Content -->
    <!-- Page Heading -->
    <div class="row gutters-sm">

        <div class="col-md-12 col-xl-12  col-sm-12">
            <div class="card shadow mb-4  ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary  ">Statistik Kehadiran Siswa</h6>
                </div>

                <div class="col-md-12 col-sm-12 col-xl-12">
                    <div class="alert alert-success" role="alert">
                        <div class="row ">
                            <div class="col-md-6 co-sm-12 col-xl-6 text-sm-left text-sm-center">
                                Tanggal :
                            </div>
                            <div class="col-md-6 co-sm-12 col-xl-6 text-right text-sm-center ">
                                <?php
                                date_default_timezone_set("Asia/Jakarta");
                                $date = new DateTime("now");
                                echo tgl_indo(date('Y-m-d', strtotime($pembelajaran['date']))); ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row p-4">
                    <div class="col-xl-6 col-sm-12 col-md-12 mb-2">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <a href="<?= base_url('guru/mapel_detail/1/' . $pembelajaran['id']) ?>">
                                            <h5 class="font-weight-bold text-primary text-uppercase mb-1">Hadir Tepat Waktu</h5>
                                        </a>
                                        <div class=" h5 mb-0 font-weight-bold text-gray-800"><?= $hadir; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div><br>
                                <a href="<?= base_url('guru/kirim_laporan/1/' . $data_kelas['class_id'] . '/' . $pembelajaran['id']) ?>">Kirim Laporan Ke Group</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-12 col-md-12 col-md-12 mb-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <a href="<?= base_url('guru/mapel_detail/2/' . $pembelajaran['id']) ?>">
                                            <h5 class="font-weight-bold text-primary text-uppercase mb-1">Hadir Terlambat</h5>
                                        </a>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $telat; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div><br>
                                <a href="<?= base_url('guru/kirim_laporan/2/' . $data_kelas['class_id'] . '/' . $pembelajaran['id']) ?>">Kirim Laporan Ke Group</a>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-6 col-sm-12 col-md-12 col-md-12 mb-2">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <a href="<?= base_url('guru/mapel_detail/3/' . $pembelajaran['id']) ?>">
                                            <h5 class="font-weight-bold text-primary text-uppercase mb-1">Sakit</h5>
                                        </a>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sakit; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div><br>
                                <a href="<?= base_url('guru/kirim_laporan/3/' . $data_kelas['class_id'] . '/' . $pembelajaran['id']) ?>">Kirim Laporan Ke Group</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-12 col-md-6 col-md-12 mb-2">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-primary">
                                    <div class="col mr-2">
                                        <a href="<?= base_url('guru/mapel_detail/4/' . $pembelajaran['id']) ?>">
                                            <h5 class="font-weight-bold text-primary text-uppercase mb-1">IZIN</h5>
                                        </a>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $izin; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div><br>
                                <a href="<?= base_url('guru/kirim_laporan/4/' . $data_kelas['class_id'] . '/' . $pembelajaran['id']) ?>">Kirim Laporan Ke Group</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-12 col-md-6 col-md-12 mb-2">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <a href="<?= base_url('guru/mapel_detail/0/' . $pembelajaran['id']) ?>">
                                            <h5 class="font-weight-bold text-primary text-uppercase mb-1">Alpha/Belum Scan</h5>
                                        </a>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $alpha; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div><br>
                                <a href="<?= base_url('guru/kirim_laporan/0/' . $data_kelas['class_id'] . '/' . $pembelajaran['id']) ?>">Kirim Laporan Ke Group</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-12 col-md-6 col-md-12 mb-2">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <a href="<?= base_url('guru/mapel_detail/PKL/' . $pembelajaran['id']) ?>">
                                            <h5 class="font-weight-bold text-primary text-uppercase mb-1">PKL / OJT</h5>
                                        </a>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pkl; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div><br>
                                <a href="<?= base_url('guru/kirim_laporan/PKL/' . $data_kelas['class_id'] . '/' . $pembelajaran['id']) ?>">Kirim Laporan Ke Group</a>
                            </div>
                        </div>
                    </div>


                </div>



            </div>
        </div>
    </div>


    <!-- Begin Page Content -->
    <style>
        body {
            margin: 10px;
        }

        #button {
            display: inline-block;
            background: #ddd;
            border: 1px solid #ccc;
            padding: 5px 10px;
            color: blue;
            cursor: pointer;
        }

        .check {
            display: inline-block;
            margin-right: 10px;
        }
    </style>

    <!-- Page Heading -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary ">History Absen Siswa</h6>
        </div>

        <div class="card-body">
            <?= $this->session->flashdata('message'); ?>

            <div class="responsive" style="overflow-x:auto;">
                <form action="<?= base_url('guru/update_pembelajaran2') ?>" method="POST">
                    <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                                <!-- <th scope="col">Keterangan</th> -->
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $cek = 0;
                            $array = $this->db->query("SELECT user.name, student_room_absent.* FROM student_room_absent 
                            inner JOIN user ON student_room_absent.student_id = user.id where room_history_id = '" . $pembelajaran['id'] . "'")->result_array();
                            foreach ($array as $key => $array) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $array['name'] ?></td>
                                    <td>
                                        <!-- <label class="slds-checkbox-button slds-checkbox-button_is-checked" for="example-unique-id-31">
                                        <input type="checkbox" class="btn slds-assistive-text" name = "aksi[]" value="< ?= $array['student_room_id']?>" style="width: 20px; height: 20px;" />
                                    </label> -->

                                        <!-- Desktop View -->
                                        <div class="d-none d-lg-block" style="text-align: justify; text-justify: inter-word;">
                                            <label class="radio-inline">
                                                <input class="form-check-input" type="radio" <?php if ($array['status'] == '0'  and $array['description'] == '-' or $array['status'] == '0'  and $array['description'] == 'Siswa ini belum absen pagi!') {
                                                                                                    echo 'checked';
                                                                                                } ?> value="0" style="width: 15px; height: 15px;">&ensp; Alfa/Belum Absen &ensp; | &ensp;
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="pilih<?= $cek ?>" <?php if ($array['status'] == '1') {
                                                                                                echo 'checked';
                                                                                            } ?> value="1" style="width: 15px; height: 15px;">&ensp; Hadir Tepat Waktu &ensp; | &ensp;
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="pilih<?= $cek ?>" <?php if ($array['status'] == '2') {
                                                                                                echo 'checked';
                                                                                            } ?> value="2" style="width: 15px; height: 15px;">&ensp; Hadir Telat &ensp; | &ensp;
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="pilih<?= $cek ?>" <?php if ($array['status'] == '3') {
                                                                                                echo 'checked';
                                                                                            } ?> value="3" style="width: 15px; height: 15px;">&ensp; Sakit &ensp; | &ensp;
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="pilih<?= $cek ?>" <?php if ($array['status'] == '4') {
                                                                                                echo 'checked';
                                                                                            } ?> value="4" style="width: 15px; height: 15px;">&ensp; Izin &ensp; | &ensp;
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="pilih<?= $cek ?>" <?php if ($array['status'] == '0' and $array['description'] == 'Bolos') {
                                                                                                echo 'checked';
                                                                                            } ?> value="Bolos" style="width: 15px; height: 15px;">&ensp; Bolos &ensp; | &ensp;
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="pilih<?= $cek ?>" <?php if ($array['status'] == '0' and $array['description'] == 'PKL/OJT') {
                                                                                                echo 'checked';
                                                                                            } ?> value="PKL/OJT" style="width: 15px; height: 15px;">&ensp; PKL/OJT &ensp; | &ensp;
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="pilih<?= $cek ?>" <?php if ($array['status'] == '0' and $array['description'] == 'Lainnya') {
                                                                                                echo 'checked';
                                                                                            } ?> value="Lainnya" style="width: 15px; height: 15px;">&ensp; Lainnya &ensp; | &ensp;
                                            </label>
                                            <!-- <label class="radio-inline">
                                                <input type="radio" name="pilih< ?= $cek ?>" < ?php if ($array['status'] == 'hapus') {
                                                                                                echo 'checked';
                                                                                            } ?> value="delete" style="width: 15px; height: 15px;">&ensp; Hapus
                                            </label> -->
                                        </div>

                                        <!-- Mobile View -->
                                        <div class="d-lg-none" style="text-align: justify; text-justify: inter-word;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" <?php if ($array['status'] == '0'  and $array['description'] == '-' or $array['status'] == '0'  and $array['description'] == 'Siswa ini belum absen pagi!') {
                                                                                                    echo 'checked';
                                                                                                } ?> value="0" name="m<?= $cek ?>" id="m<?= $cek ?>">
                                                <label class="form-check-label" for="m<?= $cek ?>">
                                                    Alfa/Belum Absen
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" <?php if ($array['status'] == '1') {
                                                                                                    echo 'checked';
                                                                                                } ?> value="1" name="m<?= $cek ?>" id="m<?= $cek ?>2">
                                                <label class="form-check-label" for="m<?= $cek ?>2">
                                                    Hadir
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" <?php if ($array['status'] == '2') {
                                                                                                    echo 'checked';
                                                                                                } ?> value="2" name="m<?= $cek ?>" id="m<?= $cek ?>3">
                                                <label class="form-check-label" for="m<?= $cek ?>3">
                                                    Telat
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" <?php if ($array['status'] == '3') {
                                                                                                    echo 'checked';
                                                                                                } ?> value="3" name="m<?= $cek ?>" id="m<?= $cek ?>4">
                                                <label class="form-check-label" for="m<?= $cek ?>4">
                                                    Sakit
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" <?php if ($array['status'] == '4') {
                                                                                                    echo 'checked';
                                                                                                } ?> value="4" name="m<?= $cek ?>" id="m<?= $cek ?>5">
                                                <label class="form-check-label" for="m<?= $cek ?>5">
                                                    Izin
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" <?php if ($array['status'] == '0' and $array['description'] == 'Bolos') {
                                                                                                    echo 'checked';
                                                                                                } ?> value="Bolos" name="m<?= $cek ?>" id="m<?= $cek ?>6">
                                                <label class="form-check-label" for="m<?= $cek ?>6">
                                                    Bolos
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" <?php if ($array['status'] == '0' and $array['description'] == 'PKL/OJT') {
                                                                                                    echo 'checked';
                                                                                                } ?> value="PKL/OJT" name="m<?= $cek ?>" id="m<?= $cek ?>7">
                                                <label class="form-check-label" for="m<?= $cek ?>7">
                                                    PKL/OJT
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" <?php if ($array['status'] == '0' and $array['description'] == 'Lainnya') {
                                                                                                    echo 'checked';
                                                                                                } ?> value="Lainnya" name="m<?= $cek ?>" id="m<?= $cek ?>8">
                                                <label class="form-check-label" for="m<?= $cek ?>8">
                                                    Lainnya
                                                </label>
                                            </div>
                                            <!-- <div class="form-check">
                                                <input class="form-check-input" type="radio" < ?php if ($array['status'] == 'hapus') {
                                                                                                    echo 'checked';
                                                                                                } ?> value="hapus" name="m< ?= $cek ?>" id="m< ?= $cek ?>9">
                                                <label class="form-check-label" for="m< ?= $cek ?>9">
                                                    Hapus
                                                </label>
                                            </div> -->
                                        </div>


                                    </td>

                                    <td><?php
                                        if ($array['status'] == '1') {
                                            echo '<span class="badge badge-pill badge-success">Hadir Tepat Waktu</span>';
                                        } elseif ($array['status'] == '2') {
                                            echo '<span class="badge badge-pill badge-warning">Hadir Terlambat</span>';
                                        } elseif ($array['status'] == '3') {
                                            echo '<span class="badge badge-pill badge-info">Sakit</span>';
                                        } elseif ($array['status'] == '4') {
                                            echo '<span class="badge badge-pill badge-primary">Izin</span>';
                                        } else {
                                            if ($array['description'] == 'Bolos') {
                                                echo '<span class="badge badge-pill badge-danger">Bolos </span>';
                                            } elseif ($array['description'] == 'PKL/OJT') {
                                                echo '<span class="badge badge-pill badge-secondary">Sedang PKL/OJT </span>';
                                            } elseif ($array['description'] == 'Lainnya') {
                                                echo '<span class="badge badge-pill badge-secondary">Lainnya </span>';
                                            } else {
                                                echo '<span class="badge badge-pill badge-danger">Alfa / Belum Absen </span>';
                                            }
                                        }
                                        ?></td>
                                </tr>
                            <?php $cek++;
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td>
                                    <input type="hidden" name="room_history_id" value="<?= $pembelajaran['id'] ?>">
                                    <div class="d-none d-lg-block" style="text-align: justify; text-justify: inter-word;">
                                        <button type="submit" class="btn btn-primary form-control" name="aksi" value="desktop">Simpan</button>
                                    </div>

                                    <div class="d-lg-none" style="text-align: justify; text-justify: inter-word;">
                                        <button type="submit" class="btn btn-primary form-control" name="aksi" value="mobile">Simpan</button>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>

        </div>

    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<!-- Modal Add Role -->
<div class="modal fade" id="addNewUser" tabindex="-1" aria-labelledby="addRoleModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleModelLabel">Tambah Guru Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('guru/update_mapel_pembelajaran/' . $pembelajaran['id']) ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="wali" class="col-sm-12 control-label">Mata Pelajaran</label>
                        <select class="form-control" name="lessons" id="opsi_mapel" style="width: 100%; height:500px;">
                            <Option value="" selected> --- Pilih Mata Pelajaran --- </Option>
                            <?php
                            foreach ($mapel as $key => $mapel) { ?>
                                <Option value="<?= $mapel['mapel_id'] ?>"><?= $mapel['lessons'] . " - Kelas " . $mapel['grade'] ?></Option>
                            <?php } ?>
                        </select>

                        <script>
                            $('#opsi_mapel').select2({
                                placeholder: " --- Pilih Mata Pelajaran --- ",
                                minimumInputLength: 3,
                            });
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary form-control">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "ScrollX": true
        });
    });
</script>