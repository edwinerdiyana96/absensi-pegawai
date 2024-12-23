<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-5">

            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <h1 class="h3 mb-4 text-gray-800">Ubah Password</h1>
                    </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?= $this->session->flashdata('message'); ?>
                                </div>
                            </div>

                            <form method="post" action="<?= base_url('user/updateProfile'); ?>">
                                <!-- <div class="form-group">
                                    <label for="current_password">Password Saat ini</label>
                                    <input type="current_password" name="current_password" class="form-control" id="current_password">
                                    <div class="small text-danger">< ?= form_error('current_password'); ?></div>
                                </div> -->

                                <div class="form-group">
                                    <label for="new_password1">Password Baru</label>
                                    <input type="password" name="new_password1" class="form-control" id="new_password1" placeholder="New Password">
                                    <div class="small text-danger"><?= form_error('new_password1'); ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="formGroupExampleInput">Ulangi Password Baru</label>
                                    <input type="password" name="new_password2" class="form-control" id="new_password2" placeholder="Repeat Password">
                                    <div class="small text-danger"><?= form_error('new_password2'); ?></div>

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
    </div>
    <div class="col-md-7">

        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <h1 class="h3 mb-4 text-gray-800">Update Profile</h1>
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <?= $this->session->flashdata('message_profile'); ?>
                            </div>
                        </div>

                        <?= form_open_multipart('user/edit'); ?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Email</label>
                                        <input type="text" name="email" readonly value="<?= $user['email'] ?>" class="form-control" id="email">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nama</label>
                                        <input type="text" readonly value="<?= $user['name']; ?>" name="name" class="form-control" id="name">
                                        <div class="small text-danger"><?= form_error('name') ?></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telpon</label>
                                    <input type="tel" value="<?= $user['phone']; ?>" name="phone" class="form-control" id="name">
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="textarea" value="<?= $user['address']; ?>" name="address" class="form-control">
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">Perbarui Profile</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="col">Gambar <span class="text-danger">Maksimal 2Mb</span></div>
                                    <div class="col-md-12">
                                        <div class="row">

                                            <div class="col-md-12 mb-4">
                                                <div class="">
                                                    <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-thumbnail">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image" id="image">
                                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>




<!-- End of Main Content -->
