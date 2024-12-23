<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

class Telegram extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
        $this->load->model('Admin_model');
        $this->load->model('Absensi_model');
		$this->load->model('M_Datatables');
        


        function RemoveSpecialChar($str)
        {
            $res = preg_replace('/[\;\" "\:\}\{]+/', ' ', $str);
            return $res;
        }
    
        function ReplaceKoma($strKoma)
        {
            $res = preg_replace('/[,]+/', '', $strKoma);
            return $res;
        }


        function tanggal_indo($tanggal, $cetak_hari = false)
        {
            $hari = array(
                1 =>    'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu'
            );

            $bulan = array(
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $split       = explode('-', $tanggal);
            $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

            if ($cetak_hari) {
                $num = date('N', strtotime($tanggal));
                return $hari[$num] . ', ' . $tgl_indo;
            }
            return $tgl_indo;
        }
    
    }

    
   

    public function index()
    {
        $data['title'] = 'KIRIM KE TELEGRAM';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user_data'] = $this->Absensi_model->getDataPegawai()->result_array();
        $data['total_pegawai'] = $this->Absensi_model->getDataPegawai()->num_rows();
        $data['total_hadir_hari_ini'] = $this->Absensi_model->getAttendanceToday()->num_rows();
        $data['total_tidak_hadir_hari_ini'] = $this->Absensi_model->getCountNotAttendanceToday()->num_rows();
        $data['tidak_hadir_hari_ini'] = $this->Absensi_model->getNotAttendanceToday();
        $data['total_terlambat'] = $this->Absensi_model->getLateAttendanceToday()->num_rows();
        $data['terlambat'] = $this->Absensi_model->getLateAttendanceToday()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('telegram/index', $data);
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
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
	}

    public function insertDataAttendance()
    {
        $this->Absensi_model->insertDataAttendance();
        redirect('Telegram/');
    }

	public function sendRekapTelegram()
    {
        $settings = $this->db->get('settings')->row_array();
        // $enter = " \n";
        $enter = " " . chr(10);
        $garis = "------------------------------------------------------";
        $info =  "[PESAN OTOMATIS] - ";
        $date = tanggal_indo(date('Y-m-d'), true) . $enter;
        
		$total_hadir = "*Total Hadir: " . $data['total_hadir_hari_ini'] = $this->Absensi_model->getAttendanceToday()->num_rows() . $enter;
        $total_terlambat = "*Total Terlambat: " . $data['total_terlambat'] = $this->Absensi_model->getLateAttendanceToday()->num_rows() . $enter;
        $total_tidak_hadir = "*Total Tidak Hadir: " . $data['total_tidak_hadir_hari_ini'] = $this->Absensi_model->getCountNotAttendanceToday()->num_rows() . $enter;
        
		$title1 = "Guru / Pegawai Yang Belum Hadir / Scan:".$enter;
		$title2 = "Guru / Pegawai Yang Sakit:".$enter;
		$title3 = "Guru / Pegawai Yang Izin:".$enter;
		$title4 = "Guru / Pegawai Yang Off:".$enter;

		$data['belum_hadir_hari_ini'] = $this->Absensi_model->getBeforeAttendanceToday()->result_array();
		$data['sakit_hari_ini'] = $this->Absensi_model->getSickAttendanceToday()->result_array();
		$data['izin_hari_ini'] = $this->Absensi_model->getPermitAttendanceToday()->result_array();
		$data['off_hari_ini'] = $this->Absensi_model->getOffAttendanceToday()->result_array();

        $arr_belum = []; //create empty array belum hadir
		$arr_sakit = []; //create empty array sakit
		$arr_izin = []; //create empty array izin
		$arr_off = []; //create empty array off

        date_default_timezone_set("Asia/Jakarta");
        $time = date('H.i.s');

        foreach ($data['belum_hadir_hari_ini'] as $key => $bh) {
            $no = $key + 1;
            $arr_belum[] = array(
                '' => $no,
                '.' => '',
                '.' => $bh['name'] . $enter
            ); //assign each sub-array to the newly created array
        }
		foreach ($data['sakit_hari_ini'] as $key => $s) {
            $no = $key + 1;
            $arr_sakit[] = array(
                '' => $no,
                '.' => '',
                '.' => $s['name'],
                '(' => $s['description'],
                ')' => $enter
            ); //assign each sub-array to the newly created array
        }
		foreach ($data['izin_hari_ini'] as $key => $i) {
            $no = $key + 1;
            $arr_izin[] = array(
                '' => $no,
                '.' => '',
                '.' => $i['name'],
                '(' => $i['description'],
                ')' => $enter
            ); //assign each sub-array to the newly created array
        }
		foreach ($data['off_hari_ini'] as $key => $i) {
            $no = $key + 1;
            $arr_off[] = array(
                '' => $no,
                '.' => '',
                '.' => $i['name'],
                '(' => $i['description'],
                ')' => $enter
            ); //assign each sub-array to the newly created array
        }

        $json_belum = json_encode($arr_belum);
		$json_sakit = json_encode($arr_sakit);
		$json_izin = json_encode($arr_izin);
		$json_off = json_encode($arr_off);
        

        $str_belum = $json_belum;
		$str_sakit = $json_sakit;
		$str_izin = $json_izin;
		$str_off = $json_off;

        $str1_belum = RemoveSpecialChar($str_belum);
        $str2_belum = ReplaceKoma($str1_belum);
		$str1_sakit = RemoveSpecialChar($str_sakit);
        $str2_sakit = ReplaceKoma($str1_sakit);
		$str1_izin = RemoveSpecialChar($str_izin);
        $str2_izin = ReplaceKoma($str1_izin);
		$str1_off = RemoveSpecialChar($str_off);
        $str2_off = ReplaceKoma($str1_off);

        $str2_belum = str_replace('[', ' ', $str2_belum);
        $str2_belum = str_replace(']', ' ', $str2_belum);
        $str2_belum = str_replace('\n', '
', $str2_belum);
		$str2_sakit = str_replace('[', ' ', $str2_sakit);
        $str2_sakit = str_replace(']', ' ', $str2_sakit);
        $str2_sakit = str_replace('\n', '
', $str2_sakit);
		$str2_izin = str_replace('[', ' ', $str2_izin);
        $str2_izin = str_replace(']', ' ', $str2_izin);
        $str2_izin = str_replace('\n', '
', $str2_izin);
		$str2_off = str_replace('[', ' ', $str2_off);
        $str2_off = str_replace(']', ' ', $str2_off);
        $str2_off = str_replace('\n', '
', $str2_off);
        
        $cainfo = "https://test.smkkarnas.net/cacert.pem";

        // $api = 'https://api.telegram.org/bot5066295791:AAF_kbJLXtZMcgp9Km_uSOJj6AyZ5PF6jOg/sendMessage?chat_id=-1001617026948&text='.urlencode($info . $date . $total_hadir . $total_terlambat . $total_tidak_hadir . $garis . $enter . $title1 . $str2_belum . $garis . $enter . $title2 . $str2_sakit .$garis . $enter . $title3 . $str2_izin .$garis . $enter . $title4 . $str2_off).'';
        $api = 'https://api.telegram.org/'.$settings['bot_telegram'].':'.$settings['token_telegram'].'/sendMessage?chat_id=-'.$settings['chat_id_telegram'].'&text='.urlencode($info . $date . $total_hadir . $total_terlambat . $total_tidak_hadir . $garis . $enter . $title1 . $str2_belum . $garis . $enter . $title2 . $str2_sakit .$garis . $enter . $title3 . $str2_izin .$garis . $enter . $title4 . $str2_off).'';
        
        $ch = curl_init($api);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CAINFO, $cainfo);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($date));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_2TLS");
        curl_setopt($ch, CURLOPT_SSLVERSION, "CURL_SSLVERSION_TLSv1_2");
        $result = curl_exec($ch);
        curl_close($ch);

        var_dump($api);
        
        redirect($_SERVER['HTTP_REFERER']);
        
    }
    
    public function sendTerlambatTelegram()
    {
        $settings = $this->db->get('settings')->row_array();
        $data['terlambat'] = $this->Absensi_model->getLateAttendanceToday()->result_array();
       
        
         // $enter = " \n";
        $enter = " " . chr(10);
        $garis = "--------------------------------";
        $info =  "[PESAN OTOMATIS] - ";
        $date = tanggal_indo(date('Y-m-d'), true) . $enter;
        $title = "Guru / Pegawai Yang Terlambat (Realtime):".$enter;
        
        // $total_hadir = "*Total Yang Hadir: " . $data['total_hadir_hari_ini'] = $this->Absensi_model->getAttendanceToday()->num_rows() . $enter;
        // $total_terlambat = "*Total Terlambat: " . $data['total_terlambat'] = $this->Absensi_model->getLateAttendanceToday()->num_rows() . $enter;
        // $total_tidak_hadir = "*Total Tidak Hadir: " . $data['total_tidak_hadir_hari_ini'] = $this->Absensi_model->getCountNotAttendanceToday()->num_rows() . $enter;
        // $terlambat = $data['terlambat'] = $this->Absensi_model->getLateAttendanceToday()->result_array();

        $arr = []; //create empty array

        date_default_timezone_set("Asia/Jakarta");
        $time = date('H.i.s');

        foreach ($data['terlambat'] as $key => $trlmbt) {
            $phpdate = strtotime($trlmbt['time_in']);
            $mysqldate = date('H.i.s', $phpdate);
            $no = $key + 1;
            $arr[] = array(
                '' => $no,
                '.' => '',
                '.' => $trlmbt['name'],
                '(' => $mysqldate,
                ')' => $enter
            ); //assign each sub-array to the newly created array
        }

        $json = json_encode($arr);

        $str = $json;

        $str1 = RemoveSpecialChar($str);
        $str2 = ReplaceKoma($str1);

        $str2 = str_replace('[', ' ', $str2);
        $str2 = str_replace(']', ' ', $str2);
        $str2 = str_replace('\n', '
', $str2);
        
        $cainfo = "https://test.smkkarnas.net/cacert.pem";

        $api = 'https://api.telegram.org/'.$settings['bot_telegram'].':'.$settings['token_telegram'].'/sendMessage?chat_id=-'.$settings['chat_id_telegram'].'&text='.urlencode($info . $date . $garis . $enter . $title . $str2).'';

        $ch = curl_init($api);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CAINFO, $cainfo);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($date));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_2TLS");
        curl_setopt($ch, CURLOPT_SSLVERSION, "CURL_SSLVERSION_TLSv1_2");
        $result = curl_exec($ch);
        curl_close($ch);

        var_dump($api);
        
        redirect($_SERVER['HTTP_REFERER']);
    }

	public function send3TerbaikHariIni()
    {
       
    }
}

?>
