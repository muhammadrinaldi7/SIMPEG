<div class="container">
<br>
<h4><center>LAPORAN ABSENSI HARI INI</center></h4>
<br>
<?php
setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set('Asia/Kuala_Lumpur');
$hrini= strftime(" %d %B %Y"); ?>
<strong>Tanggal :<?= $hrini?></strong>
<br>
<br>
<table border="1" class="table table-bordered table-hover">
    <br>
    <thead>
    <tr>
        <th>No</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>Jam Masuk</th>
        <th>Jam Pulang</th>
        <th>Keterangan</th>
    </tr>
    </thead>
    <?php
    include "../../aset/connection.php";
    setlocale(LC_ALL, 'id-ID', 'id_ID');
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $hrini= strftime("%d %B %Y");
    $sql="SELECT k.nik,k.nama, a.tanggal, a.jam_masuk, a.jam_pulang, a.ket from karyawan k LEFT JOIN absensi a ON k.nik=a.nik and a.tanggal like '%$hrini%'";

    $hasil=mysqli_query($con,$sql);
    $no=0;
    while ($data = mysqli_fetch_array($hasil)) {
        $no++;

        ?>
        <tbody>
        <tr>
            <td><?php echo $no;?></td>
            <td><?php echo "'".$data["nik"]; ?></td>
            <td><?php echo $data["nama"];   ?></td>
            <td><?php echo $data["jam_masuk"];   ?></td>
            <td><?php echo $data["jam_pulang"];   ?></td>
            <td><center><?php echo $data["ket"];?></center></td>
        </tr>
        </tbody>
        <?php
    }
    ?>
</table>
</div>