<script type="text/javascript">
    window.print()
    </script>
<?php 
    include '../../aset/connection.php';
    if(isset($_POST['slip'])){
        $nik = $_POST['nik'];
        $qry = "select k.*, nama_jabatan from karyawan k left join jabatan_karyawan on jabatan_karyawan.nik = k.nik left join jabatan on jabatan_karyawan.kd_jabatan = jabatan.kd_jabatan where k.nik = $nik;";
        $lihat = mysqli_query($con,$qry);
        $data = mysqli_fetch_array($lihat);
    }
?>
<div class="container">
<table border="0" cellspacing="0" cellpadding="">
    <tr><th><img src="../../img1/gawi.jpg" width="200" float="left" height="120" alt="" srcset=""></th><td style="width:80%;"><h2 style="margin-top:33px"><center>PT. GAWI MAKMUR KALIMANTAN</center></h2></td><th style="width:100%"></th></tr>
</table>


 
 <br>
<h3><u><center>SLIP GAJIH KARYAWAN</center></u></h3>
<h4 style = "margin-top:0;margin-bottom:0"><center>Jl. Pramuka Km.6 Banjarmasin Utara</center></h4> 
<hr style="width:50%;border:3px solid black" >
<br>
<?php
setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set('Asia/Kuala_Lumpur');
$hrini= strftime(" %d %B %Y"); ?>
<table>
    <tr><th style="text-align:left">NIK</th><td>: <?= $nik; ?></td> </tr>
    <tr><th style="text-align:left">Nama</th><td>: <?= $data['nama']; ?></td></tr>
    <tr><th style="text-align:left">Status</th><td>: <?= $data['nama_jabatan']; ?></td></tr>
</table>
<br>
<strong> <u> Penghasilan :</u></strong> <br>
<?php 
$bln= strftime("%B"); 
$gapok = mysqli_fetch_array(mysqli_query($con,"SELECT k.nik,j.gapok from karyawan k left join jabatan_karyawan jk on jk.nik=k.nik left join jabatan j on j.kd_jabatan=jk.kd_jabatan where k.nik='$nik';"));
$ut = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(case when ket='H' then 1 else 0 end)*18000 as ut from absensi where nik='$nik' and tanggal like '%$bln%';"));
$um = mysqli_fetch_array(mysqli_query($con,"SELECT (SUM(CASE WHEN ket='H' then 1 else 0 end)+SUM(CASE WHEN ket='I' then 1 else 0 end)+SUM(CASE WHEN ket='T' then 1 else 0 end))*20000 as um from absensi where nik='$nik' and tanggal like '%$bln%';"));
$iq = mysqli_fetch_array(mysqli_query($con,"SELECT IF(sum(case when ket='H' then 1 else 0 end)>=18,200000,0) as iq from absensi where nik='$nik' and tanggal like '%$bln%';"));

?>
<table border="0" >
    <br>
    <thead>
    <tr style="height:30px"><th style="text-align:left">Gajih Pokok</th> <td style="width:80px"></td><td>= <b> <?= "Rp. ".number_format($gapok['gapok']);?></b></td></tr>
    <tr style="height:30px"><th style="text-align:left">Tunjangan Transportasi</th><td></td><td>= <b><?= "Rp. ".number_format($ut['ut']);?></b></td></tr>
    <tr style="height:30px"><th style="text-align:left">Tunjangan Makan</th><td></td><td>= <b><?= "Rp. ".number_format($um['um']);?></b></td></tr>
    <tr style="height:30px"><th style="text-align:left">Insentif Quality</th><td></td><td>= <b><?= "Rp. ".number_format($iq['iq']);?></b></td></tr>
    <tr><th><td></td><td><hr style="position:left;width:100%" ></td> </th></tr>
    <?php $ttlp = $gapok['gapok'] + $ut['ut'] + $um['um'] + $iq['iq']?>
    <tr><th> TOTAL PENDAPATAN<td></td><td>= <b><?= "Rp. ".number_format($ttlp);?></b></td> </th></tr>
</thead> 
    <?php
    include "../../aset/connection.php";
    setlocale(LC_ALL, 'id-ID', 'id_ID');
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $hrini= strftime("%d %B %Y");
    $sql="SELECT * from karyawan where nik='$nik';";
    ?>
</table>
</div>