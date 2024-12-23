<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Operator extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Admin_model');
		$this->load->model('Absensi_model');
		$this->load->helper('download');
		$this->load->model('M_Datatables');

		$cek = 0;
		$cek = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->num_rows();
		if ( $cek == 0) {
		    redirect('auth');
		}


	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['jumlah_pegawai'] = $this->Admin_model->getPegawai()->num_rows();
		$data['total_guru'] = $this->Admin_model->getTotalGuru()->num_rows();
		$data['total_staf'] = $this->Admin_model->getTotalStaf()->num_rows();
		$data['total_lainnya'] = $this->Admin_model->getTotalLainnya()->num_rows();
		$data['hadir_hari_ini'] = $this->Absensi_model->getAttendanceToday()->num_rows();
// 		$data['tidak_hadir_per_hari'] = $this->Absensi_model->getTidakHadirPerhari()->num_rows();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('operator/index', $data);
		$this->load->view('user/footer');
	}

	public function jam_absen()
	{
		$data['title'] = 'Jam Absen';
		$data['jam_absen'] = $this->db->get('time_attendance')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('operator/time_attendance', $data);
		$this->load->view('templates/footer');
	}

	public function absensi_manual()
	{
		$data['title'] = 'KONFIRMASI KETIDAKHADIRAN';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['data_ketidakhadiran'] = $this->Absensi_model->getDataKetidakHadiran();
		$data['user_attendance'] = $this->Absensi_model->getDataAbsensiByUserId();
		$data['data_holiday'] = $this->Absensi_model->getHoliday()->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('operator/absensi_manual', $data);
		$this->load->view('user/footer');
	}

	function data_ketidakhadiran()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$query  = "SELECT ketidakhadiran.*, user.* FROM ketidakhadiran JOIN user ON ketidakhadiran.id_user = user.id";
		// $query  = "SELECT * FROM ketidakhadiran";

		$search = array('name', 'status', 'keterangan', 'id_tidakhadir');
		// $where  = null; 
		$where  = array('tanggal' => $curr_date,
			'ketidakhadiran.is_active' => '0');
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
	}

	public function libur($params = "")
	{
		if ($params == 'hadir') {
			$data = [
				'description' => $this->input->post('description'),
				'confirm' => '1'
			];
			$this->db->where('attendance_id', $this->input->post('attendance_id'));
			$this->db->update('data_attendance', $data);

			$this->session->set_flashdata('message', '<script>
               swal({
                title: "Absensi Dikonfirmasi!",
                text: "Absensi Berhasil Di Konfirmasi",
                icon: "success",
                button: "Ok"
                    // timer: 3000
                });
                </script>');
			redirect('operator/libur');
		} elseif ($params == 'tolak') {
			$data = [
				'description' => $this->input->post('description'),
				'confirm' => '2'
			];
			$this->db->where('attendance_id', $this->input->post('attendance_id'));
			$this->db->update('data_attendance', $data);

			$this->session->set_flashdata('message', '<script>
               swal({
                title: "Absensi Dikonfirmasi!",
                text: "Absensi Berhasil Di Konfirmasi",
                icon: "success",
                button: "Ok"
                    // timer: 3000
                });
                </script>');
			redirect('operator/libur');
		} else {
			$data['title'] = 'ABSENSI LIBUR';
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['user_attendance'] = $this->Absensi_model->get_data_attendance_delay();
			$data['data_holiday'] = $this->Absensi_model->getHoliday()->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('operator/absensi_libur', $data);
			$this->load->view('user/footer');
		}
	}

	public function ketidakhadiran($params1 = "", $params2 = "")
	{
		if ($params1 == 'terima') {
			$data = [
				'is_active' => '1'
			];

			$tabel = $this->Absensi_model->getDataKetidakhadiranById($params2)->row_array();

			$this->db->where('id_tidakhadir', $params2);
			$this->db->update('ketidakhadiran', $data);

			$data = [
				'status' => $tabel['status'],
				'description' => $tabel['keterangan']
			];
			$this->db->where('user_id', $tabel['id_user']);
			$this->db->where('date', date('Y-m-d'));
			$this->db->update('data_attendance', $data);

			$this->session->set_flashdata('message', '<script>
               swal({
                title: "Absensi Dikonfirmasi!",
                text: "Absensi Berhasil Di Konfirmasi",
                icon: "success",
                button: "Ok"
                    // timer: 3000
                });
                </script>');
			redirect('operator/absensi_manual');
		} elseif ($params1 == 'tolak') {
			$data = [
				'is_active' => '2'
			];

			$tabel = $this->Absensi_model ->getDataKetidakhadiranById($params2)->row_array();

			$this->db->where('id_tidakhadir', $params2);
			$this->db->update('ketidakhadiran', $data);
			$this->session->set_flashdata('message', '<script>
               swal({
                title: "Absensi Dikonfirmasi!",
                text: "Absensi Berhasil Di Konfirmasi",
                icon: "success",
                button: "Ok"
                    // timer: 3000
                });
                </script>');
			redirect('operator/absensi_manual');
		} else {
			$data['title'] = 'Absen Libur';
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['user_attendance'] = $this->Absensi_model->get_data_attendance_delay();
			$data['data_holiday'] = $this->Absensi_model->getHoliday()->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('operator/absensi_libur', $data);
			$this->load->view('user/footer');
		}
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
		$this->load->view('operator/kehadiran', $data);
		$this->load->view('templates/footer');
	}

	function data_sakit()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$query  = "SELECT data_attendance.* , user.* FROM data_attendance LEFT JOIN user ON data_attendance.user_id = user.id";
		$search = array('name', 'description', 'id', 'phone');
		// $where  = null; 
		$where  = array('date' => $curr_date,
						'status' => '3');

		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
	}

	function data_izin()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$query  = "SELECT data_attendance.* , user.* FROM data_attendance JOIN user ON data_attendance.user_id = user.id";
		$search = array('name', 'description', 'id', 'phone');
		// $where  = null; 
		$where  = array('date' => $curr_date,
						'status' => '4');

		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
	}
	function data_belum_hadir()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$query  = "SELECT data_attendance.* , user.* FROM data_attendance LEFT JOIN user ON data_attendance.user_id = user.id";
		$search = array('name', 'id', 'phone', 'attendance_id');
		// $where  = null; 
		$where  = array('date' => $curr_date,
						'status' => '0');

		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_query_belum_absen($query, $search, $where, $isWhere);
	}
	function data_terlambat()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$query  = "SELECT data_attendance.* , user.* FROM data_attendance LEFT JOIN user ON data_attendance.user_id = user.id";
		$search = array('name', 'time_in', 'id', 'phone');
		// $where  = null; 
		$where  = array('date' => $curr_date,
						'status' => '2');

		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
	}

	function data_off()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$query  = "SELECT data_attendance.* , user.* FROM data_attendance LEFT JOIN user ON data_attendance.user_id = user.id";
		$search = array('name', 'description', 'id', 'phone');
		// $where  = null; 
		$where  = array('date' => $curr_date,
						'status' => '5');

		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
	}

	// public function konfirmasi_ketidakhadiran($params = "")
	// {
	// 	if ($params == 'sakit') {
	// 		$data = [
	// 			'description' => $this->input->post('description'),
	// 			'confirm' => '1'
	// 		];
	// 		$this->db->where('attendance_id', $this->input->post('attendance_id'));
	// 		$this->db->update('data_attendance', $data);

	// 		$this->session->set_flashdata('message', '<script>
    //            swal({
    //             title: "Absensi Dikonfirmasi!",
    //             text: "Absensi Berhasil Di Konfirmasi",
    //             icon: "success",
    //             button: "Ok"
    //                 // timer: 3000
    //             });
    //             </script>');
	// 		redirect('operator/libur');
	// 	} elseif ($params == 'tolak') {
	// 		$data = [
	// 			'description' => $this->input->post('description'),
	// 			'confirm' => '2'
	// 		];
	// 		$this->db->where('attendance_id', $this->input->post('attendance_id'));
	// 		$this->db->update('data_attendance', $data);

	// 		$this->session->set_flashdata('message', '<script>
    //            swal({
    //             title: "Absensi Dikonfirmasi!",
    //             text: "Absensi Berhasil Di Konfirmasi",
    //             icon: "success",
    //             button: "Ok"
    //                 // timer: 3000
    //             });
    //             </script>');
	// 		redirect('operator/libur');
	// 	} else {
	// 		$data['title'] = 'Absen Libur';
	// 		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
	// 		$data['user_attendance'] = $this->Absensi_model->get_data_attendance_delay();
	// 		$data['data_holiday'] = $this->Absensi_model->getHoliday()->result_array();

	// 		$this->load->view('templates/header', $data);
	// 		$this->load->view('templates/sidebar', $data);
	// 		$this->load->view('templates/topbar', $data);
	// 		$this->load->view('operator/absensi_libur', $data);
	// 		$this->load->view('user/footer');
	// 	}
	// }

	public function editDataAbsensi($id)
	{
		$data['title'] = 'Update Data Absensi Per User';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['user_attendance'] = $this->Absensi_model->getDataAbsensiByUserId($id);
		//$data['list_data_attendance'] = $this->db->get('data_attendance')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('operator/absensi_manual', $data);
		$this->load->view('templates/footer');
	}

	public function updateUserAbsensiHadir()
	{

		$this->Absensi_model->updateAbsensiUserHadir();
		$this->session->set_flashdata('message', '<script>
           swal({
            title: "Absensi Status!",
            text: "Absensi Berhasil Di Perbarui",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
		redirect('operator/absensi_manual');
	}
	public function updateUserAbsensiSakit()
	{

		$this->Absensi_model->updateAbsensiUserSakit();
		$this->session->set_flashdata('message', '<script>
           swal({
            title: "Absensi Status!",
            text: "Absensi Berhasil Di Perbarui",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
		redirect('operator/absensi_manual');
	}
	public function updateUserAbsensiIzin()
	{

		$this->Absensi_model->updateAbsensiUserIzin();
		$this->session->set_flashdata('message', '<script>
           swal({
            title: "Absensi Status!",
            text: "Absensi Berhasil Di Perbarui",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
		redirect('operator/absensi_manual');
	}

	public function updateUserAbsensiOff()
	{

		$this->Absensi_model->updateAbsensiUserOff();
		$this->session->set_flashdata('message', '<script>
           swal({
            title: "Absensi Status!",
            text: "Absensi Berhasil Di Perbarui",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
		redirect('operator/absensi_manual');
	}

	
	public function qr($params = "", $params2 = "")
	{
		$data['title'] = 'QR Code';
		$data['qr'] = $this->db->get('qr')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		if ($params == "add") {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randstring = '';
			for ($i = 0; $i < 20; $i++) {
				$randstring = $randstring . $characters[rand(0, strlen($characters))];
			}
			$data = [
				'qr_token' => $randstring
			];
			$this->db->insert('qr', $data);
			$this->session->set_flashdata('message', '<script>
                swal({
                    title: "QR Token!",
                    text: "QR Token Berhasil Di Tambahkan",
                    icon: "success",
                    button: "Ok"
                    // timer: 3000
                    });
                    </script>');
                    
			include APPPATH . 'third_party/php-qrcode-library/qrlib.php';


			/*create folder*/
			$tempdir = "assets/qr/";
			if (!file_exists($tempdir))
				mkdir($tempdir, 0755);
			$kode = $randstring;
			$file_name = $kode . ".png";
			$file_path = $tempdir . $file_name;

			QRcode::png($kode, $file_path, "H", 12, 2);
			/* param (1)qrcontent,(2)filename,(3)errorcorrectionlevel,(4)pixelwidth,(5)margin */

			redirect('operator/qr');

		} elseif ($params == "delete") {
			$this->db->where('id', $params2);
			$this->db->delete('qr');
			$this->session->set_flashdata('message', '<script>
               swal({
                title: "QR Token!",
                text: "QR Token Berhasil Di Hapus",
                icon: "success",
                button: "Ok"
                // timer: 3000
                });
                </script>');
                
			redirect('operator/qr');
		} 
		elseif ($params == "cetak") 
		{
			//$this->db->where('id', $params2);
			$data['cetak_qr'] = $this->db->get_where('qr',['id' => $params2])->row_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/qr_code', $data);
			$this->load->view('templates/footer');
		} 
		elseif ($params == "ganti") 
		{
			$config['upload_path']          = './assets/images/qr-template/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            // $config['max_size']             = 54100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;
			// $config['file_name']			= "QR-TEMPLATE.png";

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
               redirect('operator/qr');
            }
			else{
                $data = array('upload_data' => $this->upload->data());
                $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                $file_name = $upload_data['file_name'];
                $input = [
                    'bg-qrcode'  => "assets/images/qr-template/".$file_name
					// 'bg-qrcode'  => "assets/images/qr-template/QR-TEMPLATE.png"
                ];
                $this->db->update('settings', $input);
                $this->session->set_flashdata('message', '<script>
                swal({
                   title: "Berhasil!",
                   text: "Background Berhasil diganti!",
                   icon: "success",
                   button: "Ok"
                       // timer: 3000
                   });
                   </script>');
				redirect($_SERVER['HTTP_REFERER']);
            }
		} 
		else {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('operator/qrcode', $data);
			$this->load->view('templates/footer');
		}
	}

	public function delete_date_attendance()
	{

		// Function to get all the dates in given range
function getDatesFromRange($start, $end, $format = 'Y-m-d') {
      
    // Declare an empty array
    $array = array();
      
    // Variable that store the date interval
    // of period 1 day
    $interval = new DateInterval('P1D');
  
    $realEnd = new DateTime($end);
    $realEnd->add($interval);
  
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
  
    // Use loop to store date into array
    foreach($period as $date) {                 
        $array[] = $date->format($format); 
    }
  
    // Return the array elements
    return $array;
}

		$date = getDatesFromRange($this->input->post('awal'), $this->input->post('akhir'));
		// echo $date[0]. "<br>";
		// echo count($date);
		$no = 0;
		for ($i=0; $i < count($date) ; $i++) { 
			echo $date[$i]."<br>";
			$this->db->where('date', $date[$i]);
			$this->db->delete('data_attendance');
			$data = [
				'date' => $date[$i],
				'description' => htmlspecialchars($this->input->post('description'))
			];
			$this->db->insert('data_holiday', $data);
		}

		// $date = $this->input->post('date');

		$this->session->set_flashdata('message', '<script>
           swal({
            title: "Berhasil!",
            text: "Tanggal Libur Berhasil di Tambahkan",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
		redirect('operator/libur');
	}

	public function export($params = "")
	{

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
		$alignment_center = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;

		$params = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		if (empty($params)) {
			$bulan = "Semua";
			$tanggal_awal = date($tahun.'-01-01');
            $tanggal_akhir = date($tahun.'-12-t',time());
		} else {
			$bulan = $params;

			if ($bulan == 'Januari') {
    			$tanggal_awal = date($tahun.'-01-01');
                $tanggal_akhir = date($tahun.'-01-t',time());
			} elseif ($bulan == 'Februari') {
    			$tanggal_awal = date($tahun.'-02-01');
                $tanggal_akhir = date($tahun.'-02-t',time());
			} elseif ($bulan == 'Maret') {
    			$tanggal_awal = date($tahun.'-03-01');
                $tanggal_akhir = date($tahun.'-03-t',time());
			} elseif ($bulan == 'April') {
    			$tanggal_awal = date($tahun.'-04-01');
                $tanggal_akhir = date($tahun.'-04-t',time());
			} elseif ($bulan == 'Mei') {
    			$tanggal_awal = date($tahun.'-05-01');
                $tanggal_akhir = date($tahun.'-05-t',time());
			} elseif ($bulan == 'Juni') {
    			$tanggal_awal = date($tahun.'-06-01');
                $tanggal_akhir = date($tahun.'-06-t',time());
			} elseif ($bulan == 'Juli') {
    			$tanggal_awal = date($tahun.'-07-01');
                $tanggal_akhir = date($tahun.'-07-t',time());
			} elseif ($bulan == 'Agustus') {
    			$tanggal_awal = date($tahun.'-08-01');
                $tanggal_akhir = date($tahun.'-08-t',time());
			} elseif ($bulan == 'September') {
    			$tanggal_awal = date($tahun.'-09-01');
                $tanggal_akhir = date($tahun.'-09-t',time());
			} elseif ($bulan == 'Oktober') {
    			$tanggal_awal = date($tahun.'-10-01');
                $tanggal_akhir = date($tahun.'-10-t',time());
			} elseif ($bulan == 'November') {
    			$tanggal_awal = date($tahun.'-11-01');
                $tanggal_akhir = date($tahun.'-11-t',time());
			} elseif ($bulan == 'Desember') {
    			$tanggal_awal = date($tahun.'-12-01');
                $tanggal_akhir = date($tahun.'-12-t',time());
			}
		}

		$settings = $this->db->get('settings')->row_array();
		$sheet->setCellValue('A1', "LAPORAN ABSENSI ".$settings['name']); // Set kolom A1 dengan tulisan "DATA SISWA"
		$sheet->mergeCells('A1:M1'); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$sheet->getStyle('A1')->getFont()->setSize(16); // Set font size 15 untuk kolom A1
		$sheet->setCellValue('A2', $settings['address']); // Set kolom A1 dengan tulisan "DATA SISWA"
		$sheet->mergeCells('A2:M2'); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		$sheet->getStyle('A1')->getAlignment()->setHorizontal($alignment_center);
		$sheet->getStyle('A2')->getAlignment()->setHorizontal($alignment_center);

		// Buat header tabel nya pada baris ke 3
		if ($bulan == 'Semua') {
			$sheet->setCellValue('A5', "BULAN"); // Set kolom A3 dengan tulisan "NO"
			$sheet->setCellValue('B5', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
			$sheet->setCellValue('C5', "JABATAN"); // Set kolom C3 dengan tulisan "NAMA"
			$sheet->setCellValue('D5', "TEPAT WAKTU"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
			$sheet->setCellValue('E5', "TELAT"); // Set kolom E3 dengan tulisan "TELEPON"
			$sheet->setCellValue('F5', "SAKIT"); // Set kolom F3 dengan tulisan "ALAMAT"
			$sheet->setCellValue('G5', "IZIN");
			$sheet->setCellValue('H5', "ALPHA");
			$sheet->setCellValue('I5', "ABSEN KHUSUS");
			$sheet->setCellValue('J5', "TOTAL HADIR");
			$sheet->setCellValue('K5', "TOTAL TIDAK HADIR");
			$sheet->setCellValue('L5', "PERSENTASE");
			$sheet->setCellValue('M5', "PERSENTASE DATANG TELAT");
			$sheet->setCellValue('N5', "PERSENTASE TEPAT WAKTU");
		} else {
			$sheet->setCellValue('A5', "No"); // Set kolom A3 dengan tulisan "NO"
			$sheet->setCellValue('B5', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
			$sheet->setCellValue('C5', "JABATAN"); // Set kolom C3 dengan tulisan "NAMA"
			$sheet->setCellValue('D5', "TEPAT WAKTU"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
			$sheet->setCellValue('E5', "TELAT"); // Set kolom E3 dengan tulisan "TELEPON"
			$sheet->setCellValue('F5', "SAKIT"); // Set kolom F3 dengan tulisan "ALAMAT"
			$sheet->setCellValue('G5', "IZIN");
			$sheet->setCellValue('H5', "ALPHA");
			$sheet->setCellValue('I5', "ABSEN KHUSUS");
			$sheet->setCellValue('J5', "TOTAL HADIR");
			$sheet->setCellValue('K5', "TOTAL TIDAK HADIR");
			$sheet->setCellValue('L5', "PERSENTASE");
			$sheet->setCellValue('M5', "PERSENTASE DATANG TELAT");
			$sheet->setCellValue('N5', "PERSENTASE TEPAT WAKTU");
		}

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$sheet->getStyle('A5')->applyFromArray($style_col);
		$sheet->getStyle('B5')->applyFromArray($style_col);
		$sheet->getStyle('C5')->applyFromArray($style_col);
		$sheet->getStyle('D5')->applyFromArray($style_col);
		$sheet->getStyle('E5')->applyFromArray($style_col);
		$sheet->getStyle('F5')->applyFromArray($style_col);
		$sheet->getStyle('G5')->applyFromArray($style_col);
		$sheet->getStyle('H5')->applyFromArray($style_col);
		$sheet->getStyle('I5')->applyFromArray($style_col);
		$sheet->getStyle('J5')->applyFromArray($style_col);
		$sheet->getStyle('K5')->applyFromArray($style_col);
		$sheet->getStyle('L5')->applyFromArray($style_col);
		$sheet->getStyle('M5')->applyFromArray($style_col);
		$sheet->getStyle('N5')->applyFromArray($style_col);

		// Set height baris ke 1, 2 dan 3
		$sheet->getRowDimension('1')->setRowHeight(20);
		$sheet->getRowDimension('2')->setRowHeight(20);
		$sheet->getRowDimension('3')->setRowHeight(20);
		$sheet->getRowDimension('4')->setRowHeight(20);
		$sheet->getRowDimension('5')->setRowHeight(40);

		// Buat query untuk menampilkan semua data siswa
		$data = $this->Absensi_model->getUserAllPegawaiExport()->result_array();
		if ($bulan == "semua") {
			$sheet->setCellValue('K4', "Rekap Tahun " . date($tahun)); // Set kolom A1 dengan tulisan "DATA SISWA"
			$sheet->mergeCells('K4:M4'); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('K4')->getAlignment()->setHorizontal($alignment_center);
		} else {
			$sheet->setCellValue('K4', "Rekap Bulan " . $bulan . " Tahun " . date($tahun)); // Set kolom A1 dengan tulisan "DATA SISWA"
			$sheet->mergeCells('K4:M4'); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('K4')->getAlignment()->setHorizontal($alignment_center);
		}


		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach ($data as $key => $data) { // Ambil semua data dari hasil eksekusi $sql

			if ($bulan == "Semua") {

				for ($i = 0; $i < 12; $i++) {

					$m = $i + 1;
					$tanggal_awal = date('Y') . "-" . $m . "-01";
					$tanggal_akhir = date('Y') . "-" . $m . "-31";

					// $hadir = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '1' and user_id = '".$data['id']."'"));
					// $izin = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '4' and user_id = '".$data['id']."'"));
					// $sakit = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '3' and user_id = '".$data['id']."'"));
					// $telat = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '2' and user_id = '".$data['id']."'"));
					// $alpha = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '0' and user_id = '".$data['id']."'"));


					$hadir = $this->Absensi_model->getHadirBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
					$izin = $this->Absensi_model->getIzinBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
					$sakit = $this->Absensi_model->getSakitBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
					$telat = $this->Absensi_model->getTelatBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
					$alpha = $this->Absensi_model->getAlphaBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
					$khusus = $this->db->query("SELECT * FROM data_attendance WHERE status = '6' AND date BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."' AND user_id = '".$data['id']."'")->num_rows();

					$all = $hadir + $telat + $sakit + $izin + $alpha + $khusus;
					$total_hadir = $hadir + $telat + $khusus;
					$absent = $sakit + $izin + $alpha;
					if ($all == 0) {
						$persentase = 0;
					} else {
						$persentase = number_format(($hadir + $telat + $khusus) / $all * 100);
					}

					
					$pesentase_tepat_waktu = 0;
					$persentase_telat = 0;
					if ($hadir != 0) {
						$pesentase_tepat_waktu = number_format(($hadir/$all)*100,2);
					}
					if ($telat != 0) {
						$persentase_telat = number_format(($telat/$all)*100,2);
					}


					$sheet->setCellValue('A' . $numrow, bulan_indo($m));
					$sheet->setCellValue('B' . $numrow, $data['name']);
					$sheet->setCellValue('C' . $numrow, $data['department']);
					$sheet->setCellValue('D' . $numrow, $hadir);
					$sheet->setCellValue('E' . $numrow, $telat);
					$sheet->setCellValue('F' . $numrow, $sakit);
					$sheet->setCellValue('G' . $numrow, $izin);
					$sheet->setCellValue('H' . $numrow, $alpha);
					$sheet->setCellValue('I' . $numrow, $khusus);
					$sheet->setCellValue('J' . $numrow, $total_hadir);
					$sheet->setCellValue('K' . $numrow, $absent);
					$sheet->setCellValue('L' . $numrow, $persentase . "%");
					$sheet->setCellValue('M' . $numrow, $persentase_telat . "%");
					$sheet->setCellValue('N' . $numrow, $pesentase_tepat_waktu . "%");


					// Khusus untuk no telepon. kita set type kolom nya jadi STRING
					// $sheet->setCellValue('E'.$numrow, $data['telp']);

					// $sheet->setCellValue('F'.$numrow, $data['alamat']);

					// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
					$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
					$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
					$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
					$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
					$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
					$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
					$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
					$sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
					$sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
					$sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
					$sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
					$sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
					$sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
					$sheet->getStyle('N' . $numrow)->applyFromArray($style_row);

					$sheet->getRowDimension($numrow)->setRowHeight(20);

					$numrow++;
				}
			}

			// HANYA SATU BULAN
			else {
				// $hadir = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '1' and user_id = '".$data['id']."'"));
				// $izin = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '4' and user_id = '".$data['id']."'"));
				// $sakit = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '3' and user_id = '".$data['id']."'"));
				// $telat = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '2' and user_id = '".$data['id']."'"));
				// $alpha = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '0' and user_id = '".$data['id']."'"));

				$hadir = $this->Absensi_model->getHadirBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
				$izin = $this->Absensi_model->getIzinBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
				$sakit = $this->Absensi_model->getSakitBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
				$telat = $this->Absensi_model->getTelatBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
				$alpha = $this->Absensi_model->getAlphaBulanById($data['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
				$khusus = $this->db->query("SELECT * FROM data_attendance WHERE status = '6' AND date BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."' AND user_id = '".$data['id']."'")->num_rows();

				$all = $hadir + $telat + $sakit + $izin + $alpha + $khusus;
				$total_hadir = $hadir + $telat + $khusus;
				$absent = $sakit + $izin + $alpha;
				if ($all == 0) {
					$persentase = 0;
				} else {
					$persentase = number_format(($hadir + $telat + $khusus) / $all * 100);
				}

				
				$pesentase_tepat_waktu = 0;
				$persentase_telat = 0;
				if ($hadir != 0) {
					$pesentase_tepat_waktu = number_format(($hadir/$all)*100,2);
				}
				if ($telat != 0) {
					$persentase_telat = number_format(($telat/$all)*100,2);
				}

				$sheet->setCellValue('A' . $numrow, $no++);
				$sheet->setCellValue('B' . $numrow, $data['name']);
				$sheet->setCellValue('C' . $numrow, $data['department']);
				$sheet->setCellValue('D' . $numrow, $hadir);
				$sheet->setCellValue('E' . $numrow, $telat);
				$sheet->setCellValue('F' . $numrow, $sakit);
				$sheet->setCellValue('G' . $numrow, $izin);
				$sheet->setCellValue('H' . $numrow, $alpha);
				$sheet->setCellValue('I' . $numrow, $khusus);
				$sheet->setCellValue('J' . $numrow, $total_hadir);
				$sheet->setCellValue('K' . $numrow, $absent);
				$sheet->setCellValue('L' . $numrow, $persentase . "%");
				$sheet->setCellValue('M' . $numrow, $persentase_telat . "%");
				$sheet->setCellValue('N' . $numrow, $pesentase_tepat_waktu . "%");


				// Khusus untuk no telepon. kita set type kolom nya jadi STRING
				// $sheet->setCellValue('E'.$numrow, $data['telp']);

				// $sheet->setCellValue('F'.$numrow, $data['alamat']);

				// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
				$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('N' . $numrow)->applyFromArray($style_row);

				$sheet->getRowDimension($numrow)->setRowHeight(20);
				$numrow++; // Tambah 1 setiap kali looping
			}
			$no++; // Tambah 1 setiap kali looping
		}
		$numrow++;
		// Set width kolom
		$sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$sheet->getColumnDimension('B')->setWidth(25); // Set width kolom B
		$sheet->getColumnDimension('C')->setWidth(20); // Set width kolom C
		$sheet->getColumnDimension('D')->setWidth(15); // Set width kolom D
		$sheet->getColumnDimension('E')->setWidth(8); // Set width kolom E
		$sheet->getColumnDimension('F')->setWidth(8); // Set width kolom F
		$sheet->getColumnDimension('G')->setWidth(8); // Set width kolom C
		$sheet->getColumnDimension('H')->setWidth(8); // Set width kolom D
		$sheet->getColumnDimension('I')->setWidth(15); // Set width kolom D
		$sheet->getColumnDimension('J')->setWidth(15); // Set width kolom E
		$sheet->getColumnDimension('K')->setWidth(13); // Set width kolom F
		$sheet->getColumnDimension('L')->setWidth(25); // Set width kolom F
		$sheet->getColumnDimension('M')->setWidth(25); // Set width kolom F
		$sheet->getColumnDimension('N')->setWidth(25); // Set width kolom F


		$isi_post = $this->input->post();


		$sheet->setCellValue('M' . $numrow, "Kuningan, " . tgl_indo(date('Y-m-d'))); // Set mengetahui
		$sheet->mergeCells('M' . $numrow . ':N' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('M' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1

		$numrow++;
		$sheet->setCellValue('H' . $numrow, "Mengetahui");
		$sheet->mergeCells('H' . $numrow . ':J' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('H' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		$sheet->getStyle('H' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		$numrow++;

		if (count($this->input->post('jabatan')) == '1') {
			$sheet->setCellValue('H' . $numrow, $isi_post['jabatan'][0]);
			$sheet->mergeCells('H' . $numrow . ':J' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('H' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('H' . $numrow)->getAlignment()->setHorizontal($alignment_center);
			$numrow = $numrow + 5;
			$sheet->setCellValue('H' . $numrow, $isi_post['nama'][0]);
			$sheet->mergeCells('H' . $numrow . ':J' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('H' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('H' . $numrow)->getAlignment()->setHorizontal($alignment_center);
	

		}elseif (count($isi_post['jabatan']) == '2') {
			$sheet->setCellValue('C' . $numrow, $isi_post['jabatan'][0]);
			$sheet->mergeCells('C' . $numrow . ':D' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('C' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('C' . $numrow)->getAlignment()->setHorizontal($alignment_center);
			
			$sheet->setCellValue('K' . $numrow, $isi_post['jabatan'][1]);
			$sheet->mergeCells('K' . $numrow . ':L' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('K' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('K' . $numrow)->getAlignment()->setHorizontal($alignment_center);
			$numrow = $numrow + 5;
	
			$sheet->setCellValue('C' . $numrow, $isi_post['nama'][0]);
			$sheet->mergeCells('C' . $numrow . ':D' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('C' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('C' . $numrow)->getAlignment()->setHorizontal($alignment_center);

			$sheet->setCellValue('K' . $numrow, $isi_post['nama'][1]);
			$sheet->mergeCells('K' . $numrow . ':L' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('K' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('K' . $numrow)->getAlignment()->setHorizontal($alignment_center);


		}elseif (count($isi_post['jabatan']) == '3') {
			$sheet->setCellValue('C' . $numrow, $isi_post['jabatan'][0]);
			$sheet->mergeCells('C' . $numrow . ':D' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('C' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('C' . $numrow)->getAlignment()->setHorizontal($alignment_center);
			
			$sheet->setCellValue('H' . $numrow, $isi_post['jabatan'][1]);
			$sheet->mergeCells('H' . $numrow . ':J' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('H' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('H' . $numrow)->getAlignment()->setHorizontal($alignment_center);
			
			$sheet->setCellValue('L' . $numrow, $isi_post['jabatan'][2]);
			$sheet->mergeCells('L' . $numrow . ':M' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('L' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('L' . $numrow)->getAlignment()->setHorizontal($alignment_center);
			$numrow = $numrow + 5;
	
			$sheet->setCellValue('C' . $numrow, $isi_post['nama'][0]);
			$sheet->mergeCells('C' . $numrow . ':D' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('C' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('C' . $numrow)->getAlignment()->setHorizontal($alignment_center);

			$sheet->setCellValue('H' . $numrow, $isi_post['nama'][1]);
			$sheet->mergeCells('H' . $numrow . ':J' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('H' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('H' . $numrow)->getAlignment()->setHorizontal($alignment_center);

			$sheet->setCellValue('L' . $numrow, $isi_post['nama'][1]);
			$sheet->mergeCells('L' . $numrow . ':M' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('L' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('L' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		}



		// $sheet->setCellValue('B' . $numrow, "Kasubag TU");
		// $sheet->mergeCells('B' . $numrow . ':C' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('B' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1



		// $sheet->setCellValue('J' . $numrow, "Staff Kepegawaian");
		// $sheet->mergeCells('J' . $numrow . ':L' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('J' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		// $sheet->getStyle('J' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		// $numrow = $numrow + 5;

		// $sheet->setCellValue('B' . $numrow, "Eman Arisman");
		// $sheet->mergeCells('B' . $numrow . ':C' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('B' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1


		// $sheet->setCellValue('J' . $numrow, "Sarif Priant, A.Md.");
		// $sheet->mergeCells('J' . $numrow . ':L' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('J' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		// $sheet->getStyle('J' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		// $numrow++;

		// $sheet->setCellValue('F' . $numrow, "Mengetahui");
		// $sheet->mergeCells('F' . $numrow . ':I' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('F' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		// $sheet->getStyle('F' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		// $numrow++;

		// $sheet->setCellValue('F' . $numrow, "Kepala Sekolah");
		// $sheet->mergeCells('F' . $numrow . ':I' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('F' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		// $sheet->getStyle('F' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		// $numrow = $numrow + 5;

		// $sheet->setCellValue('F' . $numrow, "Dr. H. Yepri Esa Trijaka, M.M.Pd");
		// $sheet->mergeCells('F' . $numrow . ':I' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('F' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		// $sheet->getStyle('F' . $numrow)->getAlignment()->setHorizontal($alignment_center);






		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$sheet->setTitle("Laporan Absensi Per Bulan");

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Absensi - Rekap Per Bulan '.$bulan.' '.$tahun.'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}

	public function absen_khusus($params="",$params2=""){
		if ($params=="terima") {
			$data = [
				'confirm' => '1'
			];
			$this->db->where('attendance_id', $params2);
			$this->db->update('data_attendance', $data);
			$this->session->set_flashdata('message', '<script>
               swal({
                title: "Status Berhasil!",
                text: "Absensi Khusus Berhasil di Terma",
                icon: "success",
                button: "Ok"
                // timer: 3000
                });
                </script>');
			redirect('operator/absen_khusus');
		}elseif ($params=="tolak") {
			$data = [
				'status' => '0',
				'confirm' => '1'
			];
			$this->db->where('attendance_id', $params2);
			$this->db->update('data_attendance', $data);
			$this->session->set_flashdata('message', '<script>
               swal({
                title: "Status Berhasil!",
                text: "Absensi Khusus Berhasil di Tolak",
                icon: "success",
                button: "Ok"
                // timer: 3000
                });
                </script>');
			redirect('operator/absen_khusus');
		}else{
			$data['title'] = 'ABSENSI KHUSUS ';
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['data_ketidakhadiran'] = $this->Absensi_model->getDataKetidakHadiran();
			$data['user_attendance'] = $this->Absensi_model->getDataAbsensiByUserId();
			$data['data_holiday'] = $this->Absensi_model->getHoliday()->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('operator/absensi_khusus', $data);
			$this->load->view('user/footer');
		}
	}

	function data_absen_khusus()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$query  = "SELECT data_attendance.*, user.name FROM data_attendance JOIN user ON data_attendance.user_id = user.id";
		// $query  = "SELECT * FROM ketidakhadiran";

		$search = array('name', 'time_in', 'attendance_id');
		// $where  = null; 
		$where  = array(
			'data_attendance.date' => $curr_date,
			'data_attendance.confirm' => '0',
			'data_attendance.status' => '6'
		);
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
	}

	function jarak(){
		$data['title'] = 'Pengaturan Jarak Absensi';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['jarak_absen'] = $this->db->get('data_jarak')->result_array();
		$data['jarak_aktif'] = $this->db->get_where('data_jarak', ['status' => 1])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('operator/jarak', $data);
		$this->load->view('templates/footer');
	}

	function absen_pusat($params=""){
		if ($params=='cek') {
			$hasil_scan = $this->input->post('qr');
			$today = date('D');
			// $scan = $this->db->query("SELECT * FROM qr where qr_token = '" . $hasil_scan . "'")->num_rows();
			$scan = $this->db->query("SELECT * FROM user WHERE id = '".$hasil_scan."'")->num_rows();
			if ($scan == 1) {
				$data['title'] = 'Absensi Pusat';
				$data['user'] = $this->db->get_where('user', ['id' => $this->input->post('qr')])->row_array();
				$data['user_id'] = $hasil_scan;
				$this->load->view('templates/header', $data);
				$this->load->view('scan/absen_pusat', $data);
				// $this->load->view('templates/footer-pusat');
				// $this->load->view('templates/header', $data);
				// $this->load->view('templates/sidebar', $data);
				// $this->load->view('templates/topbar', $data);
				$this->load->view('templates/footer-pusat');
			} elseif ($scan == 0) {
				// $this->session->set_flashdata('message_absen', '<div class="alert alert-danger" role="danger">Qr tidak valid</div>');
				$this->session->set_flashdata('message', 
				'<script>
					swal({
						title: "QR Code Status",
						text: "QR Token Tidak Valid",
						icon: "error",
						button: "Ok",
						timer: 2000
					});
				</script>');
				// redirect('operator/absen_pusat');
				echo $hasil_scan;
			}
		}else{
			$data['title'] = 'ABSENSI PUSAT';
			$data['laporan'] = $this->db->query("
			SELECT data_attendance.user_id, data_attendance.status, data_attendance.time_in, data_picture.image , data_attendance.time_out
			FROM data_attendance 
			INNER JOIN data_picture ON data_picture.data_attendance = data_attendance.attendance_id 
			WHERE data_attendance.date = '".date('Y-m-d')."'")->result_array();
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$this->load->view('templates/header-pusat', $data);
			$this->load->view('scan/scan_pusat', $data);
			$this->load->view('templates/footer-pusat');
			// $this->load->view('templates/sidebar');
			// $this->load->view('templates/topbar');
			// $this->load->view('templates/footer');
		}
	}
	

	public function absen($user_id="")
	{

		$hasil_scan = $user_id;
		$today = date('D');
		// $scan = $this->db->query("SELECT * FROM qr where qr_token = '" . $hasil_scan . "'")->num_rows();
		$scan = $this->db->query("SELECT * FROM user WHERE id = '".$hasil_scan."'")->num_rows();
		if ($scan == 1) {
				$this->Absensi_model->absen_pusat($user_id);
		} elseif ($scan == 0) {
			// $this->session->set_flashdata('message_absen', '<div class="alert alert-danger" role="danger">Qr tidak valid</div>');
			$this->session->set_flashdata('message', 
			'<script>
				swal({
					title: "QR Code Status",
					text: "QR Token Tidak Valid",
					icon: "error",
					button: "Ok",
					timer: 2000
				});
            </script>');
			redirect('operator/absen_pusat');
		}
	}




	public function laporan_absen_pusat($params = "", $params2 = "")
	{
		$data['title'] = 'Laporan Absensi Pusat';
		$data['laporan'] = $this->db->query("
		SELECT data_attendance.user_id, data_attendance.status, data_attendance.time_in, data_picture.image , data_attendance.time_out
		FROM data_attendance 
		INNER JOIN data_picture ON data_picture.data_attendance = data_attendance.attendance_id 
		WHERE data_attendance.date = '".date('Y-m-d')."'")->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('operator/laporan_absen_pusat', $data);
		$this->load->view('templates/footer');
		
	}



	public function export_harian($params = "")
	{
		$isi_post = $this->input->post();
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
		$alignment_center = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;

		
		
		$settings = $this->db->get('settings')->row_array();
		$sheet->setCellValue('A1', "LAPORAN ABSENSI ".$settings['name']); // Set kolom A1 dengan tulisan "DATA SISWA"
		$sheet->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$sheet->getStyle('A1')->getFont()->setSize(16); // Set font size 15 untuk kolom A1
		$sheet->setCellValue('A2', $settings['address']); // Set kolom A1 dengan tulisan "DATA SISWA"
		$sheet->mergeCells('A2:F2'); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		$sheet->getStyle('A1')->getAlignment()->setHorizontal($alignment_center);
		$sheet->getStyle('A2')->getAlignment()->setHorizontal($alignment_center);

		// Buat header tabel nya pada baris ke 3
	
			$sheet->setCellValue('A5', "No"); // Set kolom A3 dengan tulisan "NO"
			$sheet->setCellValue('B5', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
			$sheet->setCellValue('C5', "JABATAN"); // Set kolom C3 dengan tulisan "NAMA"
			$sheet->setCellValue('D5', "Tanggal"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
			$sheet->setCellValue('E5', "JAM MASUK"); // Set kolom E3 dengan tulisan "TELEPON"
			$sheet->setCellValue('F5', "STATUS");
		

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$sheet->getStyle('A5')->applyFromArray($style_col);
		$sheet->getStyle('B5')->applyFromArray($style_col);
		$sheet->getStyle('C5')->applyFromArray($style_col);
		$sheet->getStyle('D5')->applyFromArray($style_col);
		$sheet->getStyle('E5')->applyFromArray($style_col);
		$sheet->getStyle('F5')->applyFromArray($style_col);

		// Set height baris ke 1, 2 dan 3
		$sheet->getRowDimension('1')->setRowHeight(20);
		$sheet->getRowDimension('2')->setRowHeight(20);
		$sheet->getRowDimension('3')->setRowHeight(20);
		$sheet->getRowDimension('4')->setRowHeight(20);

		// Buat query untuk menampilkan semua data siswa



		if ($isi_post['status'] == "") {
			$data = $this->db->query("SELECT user.name, user.department, data_attendance.status, data_attendance.date, data_attendance.time_in 
			FROM `data_attendance` INNER JOIN user ON user.id = data_attendance.user_id 
			WHERE data_attendance.date BETWEEN '".$isi_post['awal']."' AND '".$isi_post['akhir']."'")->result_array();
		}else{
			$data = $this->db->query("SELECT user.name, user.department, data_attendance.status, data_attendance.date, data_attendance.time_in 
			FROM `data_attendance` INNER JOIN user ON user.id = data_attendance.user_id 
			WHERE data_attendance.date BETWEEN '".$isi_post['awal']."' AND '".$isi_post['akhir']."' AND data_attendance.status = '".$isi_post['status']."'")->result_array();
		}
		
		
		
			$sheet->setCellValue('D4', "Rekap Tanggal : " . tgl_indo($isi_post['awal'])." s/d ".tgl_indo($isi_post['akhir'])); // Set kolom A1 dengan tulisan "DATA SISWA"
			$sheet->mergeCells('D4:F4'); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('D4')->getAlignment()->setHorizontal($alignment_center);
	

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach ($data as $key => $data) { // Ambil semua data dari hasil eksekusi $sql

				// $hadir = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '1' and user_id = '".$data['id']."'"));
				// $izin = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '4' and user_id = '".$data['id']."'"));
				// $sakit = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '3' and user_id = '".$data['id']."'"));
				// $telat = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '2' and user_id = '".$data['id']."'"));
				// $alpha = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '0' and user_id = '".$data['id']."'"));
				$status = "";
				if ($data['status'] == '0') {
					$status = 'Tidak Scan QR';
				}elseif ($data['status'] == '1') {
					$status = 'Hadir Tepat Waktu';
				}elseif ($data['status'] == '2') {
					$status = 'Hadir Telat';
				}elseif ($data['status'] == '3') {
					$status = 'Sakit';
				}elseif ($data['status'] == '4') {
					$status = 'Izin';
				}elseif ($data['status'] == '5') {
					$status = 'Off';
				}elseif ($isi_post['status'] == '6') {
					$data_sortir_status = 'Hadir Konfirmasi';
				}

				$sheet->setCellValue('A' . $numrow, $no++);
				$sheet->setCellValue('B' . $numrow, $data['name']);
				$sheet->setCellValue('C' . $numrow, $data['department']);
				$sheet->setCellValue('D' . $numrow, $data['date']);
				$sheet->setCellValue('E' . $numrow, $data['time_in']);
				$sheet->setCellValue('F' . $numrow, $status);


				// Khusus untuk no telepon. kita set type kolom nya jadi STRING
				// $sheet->setCellValue('E'.$numrow, $data['telp']);

				// $sheet->setCellValue('F'.$numrow, $data['alamat']);

				// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
				$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);

				$sheet->getRowDimension($numrow)->setRowHeight(20);
				$numrow++; // Tambah 1 setiap kali looping
			
			$no++; // Tambah 1 setiap kali looping
		}
		$numrow++;
		// Set width kolom
		$sheet->getColumnDimension('A')->setWidth(15); // Set width kolom A
		$sheet->getColumnDimension('B')->setWidth(25); // Set width kolom B
		$sheet->getColumnDimension('C')->setWidth(20); // Set width kolom C
		$sheet->getColumnDimension('D')->setWidth(15); // Set width kolom D
		$sheet->getColumnDimension('E')->setWidth(15); // Set width kolom E
		$sheet->getColumnDimension('F')->setWidth(20); // Set width kolom F




		$numrow++;


		
		$isi_post = $this->input->post();


		$tanggal_sekarang = date('Y-m-d');
		$sheet->setCellValue('D' . $numrow, "Kuningan, " . tgl_indo($tanggal_sekarang)); // Set mengetahui
		$sheet->mergeCells('D' . $numrow . ':F' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('D' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		$sheet->getStyle('D' . $numrow)->getAlignment()->setHorizontal($alignment_center);

		$numrow++;
		$sheet->setCellValue('C' . $numrow, "Mengetahui");
		$sheet->mergeCells('C' . $numrow . ':D' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('C' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		$sheet->getStyle('C' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		$numrow++;

		if (count($this->input->post('jabatan')) == '1') {
			$sheet->setCellValue('C' . $numrow, $isi_post['jabatan'][0]);
			$sheet->mergeCells('C' . $numrow . ':D' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('C' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('C' . $numrow)->getAlignment()->setHorizontal($alignment_center);
			$numrow = $numrow + 5;
			$sheet->setCellValue('C' . $numrow, $isi_post['nama'][0]);
			$sheet->mergeCells('C' . $numrow . ':D' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('C' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('C' . $numrow)->getAlignment()->setHorizontal($alignment_center);
	

		}elseif (count($isi_post['jabatan']) == '2') {
			$sheet->setCellValue('A' . $numrow, $isi_post['jabatan'][0]);
			$sheet->mergeCells('A' . $numrow . ':B' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('A' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('A' . $numrow)->getAlignment()->setHorizontal($alignment_center);
			
			$sheet->setCellValue('E' . $numrow, $isi_post['jabatan'][1]);
			$sheet->mergeCells('E' . $numrow . ':F' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('E' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('E' . $numrow)->getAlignment()->setHorizontal($alignment_center);
			$numrow = $numrow + 5;
	
			$sheet->setCellValue('A' . $numrow, $isi_post['nama'][0]);
			$sheet->mergeCells('A' . $numrow . ':B' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('A' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('A' . $numrow)->getAlignment()->setHorizontal($alignment_center);

			$sheet->setCellValue('E' . $numrow, $isi_post['nama'][1]);
			$sheet->mergeCells('E' . $numrow . ':F' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('E' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('E' . $numrow)->getAlignment()->setHorizontal($alignment_center);


		}elseif (count($isi_post['jabatan']) == '3') {
			$sheet->setCellValue('A' . $numrow, $isi_post['jabatan'][0]);
			$sheet->mergeCells('A' . $numrow . ':B' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('A' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('A' . $numrow)->getAlignment()->setHorizontal($alignment_center);
			
			$sheet->setCellValue('C' . $numrow, $isi_post['jabatan'][1]);
			$sheet->mergeCells('C' . $numrow . ':D' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('C' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('C' . $numrow)->getAlignment()->setHorizontal($alignment_center);
			
			$sheet->setCellValue('E' . $numrow, $isi_post['jabatan'][2]);
			$sheet->mergeCells('E' . $numrow . ':F' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('E' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('E' . $numrow)->getAlignment()->setHorizontal($alignment_center);
			$numrow = $numrow + 5;
	
			$sheet->setCellValue('A' . $numrow, $isi_post['nama'][0]);
			$sheet->mergeCells('A' . $numrow . ':B' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('A' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('A' . $numrow)->getAlignment()->setHorizontal($alignment_center);

			$sheet->setCellValue('C' . $numrow, $isi_post['nama'][1]);
			$sheet->mergeCells('C' . $numrow . ':D' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('C' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('C' . $numrow)->getAlignment()->setHorizontal($alignment_center);

			$sheet->setCellValue('E' . $numrow, $isi_post['nama'][1]);
			$sheet->mergeCells('E' . $numrow . ':F' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('E' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
			$sheet->getStyle('E' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		}



		// $sheet->setCellValue('A' . $numrow, "Kasubag TU");
		// $sheet->mergeCells('A' . $numrow . ':B' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('A' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		// $sheet->getStyle('A' . $numrow)->getAlignment()->setHorizontal($alignment_center);



		// $sheet->setCellValue('E' . $numrow, "Staff Kepegawaian");
		// $sheet->mergeCells('E' . $numrow . ':F' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('E' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		// $sheet->getStyle('E' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		// $numrow = $numrow + 5;

		// $sheet->setCellValue('A' . $numrow, "Eman Arisman");
		// $sheet->mergeCells('A' . $numrow . ':B' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('A' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		// $sheet->getStyle('A' . $numrow)->getAlignment()->setHorizontal($alignment_center);


		// $sheet->setCellValue('E' . $numrow, "Sarif Priant, A.Md.");
		// $sheet->mergeCells('E' . $numrow . ':F' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('E' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		// $sheet->getStyle('E' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		// $numrow++;

		// $sheet->setCellValue('C' . $numrow, "Mengetahui");
		// $sheet->mergeCells('C' . $numrow . ':D' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('C' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		// $sheet->getStyle('C' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		// $numrow++;

		// $sheet->setCellValue('C' . $numrow, "Kepala Sekolah");
		// $sheet->mergeCells('C' . $numrow . ':D' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('C' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		// $sheet->getStyle('C' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		// $numrow = $numrow + 5;

		// $sheet->setCellValue('C' . $numrow, "Dr. H. Yepri Esa Trijaka, M.M.Pd");
		// $sheet->mergeCells('C' . $numrow . ':D' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		// $sheet->getStyle('C' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		// $sheet->getStyle('C' . $numrow)->getAlignment()->setHorizontal($alignment_center);




		        if ($isi_post['status'] == '0') {
					$data_sortir_status = 'Tidak Scan QR';
				}elseif ($isi_post['status'] == '1') {
					$data_sortir_status = 'Hadir Tepat Waktu';
				}elseif ($isi_post['status'] == '2') {
					$data_sortir_status = 'Hadir Telat';
				}elseif ($isi_post['status'] == '3') {
					$data_sortir_status = 'Sakit';
				}elseif ($isi_post['status'] == '4') {
					$data_sortir_status = 'Izin';
				}elseif ($isi_post['status'] == '5') {
					$data_sortir_status = 'Off';
				}elseif ($isi_post['status'] == '6') {
					$data_sortir_status = 'Hadir Konfirmasi';
				}else{
				    $data_sortir_status = "Semua Status";
				}


		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$judul = "Status".$data_sortir_status;
		$sheet->setTitle("Laporan Absensi Harian");

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Absensi - Rekap Harian (Status : '.$data_sortir_status.').xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}
	
	public function change_maps_enabled($params=""){
	    $data = [
	        'maps_enabled' => $params
	    ];
	    $this->db->update('settings', $data);
	    $this->session->set_flashdata('message', 
			'<script>
				swal({
					title: "Berhasil",
					text: "Status Map Berhasil di Perbaharui!",
					icon: "success",
					button: "Ok",
					timer: 2000
				});
            </script>');
		redirect('admin/settings');
	}

	
	public function change_uuid_enabled($params=""){
	    $data = [
	        'uuid_enabled' => $params
	    ];
	    $this->db->update('settings', $data);
	    $this->session->set_flashdata('message', 
			'<script>
				swal({
					title: "Berhasil",
					text: "Status Uuid Berhasil di Perbaharui!",
					icon: "success",
					button: "Ok",
					timer: 2000
				});
            </script>');
		redirect('admin/settings');
	}





	}



