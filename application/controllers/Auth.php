<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Absensi_model');
        $this->load->model('Admin_model');
        $this->load->helper('cookie');
    }
    public function index()
    {
        // if ($this->session->userdata('email')) {
        //     redirect('user');
        // }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|trim');

        if ($this->form_validation->run() == false) {
            if (isset($_COOKIE['role_id'])) {
                $data = [
                    'email' => $_COOKIE['email'],
                    'id' => $_COOKIE['id'],
                    'role_id' => $_COOKIE['role_id']
                ];
                $this->session->set_userdata($data);

                $cek = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->num_rows();
                if ($cek!=0) {
                    if ($_COOKIE['role_id'] == 1) {
                        redirect('admin');
                    } else if ($_COOKIE['role_id'] == 16) {
                        redirect('operator');
                    } else if ($_COOKIE['role_id'] == 20) {
                        redirect('wakasek');
                    } else if ($_COOKIE['role_id'] == 19) {
                        redirect('kepsek');
                    } else {
                        redirect('user/dashboard');
                    }
                    // echo $cek;
                }else{
                    $this->session->unset_userdata('email');
                    $this->session->unset_userdata('role_id');
                    unset($_COOKIE['role_id']);
                    unset($_COOKIE['id']);
                    unset($_COOKIE['email']);
                    delete_cookie('role_id');
                    $data['title'] = "Login Page ";
                    //$this->load->view('auth/header', $data);
                    //$this->load->view('auth/login');
                    //$this->load->view('auth/footer');
                    $this->load->view('templates/header', $data);
                    $this->load->view('auth/login');
                    $this->load->view('templates/footer');
                }
            } else {
                $data['title'] = "Login Page ";
                //$this->load->view('auth/header', $data);
                //$this->load->view('auth/login');
                //$this->load->view('auth/footer');
                $this->load->view('templates/header', $data);
                $this->load->view('auth/login');
                $this->load->view('templates/footer');
            }
        } else {
            // Check if the "Remember Me" checkbox is checked
            if (isset($_POST['remember_me_token'])) {
            // Generate a secure token (you can use a library for this)
            $token = bin2hex(random_bytes(32)); // Generate a 64-character random token
    
            // Store the token in a cookie with an expiration time (e.g., 30 days)
            setcookie('remember_me', $token, time() + 30 * 24 * 60 * 60, '/');
            } else {
            // If "Remember Me" is not checked, remove any existing remember me cookies
            setcookie('remember_me', '', time() - 3600, '/');
            }

            // Now, you can check for the "remember_me" cookie when a user visits the site:
            if (isset($_COOKIE['remember_me'])) {
            // Validate the token and automatically log the user in if it's valid
            $storedToken = $_COOKIE['remember_me'];
    
            // Compare the stored token with the one stored in your database (not shown here)
            // If it matches, log the user in automatically
    
            // Example: $storedToken == $tokenFromDatabase
            // if (hash_equals($storedToken, $tokenFromDatabase)) {
            //     // User is authenticated
            //     // Log the user in
            // }
            }
            //validasi sukses
            $this->_login();
        }
    }

    public function _login()
    {
        $email =  $this->input->post('email');
        $password =  $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        $settings = $this->db->get('settings')->row_array();

        if ($user) {
            //jika user aktif

            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    //jika password benar

                    //$uuid = kode_uuid();

                    $uuid =  $this->input->post('uuid');
                    // echo "".$uuid."";

                    if ($settings['uuid_enabled'] == '1' && $user['role_id'] != '1') {
                        if ($user['uuid'] != $uuid) {
                            if ($user['uuid'] == '') {
                                $data = [
                                    'uuid'  => $uuid
                                ];
                                $this->db->where('email', $email);
                                $this->db->update('user', $data);
                                $data = [
                                    'email' => $user['email'],
                                    'id' => $user['id'],
                                    'role_id' => $user['role_id']
                                ];
                                $this->session->set_userdata($data);
        
                                setcookie('role_id', $user['role_id'], time() + (86400 * 30 * 360), "/");
                                setcookie('email', $user['email'], time() + (86400 * 30 * 360), "/");
                                setcookie('id', $user['id'], time() + (86400 * 30 * 360), "/");
        
                                if ($user['role_id'] == 1) {
                                    redirect('admin');
                                } else if ($user['role_id'] == 16) {
                                    redirect('operator');
                                } else if ($user['role_id'] == 20) {
                                    redirect('wakasek');
                                } else if ($user['role_id'] == 19) {
                                    redirect('kepsek');
                                } else {
                                    redirect('user/dashboard');
                                }
                            }else{
                                $this->session->set_flashdata('message', '
                                <center><div class="alert alert-danger" role="danger">Maaf Akun Anda Tidak Bisa Diloginkan di Perangkat Lain!</div></center>');
                                redirect($_SERVER['HTTP_REFERER']);
                            }
                            //$this->session->set_flashdata('message', '<script>
                            //Swal.fire({
                            //    icon: "error",
                            //    title: "Oops...",
                            //    text: "Something went wrong!",
                            //    footer: "<a href="">Why do I have this issue?</a>"
                            // timer: 3000
                            //});
                            //</script>');

                        } else {
                            $data = [
                                'email' => $user['email'],
                                'id' => $user['id'],
                                'role_id' => $user['role_id']
                            ];
                            $this->session->set_userdata($data);

                            setcookie('role_id', $user['role_id'], time() + (86400 * 30 * 360), "/");
                            setcookie('email', $user['email'], time() + (86400 * 30 * 360), "/");
                            setcookie('id', $user['id'], time() + (86400 * 30 * 360), "/");

                            if ($user['role_id'] == 1) {
                                redirect('admin');
                            } else if ($user['role_id'] == 16) {
                                redirect('operator');
                            } else if ($user['role_id'] == 20) {
                                redirect('wakasek');
                            } else if ($user['role_id'] == 19) {
                                redirect('kepsek');
                            } else {
                                redirect('user/dashboard');
                            }
                        }
                    }else{
                        $data = [
                            'email' => $user['email'],
                            'id' => $user['id'],
                            'role_id' => $user['role_id']
                        ];
                        $this->session->set_userdata($data);

                        setcookie('role_id', $user['role_id'], time() + (86400 * 30 * 360), "/");
                        setcookie('email', $user['email'], time() + (86400 * 30 * 360), "/");
                        setcookie('id', $user['id'], time() + (86400 * 30 * 360), "/");

                        if ($user['role_id'] == 1) {
                            redirect('admin');
                        } else if ($user['role_id'] == 16) {
                            redirect('operator');
                        } else if ($user['role_id'] == 20) {
                            redirect('wakasek');
                        } else if ($user['role_id'] == 19) {
                            redirect('kepsek');
                        } else {
                            redirect('user/dashboard');
                        }
                    }



                } else {
                    $this->session->set_flashdata('message', '
                        <center><div class="alert alert-danger" role="danger">Password Yang Anda Masukan Salah!</div></center>');

                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '
                    <center><div class="alert alert-danger" role="danger">Email Yang Anda Masukan Belum Di Aktivasi!</div></center>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '
                <center><div class="alert alert-danger" role="danger">Email Yang Anda Masukan Tidak Terdaftar Di Sistem!</div></center>');
            redirect('auth');
        }
    }



    public function registration()
    {
        // if ($this->session->userdata('email')) {
        //     redirect('user');
        // }

        $this->form_validation->set_rules('name', 'NAME', 'required|trim');
        $this->form_validation->set_rules('email', 'EMAIL', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'email already used']);
        $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[6]|matches[password2]', ['matches' => 'password too short']);
        $this->form_validation->set_rules('password2', 'password', 'required|min_length[6]|trim|matches[password1]', ['matches' => 'password too short']);
        $this->form_validation->set_rules('no_hp', 'No Handphone', 'required|trim|numeric');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Registration Page ";
            $this->load->view('auth/header', $data);
            $this->load->view('auth/registration');
            $this->load->view('auth/footer');
        } else {
            $email = $this->input->post('email', true);
            $no_hp = $this->input->post('no_hp', true);
            $tempat_lahir = $this->input->post('tempat_lahir', true);
            $tanggal_lahir = $this->input->post('tanggal_lahir', true);
            $jenis_kelamin = $this->input->post('jenis_kelamin', true);
            $alamat = $this->input->post('tanggal_lahir', true);
            $angkatan = $this->input->post('angkatan', true);
            $data = [

                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image'  => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'no_hp' => htmlspecialchars($no_hp),
                'tempat_lahir' => htmlspecialchars($tempat_lahir),
                'tanggal_lahir' => htmlspecialchars($tanggal_lahir),
                'jenis_kelamin' => htmlspecialchars($jenis_kelamin),
                'alamat' => htmlspecialchars($alamat),
                'angkatan' => htmlspecialchars($angkatan),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()

            ];


            //siapkan token 
            $token =  base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];
            $this->db->insert('user_token', $user_token);
            $this->db->insert('user', $data);
            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Account has been created, please activate your acount</div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $this->load->library('email');

        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'it.smkkarnas.40@gmail.com';
        $config['smtp_pass'] = 'xjcvfmobfiuucwrd';
        $config['smtp_port'] = 465;
        $config['mailtype'] = 'html';
        // $config['charset'] = 'utf-8';
        $config['charset'] = 'iso-8859-1';
        $this->email->initialize($config);

        $this->email->set_newline("\r\n");



        $this->email->from('it.smkkarnas.40@gmail.com', 'Admin IT Absensi Pegawai');
        $this->email->to($this->input->post('email'));
        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message("clik here to verify your account : <a href ='" . base_url() . "auth/verify?email=" . $this->input->post('email') . "&token=" . urlencode($token) . "' > Activate </a>");
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message("Klik Tautan Berikut Ini Untuk Melakukan Reset Password: <button><a href ='" . base_url() . "auth/resetpassword?email=" . $this->input->post('email') . "&token=" . urlencode($token) . "' > Reset Password</a></button>");
        }
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
        }
    }


    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated, please login</div>');
                    redirect('auth');
                } else {
                    $this->session->set_flashdata('message', '
                        <div class="alert alert-danger" role="alert">Token Expired</div>');
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong token</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger" role="alert">Wrong email</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data = [
            'uuid' => ''
        ];
        $this->db->where('email', $this->session->userdata('email'));
        $this->db->update('user',$data);
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        unset($_COOKIE['role_id']);
        unset($_COOKIE['id']);
        unset($_COOKIE['email']);
        delete_cookie('role_id');

        // $this->load->view('templates/header');

        $this->session->set_flashdata('message', '
            <center><div class="alert alert-success" role="alert">Kamu Sudah Keluar Dari Akun Kamu! </div></center>');
        redirect('auth');
    }

    public function blocked()
    {
        $data['title'] = 'Blocked by sistem';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('auth/blocked');
        $this->load->view('templates/footer');
    }


    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'EMAIL', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Forgot Password";
            // $this->load->view('auth/header', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('auth/footer');
        } else {
            $email = $this->input->post('email');
            $user =  $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user_token', $user_token);

                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '
                    <div class="alert alert-danger" role="alert">Check your email to reset your password</div>');
                redirect('auth/forgotpassword');
            } else {

                $this->session->set_flashdata('message', '
                    <div class="alert alert-danger" role="alert">Email not registered or not active</div>');
                redirect('auth/forgotpassword');
            }
        }
    }


    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '
                    <div class="alert alert-danger" role="alert">Reset Password Failed, Invalid token</div>');
                redirect('auth/forgotpassword');
            }
        } else {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger" role="alert">Reset Password Failed, Email is  not registered or not active</div>');
            redirect('auth/forgotpassword');
        }
    }



    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        } else {
        }
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[6]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Change Password";
            // $this->load->view('auth/header', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('auth/footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '
                <div class="alert alert-success" role="alert">Password success changed, please login</div>');
            redirect('auth');
        }
    }
}
