<?php
session_start();
if (!isset($_SESSION['nik']) == 0) {
    header('Location:../index.php');
  }
if (isset($_POST['login'])) {
	ob_start();
	$username	= $_POST['username'];
	$pass		= $_POST['password'];
	include 'connection.php';

	$result = mysqli_query($con, "SELECT * from user WHERE  username = '$username' and password = '$pass'");
	$cek = mysqli_num_rows($result);
    if ($cek == 1) {
            $row = mysqli_fetch_assoc($result);
			$_SESSION['nik'] = $row['nik'];
            $_SESSION['level'] = $row['level'];
            $_SESSION['status'] = true;
            header('location:../home.php');
			} else {
			$_SESSION['status'] = false;
            header('location:login1.php');
			}
		}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-gradient-success">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg" style="margin-top: 120px;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-2 d-lg-block"></div>
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">LOGIN</h1>
                                    </div>
                                    <?php
                                        if (isset($_SESSION["status"])) {
                                        if ($_SESSION["status"] == false) {
                                        ?>
                                            <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-ban"></i> Gagal</h5>
                                            Username atau password salah
                                            </div>
                                        <?php
                                        }
                                        }
                                    ?>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" name="username" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        
                                        <input type="submit" value="Login" name="login" class="btn btn-primary btn-user btn-block">
                                        <hr>
                                        <input type="button" value="Kembali" class="btn btn-google btn-user btn-block" onclick="history.back(-1)">
                                    </form>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>