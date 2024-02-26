<?php
if(isset($_GET['nik'])){
    $nik = $_GET['nik'];
    $delete = mysqli_query($con, "DELETE FROM jabatan WHERE nik=$nik");
    if($delete){
        $_SESSION['hasil'] = true;
        $_SESSION['pesan'] = "Hapus data jabatan berhasil";
    }else{
        $_SESSION['hasil'] = false;
        $_SESSION['pesan'] = "Hapus data jabatan gagal!";
    }
    echo "<meta http-equiv='refresh' content='0;url=?page=jabatan'>";    
}else{
    $_SESSION['hasil'] = false;
    $_SESSION['pesan'] = "";
    echo "<meta http-equiv='refresh' content='0;url=?page=jabatan'>";    
}    
?>