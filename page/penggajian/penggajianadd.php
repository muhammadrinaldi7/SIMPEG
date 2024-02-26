<?php
$nik = $_GET['nik'];
$nikc = mysqli_query($con, "SELECT nik,nama FROM karyawan where nik not in(select nik from jabatan_karyawan)and nik like $nik;");
$cknik = mysqli_num_rows($nikc);
if($cknik>0){
    die("<div class='container-fluid'><b>Oops!</b> Access Failed.
    <p>Karyawan Ini Belum Masuk Dalam Level Karyawan</p>
    <a href='?page=penggajian' class='btn btn-danger btn-sm float-left' type='button'>Back</a>
    </div>");
}
setlocale(LC_ALL, 'id-ID', 'id_ID');
$tgl = strftime("%B %Y");
// Fetch user data based on id
$result = mysqli_query($con, "SELECT p.id,p.nik,p.nama,SUM(CASE when ket='H' then 1 else 0 end)+
SUM(CASE WHEN ket='T' then 1 else 0 end)as hk, SUM(case when ket='I' then 1 else 0 end)izin, 
SUM(CASE WHEN ket='A' then 1 else 0 end)alpha, SUM(CASE WHEN ket='T' then 1 else 0 end)telat,
SUM(CASE WHEN ket='T' then 1 else 0 end)+SUM(case when ket='H' then 1 else 0 end)-
SUM(case when ket='T' then 1 else 0 end) as hk1,SUM(case when ket='H' then 1 else 0 end)*uang_tp as ut,SUM(CASE WHEN ket='H' then 1 else 0 end)+
SUM(CASE WHEN ket='I' then 1 else 0 end)+SUM(CASE WHEN ket='T' then 1 else 0 end)as hk2,
(SUM(CASE WHEN ket='H' then 1 else 0 end)+SUM(CASE WHEN ket='I' then 1 else 0 end)+
SUM(CASE WHEN ket='T' then 1 else 0 end))*uang_mkn as um,IF(hadir>=18,200000,0) as iq 
from penggajian p left join absensi a on p.nik=a.nik left join jabatan_karyawan on jabatan_karyawan.nik = a.nik left join jabatan on jabatan.kd_jabatan = jabatan_karyawan.kd_jabatan where tanggal like '%$tgl%' group by p.nama;");
$qry = mysqli_query($con, "SELECT k.nik,j.uang_tp,j.uang_mkn,j.gapok from karyawan k left join jabatan_karyawan jk on jk.nik=k.nik left join jabatan j on j.kd_jabatan=jk.kd_jabatan where k.nik=$nik;") or die(mysqli_error);
$baris = mysqli_fetch_array($qry);
while ($data = mysqli_fetch_array($result)) {
    $nik = $data['nik'];
    $nama = $data['nama'];
    $hadir = $data['hk'];
    $izin = $data['izin'];
    $alpha = $data['alpha'];
    $telat = $data['telat'];
    $iq = $data['iq'];
    $ut = $data['ut'];
    $um = $data['um'];
}
?>

<div class="container-fluid">
<div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="?page=karyawan">Karyawan</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                    </ol>
                </div>
            </div>
    <div class="card-header">
        <strong>Input Gajih</strong>
    </div> 
    
    <div class="card-body">      
       <div class="container-fluid">
            <form method="POST">
                <div class="form-group">
                    <label for="nama_lokasi">NIK</label>
                    <input type="text" maxlength="16" name="nik" value="<?= $nik?>" class="form-control" readonly required>
                    <br>
                    <label for="nama_lokasi">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= $nama?>" readonly required>
                    <br>
                    <label for="nama_lokasi">Total Kehadiran</label>
                    <input type="text" maxlength="13"  name="hadir" value="<?= $hadir?>" class="col-sm-4 form-control" readonly required>
                    <br>
                    <label for="nama_lokasi">Total Izin</label>
                    <input type="text" value="<?= $izin?>" name="izin" class="col-sm-4 form-control" readonly required>
                    <br>
                    <label for="nama_lokasi">Total Alpha</label>
                    <input type="text" name="alpha" class="form-control col-sm-4" value="<?= $alpha?>" readonly required>
                    <br>
                    <label for="nama_lokasi">Total Telat</label>
                    <input type="text" name="telat" class="form-control col-sm-4" value="<?= $telat?>" readonly required>
                    <br>
                    <input type="hidden" name="gapok" value="<?= $baris['gapok']?>"id="">
                    <label for="nama_lokasi">Insentif Quality</label>
                    <input type="text" name="iq" class="form-control col-sm-4" value="<?= $iq?>" readonly required>
                    <br>
                    <label for="nama_lokasi">Insentif Quality</label>
                    <input type="text" name="ut" class="form-control col-sm-4" value="<?= $ut?>" readonly required>
                    <br>
                    <label for="nama_lokasi">Insentif Quality</label>
                    <input type="text" name="ut" class="form-control col-sm-4" value="<?= $um?>" readonly required>
                    <br>
                    <?php
                    $totlgaji = $baris['gapok']+$ut+$um;
                    ?>
                    <label for="nama_lokasi">Total Gajih</label>
                    <input type="text" name="tg" class="form-control col-sm-4" required readonly value="<?= $totlgaji?>">
                    <br>
                </div>
                <a href="?page=karyawan" class="btn btn-danger btn-sm float-right"><i class="fa fa-times">Batal</i></a>
                <button type="submit" name="update" class="btn btn-success btn-sm float-right mr-1">
                      <i class="fa fa-save"></i>Simpan
                </button>
            </form>
            <?php
            $bulan = strftime("%B");
            if (isset($_POST['update'])) {
                $nik = $_POST['nik'];
                $nama = addslashes($_POST['nama']);
                $hadir = $_POST['hadir'];
                $izin = $_POST['izin'];
                $alpha = $_POST['alpha'];
                $telat = $_POST['telat'];
                $iq = $_POST['iq'];
                $tg = $_POST['tg'];
                $totalgaji = $iq+$tg;
                // update user data
                $result = mysqli_query($con, "UPDATE penggajian SET nama='$nama', hadir='$hadir', izin='$izin', alpha='$alpha',telat = '$telat',bulan = '$bulan', iq='$iq', total_gajih =$totalgaji where nik='$nik';");
                echo "<meta http-equiv='refresh' content='0;url=?page=penggajian'>";
            }
            ?>
       </div>
    </div>
</div> 