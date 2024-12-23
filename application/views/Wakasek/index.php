<!-- Back-End - Get Data -->
<!-- < ?php
    // $jumlah_pegawai = $this->Admin_model->getPegawai()->num_rows();
? > -->

<!-- <nav class="navbar fixed-bottom navbar-expand d-lg-none d-sm-block" style="background-color: #004F7A">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item">
            <a id="kirim" style="color: white; "><i class="fa fa-qrcode" aria-hidden="true"></i> SCAN QR CODE</a>
        </li>
    </ul>
</nav> -->

<!-- Begin Page Content -->
<div class="container-fluid dashboard-atas">
    <!-- Page Heading -->
    <h1 class="h3 mb-4  text-gray-800"><?= $title ?></h1>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Pegawai</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"> <?= $jumlah_pegawai; ?></div>
                        </div>
                        <div class="col-auto">
                            <span style="color: Mediumslateblue;">
                                <i class="fas fa-user-graduate fa-3x"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total guru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $total_guru; ?></div>
                        </div>
                        <div class="col-auto">
                            <span style="color: Mediumslateblue;">
                                <i class="fas fa-user-ninja fa-3x"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Staf & Lainnya</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $total_lainnya; ?></div>
                        </div>
                        <div class="col-auto">
                            <span style="color: Mediumslateblue;">
                                <i class="fas fa-user-ninja fa-3x"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                                persentase Kehadiran</div>
                            <div class="h5 font-weight-bold text-gray-800"><?= number_format($hadir_hari_ini / $jumlah_pegawai * 100) ?>%</div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?= '50' ?>;"></div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <span style="color: Mediumslateblue;">
                                <i class="fas fa-chart-pie fa-3x "></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="today-tab" data-toggle="tab" href="#today" role="tab" aria-controls="today" aria-selected="true">Perhari</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="month-tab" data-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="false">Perbulan</a>
        </li>
        <li class="nav-item" role="presentation">
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
            <div class="row">
                <!-- Area Chart -->
                <div class="col-xl-12 cold-md-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Grafik Presentasi Perhari</h6>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="chart-area">
                                        <canvas id="grafik_perhari"></canvas>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border-left m-4 p-4">
                                        <h1 class='align-middle text-primary'><?= $hadir_hari_ini ?></h1>
                                        <p class='dark'>Hadir</p>
                                        <hr>
                                        <h1 class='align-middle text-danger'><?= $jumlah_pegawai - $hadir_hari_ini ?></h1>
                                        <p>Tidak Hadir</p>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>


        <!-- tab perbulan -->
        <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab">
            <div class="row">
                <!-- Area Chart -->
                <div class="col-xl-12 cold-md-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Grafik Persentase Kehadiran Tahun <?= date('Y') ?></h6>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="chart-area">
                                        <canvas id="PersentasePerbulan"></canvas>
                                    </div>
                                </div>
                                <!-- 
                                <div class="col-md-4">
                                    <div class="border-left m-4 p-4">
                                        <h1 class='align-middle text-primary'>75</h1>
                                        <p class='dark'>Total Kehadiran</p>
                                        <hr>
                                        <h1 class='align-middle text-warning'>10</h1>
                                        <p>Total Keterlambatan</p>
                                        <hr>
                                        <h1 class='align-middle text-danger'>20</h1>
                                        <p>Total Ketidakahdiran</p>

                                    </div>

                                </div> -->
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
