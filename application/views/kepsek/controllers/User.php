<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class User extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
        $this->load->model('Absensi_model');
        $this->load->model('Admin_model');
		$this->load->model('M_Datatables');
        
    }

    public function index($params="")
    {
        // is_logged_in();
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        if ($params == "filter_harian") {
			$data['tanggal_sekarang'] = $this->input->post('filter');
			$data['bulan_sekarang'] = date('Y-m');
			$data['sortir'] = 'Filter Harian';
		} elseif ($params == "filter_bulanan") {
			$data['tanggal_sekarang'] = date('Y-m-d');
			$data['bulan_sekarang'] = $this->input->post('filter');
			$data['sortir'] = 'Filter Bulanan';
		} else {
			$data['tanggal_sekarang'] = date('Y-m-d');
			$data['bulan_sekarang'] = date('Y-m');
			$data['sortir'] = 'Filter Harian';
		}

		$data['cek_absen_khusus'] = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '".$data['user']['id']."' AND date = '".date('Y-m-d')."' AND status = '0'")->num_rows();

        $tanggal_awal = date('Y-m-')."1";
        $tanggal_akhir = date('Y-m-')."31";

        $data['riwayat'] = $this->Absensi_model->getAbsensiUserByDate($data['user']['id'],$tanggal_awal,$tanggal_akhir)->result_array();
        $id = $this->session->userdata('id');
        $data['data_pegawai'] = $this->Admin_model->getPegawaibyId($id)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('user/footer');
    }


	public function dashboard($params="")
    {
        // is_logged_in();
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        if ($params == "filter_harian") {
			$data['tanggal_sekarang'] = $this->input->post('filter');
			$data['bulan_sekarang'] = date('Y-m');
			$data['sortir'] = 'Filter Harian';
		} elseif ($params == "filter_bulanan") {
			$data['tanggal_sekarang'] = date('Y-m-d');
			$data['bulan_sekarang'] = $this->input->post('filter');
			$data['sortir'] = 'Filter Bulanan';
		} else {
			$data['tanggal_sekarang'] = date('Y-m-d');
			$data['bulan_sekarang'] = date('Y-m');
			$data['sortir'] = 'Filter Harian';
		}

		$data['cek_absen_khusus'] = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '".$data['user']['id']."' AND date = '".date('Y-m-d')."' AND status = '0'")->num_rows();

        $tanggal_awal = date('Y-m-')."1";
        $tanggal_akhir = date('Y-m-')."31";

        $data['riwayat'] = $this->Absensi_model->getAbsensiUserByDate($data['user']['id'],$tanggal_awal,$tanggal_akhir)->result_array();
        $id = $this->session->userdata('id');
        $data['data_pegawai'] = $this->Admin_model->getPegawaibyId($id)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('user/footer');
    }



    // function data_rekap_pegawai_perbulan($bulan = "")
	// {
	// 	date_default_timezone_set("Asia/Jakarta");

	// 	$tgl1 = date('Y-m-d', strtotime($bulan));
	// 	$tgl2 = date('Y-m-d', strtotime('+1 month', strtotime($bulan)));
    //     $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

	// 	$query  = "SELECT * FROM `data_attendance` 
	// 	JOIN `user` ON data_attendance.`user_id` = user.`id`";
	// 	$search = array('attendance_id', 'user_id', 'name', 'date', 'time_in', 'time_break', 'time_out', 'status', 'description');
	// 	// $where  = null;
	// 	$where  = array(
	// 		'date >' => $tgl1,
	// 		'date <' => $tgl2,
    //         'user_id' => $user['id']
	// 	);

	// 	// jika memakai IS NULL pada where sql
	// 	$isWhere = null;
	// 	// $isWhere = 'artikel.deleted_at IS NULL';
	// 	header('Content-Type: application/json');
	// 	echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
	// }

    // function data_rekap_bulanan()
	// {
	// 	date_default_timezone_set("Asia/Jakarta");

	// 	$tgl1 = date('Y')."-01-01";
	// 	$tgl2 = date('Y-m-d', strtotime('+1 years', strtotime($tgl1)));
    //     $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

	// 	$query  = "SELECT * FROM `user`";
	// 	$search = array('name', 'view_sakit', 'view_izin', 'view_alpha', 'view_hadir', 'view_tidak_hadir', 'view_persentase');
	// 	// $where  = null;
	// 	$where  = array(
	// 		'role_id !' => '1',
    //         'id' => $user['id']
	// 	);

	// 	// jika memakai IS NULL pada where sql
	// 	$isWhere = null;
	// 	// $isWhere = 'artikel.deleted_at IS NULL';
	// 	header('Content-Type: application/json');
	// 	echo $this->M_Datatables->get_tables_rekap_bulanan($query, $search, $where, $isWhere, $tgl1, $tgl2);
	// }
    
    public function edit()
    {
            $data['title'] = 'Edit Profile';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/updateProfile', $data);
            $this->load->view('templates/footer');
        
            $phone= $this->input->post('phone');
            $email= $this->input->post('email');
            $address = $this->input->post('address');
            //cek jika ada gambar
            $upload_image = $_FILES['image']['name'];

            $upload_image = str_replace(" ", "", $upload_image);

            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = [
            'phone' => $phone,
            'address' => $address
            ];

            $this->db->where('email', $email);
            $this->db->update('user',$data);
            $this->session->set_flashdata('message_profile', '<script>
                     swal({
                title: "Profile",
                text: "Profile Telah di Perbarui",
                icon: "success",
                button: "Ok"
                // timer: 3000
            });
                </script>');
            redirect('user/updateProfile');
    }


    public function updateProfile()
    {
        // $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/updateProfile', $data);
            $this->load->view('templates/footer');
        } else {
            // $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            // if ($current_password == $new_password) {
            //     $this->session->set_flashdata('message','<script>
            //          swal({
            //     title: "Password",
            //     text: "Password Telah di Perbarui",
            //     icon: "success",
            //     button: "Ok"
            //     // timer: 3000
            // });
            //     </script>');
            //     redirect('user/updateProfile');
            // } else {
                //password oke 
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $this->db->set('password', $password_hash);
                $this->db->where('email', $this->session->userdata('email'));
                $this->db->update('user');
                $this->session->set_flashdata('message','<script>
                     swal({
                title: "Password",
                text: "Password Telah di Perbarui",
                icon: "success",
                button: "Ok"
                // timer: 3000
            });
                </script>');
                redirect('user/updateProfile');
            // }
           
        }
    }


    // public function export($params = "")
	// {
	// 	$spreadsheet = new Spreadsheet();
	// 	$sheet = $spreadsheet->getActiveSheet();

	// 	// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
	// 	$style_col = [
	// 		'font' => ['bold' => true], // Set font nya jadi bold
	// 		'alignment' => [
	// 			'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
	// 			'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	// 		],
	// 		'borders' => [
	// 			'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
	// 			'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
	// 			'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
	// 			'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
	// 		]
	// 	];

	// 	// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
	// 	$style_row = [
	// 		'alignment' => [
	// 			'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	// 		],
	// 		'borders' => [
	// 			'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
	// 			'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
	// 			'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
	// 			'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
	// 		]
	// 	];
	// 	$alignment_center = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;

	// 	$params = $this->input->post('bulan');
	// 	if (empty($params)) {
	// 		$bulan = "Semua";
	// 		$tanggal_awal = date('Y') . "-01-01";
	// 		$tanggal_akhir = date('Y') . "-12-31";
	// 	} else {
	// 		$bulan = $params;

	// 		if ($bulan == 'Januari') {
	// 			$tanggal_awal = date('Y') . "-01-01";
	// 			$tanggal_akhir = date('Y') . "-01-31";
	// 		} elseif ($bulan == 'Februari') {
	// 			$tanggal_awal = date('Y') . "-02-01";
	// 			$tanggal_akhir = date('Y') . "-02-31";
	// 		} elseif ($bulan == 'Maret') {
	// 			$tanggal_awal = date('Y') . "-03-01";
	// 			$tanggal_akhir = date('Y') . "-03-31";
	// 		} elseif ($bulan == 'April') {
	// 			$tanggal_awal = date('Y') . "-04-01";
	// 			$tanggal_akhir = date('Y') . "-04-31";
	// 		} elseif ($bulan == 'Mei') {
	// 			$tanggal_awal = date('Y') . "-05-01";
	// 			$tanggal_akhir = date('Y') . "-05-31";
	// 		} elseif ($bulan == 'Juni') {
	// 			$tanggal_awal = date('Y') . "-06-01";
	// 			$tanggal_akhir = date('Y') . "-06-31";
	// 		} elseif ($bulan == 'Juli') {
	// 			$tanggal_awal = date('Y') . "-07-01";
	// 			$tanggal_akhir = date('Y') . "-07-31";
	// 		} elseif ($bulan == 'Agustus') {
	// 			$tanggal_awal = date('Y') . "-08-01";
	// 			$tanggal_akhir = date('Y') . "-08-31";
	// 		} elseif ($bulan == 'September') {
	// 			$tanggal_awal = date('Y') . "-09-01";
	// 			$tanggal_akhir = date('Y') . "-09-31";
	// 		} elseif ($bulan == 'Oktober') {
	// 			$tanggal_awal = date('Y') . "-10-01";
	// 			$tanggal_akhir = date('Y') . "-10-31";
	// 		} elseif ($bulan == 'November') {
	// 			$tanggal_awal = date('Y') . "-11-01";
	// 			$tanggal_akhir = date('Y') . "-11-31";
	// 		} elseif ($bulan == 'Desember') {
	// 			$tanggal_awal = date('Y') . "-12-01";
	// 			$tanggal_akhir = date('Y') . "-12-31";
	// 		}
	// 	}

	// 	$sheet->setCellValue('A1', "LAPORAN ABSENSI SMK KARYA NASIONAL"); // Set kolom A1 dengan tulisan "DATA SISWA"
	// 	$sheet->mergeCells('A1:j1'); // Set Merge Cell pada kolom A1 sampai F1
	// 	$sheet->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
	// 	$sheet->getStyle('A1')->getFont()->setSize(16); // Set font size 15 untuk kolom A1
	// 	$sheet->setCellValue('A2', "Jl. Cirendang - Cigugur, Cirendang, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45518"); // Set kolom A1 dengan tulisan "DATA SISWA"
	// 	$sheet->mergeCells('A2:J2'); // Set Merge Cell pada kolom A1 sampai F1
	// 	$sheet->getStyle('A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
	// 	$sheet->getStyle('A1')->getAlignment()->setHorizontal($alignment_center);
	// 	$sheet->getStyle('A2')->getAlignment()->setHorizontal($alignment_center);

	// 	// Buat header tabel nya pada baris ke 3
	// 	if ($bulan == 'Semua') {
	// 		$sheet->setCellValue('A5', "BULAN"); // Set kolom A3 dengan tulisan "NO"
	// 		$sheet->setCellValue('B5', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
	// 		$sheet->setCellValue('C5', "JABATAN"); // Set kolom C3 dengan tulisan "NAMA"
	// 		$sheet->setCellValue('D5', "TEPAT WAKTU"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
	// 		$sheet->setCellValue('E5', "TELAT"); // Set kolom E3 dengan tulisan "TELEPON"
	// 		$sheet->setCellValue('F5', "SAKIT"); // Set kolom F3 dengan tulisan "ALAMAT"
	// 		$sheet->setCellValue('G5', "IZIN");
	// 		$sheet->setCellValue('H5', "ALPHA");
	// 		$sheet->setCellValue('I5', "TOTAL HADIR");
	// 		$sheet->setCellValue('J5', "TOTAL TIDAK HADIR");
	// 		$sheet->setCellValue('K5', "PERSENTASE");
	// 	} else {
	// 		$sheet->setCellValue('A5', "No"); // Set kolom A3 dengan tulisan "NO"
	// 		$sheet->setCellValue('B5', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
	// 		$sheet->setCellValue('C5', "JABATAN"); // Set kolom C3 dengan tulisan "NAMA"
	// 		$sheet->setCellValue('D5', "TEPAT WAKTU"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
	// 		$sheet->setCellValue('E5', "TELAT"); // Set kolom E3 dengan tulisan "TELEPON"
	// 		$sheet->setCellValue('F5', "SAKIT"); // Set kolom F3 dengan tulisan "ALAMAT"
	// 		$sheet->setCellValue('G5', "IZIN");
	// 		$sheet->setCellValue('H5', "ALPHA");
	// 		$sheet->setCellValue('I5', "TOTAL HADIR");
	// 		$sheet->setCellValue('J5', "TOTAL TIDAK HADIR");
	// 		$sheet->setCellValue('K5', "PERSENTASE");
	// 	}

	// 	// Apply style header yang telah kita buat tadi ke masing-masing kolom header
	// 	$sheet->getStyle('A5')->applyFromArray($style_col);
	// 	$sheet->getStyle('B5')->applyFromArray($style_col);
	// 	$sheet->getStyle('C5')->applyFromArray($style_col);
	// 	$sheet->getStyle('D5')->applyFromArray($style_col);
	// 	$sheet->getStyle('E5')->applyFromArray($style_col);
	// 	$sheet->getStyle('F5')->applyFromArray($style_col);
	// 	$sheet->getStyle('G5')->applyFromArray($style_col);
	// 	$sheet->getStyle('H5')->applyFromArray($style_col);
	// 	$sheet->getStyle('I5')->applyFromArray($style_col);
	// 	$sheet->getStyle('J5')->applyFromArray($style_col);
	// 	$sheet->getStyle('K5')->applyFromArray($style_col);

	// 	// Set height baris ke 1, 2 dan 3
	// 	$sheet->getRowDimension('1')->setRowHeight(20);
	// 	$sheet->getRowDimension('2')->setRowHeight(20);
	// 	$sheet->getRowDimension('3')->setRowHeight(20);
	// 	$sheet->getRowDimension('4')->setRowHeight(20);

	// 	// Buat query untuk menampilkan semua data siswa
    //     $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
	// 	$data = $this->Absensi_model->getPegawaiExportByUserId($user['id'])->result_array();


	// 	if ($bulan == "semua") {
	// 		$sheet->setCellValue('I4', "Rekap Tahun " . date('Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
	// 		$sheet->mergeCells('I4:K4'); // Set Merge Cell pada kolom A1 sampai F1
	// 		$sheet->getStyle('I4')->getAlignment()->setHorizontal($alignment_center);
	// 	} else {
	// 		$sheet->setCellValue('I4', "Rekap Bulan " . $bulan . " Tahun " . date('Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
	// 		$sheet->mergeCells('I4:K4'); // Set Merge Cell pada kolom A1 sampai F1
	// 		$sheet->getStyle('I4')->getAlignment()->setHorizontal($alignment_center);
	// 	}


	// 	$no = 1; // Untuk penomoran tabel, di awal set dengan 1
	// 	$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
	// 	foreach ($data as $key => $data) { // Ambil semua data dari hasil eksekusi $sql

	// 		if ($bulan == "Semua") {

	// 			for ($i = 0; $i < 12; $i++) {

	// 				$m = $i + 1;
	// 				$tanggal_awal = date('Y') . "-" . $m . "-01";
	// 				$tanggal_akhir = date('Y') . "-" . $m . "-31";

	// 				// $hadir = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '1' and user_id = '".$data['id']."'"));
	// 				// $izin = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '4' and user_id = '".$data['id']."'"));
	// 				// $sakit = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '3' and user_id = '".$data['id']."'"));
	// 				// $telat = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '2' and user_id = '".$data['id']."'"));
	// 				// $alpha = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '0' and user_id = '".$data['id']."'"));


	// 				$hadir = $this->Absensi_model->getHadirBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
	// 				$izin = $this->Absensi_model->getIzinBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
	// 				$sakit = $this->Absensi_model->getSakitBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
	// 				$telat = $this->Absensi_model->getTelatBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
	// 				$alpha = $this->Absensi_model->getAlphaBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();

	// 				$all = $hadir + $telat + $sakit + $izin + $alpha;
	// 				$total_hadir = $hadir + $telat;
	// 				$absent = $sakit + $izin + $alpha;
	// 				if ($all == 0) {
	// 					$persentase = 0;
	// 				} else {
	// 					$persentase = number_format(($hadir + $telat) / $all * 100);
	// 				}


	// 				$sheet->setCellValue('A' . $numrow, bulan_indo($m));
	// 				$sheet->setCellValue('B' . $numrow, $data['name']);
	// 				$sheet->setCellValue('C' . $numrow, $data['department']);
	// 				$sheet->setCellValue('D' . $numrow, $hadir);
	// 				$sheet->setCellValue('E' . $numrow, $telat);
	// 				$sheet->setCellValue('F' . $numrow, $sakit);
	// 				$sheet->setCellValue('G' . $numrow, $izin);
	// 				$sheet->setCellValue('H' . $numrow, $alpha);
	// 				$sheet->setCellValue('I' . $numrow, $total_hadir);
	// 				$sheet->setCellValue('J' . $numrow, $absent);
	// 				$sheet->setCellValue('K' . $numrow, $persentase . "%");


	// 				// Khusus untuk no telepon. kita set type kolom nya jadi STRING
	// 				// $sheet->setCellValue('E'.$numrow, $data['telp']);

	// 				// $sheet->setCellValue('F'.$numrow, $data['alamat']);

	// 				// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	// 				$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
	// 				$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
	// 				$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
	// 				$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
	// 				$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
	// 				$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
	// 				$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
	// 				$sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
	// 				$sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
	// 				$sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
	// 				$sheet->getStyle('K' . $numrow)->applyFromArray($style_row);

	// 				$sheet->getRowDimension($numrow)->setRowHeight(20);

	// 				$numrow++;
	// 			}
	// 		}

	// 		// HANYA SATU BULAN
	// 		else {
	// 			// $hadir = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '1' and user_id = '".$data['id']."'"));
	// 			// $izin = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '4' and user_id = '".$data['id']."'"));
	// 			// $sakit = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '3' and user_id = '".$data['id']."'"));
	// 			// $telat = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '2' and user_id = '".$data['id']."'"));
	// 			// $alpha = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '0' and user_id = '".$data['id']."'"));

	// 			$hadir = $this->Absensi_model->getHadirBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
	// 			$izin = $this->Absensi_model->getIzinBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
	// 			$sakit = $this->Absensi_model->getSakitBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
	// 			$telat = $this->Absensi_model->getTelatBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
	// 			$alpha = $this->Absensi_model->getAlphaBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();

	// 			$all = $hadir + $telat + $sakit + $izin + $alpha;
	// 			$total_hadir = $hadir + $telat;
	// 			$absent = $sakit + $izin + $alpha;
	// 			if ($all == 0) {
	// 				$persentase = 0;
	// 			} else {
	// 				$persentase = number_format(($hadir + $telat) / $all * 100);
	// 			}

	// 			$sheet->setCellValue('A' . $numrow, $no++);
	// 			$sheet->setCellValue('B' . $numrow, $data['name']);
	// 			$sheet->setCellValue('C' . $numrow, $data['department']);
	// 			$sheet->setCellValue('D' . $numrow, $hadir);
	// 			$sheet->setCellValue('E' . $numrow, $telat);
	// 			$sheet->setCellValue('F' . $numrow, $sakit);
	// 			$sheet->setCellValue('G' . $numrow, $izin);
	// 			$sheet->setCellValue('H' . $numrow, $alpha);
	// 			$sheet->setCellValue('I' . $numrow, $total_hadir);
	// 			$sheet->setCellValue('J' . $numrow, $absent);
	// 			$sheet->setCellValue('K' . $numrow, $persentase . "%");


	// 			// Khusus untuk no telepon. kita set type kolom nya jadi STRING
	// 			// $sheet->setCellValue('E'.$numrow, $data['telp']);

	// 			// $sheet->setCellValue('F'.$numrow, $data['alamat']);

	// 			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	// 			$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
	// 			$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
	// 			$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
	// 			$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
	// 			$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
	// 			$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
	// 			$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
	// 			$sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
	// 			$sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
	// 			$sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
	// 			$sheet->getStyle('K' . $numrow)->applyFromArray($style_row);

	// 			$sheet->getRowDimension($numrow)->setRowHeight(20);
	// 			$numrow++; // Tambah 1 setiap kali looping
	// 		}
	// 		$no++; // Tambah 1 setiap kali looping
	// 	}
	// 	$numrow++;
	// 	// Set width kolom
	// 	$sheet->getColumnDimension('A')->setWidth(15); // Set width kolom A
	// 	$sheet->getColumnDimension('B')->setWidth(25); // Set width kolom B
	// 	$sheet->getColumnDimension('C')->setWidth(20); // Set width kolom C
	// 	$sheet->getColumnDimension('D')->setWidth(15); // Set width kolom D
	// 	$sheet->getColumnDimension('E')->setWidth(8); // Set width kolom E
	// 	$sheet->getColumnDimension('F')->setWidth(8); // Set width kolom F
	// 	$sheet->getColumnDimension('G')->setWidth(8); // Set width kolom C
	// 	$sheet->getColumnDimension('H')->setWidth(8); // Set width kolom D
	// 	$sheet->getColumnDimension('I')->setWidth(15); // Set width kolom D
	// 	$sheet->getColumnDimension('J')->setWidth(15); // Set width kolom E
	// 	$sheet->getColumnDimension('K')->setWidth(13); // Set width kolom F





	// 	$sheet->setCellValue('H' . $numrow, "Kuningan, " . tgl_indo(date('d-m-Y'))); // Set mengetahui
	// 	$sheet->mergeCells('H' . $numrow . ':J' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
	// 	$sheet->getStyle('H' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1

	// 	$numrow++;


	// 	$sheet->setCellValue('B' . $numrow, "Kasubag TU");
	// 	$sheet->mergeCells('B' . $numrow . ':C' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
	// 	$sheet->getStyle('B' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1



	// 	$sheet->setCellValue('H' . $numrow, "Staff Kepegawaian");
	// 	$sheet->mergeCells('H' . $numrow . ':J' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
	// 	$sheet->getStyle('H' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
	// 	$sheet->getStyle('H' . $numrow)->getAlignment()->setHorizontal($alignment_center);
	// 	$numrow = $numrow + 5;

	// 	$sheet->setCellValue('B' . $numrow, "Eman Arisman");
	// 	$sheet->mergeCells('B' . $numrow . ':C' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
	// 	$sheet->getStyle('B' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1


	// 	$sheet->setCellValue('H' . $numrow, "Sarif Priant, A.Md.");
	// 	$sheet->mergeCells('H' . $numrow . ':J' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
	// 	$sheet->getStyle('H' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
	// 	$sheet->getStyle('H' . $numrow)->getAlignment()->setHorizontal($alignment_center);
	// 	$numrow++;

	// 	$sheet->setCellValue('D' . $numrow, "Mengetahui");
	// 	$sheet->mergeCells('D' . $numrow . ':F' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
	// 	$sheet->getStyle('D' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
	// 	$sheet->getStyle('D' . $numrow)->getAlignment()->setHorizontal($alignment_center);
	// 	$numrow++;

	// 	$sheet->setCellValue('D' . $numrow, "Kepala Sekolah");
	// 	$sheet->mergeCells('D' . $numrow . ':F' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
	// 	$sheet->getStyle('D' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
	// 	$sheet->getStyle('D' . $numrow)->getAlignment()->setHorizontal($alignment_center);
	// 	$numrow = $numrow + 5;

	// 	$sheet->setCellValue('D' . $numrow, "Dr.Yepi Esa Trijaka, M.M.Pd");
	// 	$sheet->mergeCells('D' . $numrow . ':F' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
	// 	$sheet->getStyle('D' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
	// 	$sheet->getStyle('D' . $numrow)->getAlignment()->setHorizontal($alignment_center);

	// 	// Set orientasi kertas jadi LANDSCAPE
	// 	$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

	// 	// Set judul file excel nya
	// 	$sheet->setTitle("Laporan Absensi Per Bulan");

	// 	// Proses file excel
	// 	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	// 	header('Content-Disposition: attachment; filename="Laporan Absensi - Rekap Per Bulan.xlsx"'); // Set nama file excel nya
	// 	header('Cache-Control: max-age=0');

	// 	$writer = new Xlsx($spreadsheet);
	// 	$writer->save('php://output');
	// }

	function data_guru()
	{
		$query  = "SELECT * FROM user";
		$search = array('name', 'department', 'email', 'phone', 'gender', 'id','is_flexible');
		// $where  = null; 
		$where  = array('role_id !' => '1');

		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
	}
    
}
