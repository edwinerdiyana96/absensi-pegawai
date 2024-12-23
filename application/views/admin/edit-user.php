<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-5">

            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <h1 class="h3 mb-4 text-gray-800">Ganti Password</h1>
                    </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?= $this->session->flashdata('message_password'); ?>
                                </div>
                            </div>

                        <form action="<?= base_url('admin/editUserProfile/'.$user_edit['id']."/password")?>" method="POST">
                                <!-- <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="current_password" name="current_password" class="form-control" id="current_password">
                                    <div class="small text-danger">< ?= form_error('current_password'); ?></div>
                                </div> -->

                                <div class="form-group">
                                    <label for="new_password1">New Password</label>
                                    <input type="password" name="pass1" class="form-control" id="pass1" placeholder="New Password">
                                    <div class="small text-danger"><?= form_error('new_password1'); ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="formGroupExampleInput">Repeat Password</label>
                                    <input type="password" name="pass2" class="form-control" id="pass2" placeholder="Repeat Password">
                                    <div class="small text-danger"><?= form_error('new_password2'); ?></div>

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                            </form>
                        </div>

<script type="text/javascript">
    window.onload = function () {
        document.getElementById("pass1").onchange = validatePassword;
        document.getElementById("pass2").onchange = validatePassword;
    }
    function validatePassword(){
        var pass2=document.getElementById("pass2").value;
        var pass1=document.getElementById("pass1").value;
        if(pass1!=pass2)
            document.getElementById("pass2").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
        else
            document.getElementById("pass2").setCustomValidity('');
    }
</script>

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
                                <?= $this->session->flashdata('message'); ?>
                            </div>
                        </div>
                        <form action="<?= base_url('admin/editUserProfile/'.$user_edit['id']."/profile")?>" method="POST">
                        <!-- < ?= form_open_multipart('user/edit'); ?> -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Email</label>
                                        <input type="email" name="email" value="<?= $user_edit['email'] ?>" class="form-control" id="email">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nama</label>
                                        <input type="text" value="<?= $user_edit['name']; ?>" name="name" class="form-control" id="name">
                                        <div class="small text-danger"><?= form_error('name') ?></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Jenis Kelamin</label>
                                        <select class="form-control" name="gender">
                                            <?php
                                            if ($user_edit['gender'] == "L") { ?>
                                                <option value="L" selected>Laki-Laki</option>
                                                <option value="P">Perempuan</option>
                                            <?php } else { ?>
                                                <option value="L">Laki-Laki</option>
                                                <option value="P" selected>Perempuan</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Jabatan</label>
                                        <select class="form-control" name="role">
                                            <?php
                                            foreach ($role as $key => $role) { 
                                            if ($user_edit['role_id'] == $role['id']) { ?>
                                                <option value="<?= $role['id']?>" selected><?= $role['role']?></option>
                                            <?php } else { ?>
                                                <option value="<?= $role['id']?>"><?= $role['role']?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telpon</label>
                                    <input type="number" value="<?= $user_edit['phone']; ?>" name="phone" class="form-control" id="name">
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="textarea" value="<?= $user_edit['address']; ?>" name="address" class="form-control">
                                </div>

                                        <button type="submit" class="btn btn-primary form-control">Update Profile</button>
                                </div>
                            </div>
                        </form>
                            <!-- <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="col">Picture</div>
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
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>




<!-- End of Main Content
