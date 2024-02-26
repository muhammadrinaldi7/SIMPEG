                   
                <div class="container-fluid">
                   <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                    <p>Selamat Datang <strong><i></i></strong>,</p>
			<form method="POST" action="absensi/absen.php"  class="form-horizontal">
			<?php setlocale(LC_ALL, 'id-ID', 'id_ID');
					date_default_timezone_set('Asia/Kuala_Lumpur');
					$hrini= strftime("%d %B %Y");
			?>		
					<div class="form-group col-md-2">
                        <input type="hidden" class="form-control" name="nik" placeholder="" value="">
                    </div>
					
					<div class="form-group col-md-3">
                        <label for="nik" class="control-label">Tanggal Sekarang</label>
						<hr>
                        <input type="text" class="form-control" name="tanggal" placeholder="" value="<?php echo strftime("%A, %d %B %Y");?>" readonly> 
                    </div>
					<div class="form-group col-md-2">
                        <label for="nik" style="margin-top:10px;" class="control-label">Jam Sekarang</label>
						<hr>
                        <input type="text" class="form-control" name="waktu" placeholder="" value="<?php echo strftime("%I:%M:%S %p"); ?>" readonly> 
                    <hr>
					</div>
					 
					<div class="form-group col-md-3">
                        <input type="submit" name="submit" class="btn btn-success" value="ABSEN" > 
					<a class="btn  btn-danger" href="absensi/absenkeluar.php?id=<?php echo $id; ?>" onclick="return confirm('Anda yakin ingin absen pulang ?')">Absen Pulang</a>
					</div>	
				</form>			
                    </div>
                    </div>