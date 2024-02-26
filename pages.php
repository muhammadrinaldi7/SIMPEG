
<?php
if (isset($_GET['page'])){
    $page = $_GET['page'];
    switch ($page){
        case '';
        case 'dashboard':
            file_exists('page/dashboard.php') ? include 'page/dashboard.php' : include 'page/404.php';
            break;
        case 'lokasiread':
            file_exists('pages/admin/lokasiread.php') ? include 'pages/admin/lokasiread.php' : include 'pages/404.php';
        break;

        case 'karyawan':
            file_exists('page/karyawan/karyawan.php') ? include 'page/karyawan/karyawan.php' : include 'pages/404.php';
        break;

        case 'karyawanadd':
            file_exists('page/karyawan/karyawanadd.php') ? include 'page/karyawan/karyawanadd.php' : include 'pages/404.php';
        break;

        case 'karyawanedit':
            file_exists('page/karyawan/karyawanedit.php') ? include 'page/karyawan/karyawanedit.php' : include 'pages/404.php';
        break;

        case 'karyawandelete':
            file_exists('page/karyawan/karyawandelete.php') ? include 'page/karyawan/karyawandelete.php' : include 'pages/404.php';
        break;
        
        case 'absen':
            file_exists('page/absensi/absen_harian.php') ? include 'page/absensi/absen_harian.php' : include 'pages/404.php';
            break;

        case 'absenupdate':
            file_exists('page/absensi/absenupdate.php') ? include 'page/absensi/absenupdate.php' : include 'pages/404.php';
        break;

        case 'jabatan':
            file_exists('page/jabatan/jabatan.php') ? include 'page/jabatan/jabatan.php' : include 'pages/404.php';
        break;

        case 'jabatanadd':
            file_exists('page/jabatan/jabatanadd.php') ? include 'page/jabatan/jabatanadd.php' : include 'pages/404.php';
        break;

        case 'jabatanedit':
            file_exists('page/jabatan/jabatanedit.php') ? include 'page/jabatan/jabatanedit.php' : include 'pages/404.php';
        break;

        case 'jabatandelete':
            file_exists('page/jabatan/jabatandelete.php') ? include 'page/jabatan/jabatandelete.php' : include 'pages/404.php';
        break;

        case 'penggajian':
            file_exists('page/penggajian/penggajian.php') ? include 'page/penggajian/penggajian.php' : include 'pages/404.php';
            break;

        case 'penggajian-add':
            file_exists('page/penggajian/penggajianadd.php') ? include 'page/penggajian/penggajianadd.php' : include 'pages/404.php';
            break;

        case 'penggajian-reset':
            file_exists('page/penggajian/penggajianreset.php') ? include 'page/penggajian/penggajianreset.php' : include 'pages/404.php';
            break;

        case 'levelkaryawan':
            file_exists('page/levelkaryawan/levelkaryawan.php') ? include 'page/levelkaryawan/levelkaryawan.php' : include 'pages/404.php';
            break;

        case 'levelkaryawanadd':
            file_exists('page/levelkaryawan/levelkaryawanadd.php') ? include 'page/levelkaryawan/levelkaryawanadd.php' : include 'pages/404.php';
            break;

        case 'levelkaryawanedit':
            file_exists('page/levelkaryawan/levelkaryawanedit.php') ? include 'page/levelkaryawan/levelkaryawanedit.php' : include 'pages/404.php';
            break;

        case 'levelkaryawandelete':
            file_exists('page/levelkaryawan/levelkaryawandelete.php') ? include 'page/levelkaryawan/levelkaryawandelete.php' : include 'pages/404.php';
            break;

        case 'reportabsen':
        file_exists('page/laporan/reportabsen.php') ? include 'page/laporan/reportabsen.php' : include 'pages/404.php';
        break;

        case 'reportpenggajian':
            file_exists('page/laporan/reportpenggajian.php') ? include 'page/laporan/reportpenggajian.php' : include 'pages/404.php';
            break;

        case 'reportrekap':
        file_exists('page/laporan/reportrekap.php') ? include 'page/laporan/reportrekap.php' : include 'pages/404.php';
        break;

        case 'reporttunjangan':
            file_exists('page/laporan/reporttunjangan.php') ? include 'page/laporan/reporttunjangan.php' : include 'pages/404.php';
            break;

        case 'reportslip':
            file_exists('page/laporan/reportslip.php') ? include 'page/laporan/reportslip.php' : include 'pages/404.php';
            break;
        
       

        default:
            include 'page/404.php';
    }
}
    else{
        include 'page/dashboard.php';
    }
?>