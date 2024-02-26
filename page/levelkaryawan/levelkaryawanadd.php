<?php

if (isset($_POST['Submit'])) {
    $nik = $_POST['nik'];
    $kd = $_POST['kd'];
    $tgl = $_POST['tgl'];
    $result = mysqli_query($con, "INSERT INTO jabatan_karyawan(nik,kd_jabatan,tanggal_mulai) VALUES('$nik', '$kd','$tgl')");
   echo "<meta http-equiv='refresh' content='0;url=?page=levelkaryawan'>";
}
?>

<div class="container-fluid">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <strong>Tambah Data Jabatan/Level</strong>
            </div>
            <div class="card-body">
                <form method="POST"  class="form-horizontal col-md-6">
                    <div class="form-group">
                        <label for="kode" class="control-label">NIK</label> 
                        <div class="">
                        <select class="form-control" name="nik">
                        <?php
                            $sql="SELECT nik,nama FROM karyawan where nik not in(select nik from jabatan_karyawan)order by id desc;";

                            $hasil=mysqli_query($con,$sql);
                            $no=0;
                            while ($data = mysqli_fetch_array($hasil)) {
                            $no++;
                        ?>
                            <option value="<?php echo $data['nik'];?>">
                            <?php echo $data['nik'];?> - <?php echo $data['nama'];?></option>
                        <?php 
                            }
                        ?>
                        </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="jabatan" class="control-label">Pilih Level Jabatan</label>
                        <div class="">
                        <select class="form-control" name="kd">
                        <?php
                            //Perintah sql untuk menampilkan semua data pada tabel jurusan
                            $sql="SELECT * FROM jabatan";

                            $hasil=mysqli_query($con,$sql);
                            $no=0;
                            while ($data = mysqli_fetch_array($hasil)) {
                            $no++;
                        ?>
                            <option value="<?php echo $data['kd_jabatan'];?>">
                            <?php echo $data['nama_jabatan'];?></option>
                        <?php 
                            }
                        ?>
                        </select>
                        </div>
                    </div>
                    <br>
                  
                    <div class="form-group">
                        <label for="gajih" class="control-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tgl" placeholder="..." required>
                    </div>                    
                    <br>
                    <input type="submit" name="Submit" class="btn btn-success" value="Simpan">
                    <input type="reset" name="reset" class="btn btn-warning" value="Reset">
                
                </form>
            </div>
        </div>
    </div>
</div>  