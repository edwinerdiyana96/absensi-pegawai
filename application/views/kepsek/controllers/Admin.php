<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Admin extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
        $this->load->model('Admin_model');
        $this->load->model('Absensi_model');
        $this->load->model('M_Datatables');
    }

    public function index()
    {
        $data['title'] = 'Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function addNewRole()
    {
        $role_name = $this->input->post('role_name');
        $data =  [
            'role' => $role_name
        ];
        $this->Admin_model->addNewRole($data);
        $this->session->set_flashdata('message', '<script>
         swal({
            title: "Role Status!",
            text: "Role Baru Berhasil Ditambahkan",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
        redirect('Admin/role');
    }



    public function deleteRole($id)
    {

        $this->Admin_model->deleteDatarole($id);
        $this->session->set_flashdata('message', '<script>
         swal({
            title: "Role Status!",
            text: "Role Baru Berhasil Dihapus",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
        redirect('Admin/role');
    }

    public function editRole($id)
    {
        $data['title'] = 'Update Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->Admin_model->getRoleById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit-role', $data);
        $this->load->view('templates/footer');
    }

    public function updateRole()
    {
        $this->Admin_model->updateDataRole();
        $this->session->set_flashdata('message', '<script>
         swal({
            title: "Role Status!",
            text: "Role Baru Berhasil Di Perbaharui",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
        redirect('admin/role');
    }




    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=1');
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<script>
         swal({
            title: "Role Status!",
            text: "Role Baru Berhasil Dirubah",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
    }


    public function manage()
    {
        $data['title'] = 'KELOLA DATA PEGAWAI';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $data['list_user'] = $this->Admin_model->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer');
    }




    public function editUserAccess($id)
    {
        $data['title'] = 'Update Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user_role'] = $this->Admin_model->getUserById($id);
        $data['list_role'] = $this->db->get('user_role')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit-access', $data);
        $this->load->view('templates/footer');
    }

    public function updateUserAccess()
    {

        $this->Admin_model->updateAccessUser();
        $this->session->set_flashdata('message', '<script>
         swal({
            title: "Access Status!",
            text: "Akses Berhasil Di Perbarui",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
        redirect('admin/manage');
    }





//update user 
    public function deleteUser($id)
    {
        $this->Admin_model->deleteDataUser($id);
        $this->session->set_flashdata('message', '<script>
         swal({
            title: "User Status!",
            text: "User Berhasil Dihapus",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
        redirect('Admin/manage');
    }

    public function addNewUser()
    {
        $name = $this->input->post('name');
        $gender = $this->input->post('gender');
        $department = $this->input->post('department');
        $nama_department = $this->Admin_model->getRoleById($department);
        $address = $this->input->post('address');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $password = $this->input->post('password');
        $data =  [
            'name'      => htmlspecialchars($name),
            'email'     => htmlspecialchars($email),
            'image'     => 'default.jpg',
            'password'  => password_hash($password, PASSWORD_DEFAULT),
            'phone'         => htmlspecialchars($phone),
            'department'    => $nama_department['role'],
            'address'    => htmlspecialchars($address),
            'gender'        => htmlspecialchars($gender),
            'role_id'       => htmlspecialchars($this->input->post('department')),
            'is_active'     => 1,
            'date_created'  => time()

        ];
        $this->Admin_model->addNewUser($data);
        $this->session->set_flashdata('message', '<script>
         swal({
            title: "user Status!",
            text: "User Baru Berhasil Ditambahkan",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
        redirect('Admin/manage');
    }


    public function editUserProfile($id="", $params=""){ 
        if ($params=='profile') {
            $role_id = $this->input->post('role');
            $role = $this->Admin_model->getRoleById($role_id);
            $data =  [
                'name'      => htmlspecialchars($this->input->post('name')),
                'email'     => htmlspecialchars($this->input->post('email')),
                'phone'         => htmlspecialchars($this->input->post('phone')),
                'department'    => $role['role'],
                'address'    => htmlspecialchars($this->input->post('address')),
                'gender'        => htmlspecialchars($this->input->post('gender')),
                'role_id'       => htmlspecialchars($this->input->post('role'))

            ];
            $this->db->where('id', $id);
            $this->db->update('user', $data);
            $this->session->set_flashdata('message', '<script>
             swal({
                title: "Profile",
                text: "Profile Berhasil DiPerbarui",
                icon: "success",
                button: "Ok"
                // timer: 3000
                });
                </script>');
            //redirect('Admin/editUserProfile/'.$id);
            redirect('admin/manage');
        } elseif ($params == 'password') {
            $user = $this->Admin_model->getUserById($id);
            // $password = $this->input->post('current_password');
            // if (password_verify($password, $user['password'])) {
                $data = [
                    'password' => password_hash($this->input->post('pass1'), PASSWORD_DEFAULT)
                ];
                $this->db->where('id', $id);
                $this->db->update('user', $data);
                // $this->session->set_flashdata('message_password', '<script>
				$this->session->set_flashdata('message', '<script>
                 swal({
                    title: "Password Status!",
                    text: "Password Baru Berhasil Di Perbarui",
                    icon: "success",
                    button: "Ok"
                // timer: 3000
                    });
                    </script>');
                //redirect('Admin/editUserProfile/'.$id);
                redirect('admin/manage');
            // }else{
                // $this->session->set_flashdata('message_password', '<div class="alert alert-danger" role="alert"> Wrong early password! </div>');
                //redirect('Admin/editUserProfile/'.$id);
                // redirect('admin/manage');
            // }
        } elseif ($params=='status') {
            $user = $this->Admin_model->getUserById($id);

            if ($user['is_flexible'] == '0') {
                $data = [
                    'is_flexible' => '1'
                ];
            } else{
                $data = [
                    'is_flexible' => '0'
                ];
            }

            $this->db->where('id', $id);
            $this->db->update('user', $data);

            $this->session->set_flashdata('message', '<script>
             swal({
                title: "Berhasil",
                text: "Status User Berhasil DiPerbarui",
                icon: "success",
                button: "Ok"
                // timer: 3000
                });
                </script>');
            //redirect('Admin/editUserProfile/'.$id);
            redirect('admin/manage');
        } else{
            $data['title'] = 'Edit  User';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['user_edit'] = $this->Admin_model->getUserById($id);
            $data['role'] = $this->db->get('user_role')->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit-user', $data);
            $this->load->view('templates/footer');
        }
    }



    public function updateUser()
    {      
        $this->Admin_model->updateDatauser();
        $this->session->set_flashdata('message', '<script>
         swal({
            title: "User Status!",
            text: "User Baru Berhasil Di Perbarui",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
        redirect('admin/manage');
    }



    public function geolocation($params="", $params2=""){
        if ($params=='add') {
            $data = [
                'name'=> $this->input->post('nama'),
                'place_id' => $this->input->post('place_id'),
                'date_create' => date('Y-m-d')
            ];
            $this->db->insert('data_geolocation', $data);
            $this->session->set_flashdata('message', '<script>
             swal({
                title: "Berhasil!",
                text: "Data Geolocation Berhasil di Tambahkan",
                icon: "success",
                button: "Ok"
                    // timer: 3000
                });
                </script>');
            redirect('admin/geolocation');
        }elseif ($params=='edit') {
            $data = [
                'name'=> $this->input->post('nama'),
                'place_id' => $this->input->post('place_id')
            ];
            $this->db->where('id', $params2);
            $this->db->update('data_geolocation', $data);
            $this->session->set_flashdata('message', '<script>
             swal({
                title: "Berhasil!",
                text: "Data Geolocation Berhasil di Perbaharui",
                icon: "success",
                button: "Ok"
                    // timer: 3000
                });
                </script>');
            redirect('admin/geolocation');
        }elseif ($params=='hapus') {
            $this->db->where('id', $params2);
            $this->db->delete('data_geolocation');
            $this->session->set_flashdata('message', '<script>
             swal({
                title: "Berhasil!",
                text: "Data Geolocation Berhasil di Hapus",
                icon: "success",
                button: "Ok"
                    // timer: 3000
                });
                </script>');
            redirect('admin/geolocation');
        } else{ 
            $data['title'] = 'Data Geolocation';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['geolocation'] = $this->Admin_model->getGeolocation()->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/geolocation', $data);
            $this->load->view('templates/footer');
        }
    }



    public function export_user(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];


        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A1', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B1', "Email"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C1', "Nama"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D1', "Phone"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E1', "Jabatan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F1', "Jenis Kelamin"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('G1', "Status Absensi"); // Set kolom E3 dengan tulisan "ALAMAT"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A1')->applyFromArray($style_col);
        $sheet->getStyle('B1')->applyFromArray($style_col);
        $sheet->getStyle('C1')->applyFromArray($style_col);
        $sheet->getStyle('D1')->applyFromArray($style_col);
        $sheet->getStyle('E1')->applyFromArray($style_col);
        $sheet->getStyle('F1')->applyFromArray($style_col);
        $sheet->getStyle('G1')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $data = $this->Absensi_model->getDataPegawai()->result_array();

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($data as $data){ // Lakukan looping pada variabel siswa
            
            if ($data['gender']=='L') {
                $gender = 'Laki-Laki';
            } else{
                $gender = 'Perempuan';
            }
            if ($data['is_flexible']=='1') {
                $status = 'Flexible';
            } else{
                $status = 'Full Time';
            }
            $sheet->setCellValue('A'.$numrow, $no);
            $sheet->setCellValue('B'.$numrow, $data['email']);
            $sheet->setCellValue('C'.$numrow, $data['name']);
            $sheet->setCellValue('D'.$numrow, $data['phone']);
            $sheet->setCellValue('E'.$numrow, $data['department']);
            $sheet->setCellValue('F'.$numrow, $gender);
            $sheet->setCellValue('G'.$numrow, $status);
            
            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
            
            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(20); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(20); // Set width kolom E
        $sheet->getColumnDimension('G')->setWidth(20); // Set width kolom E
        
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $sheet->setTitle("Data User");

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data User.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    
    // REKAP ADMIN
	public function rekap($params = "", $params2="")
	{
		$data['title'] = 'REKAP ABSENSI DI ADMIN';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		date_default_timezone_set("Asia/Jakarta");
		$time = new DateTime("now");
		$curr_time = $time->format('H:i:s');

		if ($params == "filter_harian") {
		    if($params2==""){
		        $data['tanggal_sekarang'] = $this->input->post('filter');    
		    }else{
		        $data['tanggal_sekarang'] = $params2;
		    }
			
			$data['bulan_sekarang'] = date('Y-m');
			$data['sortir'] = 'Filter Harian';
		} elseif ($params == "filter_bulanan") {
			$data['tanggal_sekarang'] = date('Y-m-d');
			$data['bulan_sekarang'] = $this->input->post('filter');
			$data['sortir'] = 'Filter Bulanan';
		} elseif ($params == "edit") {
			$data = [
				'status' => $this->input->post('status'),
				'description' => $this->input->post('description'),
				'time_in' => $this->input->post('time_in'),
				'time_out' => $this->input->post('time_out')
			];
			$this->db->where('attendance_id', $this->input->post('attendance_id'));
			$this->db->update('data_attendance', $data);

			$this->session->set_flashdata('message', '<script>
				swal({
					title: "Berhasil!",
					text: "Data Kehadiran Siswa Berhasil di Perbaharui!",
					icon: "success",
					button: "Ok"
                // timer: 3000
					});
					</script>');
			redirect('admin/rekap/filter_harian/'.$this->input->post('tgl'));
		}
		else {
			$data['tanggal_sekarang'] = date('Y-m-d');
			$data['bulan_sekarang'] = date('Y-m');
			$data['sortir'] = 'Filter Harian';
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('rekap/admin2', $data);
		$this->load->view('templates/footer');
	}

	function data_rekap_harian($params = "")
	{
		date_default_timezone_set("Asia/Jakarta");

		$query  = "SELECT * FROM `data_attendance` 
		JOIN `user` ON data_attendance.`user_id` = user.`id`";
		$search = array('attendance_id', 'user_id', 'name', 'date', 'time_in', 'time_break', 'time_out', 'status', 'description');
		// $where  = null;
		$where  = array(
			'date' => $params
		);

		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
	}

	function data_rekap_bulanan($bulan = "")
	{
		date_default_timezone_set("Asia/Jakarta");

		$tgl1 = date('Y-m-d', strtotime($bulan));
		$tgl2 = date('Y-m-d', strtotime('+1 month', strtotime($bulan)));

		$query  = "SELECT * FROM `user`";
		$search = array('name', 'view_sakit', 'view_izin', 'view_alpha', 'view_hadir', 'view_tidak_hadir', 'view_persentase');
		// $where  = null;
		$where  = array(
			'role_id !' => '1'
		);

		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_rekap_bulanan($query, $search, $where, $isWhere, $tgl1, $tgl2);
	}

    public function export()
    {
        $this->load->view('rekap/export');
    }

	//UPDATE DATA ABSENSI OLEH ADMIN
	public function updateUserAbsensi()
	{

		$this->Absensi_model->updateAbsensiUser();
		$this->session->set_flashdata('message', '<script>
           swal({
            title: "Absensi Status!",
            text: "Data Absensi Berhasil Di Perbarui",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
		redirect('admin/rekap');
	}


    public function kehadiran()
	{
		$data['title'] = 'DATA KEHADIRAN HARI INI';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['total_pegawai'] = $this->Absensi_model->getDataPegawai()->num_rows();
		$data['total_hadir_hari_ini'] = $this->Absensi_model->getAttendanceToday()->num_rows();
		$data['total_tidak_hadir_hari_ini'] = $this->Absensi_model->getCountNotAttendanceToday()->num_rows();
		$data['tidak_hadir_hari_ini'] = $this->Absensi_model->getNotAttendanceToday();
		$data['total_terlambat'] = $this->Absensi_model->getLateAttendanceToday()->num_rows();
		// $data['izin'] = $this->Absensi_model->getPermitAttendanceToday()->result_array();
		// $data['sakit'] = $this->Absensi_model->getSickAttendanceToday()->result_array();
		// $data['belum_hadir'] = $this->Absensi_model->getBeforeAttendanceToday()->result_array();
		// $data['terlambat'] = $this->Absensi_model->getLateAttendanceToday()->result_array();
		// $data['off'] = $this->Absensi_model->getOffAttendanceToday()->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/kehadiran', $data);
		$this->load->view('templates/footer');
	}

    public function hadirkan($params=""){
        date_default_timezone_set("Asia/Jakarta");
        $data = [
            'status' => '1',
            'time_in' => date('H:i:s')
        ];
        $this->db->where('attendance_id', $params);
        $this->db->update('data_attendance', $data);

        $this->session->set_flashdata('message', '<script>
            swal({
                title: "Berhasil!",
                text: "Data Kehadiran Berhasil di Perbaharui!",
                icon: "success",
                button: "Ok"
            // timer: 3000
                });
                </script>');
        redirect('admin/kehadiran');
    }
    
    
    
    
    

    public function settings($params="", $params2=""){
        if ($params=='logo') {
            $config['upload_path']          = './assets/images/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 54100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
    
            $this->load->library('upload', $config);
    
            if ( ! $this->upload->do_upload('upload')){
                $error = array('error' => $this->upload->display_errors());
                // $this->load->view('v_upload', $error);
                // echo $error['error'];
                $this->session->set_flashdata('message', '<script>
                swal({
                   title: "Gagal!",
                   text: "'.$error['error'].'",
                   icon: "error",
                   button: "Ok"
                       // timer: 3000
                   });
                   </script>');
               redirect('admin/settings');
            }else{
                $data = array('upload_data' => $this->upload->data());
                $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                $file_name = $upload_data['file_name'];
                $input = [
                    'logo'  => "assets/images/".$file_name
                ];
                $this->db->update('settings', $input);
                $this->session->set_flashdata('message', '<script>
                swal({
                   title: "Berhasil!",
                   text: "Logo Berhasil di Perbaharui",
                   icon: "success",
                   button: "Ok"
                       // timer: 3000
                   });
                   </script>');
               redirect('admin/settings');
            }

        }elseif ($params=='sampul') {
            $config['upload_path']          = './assets/images/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 54100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
    
            $this->load->library('upload', $config);
    
            if ( ! $this->upload->do_upload('upload')){
                $error = array('error' => $this->upload->display_errors());
                // $this->load->view('v_upload', $error);
                // echo $error['error'];
                $this->session->set_flashdata('message', '<script>
                swal({
                   title: "Gagal!",
                   text: "'.$error['error'].'",
                   icon: "error",
                   button: "Ok"
                       // timer: 3000
                   });
                   </script>');
               redirect('admin/settings');
            }else{
                $data = array('upload_data' => $this->upload->data());
                $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                $file_name = $upload_data['file_name'];
                $input = [
                    'sampul'  => "assets/images/".$file_name
                ];
                $this->db->update('settings', $input);
                $this->session->set_flashdata('message', '<script>
                swal({
                   title: "Berhasil!",
                   text: "Foto Sampul Berhasil di Perbaharui",
                   icon: "success",
                   button: "Ok"
                       // timer: 3000
                   });
                   </script>');
               redirect('admin/settings');
            }

        }elseif ($params=='edit') {
            $phone 		= $this->input->post('phone');
            $no_awal    = substr($phone, 0, 1);
            $no_awal1   = substr($phone, 0, 2);
            $no_awal2   = substr($phone, 0, 3);

            if($no_awal1 =='08'){
                $nomor = "62".substr($phone,1);
                $cek_no = 1;
            }elseif($no_awal=='8'){
                $nomor = "62".$phone;
                $cek_no = 1;
            }elseif ($no_awal2=='008') {
                $nomor = "62".substr($phone,2);
                $cek_no = 1;
            }elseif ($no_awal2=='628') {
                $nomor = $phone;
                $cek_no = 1;
            }else{
                $this->session->set_flashdata('message', '<script>
                swal({
                   title: "Gagal!",
                   text: "No Telepon Yang anda masukkan tidak valid!",
                   icon: "error",
                   button: "Ok"
                       // timer: 3000
                   });
                   </script>');
               redirect('admin/settings');
            }
            $input = [
                'name'  => $this->input->post('nama'),
                'phone'  => $nomor,
                'api_telegram'  => $this->input->post('api_telegram'),
                'address'  => $this->input->post('address'),
                'langitude'  => $this->input->post('langitude'),
                'longitude'  => $this->input->post('longitude'),
                'metode_laporan'  => $this->input->post('metode_laporan')
            ];
            $this->db->update('settings', $input);
            $this->session->set_flashdata('message', '<script>
            swal({
               title: "Berhasil!",
               text: "Foto Sampul Berhasil di Perbaharui",
               icon: "success",
               button: "Ok"
                   // timer: 3000
               });
               </script>');
           redirect('admin/settings');
        } else{ 
            $data['title'] = 'Data Pengaturan';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['geolocation'] = $this->Admin_model->getGeolocation()->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/settings', $data);
            $this->load->view('templates/footer');
        }
    }

}
