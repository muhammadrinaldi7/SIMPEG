<?php include '../../aset/connection.php'; ?>
<?php

if (isset($_POST['submit'])) {
	$nik = $_POST['nik'];
	date_default_timezone_set('Asia/Kuala_Lumpur');
	$waktu = strftime("%H:%M");
	setlocale(LC_ALL, 'id-ID', 'id_ID');
	$tgl = strftime("%A, %d %B %Y");
	$jam = strftime("%I:%M:%S");
	
}
$querry = mysqli_query($con, "SELECT tanggal from absensi where nik='$nik' and tanggal like '%$tgl%'");
$cek = mysqli_num_rows($querry);
	if($cek > 0 ){
		echo "<script>alert('Cukup, Hari ini anda sudah absen') </script>";
		header("Refresh:0; url=../../home.php");
		exit;
	}else if($waktu < '08:15'){
	$save = "INSERT INTO absensi SET nik='$nik', tanggal='$tgl', jam_masuk='$waktu', ket='H'";
	mysqli_query($con, $save);
	echo "<script>alert('Terimakasih, Anda sudah absen untuk hari ini.') </script>";
    header("Refresh:0; url=../../home.php");
	}else{
	$save = "INSERT INTO absensi SET nik='$nik', tanggal='$tgl', jam_masuk='$waktu', ket='T'";
	mysqli_query($con, $save);
	echo "<script>alert('Anda Absen Telat Hari Ini.') </script>";
    header("Refresh:0; url=../../home.php");
	}
 ?>