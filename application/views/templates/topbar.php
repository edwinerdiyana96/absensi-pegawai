        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    
                    <style type="text/css">
        				.arrow1 {
        					animation: slide1 1s ease-in-out infinite;
        					margin-left: -10px;
        					/*height: 10px;*/
        					font-size: 20px;
        				}

        				.arrow2 {
        					animation: slide2 1s ease-in-out infinite;
        				}

        				.arrow3 {
        					transform-origin: 0% 50%;
        					animation: slide3 1s ease-in-out infinite;
        				}

        				.arrow4 {
        					transform-origin: 0% 50%;
        					animation: slide4 4s linear infinite;
        				}

        				@keyframes slide1 {

        					0%,
        					100% {
        						transform: translate(0, 0);
        					}

        					50% {
        						transform: translate(10px, 0);
        					}
        				}

        				@keyframes slide2 {

        					0%,
        					100% {
        						transform: translate(0, 0) rotate(45deg);
        					}

        					50% {
        						transform: translate(10px, 10px) rotate(45deg);
        					}
        				}

        				@keyframes slide3 {

        					0%,
        					100% {
        						transform: rotate(-45deg);
        					}

        					50% {
        						transform: rotate(45deg);
        					}
        				}

        				@keyframes slide4 {
        					0% {
        						transform: rotate(0);
        					}

        					100% {
        						transform: rotate(360deg);
        					}
        				}
        			</style>
                    
                    <i class="fa fa-long-arrow-left arrow1" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MENU
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                           
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">< ?= $user['id']; ?></span> -->
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                            </a>






                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('user') ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="<?= base_url('user/updateProfile') ?>">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Update Profile
                                </a>




                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>





                <!-- End of Topbar -->