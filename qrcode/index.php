
    <?php
	
		include "php-qrcode-library/qrlib.php"; 
		/*create folder*/
		$tempdir="img-qrcode/";
		if (!file_exists($tempdir))
		mkdir($tempdir, 0755);
		$kode = $_GET['kode'];
		$file_name=$kode.".png";	
		$file_path = $tempdir.$file_name;
		
		QRcode::png($kode, $file_path, "H", 12, 2);
		/* param (1)qrcontent,(2)filename,(3)errorcorrectionlevel,(4)pixelwidth,(5)margin */
		
		header("location: http://localhost/karnas_absen/operator/qr");
	
    ?>