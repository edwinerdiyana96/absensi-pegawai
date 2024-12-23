<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-12 col-lg-12 col-md-12">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 center">
              <div class="p-5">
                <div class="text-center">
                  <img src="<?= base_url('assets/img/') ?>logo_panjang.png" class="m-8 p-2">
                  <h1 class="h4 text-gray-900 mt-4 p-4">Pendaftaran Karantina Tahfizh Online</h1>
                  <p>Silakan mengisi formulir dibawah ini dengan benar</p>
                </div>
                <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">

                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" value="<?= set_value('email') ?>" id="email" placeholder="Masukan email kamu">
                    <?php echo form_error('email', '<small class="text-danger"  p-3 role="alert">', '</small>'); ?>
                  </div>

                  <div class="form-group">
                    <input type="text" name="name" value="<?= set_value('nama') ?>" class="form-control form-control-user" id="nama" placeholder="Masukan Nama Lengkap">
                    <?php echo form_error('name', '<small class="text-danger"  p-3 role="alert">', '</small>'); ?>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 ">
                      <input type="password" name="password1" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                      <?php echo form_error('password1', '<small class="text-danger"  p-3 role="alert">', '</small>'); ?>
                    </div>
                    <div class="col-sm-6">
                      <input type="password" name="password2" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="telp" name="no_hp" class="form-control form-control-user" id="no_hp" placeholder="Masukan No Hp (whatsapp)">
                    <?php echo form_error('no_hp', '<small class="text-danger"  p-3 role="alert">', '</small>'); ?>
                  </div>

                  <div class="form-group">
                    <select name="jenis_kelamin" class="custom-select custom-select-lg mb-3">
                      <option value=0 selected>Jenis Kelamin</option>
                      <option value=1>laki-Laki</option>
                      <option value=2>Perempuan</option>
                    </select>
                  </div>


                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 ">
                      <input type="text" name="tempat_lahir" class="form-control form-control-user" id="tempat_lahir" placeholder="Masukan Tempat Lahir Kamu">
                      <?php echo form_error('tempat_lahir', '<small class="text-danger"  p-3 role="alert">', '</small>'); ?>
                    </div>

                    <div class="col-sm-6 mb-3 ">
                      <input type="date" name="tanggal_lahir" class="form-control form-control-user" id="tanggal_lahir" placeholder="masukan tanggal lahir kamu">
                      <?php echo form_error('tanggal_lahir', '<small class="text-danger"  p-3 role="alert">', '</small>'); ?>
                    </div>
                  </div>

                  <div class="form-group purple-border">
                    <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukan alamat Lengkap"></textarea>
                    <?php echo form_error('alamat', '<small class="text-danger"  p-3 role="alert">', '</small>'); ?>
                  </div>

                  <div class="form-group">
                    <select name="angkatan" class="custom-select custom-select-lg mb-3">
                      <option value="Pilih angkatan" selected>Pilih Angkatan</option>
                      <option value="13">Angkatan Ke-13</option>
                      <option value="14">Angkatan Ke-14</option>
                      <option value="15">Angkatan Ke-15</option>
                    </select>
                    <?php echo form_error('angkatan', '<small class="text-danger"  p-3 role="alert">', '</small>'); ?>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="text-center">
                        <a class="small" href="<?= base_url('auth') ?>">Saya sudah punya akun, Login aja</a>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-primary btn-user btn-block">
                        Mendaftar
                      </button>
                    </div>
                  </div>
                  <hr>
                </form>

              </div>
            </div>


            <div class="col-lg-6 center bg-login">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Tata Cara Pendaftaran Karantina Tahfizh Online</h1>
                </div>


                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="<?= base_url('assets/'); ?>img/slide1.jpg" alt="Slide Pertama">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="<?= base_url('assets/'); ?>img/slide2.jpg" alt="Slide Kedua">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="<?= base_url('assets/'); ?>img/slide3.jpg" alt="Slide Ke-3">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>


              </div>
            </div>


          </div>
        </div>
      </div>

    </div>

  </div>

</div>