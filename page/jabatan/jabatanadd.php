<?php 
    if(isset($_POST['insert'])){
    $kd = $_POST['kd'];
    $jabatan = $_POST['jabatan'];
    $gajih = $_POST['gajih'];
    $ut = $_POST['ut']; 
    $um = $_POST['um'];
    $result = mysqli_query($con, "INSERT INTO jabatan SET kd_jabatan='$kd', nama_jabatan='$jabatan', gapok='$gajih', uang_tp='$ut', uang_mkn='$um';");
        if($result){
            $_SESSION['hasil'] = true;
            $_SESSION['pesan'] = "Tambah data Jabatan berhasil";
        }else{
            $_SESSION['hasil'] = false;
            $_SESSION['pesan'] = "Tambah data Jabatan gagal";            
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=jabatan'>";
    }
?>
<div class="container-fluid">
<div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="?page=jabatan">Karyawan</a></li>
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
                    <label for="kode" class="control-label">Kode Jabatan</label> 
                    <input type="text" class="form-control " name="kd" placeholder="Masukan Kode Jabatan..." required> 
                    <br>
                    <label for="jabatan" class="control-label">Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" placeholder="Masukan Nama Jabatan..." required>
                    <br>
                    <label for="gajih" class="control-label">Gajih Pokok</label>
                    <input type="text" class="form-control" name="gajih" placeholder="Masukan Gajih Pokok ..." required>
                    <br>
                    <label for="uangtransport" class="control-label">Uang Transport</label>
                    <input type="text" class="form-control" name="ut" value="18000" placeholder="Masukan Uang Transport..." readonly required>
                    <br>
                    <label for="uangmakan" class="control-label">Uang Makan</label>
                    <input type="text" class="form-control" name="um" value="20000" placeholder="Masukan Uang Makan..." readonly required>
                    <br>
                </div>

                <a href="?page=jabatan" class="btn btn-danger btn-sm float-right"><i class="fa fa-times">Batal</i></a>
                <button type="submit" name="insert" class="btn btn-success btn-sm float-right mr-1">
                      <i class="fa fa-save"></i>Simpan
                </button>
            </form>
       </div>
    </div>
</div> 