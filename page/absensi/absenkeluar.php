<?php include '../../aset/connection.php';
$id = $_GET['id'];
date_default_timezone_set('Asia/Kuala_Lumpur');
$hariini= strftime("%d %B %Y");
$jam_keluar = strftime("%I:%M");
// Fetch user data based on id
$query= mysqli_query($con,"SELECT * from absensi where id='$id' and tanggal like '%$hariini%'");
while ($data = mysqli_fetch_array($query)) {
$id = $data['id'];
}
$result = mysqli_query($con, "UPDATE absensi SET jam_pulang='$jam_keluar' where id ='$id'") or die(mysql_error());
if($result){
    session_start();
    session_destroy();
    header("location:../../index.php");
}   

?>