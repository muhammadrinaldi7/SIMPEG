<?php     
include '../../aset/connection.php';
setlocale(LC_ALL, 'id-ID', 'id_ID');
$tgl = strftime("%B");
$result =  "INSERT INTO penggajian (nik,nama) SELECT nik,nama FROM karyawan;";
if(mysqli_query($con, $result)){
    echo "<script>alert('Data Karyawan Telah Terinput') </script>";
    header("Refresh:0; url=../../home.php");
}else{
    echo "<script>alert('Data Karyawan Gagal Diinput Terinput') </script>";
header("Refresh:0; url=../../home.php");
}

?>