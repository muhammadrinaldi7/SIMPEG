<?php
session_start();

if (!isset($_SESSION['id']) == 0) {
  header('Location:index.php');
}

include_once "connection.php";
if (isset($_POST['button_login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
  $selectSql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
  $qry = mysqli_query($con,$selectSql);
  $count = mysqli_num_rows($qry);
  if ($count == 1) {
    $row = mysqli_fetch_array($qry);
    $_SESSION['pengguna_id']  = $row['id'];
    $_SESSION['peran']        = $row['peran'];
    $_SESSION['status']       = true;
    header('Location: home.php');
  } else {
    $_SESSION['status'] = false;
    header('Location: index.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="../js/bootstrap.bundle.min.js"></script>
<?php include "head.php" ?>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>SIGASING</b></a>
      </div>
	  <div class="container-fluid">
      <div class="card-body">
        <p class="login-box-msg">Masukkan username dan password anda</p>
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

        <form method="POST">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="social-auth-links text-center mt-2 mb-3">
            <button type="submit" name="button_login" class="btn btn-primary btn-block">Masuk</button>
            <a href="#" class="btn btn-danger btn-block">Buat Akun</a>
          </div>
        </form>

        <p class="mb-1">
          <a href="forgot-password.html">Lupa password?</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  </div>
  <!-- /.login-box -->


  <?php include "script.php" ?>
</body>
</html>