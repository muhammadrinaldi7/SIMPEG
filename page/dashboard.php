<?php
    include 'aset/connection.php';
    $niks = $_SESSION['nik'];
    $stmt = mysqli_query($con,"SELECT * from user where nik='$niks';");
    $row  = mysqli_fetch_array($stmt);
 ?> 
<div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <div class="row">
                    <p>Selamat Datang <strong><i><?php echo $row['username'];?></i></strong>,</p> <br>
                    <strong>Selamat berkerja dan Selamat beraktifitas hehehe... <br></strong><br><br>
			<form method="POST" action="page/absensi/absen.php"  class="form-horizontal">
			<?php setlocale(LC_ALL, 'id-ID', 'id_ID');
					date_default_timezone_set('Asia/Kuala_Lumpur');
					$hrini= strftime("%d %B %Y");
			?>		
					<div class="form-group col-md-2">
                        <input type="hidden" class="form-control" name="nik" placeholder="" value="<?php echo $_SESSION['nik']?>" readonly>
                    </div>
					
					<div class="form-group col-md-3">
                        <label for="nik" class="control-label">Tanggal Sekarang</label>
						<hr>
                        <input type="text" class="form-control" name="tanggal" placeholder="" value="<?php echo strftime("%A, %d %B %Y");?>" readonly> 
                    </div>
					<div class="form-group col-md-2">
                        <label for="nik" style="margin-top:10px;" class="control-label">Jam Sekarang</label>
						<hr>
                        <input type="text" class="form-control" name="waktu" placeholder="" value="<?php echo strftime("%H:%M"); ?>" readonly> 
                    <hr>
					</div>
					 
					<div class="form-group col-md-3">
                        <input type="submit" name="submit" class="btn btn-success" value="ABSEN" >
                        <?php
						$nik = $_SESSION['nik'];
						$harini = strftime("%d %B %Y");
						$query = mysqli_query($con, "SELECT * from absensi where nik='$nik' and tanggal like '%$harini%'");
						while ($data = mysqli_fetch_array($query)) {
							$id = $data['id'];
                            $jamkeluar = $data['jam_pulang'];
						}
					?>
					    <a class="btn  btn-danger" href="page/absensi/absenkeluar.php?id=<?php echo $id; ?>" onclick="return confirm('Anda yakin ingin absen pulang ?')">Absen Pulang</a>
					</div>	
				</form>			
                    </div>
                    </div>