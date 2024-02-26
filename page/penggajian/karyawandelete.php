<?php     
include '../../aset/connection.php';
$result =  "DELETE FROM penggajian;";
mysqli_query($con, $result);
	echo "<script>alert('Data Karyawan Telah Direset!') </script>";
    header("Refresh:0; url=../../home.php");
?>