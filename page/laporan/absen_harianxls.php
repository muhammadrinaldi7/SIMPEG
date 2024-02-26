<?php
header("Content-type: application/vnd-ms-excel");
setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set('Asia/Kuala_Lumpur');
$hrini= strftime("%A, %d %B %Y");
$filename = "Absensi-".strftime("%d %B %Y").".xls";
header("Content-Disposition: attachment;filename=".$filename);
include "dataxlsabsen.php";
?>
