<?php 
    if(isset($_POST['insert'])){
        $nik = addslashes($_POST['nik']);
        $nama =addslashes($_POST['nama']);
        $telp = $_POST['telp'];
        $email = addslashes($_POST['email']); 
        $alamat = addslashes($_POST['alamat']);
        $agama = addslashes($_POST['agama']);
        $tgl_lahir = $_POST['tanggal'];
        $insert = "INSERT INTO karyawan SET nik='$nik',nama='$nama',telp='$telp',email='$email', alamat='$alamat',agama='$agama',tanggal_lahir='$tgl_lahir'";
        $exct = mysqli_query($con,$insert);
        if($exct){
            $_SESSION['hasil'] = true;
            $_SESSION['pesan'] = "Tambah data Jabatan berhasil";
        }else{
            $_SESSION['hasil'] = false;
            $_SESSION['pesan'] = "Tambah data Jabatan gagal";            
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=karyawan'>";
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
        <strong>Data Karyawan</strong>
    </div> 
    
    <div class="card-body">      
       <div class="container-fluid">
            <form method="POST">
                <div class="form-group">
                    <label for="nama_lokasi">NIK</label>
                    <input type="text" maxlength="16" name="nik" class="form-control" required>
                    <br>
                    <label for="nama_lokasi">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                    <br>
                    <label for="nama_lokasi">No Telepon</label>
                    <input type="text" maxlength="13" name="telp" class="form-control" required>
                    <br>
                    <label for="nama_lokasi">E-mail</label>
                    <input type="email" id="exampleInputEmail" aria-describedby="emailHelp" name="email" class="form-control" required>
                    <br>
                    <label for="nama_lokasi">Alamat</label>
                    <input type="text" name="alamat" class="form-control" required>
                    <br>
                    <label for="nama_lokasi">Agama</label>
                    <input type="text" name="agama" class="form-control" required>
                    <br>
                    <label for="nama_lokasi">Tanggal Lahir</label>
                    <input type="date" name="tanggal" class="form-control" required>
                    <br>
                </div>

                <a href="?page=karyawan" class="btn btn-danger btn-sm float-right"><i class="fa fa-times">Batal</i></a>
                <button type="submit" name="insert" class="btn btn-success btn-sm float-right mr-1">
                      <i class="fa fa-save"></i>Simpan
                </button>
            </form>
       </div>
    </div>
</div> 