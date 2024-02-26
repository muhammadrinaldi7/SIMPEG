<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $delete = mysqli_query($con, "DELETE FROM karyawan WHERE id=$id");
    if($delete){
        $_SESSION['hasil'] = true;
        $_SESSION['pesan'] = "Hapus data Karyawan berhasil";
    }else{
        $_SESSION['hasil'] = false;
        $_SESSION['pesan'] = "Hapus data Karyawan gagal!";
    }
    echo "<meta http-equiv='refresh' content='0;url=?page=karyawan'>";    
}else{
    $_SESSION['hasil'] = false;
    $_SESSION['pesan'] = "";
    echo "<meta http-equiv='refresh' content='0;url=?page=karyawan'>";    
}    
?>