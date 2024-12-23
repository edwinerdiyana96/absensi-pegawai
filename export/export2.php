<?php
// Load file koneksi.php
$host = "localhost"; // Nama hostnya
$username = "root"; // Username
$password = ""; // Password (Isi jika menggunakan password)
$database = "db_absen"; // Nama databasenya

$connect = mysqli_connect($host, $username, $password, $database); // Koneksi ke MySQL

function tgl_indo($tanggal){
  $bulan = array (
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
  $pecahkan = explode('-', $tanggal);
  
  // variabel pecahkan 0 = tahun
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tanggal
 
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function bulan_indo($tanggal){
  $bulan = array (
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
  // $pecahkan = explode('-', $tanggal);
  
  // variabel pecahkan 0 = tanggal
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tahun
 
  return $bulan[ (int)$tanggal ];
   // return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}



// Load plugin PHPExcel nya
require_once 'PHPExcel/PHPExcel.php';

// Panggil class PHPExcel nya
$excel = new PHPExcel();

// Settingan awal fil excel
$excel->getProperties()->setCreator('Alterdev')
					   ->setLastModifiedBy('Alterdev')
					   ->setTitle("Data Absen")
					   ->setSubject("Absensi")
					   ->setDescription("Laporan Data Absensi")
					   ->setKeywords("Data Absensi");

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = array(
	'font' => array('bold' => true), // Set font nya jadi bold
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	)
);

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	)
);

$excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN ABSENSI SMK KARYA NASIONAL"); // Set kolom A1 dengan tulisan "DATA SISWA"
$excel->getActiveSheet()->mergeCells('A1:j1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
$excel->setActiveSheetIndex(0)->setCellValue('A2', "Jl. Cirendang - Cigugur, Cirendang, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45518"); // Set kolom A1 dengan tulisan "DATA SISWA"
$excel->getActiveSheet()->mergeCells('A2:J2'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A4', "TAHUN"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('B4', "BULAN"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('C4', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('D4', "JABATAN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
$excel->setActiveSheetIndex(0)->setCellValue('E4', "HADIR"); // Set kolom E3 dengan tulisan "TELEPON"
$excel->setActiveSheetIndex(0)->setCellValue('F4', "SAKIT"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('G4', "IZIN");
$excel->setActiveSheetIndex(0)->setCellValue('H4', "TELAT");
$excel->setActiveSheetIndex(0)->setCellValue('I4', "ALPHA");
$excel->setActiveSheetIndex(0)->setCellValue('J4', "PERSENTASE");

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('H4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('I4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J4')->applyFromArray($style_col);

$excel->getActiveSheet()
    ->getStyle('A4:J4')
    ->getFill()
    ->getStartColor()->setARGB('FFDBE2F1');


// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);

// Buat query untuk menampilkan semua data siswa
if (empty($_GET['bulan'])) {
	$bulan = "Semua";
	$tanggal_awal = date('Y')."-01-01";
		$tanggal_akhir = date('Y')."-12-31";
} else{
	$bulan = $_GET['bulan'];

	if ($bulan == 'Januari') {
		$tanggal_awal = date('Y')."-01-01";
		$tanggal_akhir = date('Y')."-01-31";
	} elseif ($bulan == 'Februari') {
		$tanggal_awal = date('Y')."-02-01";
		$tanggal_akhir = date('Y')."-02-31";
	} elseif ($bulan == 'Maret') {
		$tanggal_awal = date('Y')."-03-01";
		$tanggal_akhir = date('Y')."-03-31";
	} elseif ($bulan == 'April') {
		$tanggal_awal = date('Y')."-04-01";
			$tanggal_akhir = date('Y')."-04-31";
	} elseif ($bulan == 'Mei') {
		$tanggal_awal = date('Y')."-05-01";
		$tanggal_akhir = date('Y')."-05-31";
	} elseif ($bulan == 'Juni') {
		$tanggal_awal = date('Y')."-06-01";
		$tanggal_akhir = date('Y')."-06-31";
	} elseif ($bulan == 'Juli') {
		$tanggal_awal = date('Y')."-07-01";
		$tanggal_akhir = date('Y')."-07-31";
	} elseif ($bulan == 'Agustus') {
		$tanggal_awal = date('Y')."-08-01";
		$tanggal_akhir = date('Y')."-08-31";
	} elseif ($bulan == 'September') {
		$tanggal_awal = date('Y')."-09-01";
		$tanggal_akhir = date('Y')."-09-31";
	} elseif ($bulan == 'Oktober') {
		$tanggal_awal = date('Y')."-10-01";
		$tanggal_akhir = date('Y')."-10-31";
	} elseif ($bulan == 'November') {
		$tanggal_awal = date('Y')."-11-01";
		$tanggal_akhir = date('Y')."-11-31";
	} elseif ($bulan == 'Desember') {
		$tanggal_awal = date('Y')."-12-01";
		$tanggal_akhir = date('Y')."-12-31";
	}
}
$sql = mysqli_query($connect, "SELECT * FROM user where role_id != '19' and role_id != '1'");

$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 4
while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql

	if ($bulan=="Semua") {
		
	 for ($i = 0; $i < 12; $i++) {

	 		$m = $i + 1;
            $tanggal_awal = date('Y') . "-" . $m . "-01";
            $tanggal_akhir = date('Y') . "-" . $m . "-31";

			$hadir = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '1' and user_id = '".$data['id']."'"));
			$izin = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '4' and user_id = '".$data['id']."'"));
			$sakit = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '3' and user_id = '".$data['id']."'"));
			$telat = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '2' and user_id = '".$data['id']."'"));
			$alpha = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '0' and user_id = '".$data['id']."'"));

			$all = $hadir + $telat + $sakit + $izin + $alpha;
			if ($all == 0) {
				$persentase = 0;
			}else{
				$persentase = number_format($hadir / $all * 100);
			}

			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, date('Y'));
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, bulan_indo($m));
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['name']);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['department']);
			$excel->setActiveSheetIndex(0)->setCellValueExplicit('E'.$numrow, $hadir, PHPExcel_Cell_DataType::TYPE_STRING);
			$excel->setActiveSheetIndex(0)->setCellValueExplicit('F'.$numrow, $izin, PHPExcel_Cell_DataType::TYPE_STRING);
			$excel->setActiveSheetIndex(0)->setCellValueExplicit('G'.$numrow, $sakit, PHPExcel_Cell_DataType::TYPE_STRING);
			$excel->setActiveSheetIndex(0)->setCellValueExplicit('H'.$numrow, $telat, PHPExcel_Cell_DataType::TYPE_STRING);
			$excel->setActiveSheetIndex(0)->setCellValueExplicit('I'.$numrow, $alpha, PHPExcel_Cell_DataType::TYPE_STRING);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $persentase."%");


			// Khusus untuk no telepon. kita set type kolom nya jadi STRING
			// $excel->setActiveSheetIndex(0)->setCellValueExplicit('E'.$numrow, $data['telp'], PHPExcel_Cell_DataType::TYPE_STRING);
			
			// $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['alamat']);
				
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
			
			$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);

			$numrow++;
		}			
	} 

	// HANYA SATU BULAN
	else{
	$hadir = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '1' and user_id = '".$data['id']."'"));
	$izin = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '4' and user_id = '".$data['id']."'"));
	$sakit = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '3' and user_id = '".$data['id']."'"));
	$telat = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '2' and user_id = '".$data['id']."'"));
	$alpha = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_attendance where date <= '$tanggal_akhir' and date >= '$tanggal_awal' and status = '0' and user_id = '".$data['id']."'"));

	$all = $hadir + $telat + $sakit + $izin + $alpha;
	if ($all == 0) {
		$persentase = 0;
	}else{
		$persentase = number_format($hadir / $all * 100);
	}

	$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, date('Y'));
	$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $bulan);
	$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['name']);
	$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['department']);
	$excel->setActiveSheetIndex(0)->setCellValueExplicit('E'.$numrow, $hadir, PHPExcel_Cell_DataType::TYPE_STRING);
	$excel->setActiveSheetIndex(0)->setCellValueExplicit('F'.$numrow, $izin, PHPExcel_Cell_DataType::TYPE_STRING);
	$excel->setActiveSheetIndex(0)->setCellValueExplicit('G'.$numrow, $sakit, PHPExcel_Cell_DataType::TYPE_STRING);
	$excel->setActiveSheetIndex(0)->setCellValueExplicit('H'.$numrow, $telat, PHPExcel_Cell_DataType::TYPE_STRING);
	$excel->setActiveSheetIndex(0)->setCellValueExplicit('I'.$numrow, $alpha, PHPExcel_Cell_DataType::TYPE_STRING);
	$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $persentase."%");


	// Khusus untuk no telepon. kita set type kolom nya jadi STRING
	// $excel->setActiveSheetIndex(0)->setCellValueExplicit('E'.$numrow, $data['telp'], PHPExcel_Cell_DataType::TYPE_STRING);
	
	// $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['alamat']);
	
	// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
	
	$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
	$numrow++; // Tambah 1 setiap kali looping
	}
	$no++; // Tambah 1 setiap kali looping
}
$numrow++;
// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(13); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(8); // Set width kolom E
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(8); // Set width kolom F
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(8); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(8); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom E
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(13); // Set width kolom F





$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, "Kuningan, ".tgl_indo(date('d-m-Y'))); // Set mengetahui
$excel->getActiveSheet()->mergeCells('G'.$numrow.':I'.$numrow); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('G'.$numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('G'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // Set text center untuk kolom A1

$numrow++;


$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, "Kasubag TU");
$excel->getActiveSheet()->mergeCells('B'.$numrow.':C'.$numrow); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('B'.$numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1



$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, "Staff Kepegawaian");
$excel->getActiveSheet()->mergeCells('G'.$numrow.':I'.$numrow); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('G'.$numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('G'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // Set text center untuk kolom A1

$numrow = $numrow+5;

$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, "Eman Arisman");
$excel->getActiveSheet()->mergeCells('B'.$numrow.':C'.$numrow); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('B'.$numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1


$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, "Sarif Priant, A.Md.");
$excel->getActiveSheet()->mergeCells('G'.$numrow.':I'.$numrow); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('G'.$numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('G'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // Set text center untuk kolom A1

$numrow++;

$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "Mengetahui");
$excel->getActiveSheet()->mergeCells('D'.$numrow.':E'.$numrow); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('D'.$numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('D'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
$numrow++;

$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "Kepala Sekolah");
$excel->getActiveSheet()->mergeCells('D'.$numrow.':E'.$numrow); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('D'.$numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('D'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

$numrow = $numrow +5;

$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "Dr.Yepi Esa Trijaka, M.M.Pd");
$excel->getActiveSheet()->mergeCells('D'.$numrow.':E'.$numrow); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('D'.$numrow)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('D'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1













// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Laporan Absensi");
$excel->setActiveSheetIndex(0);

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Laporan Absensi.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>
