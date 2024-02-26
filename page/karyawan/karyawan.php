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
        <strong>Data Karyawan</strong>
    </div> 
    <div class="card-body">
        <?php 
        if ($_SESSION['level'] == "admin") { ?>
        <a href="?page=karyawanadd" class="btn btn-success mb-2"><i class="fa fa-plus-circle"></i> Tambah Data</a>
        <?php } ?>
        <hr>

        <form action="?page=karyawan" method="POST">
            <div class=" input-group mb-3">
                <input type="text" class="form-control bg-light border-1 small" aria-label="search" aria-describedby="basic-addon2" placeholder="Masukan Nama Karyawan..." name="keyword">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit" value="Cari" id="button-search" name="search"><i class="fas fa-search fa-sm"></i></button>
                </div>
            </div>
        </form> 
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover m-0"> 
                <?php
                include 'aset/connection.php'; 
                $limit = 5;
                $page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
                $mulai = ($page > 1) ? ($page * $limit) - $limit : 0;
                $query = mysqli_query($con, "SELECT * FROM karyawan LIMIT $mulai, $limit") or die(mysqli_error);
                ?>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>No Telp</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Agama</th>
                        <th>Tanggal Lahir</th>
                        <?php
                            if ($_SESSION['level'] === 'admin') { ?>
                        <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody> 
                    <?php 
                    
                    if (isset($_POST['search'])) {
                        $keyword = trim($_POST['keyword']);
                        if (!empty($keyword)) {
                            $query = mysqli_query($con,"SELECT* FROM karyawan WHERE nama like '%".$keyword."%'");
                        }
                    }
                    
                    $no = $mulai + 1;
                    while ($data = mysqli_fetch_array($query)) {
                    
                    ?>    
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $data['nik']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['telp']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['alamat']; ?></td>
                            <td><?php echo $data['agama']; ?></td>
                            <td><?php echo $data['tanggal_lahir']; ?></td>
                            <?php
                            if ($_SESSION['level'] === 'admin') { ?>
                            <td>                           
                            <a class="btn btn-sm btn-primary" href="?page=karyawanedit&id=<?php echo $data['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-sm btn-danger" href="?page=karyawandelete&nik=<?php echo $data['nik']; ?>" onclick="return confirm('Anda yakin mau menghapus data ini ?')"><i class="fa fa-trash"></i> Hapus</a>
                            </td><?php } ?>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        include 'aset/connection.php'; 
        $result = mysqli_query($con, "SELECT * FROM karyawan");
        $total_records = mysqli_num_rows($result);
        ?>
        <p>Jumlah Data : <?php echo $total_records; ?></p>
        <nav class="mb-5">
            <ul class="pagination justify-content-end">
                <?php
                $jumlah_page = ceil($total_records / $limit);
                $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
                $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
                $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;
                
                if ($page == 1) {
                    echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                    echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                } else {
                    $link_prev = ($page > 1) ? $page - 1 : 1;
                    echo '<li class="page-item"><a class="page-link" href="?page=karyawan&halaman=1">First</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?page=karyawan&halaman=' . $link_prev . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                }
                
                for ($i = $start_number; $i <= $end_number; $i++) {
                    $link_active = ($page == $i) ? ' active' : '';
                    echo '<li class="page-item ' . $link_active . '"><a class="page-link" href="?page=karyawan&halaman=' . $i . '">' . $i . '</a></li>';
                }
                
                if ($page == $jumlah_page) {
                    echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                    echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
                } else {
                    $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
                    echo '<li class="page-item"><a class="page-link" href="?page=karyawan&halaman=' . $link_next . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?page=karyawan&halaman=' . $jumlah_page . '">Last</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</div> 