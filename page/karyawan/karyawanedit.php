<?php
if(isset ($_GET['id'])){
    $id = $_GET['id'];
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $agama = $_POST['agama'];
    $tgl = $_POST['tanggal'];
    $queri = "UPDATE karyawan SET nik='$nik',nama='$nama', telp='$telp', email='$email', alamat='$alamat', agama='$agama', tanggal_lahir ='$tgl' where id ='$id'" or die(mysql_error());
    $update = mysqli_query($con,$queri);
    if($update){
    $_SESSION['hasil'] = true;
    $_SESSION['pesan'] = "Pembharuan Data Karyawan berhasil";
    }else{
    $_SESSION['hasil'] = false;
    $_SESSION['pesan'] = "Pembharuan Data Karyawan gagal";            
    }
    echo "<meta http-equiv='refresh' content='0;url=?page=karyawan'>";
}
    $result = mysqli_query($con, "SELECT * FROM karyawan WHERE id=$id");
    $data = mysqli_fetch_array($result);
    if(isset($data['id'])){
?>

<div class="container-fluid">
<div class="row">
                <div class="col-sm-6">
                     
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="?page=karyawan">Karyawan</a></li>
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
                    <label for="nama_lokasi">NIK</label>
                    <input type="hidden" maxlength="16" name="id" value="<?= $data['id']; ?>" class="form-control" required>
                    <input type="text" maxlength="16" name="nik" value="<?= $data['nik']; ?>" class="form-control" required>
                    <br>
                    <label for="nama_lokasi">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required>
                    <br>
                    <label for="nama_lokasi">No Telepon</label>
                    <input type="text" maxlength="13" name="telp" value="<?= $data['telp']; ?>" class="form-control" required>
                    <br>
                    <label for="nama_lokasi">E-mail</label>
                    <input type="email" id="exampleInputEmail" value="<?= $data['email'];?>" aria-describedby="emailHelp" name="email" class="form-control" required>
                    <br>
                    <label for="nama_lokasi">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="<?= $data['alamat'];?>" required>
                    <br>
                    <label for="nama_lokasi">Agama</label>
                    <input type="text" name="agama" class="form-control" value="<?= $data['agama'];?>"required>
                    <br>
                    <label for="nama_lokasi">Tanggal Lahir</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal_lahir'];?>" required>
                    <br>
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
    }else{
        $_SESSION['hasi'] = false;
        echo "<meta http-equiv='refresh' content='0;url=?page=karyawan'>";
    }
}else{
    $_SESSION['hasi'] = true;
    echo "<meta http-equiv='refresh' content='0;url=?page=karyawan'>";
}
?>