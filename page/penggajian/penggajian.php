<div class="container-fluid">
    <div class="card-header">
        <strong>Data Penggajihan Karyawan</strong>
    </div> 
    <div class="card-body">
    <!--    <form action="?page=jabatan" method="POST">
            <div class=" input-group mb-3">
                <input type="text" class="form-control" placeholder="Masukan Jenis Mobil..." name="keyword">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit" value="Cari" id="button-search" name="search">Cari !</button>
                </div>
            </div>
        </form> -->
        <!-- <div class="col-md-12"> -->
        <?php 
        if ($_SESSION['level'] == "admin") { ?>
        <a href="page/penggajian/karyawanadd.php" class="btn btn-success mb-2"><i class="fa fa-plus-circle"></i> Tambah Semua Karyawan</a>
        <a href="page/penggajian/karyawandelete.php" class="btn btn-danger mb-2"><i class="fa fa-trash"></i> Reset Semua Karyawan</a>
        <?php } ?>
        <hr>
       <!-- <a href="../mobil/mobil_print.php" target="_blank" class="btn btn-primary mb-2">Cetak Data</a> -->
        <div class="table-responsive">
            <table class="table table-sm table-bordered dataTable table-hover m-0" id="dataTable"> 
                <?php
                setlocale(LC_ALL, 'id-ID', 'id_ID');
                $tgl = strftime("%B %Y");
                include 'aset/connection.php'; 
                $limit = 10;
                $page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
                $mulai = ($page > 1) ? ($page * $limit) - $limit : 0;
                $query = mysqli_query($con, "SELECT p.id,p.nik,p.nama, SUM(CASE when ket= 'H' then 1 else 0 end)hadir, SUM(case when ket='I' then 1 else 0 end)izin, SUM(CASE WHEN ket='A' then 1 else 0 end)alpha,p.total_gajih from penggajian p left join absensi a on p.nik=a.nik and tanggal like '%$tgl%' group by p.nama LIMIT $mulai, $limit");
                ?>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Total Gajih</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody> 
                    <?php 
                    
                    if (isset($_POST['search'])) {
                        $keyword = trim($_POST['keyword']);
                        if (!empty($keyword)) {
                            $query = mysqli_query($con,"SELECT * FROM penggajian" );
                        }
                    }
                    
                    $no = $mulai + 1;
                    while ($data = mysqli_fetch_array($query)) {
                    
                    ?>    
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $data['nik']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo "Rp. ".number_format($data['total_gajih']); ?></td>
                            <td>
                            <?php
                            if ($_SESSION['level'] === 'admin') { ?>
                            <a class="btn btn-sm btn-success" href="?page=penggajian-add&nik=<?php echo $data['nik']; ?>"><i class="fas fa-dollar-sign text-gray-300"></i></a>
                            <a class="btn btn-sm btn-warning" href="?page=penggajian-reset&nik=<?php echo $data['nik']; ?>" onclick="return confirm('Anda yakin ingin mereset item ini ?')">Reset</a>
                            
                            <?php } ?> </td>
                            

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
        $result = mysqli_query($con, "SELECT * FROM penggajian");
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
                    echo '<li class="page-item"><a class="page-link" href="?page=penggajian&halaman=1">First</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?page=penggajian&halaman=' . $link_prev . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                }
                
                for ($i = $start_number; $i <= $end_number; $i++) {
                    $link_active = ($page == $i) ? ' active' : '';
                    echo '<li class="page-item ' . $link_active . '"><a class="page-link" href="?page=penggajian&halaman=' . $i . '">' . $i . '</a></li>';
                }
                
                if ($page == $jumlah_page) {
                    echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                    echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
                } else {
                    $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
                    echo '<li class="page-item"><a class="page-link" href="?page=penggajian&halaman=' . $link_next . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?page=penggajian&halaman=' . $jumlah_page . '">Last</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</div> 