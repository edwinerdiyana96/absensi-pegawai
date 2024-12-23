<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_model extends CI_Model
{

	public function getKodeScan($params = "")
	{
		$this->db->where('qr_token', $params);
		return $this->db->get('qr');
	}

	public function getHadirBulanById($params = "", $awal = "", $akhir = "")
	{
		$this->db->where('date <=', $akhir);
		$this->db->where('date >=', $awal);
		$this->db->where('user_id', $params);
		$this->db->where('status', '1');
		$this->db->where('confirm', '1');
		return $this->db->get('data_attendance');
	}


	public function getTelatBulanById($params = "", $awal = "", $akhir = "")
	{
		$this->db->where('date <=', $akhir);
		$this->db->where('date >=', $awal);
		$this->db->where('user_id', $params);
		$this->db->where('status', '2');
		$this->db->where('confirm', '1');
		return $this->db->get('data_attendance');
	}


	public function getSakitBulanById($params = "", $awal = "", $akhir = "")
	{
		$this->db->where('date <=', $akhir);
		$this->db->where('date >=', $awal);
		$this->db->where('user_id', $params);
		$this->db->where('status', '3');
		$this->db->where('confirm', '1');
		return $this->db->get('data_attendance');
	}
	public function getIzinBulanById($params = "", $awal = "", $akhir = "")
	{
		$this->db->where('date <=', $akhir);
		$this->db->where('date >=', $awal);
		$this->db->where('user_id', $params);
		$this->db->where('status', '4');
		$this->db->where('confirm', '1');
		return $this->db->get('data_attendance');
	}
	public function getAlphaBulanById($params = "", $awal = "", $akhir = "")
	{
		$this->db->where('date <=', $akhir);
		$this->db->where('date >=', $awal);
		$this->db->where('user_id', $params);
		$this->db->where('status', '0');
		$this->db->where('confirm', '1');
		return $this->db->get('data_attendance');
	}

	public function getBeforeAttendanceToday()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$this->db->select('*');
		
		$this->db->from('data_attendance a');
		$this->db->join('user b', 'b.id=a.user_id', 'left');
		$this->db->where('date', $curr_date);
		$this->db->where('status', '0');
		$this->db->order_by('time_in', 'desc');

		$query = $this->db->get();
		if ($query->num_rows() >= 0) {
			return $query;
		} else {
			return false;
		}
	}

	public function getPermitAttendanceToday()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$this->db->select('*');
		
		$this->db->from('data_attendance a');
		$this->db->join('user b', 'b.id=a.user_id', 'left');
		$this->db->where('date', $curr_date);
		$this->db->where('status', '4');
		$this->db->order_by('time_in', 'desc');

		$query = $this->db->get();
		if ($query->num_rows() >= 0) {
			return $query;
		} else {
			return false;
		}
	}

	public function getSickAttendanceToday()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$this->db->select('*');
		
		$this->db->from('data_attendance a');
		$this->db->join('user b', 'b.id=a.user_id', 'left');
		$this->db->where('date', $curr_date);
		$this->db->where('status', '3');
		$this->db->order_by('time_in', 'desc');

		$query = $this->db->get();
		if ($query->num_rows() >= 0) {
			return $query;
		} else {
			return false;
		}
	}

	public function getAttendanceToday()
	{
		date_default_timezone_set("Asia/Jakarta");
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		$this->db->where('date', $curr_date);
		$this->db->where('status !=', '3') && $this->db->where('status !=', '4') && $this->db->where('status !=', '5') && $this->db->where('status !=', '0');
		return $this->db->get('data_attendance');
	}

	public function getCountNotAttendanceToday()
	{
		date_default_timezone_set("Asia/Jakarta");
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		$this->db->where('date', $curr_date);
		$this->db->where('status !=', '1') && $this->db->where('status !=', '2');
		return $this->db->get('data_attendance');
	}

	public function getNotAttendanceToday()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$this->db->select('*');
		
		$this->db->from('data_attendance a');
		$this->db->join('user b', 'b.id=a.user_id', 'left');
		$this->db->where('date', $curr_date);
		$this->db->where('a.status !=', '1') && $this->db->where('a.status !=', '2');


		$query = $this->db->get();
		if ($query->num_rows() >= 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getLateAttendanceToday()
	{
		// date_default_timezone_set("Asia/Jakarta");
		// $date = new DateTime("now");
		// $curr_date = $date->format('Y-m-d');
		// $this->db->where('date', $curr_date);
		// $this->db->where('status', '2');
		// return $this->db->get('data_attendance');

		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$this->db->select('*');
		
		$this->db->from('data_attendance a');
		$this->db->join('user b', 'b.id=a.user_id', 'left');
		$this->db->where('date', $curr_date);
		$this->db->where('status', '2');
		$this->db->order_by('time_in', 'desc');

		$query = $this->db->get();
		if ($query->num_rows() >= 0) {
			return $query;
		} else {
			return false;
		}
	}

	public function getOffAttendanceToday()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$this->db->select('*');
		
		$this->db->from('data_attendance a');
		$this->db->join('user b', 'b.id=a.user_id', 'left');
		$this->db->where('date', $curr_date);
		$this->db->where('status', '5');
		$this->db->order_by('time_in', 'desc');

		$query = $this->db->get();
		if ($query->num_rows() >= 0) {
			return $query;
		} else {
			return false;
		}
	}

	public function getAttendanceByDate($awal, $akhir)
	{

		$this->db->where('date >=', $awal);
		$this->db->where('date <=', $akhir);
		return $this->db->get('data_attendance');
	}


	public function getAbsensiIdToday()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		$this->db->where('date', $curr_date);
		// $this->db->where('status !=', '0');
		return $this->db->get('data_attendance');
	}

	public function getAbsensiToday()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$this->db->select('*');
		
		$this->db->from('data_attendance a');
		$this->db->join('user b', 'b.id=a.user_id', 'left');
		$this->db->where('date', $curr_date);
		// $this->db->where('status', '0');

		$query = $this->db->get();
		if ($query->num_rows() >= 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getAbsensiByDate($params)
	{
		$this->db->select('*');
		
		$this->db->from('data_attendance a');
		$this->db->join('user b', 'b.id=a.user_id', 'left');
		$this->db->where('date', $params);
		$this->db->where('confirm', '1');
		// $this->db->where('status', '0');

		$query = $this->db->get();
		if ($query->num_rows() >= 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}


	public function getAbsensiUserByDate($id, $awal, $akhir)
	{

		$this->db->where('date <=', $akhir);
		$this->db->where('date >=', $awal);
		$this->db->where('user_id', $id);
		return $this->db->get('data_attendance');
	}

	public function getAllAbsensiUser($id)
	{

		$this->db->select('data_attendance.*, user.*');
		$this->db->from('data_attendance');
		$this->db->join('user', 'user.id = data_attendance.user_id');
		$this->db->where('data_attendance.user_id', $id);
		$this->db->order_by('date', 'Desc');
		return $this->db->get()->result_array();
	}

	public function getAbsensi()
	{
		$this->db->where('status !=', 0);
		return $this->db->get('data_attendance');
	}


	public function getRiwayat($awal, $akhir, $user)
	{
		return $this->db->query("SELECT * FROM data_attendance where user_id = '$user'");
	}


	public function getJamPulang($params)
	{
		$this->db->where('date', $params);
		$this->db->where('status', '5');
		return $this->db->get('data_attendance');
	}

	public function getUserById($params)
	{
		$this->db->where('id', $params);
		return $this->db->get('user');
	}

	public function getHadirByUser($params)
	{
		$this->db->where('user_id', $params);
		$this->db->where('status', '1');
		return $this->db->get('data_attendance');
	}

	public function getTelatByUser($params)
	{
		$this->db->where('user_id', $params);
		$this->db->where('status', '2');
		return $this->db->get('data_attendance');
	}

	public function getSakitByUser($params)
	{
		$this->db->where('user_id', $params);
		$this->db->where('status', '3');
		return $this->db->get('data_attendance');
	}


	public function getIjinByUser($params)
	{
		$this->db->where('user_id', $params);
		$this->db->where('status', '4');
		return $this->db->get('data_attendance');
	}


	//OPERATOR - ABSENSI MANUAL
	public function getDataPegawai()
	{
		$this->db->where_not_in('role_id', "1") and $this->db->where_not_in('role_id', "19");
		return $this->db->get('user');
	}

	public function getUserPegawaiById($id)
	{
		$this->db->where_not_in('role_id', 1 and 'role_id', 19);
		return $this->db->get_where('user', ['id' => $id])->row_array();
	}

	public function getUserAllPegawai($id)
	{
		$this->db->where_not_in('role_id', 1 and 'role_id', 19);
		return $this->db->get('user');
	}

	public function getUserAllPegawaiExport()
	{
		$this->db->where_not_in('role_id', 1 and 'role_id', 19);
		return $this->db->get('user');
	}

	public function getPegawaiExportByUserId($params="")
	{
		$this->db->where('id',$params);
		return $this->db->get('user');
	}



	public function getDataAbsensiByUserId()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$this->db->select('*');
		
		$this->db->from('data_attendance a');
		$this->db->join('user b', 'b.id=a.user_id', 'left');
		$this->db->where('date', $curr_date);
		$this->db->where('status', '0');

		$query = $this->db->get();
		if ($query->num_rows() >= 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}


	public function get_data_attendance_delay()
	{
		$this->db->select('*');
		
		$this->db->from('data_attendance a');
		$this->db->join('user b', 'b.id=a.user_id', 'left');
		$this->db->where('confirm', '0');

		$query = $this->db->get();
		if ($query->num_rows() >= 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getDataKetidakHadiranByUserId()
	{
		$user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$user_id = $user['id'];
		$this->db->where('id_user', $user_id);
		return $this->db->get('ketidakhadiran');
	}

	public function getDataKetidakHadiranByUserIdDate($tanggal="")
	{
		$user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$user_id = $user['id'];
		$this->db->where('id_user', $user_id);
		$this->db->where('tanggal', $tanggal);
		return $this->db->get('ketidakhadiran');
	}

	public function getDataKetidakhadiranById($params=""){
		$this->db->where('id_tidakhadir', $params);
		return $this->db->get('ketidakhadiran');
	}

	public function getDataKetidakHadiran()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');

		$this->db->select('*');
		
		$this->db->from('ketidakhadiran a');
		$this->db->join('user b', 'b.id=a.id_user', 'left');
		$this->db->where('a.tanggal', $curr_date);
		$this->db->where('a.is_active', '0');

		$query = $this->db->get();
		if ($query->num_rows() >= 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function cekDataKetidakHadiran()
	{
		$user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$user_id = $user['id'];
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		// return $this->db->query("SELECT * FROM ketidakhadiran where id_user = $user_id AND where tanggal = $curr_date")->num_rows();
		$this->db->select('*');
		$this->db->from('ketidakhadiran');
		$this->db->where('id_user', $user_id);
		$this->db->where('tanggal', $curr_date);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function insertUserAbsensiSakit($data)
	{
		$this->db->insert('ketidakhadiran',$data);
	}

	public function insertUserAbsensiIzin($data)
	{
		$this->db->insert('ketidakhadiran',$data);
	}

	public function insertUserAbsensiOff($data)
	{
		$this->db->insert('ketidakhadiran',$data);
	}

	public function updateAbsensiUserHadir()
	{
		date_default_timezone_set("Asia/Jakarta");
		$time = new DateTime("now");
		$curr_time = $time->format('H:i:s');

		$attendance_id = $this->input->post('attendance_id');

		$data = [
			'status' => $this->input->post('status_hadir'),
			'time_in' => $curr_time
		];
		$this->db->where('attendance_id', $attendance_id);
		$this->db->update('data_attendance', $data);
	}

	public function updateAbsensiUserSakit()
	{
		date_default_timezone_set("Asia/Jakarta");
		$time = new DateTime("now");
		$curr_time = $time->format('H:i:s');

		$attendance_id = $this->input->post('attendance_id');

		$data = [
			'status' => $this->input->post('status_sakit'),
			'time_in' => "00:00:00",
			'description' => $this->input->post('description')
		];
		$this->db->where('attendance_id', $attendance_id);
		$this->db->update('data_attendance', $data);
	}
	public function updateAbsensiUserIzin()
	{
		date_default_timezone_set("Asia/Jakarta");
		$time = new DateTime("now");
		$curr_time = $time->format('H:i:s');

		$attendance_id = $this->input->post('attendance_id');

		$data = [
			'status' => $this->input->post('status_izin'),
			'time_in' => "00:00:00",
			'description' => $this->input->post('description')
		];
		$this->db->where('attendance_id', $attendance_id);
		$this->db->update('data_attendance', $data);
	}

	public function updateAbsensiUserOff()
	{
		date_default_timezone_set("Asia/Jakarta");
		$time = new DateTime("now");
		$curr_time = $time->format('H:i:s');

		$attendance_id = $this->input->post('attendance_id');

		$data = [
			'status' => $this->input->post('status_off')
		];
		$this->db->where('attendance_id', $attendance_id);
		$this->db->update('data_attendance', $data);
	}
	
	//UPDATE DATA ABSENSI OLEH ADMIN
	public function updateAbsensiUser()
	{
		date_default_timezone_set("Asia/Jakarta");
		$time = new DateTime("now");
		$curr_time = $time->format('H:i:s');

		$attendance_id = $this->input->post('attendance_id');

		$data = [
			'time_in' => $this->input->post('jam_masuk'),
			'time_out' => $this->input->post('jam_pulang'),
			'status' => $this->input->post('status'),
			'description' => $this->input->post('description')
		];
		$this->db->where('attendance_id', $attendance_id);
		$this->db->update('data_attendance', $data);
	}

	public function addnewTime($data)
	{
		$this->db->insert('time_attendance', $data);
	}

	public function getTimeId($id)
	{
		return $this->db->get_where('time_attendance', ['id' => $id])->row_array();
	}

	public function updateTime()
	{
		$id = $this->input->post('id');
		$data = [
			'time_schedule' => $this->input->post('time_schedule'),
			'time_start' => $this->input->post('time_start'),
			'time_end' => $this->input->post('time_end')
		];
		$this->db->where('id', $id);
		$this->db->update('time_attendance', $data);
	}

	public function deleteTimeAttendace($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('time_attendance');
	}

	//jarak
	public function addnewJarak($data)
	{
		$this->db->insert('data_jarak', $data);
	}

	public function getJarakId($id)
	{
		return $this->db->get_where('data_jarak', ['id' => $id])->row_array();
	}

	public function updateJarak()
	{
		$id = $this->input->post('id');
		$data = [
			'jarak' => $this->input->post('jarak'),
			'status' => $this->input->post('status')
		];
		$this->db->where('id', $id);
		$this->db->update('data_jarak', $data);

		$data = [
			'status' => '0'
		];
		$this->db->where_not_in('id', $id);
		$this->db->update('data_jarak', $data);

	}

	public function deleteJarak($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('data_jarak');
	}
	//jarak









	public function insertDataAttendanceByDate($date="")
	{
		$user_data = $this->Absensi_model->getDataPegawai()->result_array();
		// $this->db->insert('data_attendance', $data);
		// $query=$this->db->query("Select * from users");
		// $results=$query->result();
		// $date = new DateTime("now");
		$curr_date = $date;
		$time_in = "00:00:00";
		$time_break = "00:00:00";
		$time_out = "00:00:00";
		$latlong = "-6.9530251697747545, 108.46944914599598";
		$location = "belum ada lokasi";
		$status = "0";
		$data = array();
		foreach ($user_data as $ud) {
			$user_id = $ud['id'];
			$row_arr = array(
				'user_id' => $user_id,
				'date' => $curr_date,
				'time_in' => $time_in,
				'time_break' => $time_break,
				'time_out' => $time_out,
				'latlong' => $latlong,
				'location' => $location,
				'status' => $status
			);
			array_push($data, $row_arr);
		}
		$cek_holiday = $this->get_holiday_by_date(date('Y-m-d'))->num_rows();
		if($cek_holiday==0){
			$this->db->insert_batch('data_attendance', $data);
		}
	}




	public function insertDataAttendance()
	{
		$user_data = $this->Absensi_model->getDataPegawai()->result_array();
		// $this->db->insert('data_attendance', $data);
		// $query=$this->db->query("Select * from users");
		// $results=$query->result();
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		$time_in = "00:00:00";
		$time_break = "00:00:00";
		$time_out = "00:00:00";
		$latlong = "-6.9530251697747545, 108.46944914599598";
		$location = "belum ada lokasi";
		$status = "0";
		$data = array();
		foreach ($user_data as $ud) {
			$user_id = $ud['id'];
			$row_arr = array(
				'user_id' => $user_id,
				'date' => $curr_date,
				'time_in' => $time_in,
				'time_break' => $time_break,
				'time_out' => $time_out,
				'latlong' => $latlong,
				'location' => $location,
				'status' => $status
			);
			array_push($data, $row_arr);
		}
		$cek_holiday = $this->get_holiday_by_date(date('Y-m-d'))->num_rows();
		if($cek_holiday==0){
			$this->db->insert_batch('data_attendance', $data);
		}
	}

	public function getDataAttendanceLimit1()
	{
		date_default_timezone_set("Asia/Jakarta");
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		$this->db->where('date', $curr_date);
		$this->db->where('status !=', '3') && $this->db->where('status !=', '4') && $this->db->where('status !=', '5') && $this->db->where('status !=', '0');
		$this->db->limit('1');
		$this->db->order_by('time_in', 'asc');
		return $this->db->get('data_attendance');
	}

	public function insertDataAttendanceRank()
	{
		$user_data = $this->Absensi_model->getDataAttendanceLimit1()->result_array();
		// $this->db->insert('data_attendance', $data);
		// $query=$this->db->query("Select * from users");
		// $results=$query->result();
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		// $time_in = "00:00:00";
		// $time_break = "00:00:00";
		// $time_out = "00:00:00";
		// $latlong = "-6.9530251697747545, 108.46944914599598";
		// $location = "belum ada lokasi";
		// $status = "0";
		$data = array();
		foreach ($user_data as $ud) {
			$user_id = $ud['user_id'];
			$attendance_id = $ud['attendance_id'];
			$time_in = $ud['time_in'];
			$row_arr = array(
				'user_id' => $user_id,
				'attendance_id' => $attendance_id,
				'time_in' => $time_in,
				'date' => $curr_date
			);
			array_push($data, $row_arr);
		}
		// $cek_holiday = $this->get_holiday_by_date(date('Y-m-d'))->num_rows();
		// if($cek_holiday==0){
		$this->db->insert_batch('rank_attendance', $data);
		// }
	}

	public function getDataAttendanceRank()
	{
		date_default_timezone_set("Asia/Jakarta");
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		$this->db->select('time_in, COUNT(time_in) AS waktu');
		// $this->db->group_by('waktu');
		// $this->db->select('user.name');
		$this->db->from('data_attendance');
		// $this->db->join('user b', 'b.id=a.user_id', 'left');
		$this->db->order_by('time_in', 'asc');
		$this->db->limit(3);
		// $this->db->where('date', $curr_date);
		$this->db->where('status', '1');

		$query = $this->db->get();
		if ($query->num_rows() >= 0) {
			return $query->result_array();
		} else {
			return false;
		}

		// $this->db->select('data_attendance.time_in, COUNT(data_attendance.time_in) as waktu');
 		// $this->db->group_by('user.name'); 
 		// $this->db->order_by('time_in', 'asc'); 
 		// $this->db->get('', 10);
	}
	
	public function time_schedule()
	{

		return $this->db->get('time_attendance')->result_array();
	}


	function cek_absen()
	{

		$user_id = $this->input->post('user_id');
		$time_cek = date('H:i:s ', strtotime('00:00:00'));
		$time_in = $this->db->query("SELECT * FROM data_attendance where user_id = $user_id ")->row_array();

		if ($time_cek > $time_in['time_in']) {
			return  true;
		} else {
			return false;
		}
	}

	public function absen()
	{

		date_default_timezone_set("Asia/Jakarta");
		$time = new DateTime("now");

		$link = base_url();
		// $jam_masuk_end = date('H:i:s', strtotime('22:00:00'));

		$curr_time = $time->format('H:i:s');
		$curr_date = $time->format('Y-m-d');

		// $attendance_id = $this->input->post('attendance_id');
		$user_id = $this->input->post('user_id');


		$jam_masuk = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Masuk'")->row_array();
		$jam_masuk_start = $jam_masuk['time_start'];
		$jam_masuk_end = $jam_masuk['time_end'];


		$jam_telat = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Telat'")->row_array();
		$jam_telat_start    = $jam_telat['time_start'];
		$jam_telat_end      = $jam_telat['time_end'];

		// $jam_istirahat          =  $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Istirahat'")->row_array();
		// $jam_istirahat_start    = $jam_istirahat['time_start'];
		// $jam_istirahat_end      = $jam_istirahat['time_end'];

		$jam_pulang         = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Pulang'")->row_array();
		$jam_pulang_start   = $jam_pulang['time_start'];
		$jam_pulang_end     = $jam_pulang['time_end'];

		$time_cek = '00:00:00';

		if ($curr_time >= $jam_masuk_start && $curr_time <= $jam_masuk_end) { //jam masuk tepat waktu

			$time_cek = '00:00:00';
			$time_in = $this->db->query("SELECT * FROM data_attendance where user_id = $user_id and date = '" . $curr_date . "'")->row_array();
			if ($time_in['time_in'] == $time_cek) { // cek jika belum 
				$data = [
					'status' => 1,
					'time_in' => $curr_time
				];

				// $this->db->where('attendance_id', $attendance_id);
				$this->db->where('user_id', $user_id);
				$this->db->where('date', $curr_date);
				$this->db->update('data_attendance', $data);
				// $this->session->set_flashdata('message_absen', '<div class="alert alert-success" role="danger"> Berhasil Absen Tepat Waktu </div>');
				$this->session->set_flashdata('message_absen', '<script>
                    swal({
                        title: "Status Absen!",
                        text: "Berhasil Absen Tepat Waktu!",
                        icon: "success",
                        button: "OK"
                // timer: 3000
                        });
                        </script>');
				redirect('user');
			} else { //jika sudah
				$this->session->set_flashdata('message_absen', '<script>
                   swal({
                    title: "Status Absen!",
                    text: "Anda Sudah Absen Masuk!",
                    icon: "danger",
                    button: "OK"
                // timer: 3000
                    });
                    </script>');
				// $this->session->set_flashdata('message_absen', '<div class="alert alert-danger" role="danger"> Anda Sudah  Absen Tepat Waktu </div>');
				redirect('user');
			}
		} else if ($curr_time >= $jam_telat_start && $curr_time <= $jam_telat_end) { //jam telat

			$time_in = $this->db->query("SELECT * FROM data_attendance where user_id = $user_id and date = '" . $curr_date . "'")->row_array();
			if ($time_cek == $time_in['time_in']) {

				$data = [
					'status' => 2,
					'time_in' => $curr_time
				];

				// $this->db->where('attendance_id', $attendance_id);
				$this->db->where('user_id', $user_id);
				$this->db->where('date', $curr_date);
				$this->db->update('data_attendance', $data);
				

				//====== fungsi telegram kirim data terlambat per absensi ======//
				
				$curl = curl_init();
				curl_setopt_array(
					$curl,
					array(
						CURLOPT_URL => 'https://absensi-pegawai-kuningan.smkkarnas.id/kirim_laporan/kirim_laporan_terlambat/',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'GET',
					)
				);
				curl_exec($curl);
				curl_close($curl);
				
				/*
				$settings = $this->db->get('settings')->row_array();
				$data['terlambat'] = $this->Absensi_model->getLateAttendanceToday()->result_array();
			   
				

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
		
				// $api = 'https://api.telegram.org/'.$settings['bot_telegram'].':'.$settings['token_telegram'].'/sendMessage?chat_id=-'.$settings['chat_id_telegram'].'&text='.urlencode($info . $date . $garis . $enter . $title . $str2).'';
				
				// // $api = 'https://api.telegram.org/'.$settings['bot_telegram'].':'.$settings['token_telegram'].'/sendMessage?chat_id=-'.$settings['chat_id_telegram'].'&text='.urlencode().'';
				// $ch = curl_init($api);
				// curl_setopt($ch, CURLOPT_HEADER, false);
				// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				// curl_setopt($ch, CURLOPT_CAINFO, $cainfo);
				// curl_setopt($ch, CURLOPT_POST, 1);
				// curl_setopt($ch, CURLOPT_POSTFIELDS, ($date));
				// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				// curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_2TLS");
				// curl_setopt($ch, CURLOPT_SSLVERSION, "CURL_SSLVERSION_TLSv1_2");
				// $result = curl_exec($ch);
				// curl_close($ch);
		
				// var_dump($api);


		
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
		 */

				
				$this->session->set_flashdata('message_absen', '<script>
                   swal({
                    title: "Status Absen!",
                    text: "Berhasil Absen Tapi Terlambat!",
                    icon: "success",
                    button: "OK"
                // timer: 3000
                    });
                    </script>');
				
				redirect('user');

				// $api = $link . 'telegram/sendTerlambatTelegram/';
				// $ch = curl_init($api);
				// curl_setopt($ch, CURLOPT_HEADER, false);
				// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				// curl_setopt($ch, CURLOPT_POST, 1);
				// curl_setopt($ch, CURLOPT_POSTFIELDS, ($time));
				// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				// $result = curl_exec($ch);
				// curl_close($ch);
				// var_dump($api);

				// '<script>
                // var delayInMilliseconds = 500; //0.5 second
                // setTimeout(function() {' .
				// 	redirect("user");
				// '}, delayInMilliseconds);
                // </script>';
			} else {
				$this->session->set_flashdata('message_absen', '<script>
                   swal({
                    title: "Status Absen!",
                    text: "Anda Sudah Absen Masuk!",
                    icon: "warning",
                    button: "OK"
                // timer: 3000
                    });
                    </script>');
				redirect('user');
			}
		}

		// else if ($curr_time > $jam_istirahat_start && $curr_time < $jam_istirahat_end) { //jam Istirahat

		//     $time_in = $this->db->query("SELECT * FROM data_attendance where user_id = $user_id and date = '" . $curr_date . "'")->row_array();
		//     if ($time_cek == $time_in['time_break'] && $time_in['time_in'] != $time_cek) {

		//         $data = [
		//             'time_break' => $curr_time
		//         ];

		//         // $this->db->where('attendance_id', $attendance_id);
		//         $this->db->where('user_id', $user_id);
		//         $this->db->where('date', $curr_date);
		//         $this->db->update('data_attendance', $data);
		//         $this->session->set_flashdata('message_absen', '<script>
		//              swal({
		//         title: "Status Absen!",
		//         text: "Absen Istirahat Berhasil!",
		//         icon: "success",
		//         button: "OK"
		//         // timer: 3000
		//     });
		//         </script>');
		//         redirect('user');
		//     } 
		//     else if ($time_in['time_in'] == $time_cek && $time_in['time_break'] == $time_cek) {
		//         $data = [
		//             'status' => 2,
		//             'time_in' => $curr_time,
		//             'time_break' => $curr_time
		//         ];
		//         $this->db->where('user_id', $user_id);
		//         $this->db->where('date', $curr_date);
		//         $this->db->update('data_attendance', $data);
		//         $this->session->set_flashdata('message_absen', '<script>
		//              swal({
		//         title: "Status Absen!",
		//         text: "Anda Berhasil Absen! Tapi Anda Terlambat!",
		//         icon: "warning",
		//         button: "OK"
		//         // timer: 3000
		//     });
		//         </script>');
		//         //fungsi telegram kirim data terlambat per absen
		//         $api = $link . 'telegram/sendTerlambatTelegram/';

		//         $ch = curl_init($api);
		//         curl_setopt($ch, CURLOPT_HEADER, false);
		//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//         curl_setopt($ch, CURLOPT_POST, 1);
		//         curl_setopt($ch, CURLOPT_POSTFIELDS, ($time));
		//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		//         $result = curl_exec($ch);
		//         curl_close($ch);

		//         var_dump($api);

		//         '<script>
		//         var delayInMilliseconds = 500; //0.5 second
		//         setTimeout(function() {'.
		//             redirect("user");
		//         '}, delayInMilliseconds);
		//         </script>';
		//     }

		//     else if ($time_in['time_in'] > $jam_masuk_end && $time_in['time_break'] == $time_cek) {
		//         $data = [
		//             'time_break' => $curr_time
		//         ];
		//         $this->db->where('user_id', $user_id);
		//         $this->db->where('date', $curr_date);
		//         $this->db->update('data_attendance', $data);
		//         $this->session->set_flashdata('message_absen', '<script>
		//              swal({
		//         title: "Status Absen!",
		//         text: "Anda Berhasil Absen Istirahat!",
		//         icon: "success",
		//         button: "OK"
		//         // timer: 3000
		//     });
		//         </script>');
		//     redirect("user");
		//     }

		//     else {
		//         $this->session->set_flashdata('message_absen', '<script>
		//              swal({
		//         title: "Status Absen!",
		//         text: "Anda Sudah Absen Istirahat !!",
		//         icon: "warning",
		//         button: "OK"
		//         // timer: 3000
		//     });
		//         </script>');
		//         redirect('user');
		//     }
		// } 

		else if ($curr_time >= $jam_pulang_start && $curr_time < $jam_pulang_end) { //jam pulang

			$time_in = $this->db->query("SELECT * FROM data_attendance where user_id = $user_id and date = '" . $curr_date . "'")->row_array();
			if ($time_cek == $time_in['time_out'] && $time_in['time_break'] != $time_cek && $time_in['time_in'] != $time_cek) {

				$data = [
					'time_out' => $curr_time
				];

				// $this->db->where('attendance_id', $attendance_id);
				$this->db->where('user_id', $user_id);
				$this->db->where('date', $curr_date);
				$this->db->update('data_attendance', $data);
				$this->session->set_flashdata('message_absen', '<script>
                   swal({
                    title: "Status Absen!",
                    text: "Berhasil Absen Pulang",
                    icon: "success",
                    button: "OK"
                // timer: 3000
                    });
                    </script>');
				redirect('user');
			} else if ($time_in['time_in'] == $time_cek && $time_in['time_break'] == $time_cek && $time_in['time_out'] == $time_cek) {
				$data = [
					'time_in' => $curr_time,
					'time_break' => '00:00:00',
					'time_out' => $curr_time,
					'status' => '2'
				];

				$this->db->where('user_id', $user_id);
				$this->db->where('date', $curr_date);
				$this->db->update('data_attendance', $data);
				$this->session->set_flashdata('message_absen', '<script>
                   swal({
                    title: "Status Absen!",
                    text: "Berhasil Absen Pulang!",
                    icon: "success",
                    button: "OK"
                // timer: 3000
                    });
                    </script>');
				//fungsi telegram kirim data terlambat per absen
				// $api = $link . 'telegram/sendTerlambatTelegram/';

				// $ch = curl_init($api);
				// curl_setopt($ch, CURLOPT_HEADER, false);
				// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				// curl_setopt($ch, CURLOPT_POST, 1);
				// curl_setopt($ch, CURLOPT_POSTFIELDS, ($time));
				// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				// $result = curl_exec($ch);
				// curl_close($ch);

				// var_dump($api);

				'<script>
                var delayInMilliseconds = 500; //0.5 second
                setTimeout(function() {' .
					redirect("user");
				'}, delayInMilliseconds);
                </script>';
			} else if ($time_in['time_break'] == $time_cek && $time_in['time_out'] == $time_cek) {
				$data = [
					// 'time_break' => $curr_time,
					'time_out' => $curr_time
				];

				$this->db->where('user_id', $user_id);
				$this->db->where('date', $curr_date);
				$this->db->update('data_attendance', $data);
				$this->session->set_flashdata('message_absen', '<script>
                   swal({
                    title: "Status Absen!",
                    text: "Berhasil Absen Pulang!",
                    icon: "success",
                    button: "OK"
                // timer: 3000
                    });
                    </script>');

				//fungsi telegram kirim data terlambat per absen

				'<script>
                var delayInMilliseconds = 500; //0.5 second
                setTimeout(function() {' .
					redirect("user");
				'}, delayInMilliseconds);
                </script>';
			} else {
				$this->session->set_flashdata('message_absen', '<script>
                   swal({
                    title: "Status Absen!",
                    text: "Anda Sudah Absen Pulang!",
                    icon: "warning",
                    button: "OK"
                // timer: 3000
                    });
                    </script>');
				redirect('user');
			}
		} else if ($curr_time > $jam_pulang_end) { //jam pulang kelebihan

			$this->session->set_flashdata('message_absen', '<script>
                swal({
                    title: "Status Absen!",
                    text: "Anda Belum Pulang Sampai Selarut Ini! Mungkin Anda Sedang Menginap.",
                    icon: "info",
                    button: "OK"
                // timer: 3000
                    });
                    </script>');
			redirect('user');
		}

		//Jam Jika Absen Belum Dimulai
		else if ($curr_time < $jam_masuk_start) {

			$this->session->set_flashdata('message_absen', '<script>
               swal({
                title: "Status Absen!",
                text: "Jam Absensi Masuk Belum Dibuka!",
                icon: "info",
                button: "OK"
                // timer: 3000
                });
                </script>');

			redirect("user");
		} else {
			echo "string";
		}
	}

	public function getAbsensiPegawai($id)
	{

		$this->db->select('data_attendance.*, user.*');
		$this->db->from('data_attendance');
		$this->db->join('user', 'user.id = data_attendance.user_id');
		$this->db->where('data_attendance.user_id', $id);
		$this->db->where('data_attendance.date', date('Y-m-d'));
		return $this->db->get()->result_array();
	}


	public function delete_date($date)
	{

		$this->db->where('date', $date);
		$this->db->delete('data_attendance');
		$this->session->set_flashdata('message', '<script>
           swal({
            title: "Tanggal Absensi",
            text: "Tanggal Absensi Berhasil Dihapus",
            icon: "success",
            button: "Ok"
                // timer: 3000
            });
            </script>');
		redirect('operator/absensi_manual');
	}

	public function absen_flexible()
	{

		date_default_timezone_set("Asia/Jakarta");
		$time = new DateTime("now");

		$link = base_url();
		// $jam_masuk_end = date('H:i:s', strtotime('22:00:00'));

		$curr_time = $time->format('H:i:s');
		$curr_date = $time->format('Y-m-d');

		// $attendance_id = $this->input->post('attendance_id');
		$user_id = $this->input->post('user_id');


		$jam_masuk = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Masuk'")->row_array();
		$jam_masuk_start = $jam_masuk['time_start'];
		$jam_masuk_end = $jam_masuk['time_end'];


		$jam_telat = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Telat'")->row_array();
		$jam_telat_start    = $jam_telat['time_start'];
		$jam_telat_end      = $jam_telat['time_end'];

		$jam_istirahat          =  $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Istirahat'")->row_array();
		$jam_istirahat_start    = $jam_istirahat['time_start'];
		$jam_istirahat_end      = $jam_istirahat['time_end'];

		$jam_pulang         = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Pulang'")->row_array();
		$jam_pulang_start   = $jam_pulang['time_start'];
		$jam_pulang_end     = $jam_pulang['time_end'];

		$time_cek = '00:00:00';
		$time_user = $this->db->query("SELECT * FROM data_attendance where user_id = $user_id and date = '" . $curr_date . "'")->row_array();

		if ($time_cek == $time_user['time_in'] && $time_user['status'] == '0') {

			$data = [
				'status' => '1',
				'time_in' => $curr_time
			];

			$this->db->where('user_id', $user_id);
			$this->db->where('date', $curr_date);
			$this->db->update('data_attendance', $data);
			$this->session->set_flashdata('message_absen', '<script>
               swal({
                title: "Berhasil Absen!",
                text: "Anda Berhasil Absen Masuk!",
                icon: "success",
                button: "OK"
                // timer: 3000
                });
                </script>');
			redirect('user');
		} elseif ($time_cek == $time_user['time_out'] && $time_cek != $time_user['time_in']) {
			$time_cek2 = date("H:i:s", strtotime("+2 minutes", strtotime(($time_user['time_in']))));
			if ($curr_time < $time_cek2) {
				$this->session->set_flashdata('message_absen', '<script>
                   swal({
                    title: "Status Absen!",
                    text: "Anda Baru Absen Masuk, Harap Tunggu 10 Menit Untuk Absen Pulang!",
                    icon: "warning",
                    button: "OK"
                // timer: 3000
                    });
                    </script>');
				redirect('user');
			} else {
				$data = [
					'time_out' => $curr_time
				];

				$this->db->where('user_id', $user_id);
				$this->db->where('date', $curr_date);
				$this->db->update('data_attendance', $data);
				$this->session->set_flashdata('message_absen', '<script>
                   swal({
                    title: "Berhasil Absen!",
                    text: "Anda Berhasil Absen Pulang!",
                    icon: "success",
                    button: "OK"
                    // timer: 3000
                    });
                    </script>');
				redirect('user');
			}
		} else {
			$this->session->set_flashdata('message_absen', '<script>
               swal({
                title: "Status Absen!",
                text: "Anda Sudah Absen Hari ini!",
                icon: "warning",
                button: "OK"
                // timer: 3000
                });
                </script>');
			redirect('user');
		}
	}




	public function absen_khusus()
	{

		date_default_timezone_set("Asia/Jakarta");
		$time = new DateTime("now");

		$link = base_url();
		// $jam_masuk_end = date('H:i:s', strtotime('22:00:00'));

		$curr_time = $time->format('H:i:s');
		$curr_date = $time->format('Y-m-d');

		// $attendance_id = $this->input->post('attendance_id');
		$user_id = $this->input->post('user_id');


		$jam_masuk = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Masuk'")->row_array();
		$jam_masuk_start = $jam_masuk['time_start'];
		$jam_masuk_end = $jam_masuk['time_end'];


		$jam_telat = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Telat'")->row_array();
		$jam_telat_start    = $jam_telat['time_start'];
		$jam_telat_end      = $jam_telat['time_end'];

		$jam_istirahat          =  $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Istirahat'")->row_array();
		$jam_istirahat_start    = $jam_istirahat['time_start'];
		$jam_istirahat_end      = $jam_istirahat['time_end'];

		$jam_pulang         = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Pulang'")->row_array();
		$jam_pulang_start   = $jam_pulang['time_start'];
		$jam_pulang_end     = $jam_pulang['time_end'];

		$time_cek = '00:00:00';
		$time_user = $this->db->query("SELECT * FROM data_attendance where user_id = $user_id and date = '" . $curr_date . "'")->row_array();

		if ($time_user['status'] == '0') {

			$data = [
				'status' => '6',
				'time_in' => $curr_time,
				'confirm' => '0',
				'description' => 'Absensi Khusus'
			];

			$this->db->where('user_id', $user_id);
			$this->db->where('date', $curr_date);
			$this->db->update('data_attendance', $data);
			$this->session->set_flashdata('message_absen', '<script>
               swal({
                title: "Berhasil Absen!",
                text: "Anda Berhasil Absen Masuk!",
                icon: "success",
                button: "OK"
                // timer: 3000
                });
                </script>');
			redirect('user');
		// } elseif ($time_cek == $time_user['time_out'] && $time_cek != $time_user['time_in']) {
		// 	$time_cek2 = date("H:i:s", strtotime("+2 minutes", strtotime(($time_user['time_in']))));
		// 	if ($curr_time < $time_cek2) {
		// 		$this->session->set_flashdata('message_absen', '<script>
        //            swal({
        //             title: "Status Absen!",
        //             text: "Anda Baru Absen Masuk, Harap Tunggu 10 Menit Untuk Absen Pulang!",
        //             icon: "warning",
        //             button: "OK"
        //         // timer: 3000
        //             });
        //             </script>');
		// 		redirect('user');
		// 	} else {
		// 		$data = [
		// 			'time_out' => $curr_time
		// 		];

		// 		$this->db->where('user_id', $user_id);
		// 		$this->db->where('date', $curr_date);
		// 		$this->db->update('data_attendance', $data);
		// 		$this->session->set_flashdata('message_absen', '<script>
        //            swal({
        //             title: "Berhasil Absen!",
        //             text: "Anda Berhasil Absen Pulang!",
        //             icon: "success",
        //             button: "OK"
        //             // timer: 3000
        //             });
        //             </script>');
		// 		redirect('user');
		// 	}
		} else {
			// $this->session->set_flashdata('message_absen', '<script>
            //    swal({
            //     title: "Status Absen!",
            //     text: "Anda Sudah Absen Hari ini!",
            //     icon: "warning",
            //     button: "OK"
            //     // timer: 3000
            //     });
            //     </script>');
			// redirect('user');

			echo $time_user['status'];
		}
	}




	public function absen_holiday()

	{

		date_default_timezone_set("Asia/Jakarta");
		$time = new DateTime("now");

		$link = base_url();
		// $jam_masuk_end = date('H:i:s', strtotime('22:00:00'));

		$curr_time = $time->format('H:i:s');
		$curr_date = $time->format('Y-m-d');

		// $attendance_id = $this->input->post('attendance_id');
		$user_id = $this->input->post('user_id');


		$jam_masuk = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Masuk'")->row_array();
		$jam_masuk_start = $jam_masuk['time_start'];
		$jam_masuk_end = $jam_masuk['time_end'];


		$jam_telat = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Telat'")->row_array();
		$jam_telat_start    = $jam_telat['time_start'];
		$jam_telat_end      = $jam_telat['time_end'];

		$jam_istirahat          =  $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Istirahat'")->row_array();
		$jam_istirahat_start    = $jam_istirahat['time_start'];
		$jam_istirahat_end      = $jam_istirahat['time_end'];

		$jam_pulang         = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Pulang'")->row_array();
		$jam_pulang_start   = $jam_pulang['time_start'];
		$jam_pulang_end     = $jam_pulang['time_end'];

		$time_cek = '00:00:00';
		$time_user_cek = $this->db->query("SELECT * FROM data_attendance where user_id = $user_id and date = '" . $curr_date . "'")->num_rows();
		$time_user = $this->db->query("SELECT * FROM data_attendance where user_id = $user_id and date = '" . $curr_date . "'")->row_array();

		if ($time_user_cek == 0) {

			$data = [
				'user_id' => $user_id,
				'date' => $curr_date,
				'time_in' => $curr_time,
				'time_break' => $time_cek,
				'time_out' => $time_cek,
				'latlong' => '-6.9530251697747545, 108.46944914599598',
				'location' => 'belum ada lokasi',
				'status' => '1',
				'confirm' => '0'
			];
			$this->db->insert('data_attendance', $data);
			$this->session->set_flashdata('message_absen', '<script>
               swal({
                title: "Berhasil Absen!",
                text: "Anda Berhasil Absen Masuk!",
                icon: "success",
                button: "OK"
                // timer: 3000
                });
                </script>');
			redirect('user');
		} elseif ($time_cek == $time_user['time_out'] && $time_cek != $time_user['time_in']) {
			$time_cek2 = date("H:i:s", strtotime("+10 minutes", strtotime(($time_user['time_in']))));
			if ($curr_time < $time_cek2) {
				$this->session->set_flashdata('message_absen', '<script>
                   swal({
                    title: "Status Absen!",
                    text: "Anda Baru Absen Masuk, Harap Tunggu 10 Menit Untuk Absen Pulang!",
                    icon: "warning",
                    button: "OK"
                // timer: 3000
                    });
                    </script>');
				redirect('user');
			} else {
				$data = [
					'time_out' => $curr_time
				];

				$this->db->where('user_id', $user_id);
				$this->db->where('date', $curr_date);
				$this->db->update('data_attendance', $data);
				$this->session->set_flashdata('message_absen', '<script>
                   swal({
                    title: "Berhasil Absen!",
                    text: "Anda Berhasil Absen Pulang!",
                    icon: "success",
                    button: "OK"
                    // timer: 3000
                    });
                    </script>');
				redirect('user');
			}
		} else {
			$time_user_cek = $this->db->query("SELECT * FROM data_attendance where user_id = $user_id and date = '" . $curr_date . "'")->row_array();
			if ($time_user_cek['time_in'] == '00:00:00') {
				$data = [
					'user_id' => $user_id,
					'date' => $curr_date,
					'time_in' => $curr_time,
					'time_break' => $time_cek,
					'time_out' => $time_cek,
					'latlong' => '-6.9530251697747545, 108.46944914599598',
					'location' => 'belum ada lokasi',
					'status' => '1',
					'confirm' => '0'
				];
				$this->db->insert('data_attendance', $data);
				$this->session->set_flashdata('message_absen', '<script>
				   swal({
					title: "Berhasil Absen!",
					text: "Anda Berhasil Absen Masuk!",
					icon: "success",
					button: "OK"
					// timer: 3000
					});
					</script>');
				redirect('user');
			}else{
			$this->session->set_flashdata('message_absen', '<script>
				swal({
				 title: "Status Absen!",
				 text: "Anda Sudah Absen Hari ini!",
				 icon: "warning",
				 button: "OK"
				 // timer: 3000
				 });
				 </script>');
			 redirect('user');
			}
		}
	}






	public function getHoliday()
	{
		$this->db->order_by('date');
		return $this->db->get('data_holiday');
	}


	public function get_holiday_by_date($params = "")
	{
		$this->db->where('date', $params);
		$this->db->order_by('date');
		return $this->db->get('data_holiday');
	}











	
	public function absen_pusat($user_id)

	{

		date_default_timezone_set("Asia/Jakarta");
		$time = new DateTime("now");

		$link = base_url();
		// $jam_masuk_end = date('H:i:s', strtotime('22:00:00'));

		$curr_time = $time->format('H:i:s');
		$curr_date = $time->format('Y-m-d');

		// $attendance_id = $this->input->post('attendance_id');


		$jam_masuk = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Masuk'")->row_array();
		$jam_masuk_start = $jam_masuk['time_start'];
		$jam_masuk_end = $jam_masuk['time_end'];


		$jam_telat = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Telat'")->row_array();
		$jam_telat_start    = $jam_telat['time_start'];
		$jam_telat_end      = $jam_telat['time_end'];

		$jam_istirahat          =  $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Istirahat'")->row_array();
		$jam_istirahat_start    = $jam_istirahat['time_start'];
		$jam_istirahat_end      = $jam_istirahat['time_end'];

		$jam_pulang         = $this->db->query("SELECT * FROM time_attendance where time_schedule = 'Jam Pulang'")->row_array();
		$jam_pulang_start   = $jam_pulang['time_start'];
		$jam_pulang_end     = $jam_pulang['time_end'];

		if (date('H:i:s') > $jam_masuk['time_start'] && date('H:i:s') <= $jam_masuk['time_end']) {
			$time_status = 1;
		}else{
			$time_status = 2;
		}

		$time_cek = '00:00:00';
		$time_user_cek = $this->db->query("SELECT * FROM data_attendance where user_id = $user_id and date = '" . $curr_date . "' AND time_in != '".$time_cek."'")->num_rows();
		$time_user = $this->db->query("SELECT * FROM data_attendance where user_id = $user_id and date = '" . $curr_date . "'")->row_array();

		if ($time_user_cek == 0) {
			$data = [
				'user_id' => $user_id,
				'date' => $curr_date,
				'time_in' => $curr_time,
				'time_break' => $time_cek,
				'time_out' => $time_cek,
				'latlong' => '-6.9530251697747545, 108.46944914599598',
				'location' => 'belum ada lokasi',
				'status' => $time_status,
				'confirm' => '1'
			];
			$this->db->where('user_id', $user_id);
			$this->db->where('date', date('Y-m-d'));
			$this->db->update('data_attendance', $data);
			$this->session->set_flashdata('message', '<script>
               swal({
                title: "Berhasil Absen!",
                text: "Anda Berhasil Absen Masuk!",
                icon: "success",
                button: "OK",
                timer: 2000
                });
                </script>');
			redirect('operator/absen_pusat');
		} elseif ($time_cek == $time_user['time_out'] && $time_cek != $time_user['time_in']) {
			$time_cek2 = date("H:i:s", strtotime("+10 minutes", strtotime(($time_user['time_in']))));
			if ($curr_time < $time_cek2) {
				$this->session->set_flashdata('message', '<script>
                   swal({
                    title: "Status Absen!",
                    text: "Anda Baru Absen Masuk, Harap Tunggu 10 Menit Untuk Absen Pulang!",
                    icon: "warning",
                    button: "OK",
					timer: 2000
					});
					</script>');
				redirect('operator/absen_pusat');
			} else {
				$data = [
					'time_out' => $curr_time
				];

				$this->db->where('user_id', $user_id);
				$this->db->where('date', $curr_date);
				$this->db->update('data_attendance', $data);
				$this->session->set_flashdata('message', '<script>
                   swal({
                    title: "Berhasil Absen!",
                    text: "Anda Berhasil Absen Pulang!",
                    icon: "success",
					button: "OK",
					timer: 2000
					});
					</script>');
				redirect('operator/absen_pusat');
			}
		} else {
			$this->session->set_flashdata('message', '<script>
               swal({
                title: "Status Absen!",
                text: "Anda Sudah Absen Hari ini!",
                icon: "warning",
                button: "OK",
                timer: 2000
                });
                </script>');
			redirect('operator/absen_pusat');
		}
	}



}
