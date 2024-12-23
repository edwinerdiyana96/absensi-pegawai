<!--===============================================================================================-->
<?php
$settings = $this->db->get('settings')->row_array(); ?>
<link rel="icon" type="image/png" href="<?= base_url($settings['logo']); ?>">
<!--===============================================================================================-->
<!--<link rel="stylesheet" type="text/css" href="< ?= base_url('assets/'); ?>vendor/bootstrap/css/bootstrap.min.css">-->
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
<!--<link rel="stylesheet" type="text/css" href="< ?= base_url('assets/'); ?>vendor/animate/animate.css">-->
<!--===============================================================================================-->
<!--<link rel="stylesheet" type="text/css" href="< ?= base_url('assets/'); ?>vendor/css-hamburgers/hamburgers.min.css">-->
<!--===============================================================================================-->
<!--<link rel="stylesheet" type="text/css" href="< ?= base_url('assets/'); ?>vendor/animsition/css/animsition.min.css">-->
<!--===============================================================================================-->
<!--<link async rel="stylesheet" type="text/css" href="< ?= base_url('assets/'); ?>vendor/select2/select2.min.css">-->
<!--===============================================================================================-->
<!--<link rel="stylesheet" type="text/css" href="< ?= base_url('assets/'); ?>vendor/daterangepicker/daterangepicker.css">-->
<!--===============================================================================================-->
<link async rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>css/util.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>css/main.css">
<link rel="stylesheet" type="text/css" href="< ?= base_url('assets/'); ?>css/sweetalert2.min.css">

<!--< ?php-->
<!--$cookie = array(-->
<!--	'name'   => 'remember_me_token',-->
<!--	'value'  => 'Random string',-->
<!--    'expire' => '1209600',  // Two weeks-->
<!--	'domain' => 'absensi.edwinerdiyana.com',-->
<!--	'path'   => '/'-->
<!--);-->

<!--set_cookie($cookie);-->

<!--?>-->

<div class="limiter">
	<div class="container-login100">


		<div class="wrap-login100">

			<form id="contactForm" class="login100-form validate-form" method="POST" action="<?= base_url('auth') ?>">
				<span class="login100-form-title p-b-43">
					SISTEM ABSENSI ONLINE <br> <?= $settings['name'] ?>
					<img src="<?= base_url($settings['logo']); ?>" alt="" width="128px" height="128px"
					style="border-radius: 50%; margin-top: 10px;">
				</span>
				<div class="small text-danger">
					<?= $this->session->flashdata('message'); ?>
				</div>


<!--<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">-->
<div class="validate-input" data-validate="Valid email is Required: ex@abc.xyz">
    <div class="input-group">
        <input class="form-control" type="text" id="email" name="email" value="<?= set_value('email') ?>" aria-describedby="emailHelp" placeholder="Masukan Email Anda . . .">
        <div class="input-group-append">
            <button type="button" id="showEmailButton" class="btn btn-outline-secondary">
                <i class="fa fa-envelope"></i>
            </button>
        </div>
    </div>
    <span class="focus-input100"></span>
</div>
				
				<div class="small text-danger">
					<div class="small text-danger"><?= form_error('email') ?></div>
				</div>

<br>

<!--<div class="wrap-input100 validate-input" data-validate="Password is required">-->
<div class="validate-input" data-validate="Password is Required">
    <div class="input-group">
        <input class="form-control" type="password" id="password" name="password" placeholder="Masukan Password Anda . . .">
        <div class="input-group-append">
            <button type="button" id="showPasswordButton" class="btn btn-outline-secondary">
                <i class="fa fa-eye"></i>
            </button>
        </div>
    </div>
</div>


<script>
    const passwordInput = document.getElementById('password');
    const showPasswordButton = document.getElementById('showPasswordButton');

    showPasswordButton.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text'; // Change the input type to "text" to show the password
        } else {
            passwordInput.type = 'password'; // Change it back to "password" to hide the password
        }
    });
</script>

				<div class="small text-danger">
					<div class="small text-danger"><?= form_error('password') ?></div>
				</div>
				
				<br>
				
				<div class="flex-sb-m w-full p-t-3 p-b-32">
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember_me_token">
						<label class="label-checkbox100" for="ckb1">
							Ingatkan Saya?
						</label>
					</div>
					
					<div>
						<a href="<?= base_url('auth/forgotpassword') ?>" class="txt1">
							Lupa Password?
						</a>
					</div>
				</div>

				<input hidden type='text' name="uuid" id='uuid' value=''>

				<div class="container-login100-form-btn">
					<button type="submit" id="kirim_uuid" class="login100-form-btn">
						Login
					</button>
				</div>
			</form>

			<div class="login100-more" style="background-image: url('<?= base_url($settings['sampul']); ?>');">
			</div>
		</div>
	</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">

	$(document).ready(function() {
			var navigator_info = window.navigator;
			var screen_info = window.screen;
			var uid = navigator_info.mimeTypes.length;
			uid += navigator_info.userAgent.replace(/\D+/g, '');
			uid += navigator_info.plugins.length;
			uid += screen_info.height || '';
			uid += screen_info.width || '';
			uid += screen_info.pixelDepth || '';
			// var uuid = console.log(uid);
			// var uuid = uid;
		$('#kirim_uuid').click(function() {
			var txtuuid = document.getElementById("uuid").innerHTML = uid;
			$('#uuid').val(txtuuid);
			document.getElementById("kirim_uuid").submit();
		});
	});
</script>


<!--===============================================================================================-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/'); ?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/popper.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/'); ?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/'); ?>vendor/daterangepicker/moment.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/daterangepicker/daterangepicker.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/'); ?>vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/'); ?>js/main.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>