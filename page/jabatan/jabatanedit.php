<?php
if(isset ($_GET['id'])){
    $id = $_GET['id'];
if(isset($_POST['update'])){
    $kd = $_POST['kd'];
    $jabatan = $_POST['jabatan'];
    $gajih = $_POST['gajih'];
    $ut = $_POST['ut']; 
    $um = $_POST['um'];
    $queri = "UPDATE jabatan SET kd_jabatan='$kd', nama_jabatan='$jabatan', gapok='$gajih', uang_tp='$ut', uang_mkn='$um' WHERE id='$id';" or die(mysql_error());
    $update = mysqli_query($con,$queri);
        if($update){
            $_SESSION['hasil'] = true;
            $_SESSION['pesan'] = "Pembharuan Data Jabatan berhasil";
        }else{
            $_SESSION['hasil'] = false;
            $_SESSION['pesan'] = "Pembharuan Data Jabatan gagal";            
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=jabatan'>";
}
    $result = mysqli_query($con, "SELECT * FROM jabatan WHERE id=$id");
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
                    <li class="breadcrumb-item"><a href="?page=jabatan">Jabtan</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                    </ol>
                </div>
            </div>
    <div class="card-header">
        <strong>Data Jabatan</strong>
    </div> 
    <div class="card-body">      
       <div class="container-fluid">
            <form method="POST">
                <div class="form-group">
                <label for="kode" class="control-label">Kode Jabatan</label> 
                    <input type="text" class="form-control " name="kd" value="<?= $data['kd_jabatan'] ?>" readonly placeholder="Masukan Kode Jabatan..." required> 
                    <br>
                    <label for="jabatan" class="control-label">Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" value="<?= $data['nama_jabatan'] ?>" readonly placeholder="Masukan Nama Jabatan..." required>
                    <br>
                    <label for="gajih" class="control-label">Gajih Pokok</label>
                    <input type="text" class="form-control" name="gajih" value="<?= $data['gapok']?>" placeholder="Masukan Gajih Pokok ..." required>
                    <br>
                    <label for="uangtransport" class="control-label">Uang Transport</label>
                    <input type="text" class="form-control" name="ut" value="<?= $data['uang_tp']?>" readonly placeholder="Masukan Uang Transport..." required>
                    <br>
                    <label for="uangmakan" class="control-label">Uang Makan</label>
                    <input type="text" class="form-control" name="um" value="<?= $data['uang_mkn']?>" readonly placeholder="Masukan Uang Makan..." required>
                    <br>
                </div>

                <a href="?page=jabatan" class="btn btn-danger btn-sm float-right"><i class="fa fa-times">Batal</i></a>
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
        echo "<meta http-equiv='refresh' content='0;url=?page=jabatan'>";
    }
    }else{
        $_SESSION['hasi'] = true;
        echo "<meta http-equiv='refresh' content='0;url=?page=jabatan'>";
    }
?>