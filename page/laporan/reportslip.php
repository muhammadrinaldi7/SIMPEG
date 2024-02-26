
<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">SLIP GAJIH KARYAWAN</h6>
    </div>
        <div class="card-body">
        <strong>CETAK SLIP GAJIH KARYAWAN </strong> <br> <br>
        <?php if ($_SESSION['level'] == "admin"){?>
        <form action="?page=reportslip" method="POST">
            <div class=" input-group mb-3">
                <input type="text" class="form-control bg-light border-1 small" aria-label="search" aria-describedby="basic-addon2" placeholder="Cari Berdasar Nik Atau Nama Karyawan..." name="keyword">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit" value="Cari" id="button-search" name="search"><i class="fas fa-search fa-sm"></i></button>
                </div>
            </div>
        </form> 
        <?php }?>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover m-0"> 
                <?php
                include 'aset/connection.php'; 
                $snik = $_SESSION['nik'];
                $limit = 5;
                $page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
                $mulai = ($page > 1) ? ($page * $limit) - $limit : 0;
                if ($_SESSION['level'] == "user"){
                    $query = mysqli_query($con, "SELECT p.id,p.nik,k.nama, k.telp from penggajian p left join karyawan k on k.nik=p.nik where p.nik = '$snik' LIMIT $mulai, $limit") or die(mysqli_error);
                } else {
                $query = mysqli_query($con, "SELECT p.id,p.nik,k.nama, k.telp from penggajian p left join karyawan k on k.nik=p.nik LIMIT $mulai, $limit") or die(mysqli_error);
                }
                ?>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>No Telp</th>
                        <th>Aksi</th>
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
                            $query = mysqli_query($con,"SELECT p.id,p.nik,k.nama, k.telp from penggajian p left join karyawan k on k.nik=p.nik where k.nama like '%".$keyword."%' OR p.nik like '%".$keyword."%'");
                        }
                    }
                    
                    $no = $mulai + 1;
                    while ($data = mysqli_fetch_array($query)) {
                    
                    ?>    
                        <tr>
                            <td style="text-align:center;"><?php echo $no ?></td>
                            <td><?php echo $data['nik']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['telp']; ?></td>                            
                            <td>           
                            <form action="page/laporan/slipgajih.php" target="_blank" method="POST" >                
                            <input type="hidden" name="nik" value="<?php echo $data['nik'] ?>">
                            <button class="btn btn-primary" type="submit" name="slip">
                            <i class="fa fa-print"></i> Cetak
                            </button>
                            </form>    
                            </td>
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
</div>