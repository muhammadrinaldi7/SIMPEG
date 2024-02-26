<div class="container">
<br>
<h4><center>ABSENSI HARI INI</center></h4>
<br>
<?php
setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set('Asia/Kuala_Lumpur');
$hrini= strftime(" %d %B %Y"); ?>
<strong>Tanggal :<?= $hrini?></strong>
<br>
<table class="table table-bordered table-hover">
    <br>
    <thead>
    <tr>
        <th>No</th>
        <?php if($_SESSION['level'] == "admin"){?>
        <th>NIK</th>
        <?php }?>
        <th>Nama</th>
        <th>Jam Masuk</th>
        <th>Jam Pulang</th>
        <th>Keterangan</th>
        <?php if($_SESSION['level'] == "admin"){?>
        <th>Aksi</th>
        <?php }?>
    </tr>
    </thead>
    <?php
    include "aset/connection.php";
    setlocale(LC_ALL, 'id-ID', 'id_ID');
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $hrini= strftime("%d %B %Y");
    $sql="SELECT a.id,k.nik,k.nama, a.tanggal, a.jam_masuk, a.jam_pulang,a.ket from karyawan k lEFT JOIN absensi a ON k.nik=a.nik and a.tanggal like '%$hrini%' group by k.nama";

    $hasil=mysqli_query($con,$sql);
    $no=0;
    while ($data = mysqli_fetch_array($hasil)) {
        $no++;

        ?>
        <tbody>
        <tr>
            <td><?php echo $no;?></td>
            <?php if($_SESSION['level'] == "admin"){?>
            <td><?php echo $data["nik"]; ?></td>
            <?php }?>
            <td><?php echo $data["nama"];   ?></td>
            <td><?php echo $data["jam_masuk"];   ?></td>
            <td><?php echo $data["jam_pulang"];   ?></td>
            <td><center><?php echo $data["ket"];   ?></center></td>
            
            <?php if($_SESSION['level'] == "admin"){?>
                <td>
                <a href="?page=absenupdate&nik=<?php echo $data['nik'].'&id='.$data['id'] ?>"class="btn btn-primary btn-sm mr-1">
                <i class="fa fa-edit"></i>
                </a>
                </td>
            <?php } ?>
        
        </tr>
        </tbody>
        <?php
    }
    ?>
</table>
</div>