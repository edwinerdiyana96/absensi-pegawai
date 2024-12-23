<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Admin_model');
		$this->load->helper('cookie');
	}

	public function AjaxDataKehadiran($params = "")
	{

		$attendance = $this->db->query("SELECT * FROM data_attendance where attendance_id = '" . $params . "'")->row_array();
		$status = "";
		if ($attendance['status'] == '0') {
			$status .= '<option value="0" selected> Belum Absen</option>';
		} else {
			$status .= '<option value="0"> Belum Absen</option>';
		}

		if ($attendance['status'] == '1') {
			$status .= '<option value="1" selected> Hadir Tepat Waktu</option>';
		} else {
			$status .= '<option value="1"> Hadir Tepat Waktu</option>';
		}

		if ($attendance['status'] == '2') {
			$status .= '<option value="2" selected> Hadir Terlambat</option>';
		} else {
			$status .= '<option value="2"> Hadir Terlambat</option>';
		}
		if ($attendance['status'] == '3') {
			$status .= '<option value="3" selected> Sakit</option>';
		} else {
			$status .= '<option value="3"> Sakit</option>';
		}
		if ($attendance['status'] == '4') {
			$status .= '<option value="4" selected> Izin</option>';
		} else {
			$status .= '<option value="4"> Izin</option>';
		}
		$paragraf = '<div class="form-group">
		<label for="grade" class="col-sm-12 control-label">STATUS KEHADIRAN</label>
		<select class="form-control grade" name="status" id="status" required>
			<option value="" selected> --- TENTUKAN STATUS KEHADIRAN --- </option>'
			. $status . '
		</select>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="time_in" maxlength="8" name="time_in" placeholder="jam:menit:detik" value = "' . $attendance['time_in'] . '">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="time_out" maxlength="8" name="time_out" placeholder="jam:menit:detik" value = "' . $attendance['time_out'] . '">
		</div>
    	<div class="form-group">
            <input type="text" class="form-control" id="description" name="description" placeholder="Keterangan Kehadiran" value = "' . $attendance['description'] . '">
        </div>
        	<input type="hidden" name="attendance_id" value="' . $params . '">
        ';
		echo $paragraf;
	}
}
