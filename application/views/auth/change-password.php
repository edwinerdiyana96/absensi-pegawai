<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class=" text-gray-900 mb-4">Change Your Password for</h1>
                                    <h5 class="h4 mb-4"><?= $this->session->userdata('reset_email'); ?></h5>

                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" method="POST" action="<?= base_url('auth/changepassword') ?>">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Enter New Password">
                                        <div class="small text-danger"><?= form_error('password1') ?></div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat New Password">
                                        <div class="small text-danger"><?= form_error('password2') ?></div>
                                    </div>


                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Change Password
                                    </button>

                                    <hr>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>