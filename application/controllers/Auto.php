<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auto extends CI_controller
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
        $data['title'] = 'AUTO INSERT DATA ATTENDANCE';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['user_data'] = $this->Absensi_model->getDataPegawai()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('auto/index', $data);
        $this->load->view('templates/footer');
    }

	function data_attendance()
	{
		$query  = "SELECT * FROM user";
		$search = array('name', 'email', 'phone', 'gender', 'id');
		$where  = null; 
		// $where  = array('role_id' => '6');

		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_query_auto($query, $search, $where, $isWhere);
	}

    public function insertDataAttendance()
    {
        $cek = $this->db->get_where('data_holiday', ['date' => date('Y-m-d')])->num_rows();
        if ($cek==0) {
            $this->Absensi_model->insertDataAttendance();
        }
        redirect('Auto/');
    }

    public function insertDataAttendanceByDate($date="")
    {
        $cek = $this->db->get_where('data_holiday', ['date' => $date])->num_rows();
        if ($cek==0) {
            $this->Absensi_model->insertDataAttendanceByDate($date);
        }
        redirect('Auto/');
    }

    public function test  (){
    $message = "wrong answer";
    echo "<script type='text/javascript'>alert('$message');</script>";
    }

    public function manual($user_id){
        $date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		$time_in = "00:00:00";
		$time_break = "00:00:00";
		$time_out = "00:00:00";
		$latlong = "-6.9530251697747545, 108.46944914599598";
		$location = "belum ada lokasi";
		$status = "0";
		$data = [
            'user_id' => $user_id,
			'date' => $curr_date,
			'time_in' => $time_in,
			'time_break' => $time_break,
			'time_out' => $time_out,
			'latlong' => $latlong,
			'location' => $location,
			'status' => $status
        ];
		$this->db->insert('data_attendance', $data);
        $message = "Selesai";
        echo "<script type='text/javascript'>alert('$message');</script>";
        redirect('Auto/');
		
    }
    

}
