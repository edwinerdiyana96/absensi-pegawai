<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pegawai extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		// is_logged_in();
		$this->load->model('Absensi_model');
		$this->load->model('Admin_model');
		$this->load->model('M_Datatables');
		$this->load->helper('jarak_helper');

		$cek = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->num_rows();
		if ($cek == 0) {
			redirect('auth');
		}
	}

	public function rekap($params = "")
	{
		// $data['title'] = 'Dashboard';
		// $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// $user = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		// $data['bulan'] = array(
		//     '0' => 'Januari',
		//     '1' => 'Februari',
		//     '2' => 'Maret',
		//     '3' => 'April',
		//     '4' => 'Mei',
		//     '5' => 'Juni',
		//     '6' => 'Juli',
		//     '7' => 'Agustus',
		//     '8' => 'September',
		//     '9' => 'Oktober',
		//     '10' => 'November',
		//     '11' => 'Desember',
		// );

		// $id = (int)$user['id'];
		// $data['data_absensi_user'] = $this->Absensi_model->getAbsensiPegawai($id);

		// $this->load->view('templates/header', $data);
		// $this->load->view('templates/sidebar', $data);
		// $this->load->view('templates/topbar', $data);
		// $this->load->view('rekap/pegawai', $data);
		// $this->load->view('templates/footer');

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


		$tanggal_awal = date('Y-m-01');
		$tanggal_akhir = date('Y-m-t', time());


		$data['riwayat'] = $this->Absensi_model->getAbsensiUserByDate($data['user']['id'], $tanggal_awal, $tanggal_akhir)->result_array();
		$id = $this->session->userdata('id');
		$data['data_pegawai'] = $this->Admin_model->getPegawaibyId($id)->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('rekap/pegawai', $data);
		$this->load->view('user/footer');
	}

	function data_rekap_pegawai_perbulan($bulan = "")
	{
		date_default_timezone_set("Asia/Jakarta");

		$tgl1 = date('Y-m-d', strtotime($bulan));
		$tgl2 = date('Y-m-d', strtotime('+1 month', strtotime($bulan)));
		$user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$query = "SELECT * FROM data_attendance JOIN user ON data_attendance.user_id = user.id";
		$search = array('attendance_id', 'user_id', 'name', 'date', 'time_in', 'time_break', 'time_out', 'status', 'description');
		// $where  = null;
		$where = array(
			'date >' => $tgl1,
			'date <' => $tgl2,
			'user_id' => $user['id']
		);

		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
	}

	function data_rekap_bulanan()
	{
		date_default_timezone_set("Asia/Jakarta");

		$tgl1 = date('Y') . "-01-01";
		$tgl2 = date('Y-m-d', strtotime('+1 years', strtotime($tgl1)));
		$user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$query = "SELECT * FROM user";
		$search = array('name', 'view_sakit', 'view_izin', 'view_alpha', 'view_hadir', 'view_tidak_hadir', 'view_persentase');
		// $where  = null;
		$where = array(
			'role_id !' => '1',
			'id' => $user['id']
		);

		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_rekap_bulanan($query, $search, $where, $isWhere, $tgl1, $tgl2);
	}

	public function export($params = "")
	{

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = [
			'font' => ['bold' => true],
			// Set font nya jadi bold
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				// Set text jadi ditengah secara horizontal (center)
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				// Set border top dengan garis tipis
				'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				// Set border right dengan garis tipis
				'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				// Set border bottom dengan garis tipis
				'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = [
			'alignment' => [
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				// Set border top dengan garis tipis
				'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				// Set border right dengan garis tipis
				'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				// Set border bottom dengan garis tipis
				'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];
		$alignment_center = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;

		$params = $this->input->post('bulan');
		if (empty($params)) {
			$bulan = "Semua";
			$tanggal_awal = date('Y-01-01');
			$tanggal_akhir = date('Y-12-t', time());
		} else {
			$bulan = $params;

			if ($bulan == 'Januari') {
				$tanggal_awal = date('Y') . "-01-01";
				$tanggal_akhir = date('Y') . "-01-31";
			} elseif ($bulan == 'Februari') {
				$tanggal_awal = date('Y') . "-02-01";
				$tanggal_akhir = date('Y') . "-02-31";
			} elseif ($bulan == 'Maret') {
				$tanggal_awal = date('Y') . "-03-01";
				$tanggal_akhir = date('Y') . "-03-31";
			} elseif ($bulan == 'April') {
				$tanggal_awal = date('Y') . "-04-01";
				$tanggal_akhir = date('Y') . "-04-31";
			} elseif ($bulan == 'Mei') {
				$tanggal_awal = date('Y') . "-05-01";
				$tanggal_akhir = date('Y') . "-05-31";
			} elseif ($bulan == 'Juni') {
				$tanggal_awal = date('Y') . "-06-01";
				$tanggal_akhir = date('Y') . "-06-31";
			} elseif ($bulan == 'Juli') {
				$tanggal_awal = date('Y') . "-07-01";
				$tanggal_akhir = date('Y') . "-07-31";
			} elseif ($bulan == 'Agustus') {
				$tanggal_awal = date('Y') . "-08-01";
				$tanggal_akhir = date('Y') . "-08-31";
			} elseif ($bulan == 'September') {
				$tanggal_awal = date('Y') . "-09-01";
				$tanggal_akhir = date('Y') . "-09-31";
			} elseif ($bulan == 'Oktober') {
				$tanggal_awal = date('Y') . "-10-01";
				$tanggal_akhir = date('Y') . "-10-31";
			} elseif ($bulan == 'November') {
				$tanggal_awal = date('Y') . "-11-01";
				$tanggal_akhir = date('Y') . "-11-31";
			} elseif ($bulan == 'Desember') {
				$tanggal_awal = date('Y') . "-12-01";
				$tanggal_akhir = date('Y') . "-12-31";
			}
		}
		$settings = $this->db->get('settings')->row_array();

		$sheet->setCellValue('A1', "LAPORAN ABSENSI " . $settings['name']); // Set kolom A1 dengan tulisan "DATA SISWA"
		$sheet->mergeCells('A1:j1'); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$sheet->getStyle('A1')->getFont()->setSize(16); // Set font size 15 untuk kolom A1
		$sheet->setCellValue('A2', "Jl. Cirendang - Cigugur, Cirendang, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45518"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$sheet->mergeCells('A2:J2'); // Set Merge Cell pada kolom A1 sampai F1
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
			$sheet->setCellValue('I5', "TOTAL HADIR");
			$sheet->setCellValue('J5', "TOTAL TIDAK HADIR");
			$sheet->setCellValue('K5', "PERSENTASE");
		} else {
			$sheet->setCellValue('A5', "No"); // Set kolom A3 dengan tulisan "NO"
			$sheet->setCellValue('B5', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
			$sheet->setCellValue('C5', "JABATAN"); // Set kolom C3 dengan tulisan "NAMA"
			$sheet->setCellValue('D5', "TEPAT WAKTU"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
			$sheet->setCellValue('E5', "TELAT"); // Set kolom E3 dengan tulisan "TELEPON"
			$sheet->setCellValue('F5', "SAKIT"); // Set kolom F3 dengan tulisan "ALAMAT"
			$sheet->setCellValue('G5', "IZIN");
			$sheet->setCellValue('H5', "ALPHA");
			$sheet->setCellValue('I5', "TOTAL HADIR");
			$sheet->setCellValue('J5', "TOTAL TIDAK HADIR");
			$sheet->setCellValue('K5', "PERSENTASE");
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

		// Set height baris ke 1, 2 dan 3
		$sheet->getRowDimension('1')->setRowHeight(20);
		$sheet->getRowDimension('2')->setRowHeight(20);
		$sheet->getRowDimension('3')->setRowHeight(20);
		$sheet->getRowDimension('4')->setRowHeight(20);

		// Buat query untuk menampilkan semua data siswa
		$user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data = $this->Absensi_model->getPegawaiExportByUserId($user['id'])->result_array();


		if ($bulan == "semua") {
			$sheet->setCellValue('I4', "Rekap Tahun " . date('Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
			$sheet->mergeCells('I4:K4'); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('I4')->getAlignment()->setHorizontal($alignment_center);
		} else {
			$sheet->setCellValue('I4', "Rekap Bulan " . $bulan . " Tahun " . date('Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
			$sheet->mergeCells('I4:K4'); // Set Merge Cell pada kolom A1 sampai F1
			$sheet->getStyle('I4')->getAlignment()->setHorizontal($alignment_center);
		}


		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach ($data as $key => $data) { // Ambil semua data dari hasil eksekusi $sql

			if ($bulan == "Semua") {

				for ($i = 0; $i < 12; $i++) {

					$m = $i + 1;
					$tanggal_awal = date('Y-m-01');
					$tanggal_akhir = date('Y-m-t', time());

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

					$all = $hadir + $telat + $sakit + $izin + $alpha;
					$total_hadir = $hadir + $telat;
					$absent = $sakit + $izin + $alpha;
					if ($all == 0) {
						$persentase = 0;
					} else {
						$persentase = number_format(($hadir + $telat) / $all * 100);
					}


					$sheet->setCellValue('A' . $numrow, bulan_indo($m));
					$sheet->setCellValue('B' . $numrow, $data['name']);
					$sheet->setCellValue('C' . $numrow, $data['department']);
					$sheet->setCellValue('D' . $numrow, $hadir);
					$sheet->setCellValue('E' . $numrow, $telat);
					$sheet->setCellValue('F' . $numrow, $sakit);
					$sheet->setCellValue('G' . $numrow, $izin);
					$sheet->setCellValue('H' . $numrow, $alpha);
					$sheet->setCellValue('I' . $numrow, $total_hadir);
					$sheet->setCellValue('J' . $numrow, $absent);
					$sheet->setCellValue('K' . $numrow, $persentase . "%");


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

				$all = $hadir + $telat + $sakit + $izin + $alpha;
				$total_hadir = $hadir + $telat;
				$absent = $sakit + $izin + $alpha;
				if ($all == 0) {
					$persentase = 0;
				} else {
					$persentase = number_format(($hadir + $telat) / $all * 100);
				}

				$sheet->setCellValue('A' . $numrow, $no++);
				$sheet->setCellValue('B' . $numrow, $data['name']);
				$sheet->setCellValue('C' . $numrow, $data['department']);
				$sheet->setCellValue('D' . $numrow, $hadir);
				$sheet->setCellValue('E' . $numrow, $telat);
				$sheet->setCellValue('F' . $numrow, $sakit);
				$sheet->setCellValue('G' . $numrow, $izin);
				$sheet->setCellValue('H' . $numrow, $alpha);
				$sheet->setCellValue('I' . $numrow, $total_hadir);
				$sheet->setCellValue('J' . $numrow, $absent);
				$sheet->setCellValue('K' . $numrow, $persentase . "%");


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

				$sheet->getRowDimension($numrow)->setRowHeight(20);
				$numrow++; // Tambah 1 setiap kali looping
			}
			$no++; // Tambah 1 setiap kali looping
		}
		$numrow++;
		// Set width kolom
		$sheet->getColumnDimension('A')->setWidth(15); // Set width kolom A
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





		$sheet->setCellValue('H' . $numrow, "Kuningan, " . tgl_indo(date('d-m-Y'))); // Set mengetahui
		$sheet->mergeCells('H' . $numrow . ':J' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('H' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1

		$numrow++;


		$sheet->setCellValue('B' . $numrow, "Kasubag TU");
		$sheet->mergeCells('B' . $numrow . ':C' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('B' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1



		$sheet->setCellValue('H' . $numrow, "Staff Kepegawaian");
		$sheet->mergeCells('H' . $numrow . ':J' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('H' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		$sheet->getStyle('H' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		$numrow = $numrow + 5;

		$sheet->setCellValue('B' . $numrow, "Eman Arisman");
		$sheet->mergeCells('B' . $numrow . ':C' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('B' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1


		$sheet->setCellValue('H' . $numrow, "Sarif Priant, A.Md.");
		$sheet->mergeCells('H' . $numrow . ':J' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('H' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		$sheet->getStyle('H' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		$numrow++;

		$sheet->setCellValue('D' . $numrow, "Mengetahui");
		$sheet->mergeCells('D' . $numrow . ':F' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('D' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		$sheet->getStyle('D' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		$numrow++;

		$sheet->setCellValue('D' . $numrow, "Kepala Sekolah");
		$sheet->mergeCells('D' . $numrow . ':F' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('D' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		$sheet->getStyle('D' . $numrow)->getAlignment()->setHorizontal($alignment_center);
		$numrow = $numrow + 5;

		$sheet->setCellValue('D' . $numrow, "Dr.Yepi Esa Trijaka, M.M.Pd");
		$sheet->mergeCells('D' . $numrow . ':F' . $numrow); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->getStyle('D' . $numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		$sheet->getStyle('D' . $numrow)->getAlignment()->setHorizontal($alignment_center);

		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$sheet->setTitle("Laporan Absensi Per Bulan");

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Absensi - Rekap Per Bulan.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}

	public function scan()
	{
		$settings = $this->db->get('settings')->row_array();
		$mapsEnabled = $settings['maps_enabled'];

		if ($mapsEnabled == 1) {
			// $lat = $this->input->post('lat');
			$lat = floatval($this->input->post('lat'));
			
			// $lng = $this->input->post('long');
			$lng = floatval($this->input->post('long'));
			
			$latKarnas = $settings['langitude'];
			// $latKarnas = floatval($settings['latitude']);
			
			$longKarnas = $settings['longitude'];
			// $longKarnas = floatval($settings['longitude']);
			
			
			$point1 = array("lat" => $lat, "long" => $lng);
			$point2 = array("lat" => $latKarnas, "long" => $longKarnas);
			$distance = hitung_jarak($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
			$jarakDefault = $this->db->get_where('data_jarak', ['status' => 1])->row_array();
			$jarak = $distance['meters'];
			
	//	if ($mapsEnabled == 1) {

			if ($jarak > $jarakDefault['jarak'] && $jarak != 12000) {
				$message = 'Absensi Tidak Bisa Dilakukan Ketika Lokasi Anda Berada Lebih Dari ' . $jarakDefault['jarak'] . ' Meter Dengan Pusat Absensi / Lingkungan ' . $settings['name'] . '! \n\n Lokasi Anda Sekarang: ' . $jarak . ' Meter Dari Pusat Absensi.';
				$this->setLocationMessage('warning', $message);
				redirect('user/dashboard');
			} elseif ($jarak == 12000) {
				$message = 'Lokasi Anda Saat Ini Tidak Terdeteksi! \n\n Solusi: \n 1) Coba tekan tombol SCAN QR kembali atau keluar dari aplikasi anda terlebih dahulu, kemudian buka kembali aplikasinya. \n\n 2) Disarankan tidak menggunakan WiFi, tapi menggunakan kuota / data seluler yang baik. \n\n 3) Pastikan GPS / Maps pada handphone anda sudah diaktifkan. \n\n Jika masih terkendala setelah melakukan solusi diatas, silahkan hubungi operator atau administrator dari aplikasi ini. Terimakasih!';
				$this->setLocationMessage('error', $message);
				redirect('user/dashboard');
			} else {
				$data['title'] = 'Scan Absensi';
				$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
				$data['attendance'] = $this->db->get_where('data_attendance', ['user_id' => $this->session->userdata('id')])->row_array();

				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('scan/index', $data);
				$this->load->view('user/footer');
			//	$this->load->view('templates/footer');
			}
		} else {
			// $this->setLocationMessage('info', 'Maps are not enabled.');
			// redirect('user/dashboard');
			
				$data['title'] = 'Scan Absensi';
				$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
				$data['attendance'] = $this->db->get_where('data_attendance', ['user_id' => $this->session->userdata('id')])->row_array();

				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('scan/index', $data);
				$this->load->view('user/footer');
			//	$this->load->view('templates/footer');
		}
	}

	private function setLocationMessage($type, $message)
	{
		$this->session->set_flashdata('message_absen', '<script>
        swal({
            title: "STATUS LOKASI",
            text: "' . $message . '",
            icon: "' . $type . '",
            button: "OK"
        });
    </script>');
	}

	public function scan_khusus()
	{

		$data['title'] = 'Scan Absensi';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['attendance'] = $this->db->get_where('data_attendance', ['user_id' => $this->session->userdata('id')])->row_array();
		$settings = $this->db->get('settings')->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('scan/scan_khusus', $data);
		$this->load->view('templates/footer');

		$lat = $this->input->post('lat1');
		$lng = $this->input->post('long1');

		$lat_karnas = $settings['langitude'];
		$long_karnas = $settings['longitude'];

		// $lat_karnas = '-7.349389038605919';
		// $long_karnas = '108.21821472248787';

		// echo $lat.", ".$lng;

		$settings = $this->db->get_where('settings')->row_array();

		if ($settings['maps_enabled'] == 1) {
			// $lat = $this->input->post('lat');
			// $lng = $this->input->post('long');

			// $lat_karnas = $settings['langitude'];
			// $long_karnas = $settings['longitude'];
			// $point1 = array("lat" => $lat, "long" => $lng);
			// $point2 = array("lat" => $lat_karnas, "long" => $long_karnas );
			// $distance = hitung_jarak($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
			// // echo '<pre>';
			// // print_r($distance);
			// // echo '</pre>';
			// $jarak_default = $this->db->get_where('data_jarak', ['status' => 1])->row_array();
			// $jarak = $distance['meters'];

			// if ($jarak > $jarak_default['jarak']) {
			// 	$this->session->set_flashdata('message_absen', '<script>
			//          swal({
			//     title: "STATUS LOKASI",
			//     text: "Absensi Tidak Bisa Dilakukan Ketika Lokasi Anda Berada Lebih Dari 100 Meter Dengan Pusat Absensi / Lingkungan '.$settings['name'].'! \n\n Lokasi Anda Sekarang: ' . $jarak . ' Meter Dari Pusat Absensi.",
			//     icon: "warning",
			//     button: "OK"
			//     // timer: 3000
			// });
			//     </script>');
			// 	redirect('user/dashboard');
			// // echo $lat_karnas."<br>";
			// // echo $long_karnas."<br>";
			// // echo $lat."<br>";
			// // echo $lng."<br>";
			// }
		}
	}


	public function absen()
	{

		$hasil_scan = $this->input->post('qr');
		$today = date('D');
		// $scan = $this->db->query("SELECT * FROM qr where qr_token = '" . $hasil_scan . "'")->num_rows();
		$scan = $this->Absensi_model->getKodeScan($hasil_scan)->num_rows();
		if ($scan == 1) {
			$user_id = $this->input->post('user_id');
			$cek_user = $this->Admin_model->getUserById($user_id);

			$cek_holiday = $this->Absensi_model->get_holiday_by_date(date('Y-m-d'))->num_rows();
			// Logika Pemilihan Absensi
			if ($today == 'Sat' || $today == 'Sun' || $cek_holiday != 0) {
				$this->Absensi_model->absen_holiday();
			} else {
				if ($cek_user['is_flexible'] == 1) {
					$this->Absensi_model->absen_flexible();
				} else {
					$this->Absensi_model->absen();
				}
			}

			// $this->session->set_flashdata('message', '<div class="alert alert-success" role="danger">Absen Berhasil</div>');
			// redirect('user');

		} elseif ($scan == 0) {
			// $this->session->set_flashdata('message_absen', '<div class="alert alert-danger" role="danger">Qr tidak valid</div>');
			$this->session->set_flashdata('message', '<script>
                     swal({
                title: "QR Code Status",
                text: "QR Token Tidak Valid",
                icon: "erorr",
                button: "Ok"
                // timer: 3000
            });
                </script>');
			redirect('user');
		}
	}

	public function absen_khusus()
	{

		$hasil_scan = $this->input->post('qr');
		$today = date('D');
		// $scan = $this->db->query("SELECT * FROM qr where qr_token = '" . $hasil_scan . "'")->num_rows();
		$scan = $this->Absensi_model->getKodeScan($hasil_scan)->num_rows();
		if ($scan == 1) {
			$user_id = $this->input->post('user_id');
			$cek_user = $this->Admin_model->getUserById($user_id);

			$cek_holiday = $this->Absensi_model->get_holiday_by_date(date('Y-m-d'))->num_rows();
			// Logika Pemilihan Absensi
			// if ($today == 'Sat' || $today == 'Sun' || $cek_holiday != 0) {
			// 	$this->Absensi_model->absen_holiday();
			// } else {
			$this->Absensi_model->absen_khusus();
			// }

			// $this->session->set_flashdata('message', '<div class="alert alert-success" role="danger">Absen Berhasil</div>');
			// redirect('user');

		} elseif ($scan == 0) {
			// $this->session->set_flashdata('message_absen', '<div class="alert alert-danger" role="danger">Qr tidak valid</div>');
			$this->session->set_flashdata('message', '<script>
                     swal({
                title: "QR Code Status",
                text: "QR Token Tidak Valid",
                icon: "erorr",
                button: "Ok"
                // timer: 3000
            });
                </script>');
			redirect('user');
		}
	}

	public function ketidakhadiran($params = "")
	{
		if ($params == "") {
			$data['filter'] = date('Y-m-d');
		} else {
			$data['filter'] = $this->input->post('filter');
		}
		$data['title'] = 'KetidakHadiran';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		$data['tanggal'] = $curr_date;
		$data['attendance'] = $this->db->get_where('data_attendance', ['user_id' => $this->session->userdata('id')])->row_array();
		$data['data_ketidakhadiran'] = $this->Absensi_model->getDataKetidakHadiranByUserIdDate($data['filter'])->result_array();

		$data['cek_data'] = $this->Absensi_model->cekDataKetidakHadiran();

		// $user_id = $this->input->post('user_id');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('scan/ketidakhadiran', $data);
		$this->load->view('templates/footer');
	}

	public function insertUserAbsensiSakit()
	{
		$id_user = $this->input->post('user_id');
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		$keterangan = $this->input->post('description');
		$status = $this->input->post('status_sakit');


		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx|doc';
		$config['max_size'] = 54100;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('upload')) {
			$error = array('error' => $this->upload->display_errors());
			// $this->load->view('v_upload', $error);
			if (empty($_FILES['upload']['name'])) {
				$data = [
					'id_user' => $id_user,
					'tanggal' => $curr_date,
					'keterangan' => $keterangan,
					'document' => '-',
					'status' => $status,
					'is_active' => '0'
				];
				$this->Absensi_model->insertUserAbsensiSakit($data);
				$this->session->set_flashdata('message', '<script>
					swal({
						title: "Konfirmasi Sakit",
						text: "Konfirmasi Sakit Berhasil Dikirimkan!",
						icon: "success",
						button: "Ok"
							// timer: 3000
						});
						</script>');
				redirect('pegawai/ketidakhadiran');
			} else {
				echo $error['error'];
				$this->session->set_flashdata('message', '<script>
						swal({
						title: "Gagal!",
						text: "' . $error['error'] . '",
						icon: "error",
						button: "Ok"
							// timer: 3000
						});
						</script>');
				redirect('admin/settings');
			}


		} else {
			echo "Sukses";
			//     $data = array('upload_data' => $this->upload->data());
			$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
			$file_name = "uploads/" . $upload_data['file_name'];

			$data = [
				'id_user' => $id_user,
				'tanggal' => $curr_date,
				'keterangan' => $keterangan,
				'document' => $file_name,
				'status' => $status,
				'is_active' => '0'
			];
			$this->Absensi_model->insertUserAbsensiSakit($data);
			$this->session->set_flashdata('message', '<script>
					swal({
						title: "Konfirmasi Sakit",
						text: "Konfirmasi Sakit Berhasil Dikirimkan!",
						icon: "success",
						button: "Ok"
							// timer: 3000
						});
						</script>');
			redirect('pegawai/ketidakhadiran');
		}

	}

	public function insertUserAbsensiIzin()
	{
		$id_user = $this->input->post('user_id');
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		$keterangan = $this->input->post('description');
		$status = $this->input->post('status_izin');


		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx|doc';
		$config['max_size'] = 54100;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('upload')) {
			$error = array('error' => $this->upload->display_errors());
			// $this->load->view('v_upload', $error);
			if (empty($_FILES['upload']['name'])) {
				$data = [
					'id_user' => $id_user,
					'tanggal' => $curr_date,
					'keterangan' => $keterangan,
					'document' => '-',
					'status' => $status,
					'is_active' => '0'
				];
				$this->Absensi_model->insertUserAbsensiIzin($data);
				$this->session->set_flashdata('message', '<script>
					swal({
						title: "Konfirmasi Izin",
						text: "Konfirmasi Izin Berhasil Dikirimkan!",
						icon: "success",
						button: "Ok"
							// timer: 3000
						});
						</script>');
				redirect('pegawai/ketidakhadiran');
			} else {
				echo $error['error'];
				$this->session->set_flashdata('message', '<script>
						swal({
						title: "Gagal!",
						text: "' . $error['error'] . '",
						icon: "error",
						button: "Ok"
							// timer: 3000
						});
						</script>');
				redirect('admin/settings');
			}


		} else {
			echo "Sukses";
			//     $data = array('upload_data' => $this->upload->data());
			$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
			$file_name = "uploads/" . $upload_data['file_name'];

			$data = [
				'id_user' => $id_user,
				'tanggal' => $curr_date,
				'keterangan' => $keterangan,
				'document' => $file_name,
				'status' => $status,
				'is_active' => '0'
			];
			$this->Absensi_model->insertUserAbsensiIzin($data);
			$this->session->set_flashdata('message', '<script>
					swal({
						title: "Konfirmasi Izin",
						text: "Konfirmasi izin Berhasil Dikirimkan!",
						icon: "success",
						button: "Ok"
							// timer: 3000
						});
						</script>');
			redirect('pegawai/ketidakhadiran');
		}
	}

	public function insertUserAbsensiOff()
	{
		$id_user = $this->input->post('user_id');
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		$keterangan = $this->input->post('description');
		$status = "5";



		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx|doc';
		$config['max_size'] = 54100;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('upload')) {
			$error = array('error' => $this->upload->display_errors());
			// $this->load->view('v_upload', $error);
			if (empty($_FILES['upload']['name'])) {
				$data = [
					'id_user' => $id_user,
					'tanggal' => $curr_date,
					'keterangan' => $keterangan,
					'document' => '-',
					'status' => $status,
					'is_active' => '0'
				];
				$this->Absensi_model->insertUserAbsensiOff($data);
				$this->session->set_flashdata('message', '<script>
				swal({
					title: "Konfirmasi Izin",
					text: "Konfirmasi Izin Berhasil Dikirimkan!",
					icon: "success",
					button: "Ok"
						// timer: 3000
					});
					</script>');
				redirect('pegawai/ketidakhadiran');
			} else {
				echo $error['error'];
				$this->session->set_flashdata('message', '<script>
					swal({
					title: "Gagal!",
					text: "' . $error['error'] . '",
					icon: "error",
					button: "Ok"
						// timer: 3000
					});
					</script>');
				redirect('admin/settings');
			}


		} else {
			echo "Sukses";
			//     $data = array('upload_data' => $this->upload->data());
			$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
			$file_name = "uploads/" . $upload_data['file_name'];

			$data = [
				'id_user' => $id_user,
				'tanggal' => $curr_date,
				'keterangan' => $keterangan,
				'document' => $file_name,
				'status' => $status,
				'is_active' => '0'
			];
			$this->Absensi_model->insertUserAbsensiOff($data);
			$this->session->set_flashdata('message', '<script>
				swal({
					title: "Konfirmasi Izin",
					text: "Konfirmasi izin Berhasil Dikirimkan!",
					icon: "success",
					button: "Ok"
						// timer: 3000
					});
					</script>');
			redirect('pegawai/ketidakhadiran');
		}
	}

	function qrcode()
	{
		$data['title'] = 'Qr Code';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		if ($data['user']['qr_code'] != 'OK') {
			include APPPATH . 'third_party/php-qrcode-library/qrlib.php';
			/*create folder*/
			$tempdir = "assets/qr/";
			if (!file_exists($tempdir))
				mkdir($tempdir, 0755);
			$kode = $data['user']['id'];
			$file_name = $kode . ".png";
			$file_path = $tempdir . $file_name;

			QRcode::png($kode, $file_path, "H", 12, 2);
			/* param (1)qrcontent,(2)filename,(3)errorcorrectionlevel,(4)pixelwidth,(5)margin */
			$input = [
				'qr_code' => 'OK'
			];
			$this->db->where('id', $data['user']['id']);
			$this->db->update('user', $input);
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/qr_code', $data);
		$this->load->view('templates/footer');
	}
}