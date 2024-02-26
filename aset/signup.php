<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php include "connection.php" ?>

<?php 

if (isset($_POST['registrasi'])) {
    $username = $_POST['username']; 
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];
    $nik = $_POST['nik']; 

    if ($pass !== $pass2) {
        echo '<script>alert("Password konfirmasi salah!");</script>';
        echo "<meta http-equiv='refresh' content='0 url=signup.php'>";
        return false; 
    }
    
    $cekNik = mysqli_query($con, "SELECT * from karyawan where nik='$nik'");
    if(mysqli_num_rows($cekNik) < 1){
        echo '<script>alert("Nik anda belum terdaftar sebagai karyawan");</script>';

        echo "<meta http-equiv='refresh' content='0 url=signup.php'>";
        return false;
    }
    $cekUsername = mysqli_query($con, "SELECT * FROM user WHERE username = '" . $username . "' OR nik like '%$nik%' ");
    if (mysqli_num_rows($cekUsername) == 1) {
        echo '<script>alert("Username atau NIK telah Terdaftar");</script>';

        echo "<meta http-equiv='refresh' content='0 url=signup.php'>";
        return false;
    }
    $exec = mysqli_query($con, "INSERT INTO user(username,password, nik,level) VALUES('$username','$pass','$nik','user')");
    if ($exec = true) {
        echo '<script>alert("User berhasil di tambahkan");</script>';
        echo "<meta http-equiv='refresh' content='0 url=login1.php'>";
    } else {
        echo '<script>alert("User gagal di tambahkan");</script>';
    }
} 
?>
<body class="bg-gradient-primary">

    <div class="container">
        <div class="card o-hidden border-1 shadow-sm my-5">
            <div class="card-body">
                <!-- Nested Row within Card Body -->

                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="nik" id="exampleFirstName"
                                            placeholder="Nomor Identitas(NIK)" required>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="username" id="exampleFirstName"
                                            placeholder="Username" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password"required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password2" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" required>
                                    </div>
                                </div>
                                <input type="submit" name="registrasi" value=" Register Account" class="btn btn-primary btn-user btn-block">
                                <hr>
                                <a href="../index.php" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-close fa-fw"></i> Kembali
                                </a>
                            </form>
                           
                    
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