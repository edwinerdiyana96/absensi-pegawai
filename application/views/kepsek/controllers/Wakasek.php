<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wakasek extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
        $this->load->model('Admin_model');
        $this->load->model('Absensi_model');

        // $cek = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->num_rows();
        // if ( $cek == 0) {
        //     redirect('auth');
        // }

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
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kepsek/index', $data);
        $this->load->view('templates/footer');
    }



    
}
