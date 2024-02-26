<?php
$id = $_GET['id'];
$nik= $_GET['nik'];
setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set('Asia/Kuala_Lumpur');
$hrini= strftime("%A, %d %B %Y");
$a = mysqli_query($con, "SELECT absensi.*, karyawan.nama from absensi inner join karyawan on absensi.nik=karyawan.nik where absensi.nik=$nik and absensi.tanggal like '%$hrini%' ");
$cekid = mysqli_num_rows($a);
if($cekid > 0) {
    while ($data = mysqli_fetch_array($a)) {
        $nik = $data['nik'];
        $tanggal = $data['tanggal'];
        $telp = $data['jam_masuk'];
        $email = $data['jam_pulang'];
        $ket = $data['ket'];
        $nama = $data['nama'];
    }
} else {
    $b = mysqli_query($con, "SELECT nik,nama from karyawan where nik='$nik'");
    while ($data = mysqli_fetch_array($b)) {
        $nik1 = $data['nik'];
        $nama = $data['nama'];
    }
}
?>

<div class="container-fluid">
<div class="row">
                <div class="col-sm-6">
                     
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="?page=absen">Absensi</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                    </ol>
                </div>
            </div>
    <div class="card-header">
        <strong>Data Karyawan</strong>
    </div> 
    
    <div class="card-body">      
       <div class="container-fluid">
            <form method="POST">
                <div class="form-group">
                    <input type="hidden" value="<?php echo $id; ?>" name="id" placeholder="">
                    <label for="nama_lokasi">NIK</label>
                    <input type="text" maxlength="16" name="nik" value="<?= $nik ?>" class="form-control" readonly required>
                    <br>
                    <label for="nama_lokasi">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= $nama ?>" readonly required>
                    <br>
                    <label for="nama_lokasi">Tanggal</label>
                    <input type="text" name="tgl" value="<?=$hrini?>" class="form-control" readonly required>
                    <br>
                    <select class="form-control" name="ket">
                        <option value="H">Hadir</option>
                        <option value="I">Izin</option>
                        <option value="A">Alpha</option>
                        <option value="T">Telat</option>
                    </select>
                </div>

                <a href="?page=karyawan" class="btn btn-danger btn-sm float-right"><i class="fa fa-times">Batal</i></a>
                <button type="submit" name="update" class="btn btn-success btn-sm float-right mr-1">
                      <i class="fa fa-save"></i>Simpan
                </button>
            </form>
       </div>
    </div>
</div> 
<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nik = $_POST['nik'];
    $keterangan = $_POST['ket'];
    $tgl = $_POST['tgl'];
    $qry = mysqli_query($con, "SELECT absensi.*, karyawan.nama from absensi inner join karyawan on absensi.nik=karyawan.nik where karyawan.nik=$nik and absensi.tanggal like '%$hrini%'");
    $cek = mysqli_num_rows($qry);
    if ($cek > 0) {
        $result = mysqli_query($con, "UPDATE absensi SET ket='$keterangan' where id ='$id'") or die(mysql_error());
    } else {
        $save = "INSERT INTO absensi SET nik='$nik', tanggal='$tgl', ket='$keterangan'";
	    mysqli_query($con, $save);
        
    }
        echo "<meta http-equiv='refresh' content='0;url=?page=absen'>";
}
?>