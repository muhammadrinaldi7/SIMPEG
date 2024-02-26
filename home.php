<?php session_start();
if(!isset($_SESSION['nik'])){
  header('location:aset/login1.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="img1/favi.png">
<?php include 'aset/connection.php'; ?>
<?php include 'aset/head.php' ?>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php if($_SESSION['level'] == "user"){
            include 'aset/sidebaruser.php';    
        } ?>
        
        <?php if($_SESSION['level'] == "admin"){
            include 'aset/sidebar.php';    
        } ?>
        
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                    <?php include 'aset/topbar.php' ?>
                <!-- End of Topbar -->
                <?php include 'pages.php';?>
            </div>
            <!-- End of Main Content -->
            <?php include 'aset/footer.php' ?>

        </div>
        <!-- End of Content Wrapper -->
        <?php include 'aset/control.php'; ?>
        <?php include 'aset/script.php'?>
    </div>
</body>
</html>