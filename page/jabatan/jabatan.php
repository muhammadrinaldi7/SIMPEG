<div class="container-fluid">
    <?php 
            if(isset($_SESSION['hasil'])){
              if($_SESSION['hasil']){
                    $alert = "alert-success";
                    $icon = "fa-check";
                    $keterangan = "Berhasil";
              }else{
                $alert = "alert-danger";
                $icon = "fa-check";
                $keterangan = "Gagal";
              }
            
        ?>
           <div class="alert <?= $alert ?> alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span aria-hidden="true">x</span></button>
              <h5><i class="fa <?= $icon ?>"></i><?= $keterangan ?></h5>
              <?= $_SESSION['pesan']; ?>
           </div>
           <?php 
              unset($_SESSION['hasil']);
              unset($_SESSION['pesan']);
          }
        ?>
    <div class="card-header">
        <strong>Data Level Jabatan</strong>
    </div> 
    
    <div class="card-body">
        <?php 
        if ($_SESSION['level'] == "admin") { ?>
        <a href="?page=jabatanadd" class="btn btn-success mb-2"><i class="fa fa-plus-circle"></i> Tambah Data</a>
        <?php } ?>
        <hr>
       <!-- <a href="../mobil/mobil_print.php" target="_blank" class="btn btn-primary mb-2">Cetak Data</a> -->
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover m-0"> 
                <?php
                include 'aset/connection.php'; 
                $limit = 5;
                $page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
                $mulai = ($page > 1) ? ($page * $limit) - $limit : 0;
                $query = mysqli_query($con, "SELECT * FROM jabatan ORDER BY gapok DESC LIMIT $mulai, $limit") or die(mysqli_error);
                ?>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Jabatan</th>
                        <th>Gajih Pokok</th>
                        <th>Uang Transport</th>
                        <th>Uang Makan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody> 
                    <?php 
                    
                    $no = $mulai + 1;
                    while ($data = mysqli_fetch_array($query)) {
                    ?>    
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $data['kd_jabatan']; ?></td>
                            <td><?php echo $data['nama_jabatan']; ?></td>
                            <td><?php echo "Rp. ".number_format($data['gapok']); ?></td>
                            <td><?php echo "Rp. ".number_format($data['uang_tp']); ?></td>
                            <td><?php echo "Rp. ".number_format($data['uang_mkn']); ?></td>
                            <td>
                            <?php
                            if ($_SESSION['level'] === 'admin') { ?>
                            <a class="btn btn-sm btn-primary" href="?page=jabatanedit&id=<?php echo $data['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-sm btn-danger" href="?page=jabatandelete&id=<?php echo $data['id']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fa fa-edit"></i> Hapus</a>
                            <?php } ?> </td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 