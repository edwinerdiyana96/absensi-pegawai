<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rank extends CI_controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->model('Absensi_model');
		$this->load->model('M_Datatables');
		
$cek = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->num_rows();
if ( $cek == 0) {
    redirect('auth');
}
	}

	public function index()
	{
		date_default_timezone_set("Asia/Jakarta");
		$bulan_sekarang = date("Y-m");
		$data['title'] = 'DAFTAR RANKING KEHADIRAN PEGAWAI';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['user_id'] = $this->input->post('id');
		$data['ranking'] = $this->Absensi_model->getDataAttendanceRank();
		$data['rank'] = $this->db->query("SELECT distinct(rank_attendance.user_id), user.* FROM rank_attendance JOIN user ON rank_attendance.user_id = user.id WHERE date LIKE '".$bulan_sekarang."-%'")->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('rank/index', $data);
		$this->load->view('templates/footer');
	}

	function data_rekap_harian_rank()
	{
		date_default_timezone_set("Asia/Jakarta");
		$query  = "SELECT * FROM data_attendance JOIN user ON data_attendance.user_id = user.id";
		$search = array('attendance_id', 'user_id', 'name', 'date', 'time_in', 'status', 'description');
		// $where  = null; 
		$where  = array(
			'date' => date("Y-m-d"),
			'status' => '1'
		);

		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
	}

	public function insertDataAttendanceRank()
    {
        $this->Absensi_model->insertDataAttendanceRank();
        redirect('rank/');
    }

}
