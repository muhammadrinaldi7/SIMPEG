<?php    
$nik = $_GET["nik"]; 
include '../../aset/connection.php';
$result =  "UPDATE penggajian SET iq='',total_gajih='' where nik='$nik'";
mysqli_query($con, $result);
	echo "<script>alert('Data Karyawan Telah Direset!') </script>";
    echo "<meta http-equiv='refresh' content='0;url=?page=penggajian'>";
?>