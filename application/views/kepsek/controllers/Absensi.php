<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->model('Absensi_model');
		$this->load->model('M_Datatables');

		// $cek = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->num_rows();
		// if ( $cek == 0) {
		//     redirect('auth');
		// }
	}

	// public function rekap($params = "", $params2 = "")
	// {
	// 	if ($params == "filter") {
	// 		$data['title'] = "Rekap Absen";
	// 		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

	// 		$data['bulan'] = array(
	// 			'0' => 'Januari',
	// 			'1' => 'Februari',
	// 			'2' => 'Maret',
	// 			'3' => 'April',
	// 			'4' => 'Mei',
	// 			'5' => 'Juni',
	// 			'6' => 'Juli',
	// 			'7' => 'Agustus',
	// 			'8' => 'September',
	// 			'9' => 'Oktober',
	// 			'10' => 'November',
	// 			'11' => 'Desember',
	// 		);

	// 		$data['filter'] = $this->input->post('filter');
	// 		$data['row_absen'] = $this->Absensi_model->getAbsensi()->result_array();
	// 		$data['data_pegawai'] = $this->Admin_model->getPegawai()->result_array();
	// 		$data['data_absensi'] = $this->Absensi_model->getAbsensiByDate($data['filter']);
	// 		$this->load->view('templates/header', $data);
	// 		$this->load->view('templates/sidebar', $data);
	// 		$this->load->view('templates/topbar', $data);
	// 		$this->load->view('rekap/index', $data);
	// 		$this->load->view('templates/footer');
	// 	} else {
	// 		$data['title'] = "Rekap Absen";
	// 		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

	// 		$data['bulan'] = array(
	// 			'0' => 'Januari',
	// 			'1' => 'Februari',
	// 			'2' => 'Maret',
	// 			'3' => 'April',
	// 			'4' => 'Mei',
	// 			'5' => 'Juni',
	// 			'6' => 'Juli',
	// 			'7' => 'Agustus',
	// 			'8' => 'September',
	// 			'9' => 'Oktober',
	// 			'10' => 'November',
	// 			'11' => 'Desember',
	// 		);
	// 		$data['filter'] = date('Y-m-d');
	// 		$data['row_absen'] = $this->Absensi_model->getAbsensi()->result_array();
	// 		$data['data_pegawai'] = $this->Admin_model->getPegawai()->result_array();
	// 		$data['data_absensi'] = $this->Absensi_model->getAbsensiToday();
	// 		$this->load->view('templates/header', $data);
	// 		$this->load->view('templates/sidebar', $data);
	// 		$this->load->view('templates/topbar', $data);
	// 		$this->load->view('rekap/index', $data);
	// 		$this->load->view('templates/footer');
	// 	}
	// }

	public function save_capture($user_id="")
	{
		$image = $this->input->post('image');
        $image = str_replace('data:image/jpeg;base64,','', $image);
        $image = base64_decode($image);
        $filename = 'image_'.time().'.png';
        file_put_contents(FCPATH.'/uploads/'.$filename,$image);

		$data_attendance = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '".$user_id."' AND date = '".date('Y-m-d')."'")->row_array();
		$cek_data_picture = $this->db->query("SELECT * FROM data_picture WHERE data_attendance = '".$data_attendance['attendance_id']."'")->num_rows();
		$insert = array(
			'data_attendance' => $data_attendance['attendance_id'],
			'image' => $filename
		);
		if ($cek_data_picture == 0) {
			$this->db->insert('data_picture',$insert);
		}else{
			$this->db->where('data_attendance', $data_attendance['attendance_id']);
			$this->db->update('data_picture',$insert);
		}
	}

	public function rekap($params = "")
	{
		$data['title'] = 'REKAP ABSENSI';
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

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('rekap/index2', $data);
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

	public function addTime()
	{
		$time_schedule = $this->input->post('time_schedule');
		$time_start = $this->input->post('time_start');
		$time_end = $this->input->post('time_end');

		$data = [
			'time_schedule' => $time_schedule,
			'time_start' => $time_start,
			'time_end' => $time_end
		];
		$this->Absensi_model->addnewTime($data);
		$this->session->set_flashdata('message', '<script>
                     swal({
                title: "Jam Absen!",
                text: "Jam Berhasil Ditambahkan",
                icon: "success",
                button: "Ok"
                // timer: 3000
            });
                </script>');
		redirect('operator/jam_absen');
	}

	public function editTime($id)
	{
		$data['title'] = 'Update Absensi';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['jam_absen_id'] = $this->Absensi_model->getTimeId($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('operator/edit-time', $data);
		$this->load->view('templates/footer');
	}


	public function updateTime()
	{
		$this->Absensi_model->updateTime();
		$this->session->set_flashdata('message', '<script>
                     swal({
                title: "Jam Absen!",
                text: "Jam Berhasil Diperbaharui",
                icon: "success",
                button: "Ok"
                // timer: 3000
            });
                </script>');
		redirect('operator/jam_absen');
	}

	public function deleteTime($id)
	{
		$this->Absensi_model->deleteTimeAttendace($id);

		$this->session->set_flashdata('message', '<script>
                     swal({
                title: "Jam Absen!",
                text: "Jam Berhasil Dihapus",
                icon: "success",
                button: "Ok"
                // timer: 3000
            });
                </script>');
		redirect('operator/jam_absen');
	}



	public function addJarak()
	{
		$jarak =  $this->input->post('jarak');
		$status = $this->input->post('status');

		$data = [
			'jarak' => $jarak,
			'status' => $status
		];
		$this->Absensi_model->addnewJarak($data);
		$this->session->set_flashdata('message', '<script>
                     swal({
                title: "Jarak Absen!",
                text: "Jarak Berhasil Ditambahkan",
                icon: "success",
                button: "Ok"
                // timer: 3000
            });
                </script>');
		redirect('operator/jarak');
	}

	public function deleteJarak($id)
	{
		$this->Absensi_model->deleteJarak($id);

		$this->session->set_flashdata('message', '<script>
                     swal({
                title: "Jarak Absen!",
                text: "Jarak Absen Berhasil Dihapus",
                icon: "success",
                button: "Ok"
                // timer: 3000
            });
                </script>');
		redirect('operator/jarak');
	}



	public function editJarak($id)
	{
		$data['title'] = 'Update Jarak';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['jarak_id'] = $this->Absensi_model->getJarakId($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('operator/edit-jarak', $data);
		$this->load->view('templates/footer');
	}


	public function updateJarak()
	{
		$this->Absensi_model->updateJarak();
		$this->session->set_flashdata('message', '<script>
                     swal({
                title: "Jarak Absen!",
                text: "Jarak Berhasil Diperbaharui",
                icon: "success",
                button: "Ok"
                // timer: 3000
            });
                </script>');
		redirect('operator/jarak');
	}





}
