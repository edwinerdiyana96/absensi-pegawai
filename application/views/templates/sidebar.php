<!-- SESSION EXPIRED -->
<?php
$settings = $this->db->get('settings')->row_array();?>
<?php
if ($this->session->userdata['email'] == TRUE) {
    //do something
} else {
    redirect(site_url(), 'refresh');
}
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <div class="sidebar-brand d-flex align-items-center justify-content-center mt-4" href="#">
        <div class="row mt-4 ">
            <div class="col-md-12">
                <div>
                    <img class=" rounded-circle" width='75px' height="75px" src="<?= base_url($settings['logo']) ?>" alt="logo-karnas">
                </div>
            </div>
            <div class="col-md-12">
                <div>
                    <p>ABSENSI ONLINE</p>
                </div>
            </div>

        </div>


        <!-- <div class="sidebar-brand-text mx-3 ">Absensi Online</div> -->
    </div>
    <hr class="sidebar-divider mt-2">
    <li class="nav-item active">

        <!-- <?= $user['role_id'] ?> -->
        <?php if ($user['role_id'] == 16) : ?>
        <a class="nav-link" download="Panduan Operator.pdf" href="<?= base_url('assets/tutorial/Panduan Operator.pdf') ?>">
        <?php elseif ($user['role_id'] == 19 or $user['role_id'] == 20) : ?>
        <a class="nav-link" download="Panduan Kepsek & Wakasek.pdf" href="<?= base_url('assets/tutorial/Panduan Kepsek & Wakasek.pdf') ?>">
        <?php elseif ($user['role_id'] == 17 or $user['role_id'] == 22) : ?>
        <a class="nav-link" download="Panduan Pegawai.pdf" href="<?= base_url('assets/tutorial/Panduan Pegawai.pdf') ?>">
        <?php else : ?>
        <a class="nav-link" download="Panduan Admin.pdf" href="<?= base_url('assets/tutorial/Panduan Admin.pdf') ?>">
        <?php endif; ?>
        <i class="fa fa-download" aria-hidden="true"></i>
        <span>Download Tutorial</span></a>
    </li>

    <hr class="sidebar-divider mt-2">





    <!-- Nav Item - Dashboard -->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`,`menu`
                            FROM  `user_menu` JOIN  `user_access_menu` 
                            ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                            WHERE `user_access_menu`.`role_id` = $role_id
                            ORDER BY `user_access_menu`.`menu_id` ASC
                            ";
    $menu = $this->db->query($queryMenu)->result_array();
    // looping menu 

    ?>


    <?php foreach ($menu as $m) : ?>

        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#<?= str_replace(' ', '', $m['menu']); ?>" aria-expanded="false" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-folder"></i>
                <span><?= $m['menu']; ?></span>
            </a>

            <!-- submenu -->
            <?php
            $menuId = $m['id'];
            $querySubMenu = "SELECT *
                FROM user_sub_menu JOIN user_menu 
                ON user_sub_menu.menu_id = user_menu.id
                WHERE user_sub_menu.menu_id = $menuId
                AND user_sub_menu.is_active = 1
            ";
            $subMenu = $this->db->query($querySubMenu)->result_array();
            ?>



            <div id="<?= str_replace(' ', '', $m['menu']); ?>" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"><?= $m['menu']; ?></h6>
                    <?php foreach ($subMenu as $sm) : ?>
                        <?php if ($title == $sm['title']) : ?>
                            <a class="collapse-item active" href="<?= base_url() ?><?= $sm['url'] ?>"> <?= $sm['icon']; ?> <span> <?= $sm['title'] ?></span></a>
                        <?php elseif ($sm['title'] == "Scan QR") : ?>
                            <a id="kirim" class="collapse-item "> <?= $sm['icon']; ?> <span> <?= $sm['title'] ?></span></a>
                        <?php else : ?>
                            <a class="collapse-item " href="<?= base_url() ?><?= $sm['url'] ?>"> <?= $sm['icon']; ?> <span> <?= $sm['title'] ?></span></a>
                        <?PHP endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <form id='form_maps' action="<?= base_url('pegawai/scan/') ?>" method="post">

                <input hidden type='text' name="lat" id='lat' value=''>

                <input hidden type='text' name="long" id='long' value=''>

                <button hidden type="submit" class="btn btn-primary">KIRIM DATA MAPS</button>
            </form>
            <!-- <button id="kirim">KIRIM</button> -->

            <script type="text/javascript">
                navigator.geolocation.getCurrentPosition(getLatLon);

                function getLatLon(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    console.log("Latitude is " + latitude);
                    console.log("Longitude is " + longitude);
                    $(document).ready(function() {
                        $('#kirim').click(function() {
                            var txtLat = document.getElementById("lat").innerHTML = latitude;
                            var txtLong = document.getElementById("long").innerHTML = longitude;
                            $('#lat').val(txtLat);
                            $('#long').val(txtLong);
                            document.getElementById("form_maps").submit();
                            // $.ajax({
                            // url: 'http://localhost/karnas_absen/pegawai/scan',
                            // type: 'POST',
                            // data: {
                            //     latitude: latitude,
                            //     longitude: longitude
                            // },
                            // success: function(data) {
                            //     $('#result').html(data);
                            // },
                            // error: function(XMLHttpRequest, textStatus, errorThrown) {
                            //     //case error
                            // }

                            // });
                        });
                    });
                }
            </script>

        </li>
        <hr class="sidebar-divider mt-3">
    <?php endforeach; ?>

    <!-- Nav Item - Dashboard -->


    <!-- <a href="<?= base_url('assets/tutorial/"') ?>" class="btn btn-primary" download=" kepsek_wakepsek.pdf">Download</a> -->


    <!-- //operator
//pegawai
//pimpinan
//admin -->



    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->