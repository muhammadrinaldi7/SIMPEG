<?php
setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set('Asia/Kuala_Lumpur');
require('../../fpdf/fpdf.php');
$pdf = new FPDF('P', 'mm','Letter');

$pdf->AddPage();

$pdf->SetFont('Times','B',16);
$pdf->Image('../../img1/gawi.jpg',5,5,70,20);
$pdf->Cell(0,10,'PT. GAWI MAKMUR KALIMANTAN',0,1,'R');

$pdf->Cell(0,10,'',0,1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(0,22,'REKAP UANG TRANSPORT, UANG MAKAN DAN INSENTIF QUALITY',0,1,'C');

$pdf->SetFont('Times','B',10);

$pdf->Cell(14,6,'Priode :',0,0,'L');
$pdf->Cell(20,6,strftime(" %B %Y"),0,1,'L');

$pdf->Cell(10,4,'',0,1);

$pdf->Cell(5,6,'',0,0,'C');
$pdf->Cell(8,10,'No',1,0,'C');
$pdf->Cell(40,10,'Nama',1,0,'C');
$pdf->Cell(8,10,'HK',1,0,'C');
$pdf->Cell(10,10,'HKE',1,0,'C');
$pdf->Cell(10,10,'I',1,0,'C');
$pdf->Cell(10,10,'A',1,0,'C');
$pdf->Cell(10,10,'T',1,0,'C');
$pdf->SetFont('Times','B',8);
$pdf->Cell(25,5,'UT',1,0,'C');
$pdf->Cell(25,5,'UM',1,0,'C');
$pdf->Cell(20,10,'IQ',1,0,'C');
$pdf->Cell(20,10,'TOTAL',1,0,'C');
$pdf->Cell(0,5,'',0,1,'');
$pdf->Cell(101,0,'',0,0,'');
$pdf->Cell(10,5,'HK',1,0,'C');
$pdf->Cell(15,5,'Jumlah',1,0,'C');
$pdf->Cell(10,5,'HK',1,0,'C');
$pdf->Cell(15,5,'Jumlah',1,1,'C');

$pdf->SetFont('Times','',10);

//Membuat Koneksi ke database akademik
include '../../aset/connection.php';

$no=1;
setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set('Asia/Kuala_Lumpur');
$hrini= strftime("%B");
//Query untuk mengambil data mahasiswa pada tabel mahasiswa
$hasil = mysqli_query($con, "SELECT p.id,p.nik,p.nama,SUM(CASE when ket='H' then 1 else 0 end)+
SUM(CASE WHEN ket='T' then 1 else 0 end)as hk, SUM(case when ket='I' then 1 else 0 end)izin, 
SUM(CASE WHEN ket='A' then 1 else 0 end)alpha, SUM(CASE WHEN ket='T' then 1 else 0 end)telat,
SUM(CASE WHEN ket='T' then 1 else 0 end)+SUM(case when ket='H' then 1 else 0 end)-
SUM(case when ket='T' then 1 else 0 end) as hk1,SUM(case when ket='H' then 1 else 0 end)*uang_tp as ut,SUM(CASE WHEN ket='H' then 1 else 0 end)+
SUM(CASE WHEN ket='I' then 1 else 0 end)+SUM(CASE WHEN ket='T' then 1 else 0 end)as hk2,
(SUM(CASE WHEN ket='H' then 1 else 0 end)+SUM(CASE WHEN ket='I' then 1 else 0 end)+
SUM(CASE WHEN ket='T' then 1 else 0 end))*uang_mkn as um,IF(hadir>=18,200000,0) as iq 
from penggajian p left join absensi a on p.nik=a.nik left join jabatan_karyawan on a.nik = jabatan_karyawan.nik left join jabatan on jabatan.kd_jabatan = jabatan_karyawan.kd_jabatan where tanggal like '%$hrini%' group by p.nama;");
while ($data = mysqli_fetch_array($hasil)){
    $pdf->Cell(5,6,'',0,0,'C');
    $pdf->Cell(8,6,$no,1,0,'C');
    $pdf->Cell(40,6,$data['nama'],1,0);
    $pdf->Cell(8,6,'21',1,0,'C');
    $pdf->SetFont('Times','B',10);
    $pdf->Cell(10,6,$data['hk'],1,0,'C');
    $pdf->SetFont('Times','',10);
    $pdf->Cell(10,6,$data['izin'],1,0,'C');
    $pdf->Cell(10,6,$data['alpha'],1,0,'C');
    $pdf->Cell(10,6,$data['telat'],1,0,'C');
    $pdf->Cell(10,6,$data['hk1'],1,0,'C');
    $pdf->Cell(15,6,number_format($data['ut']),1,0,'C');
    $pdf->Cell(10,6,$data['hk2'],1,0,'C');
    $pdf->Cell(15,6,number_format($data['um']),1,0,'C');
    $pdf->Cell(20,6,number_format($data['iq']),1,0,'C');
    $total = ($data['um']+$data['ut']+$data['iq']);
    $pdf->Cell(20,6,number_format($total),1,1,'C');
    $pdf->Cell(0,0,'',0,1,'');
    $no++;
}
$itung = mysqli_num_rows($hasil);
$hrk = 21*$itung;
$pdf->Cell(5,0,'',0,0);
$pdf->SetFont('Times','B',10);
$pdf->Cell(48,9,'TOTAL',1,0,'C');
$pdf->Cell(8,9,$hrk,1,0,'C');
$thk = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(case when ket='T' then 1 else 0 end)+SUM(case when ket='H' then 1 else 0 end) as totl from absensi where tanggal like '%$hrini%';"));
//$thlk = mysqli_fetch_array($thk);
$pdf->Cell(10,9,$thk['totl'],1,0,'C');
$izn = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(case when ket='I' then 1 else 0 end) as i from absensi where tanggal like '%$hrini%';"));
$pdf->Cell(10,9,$izn['i'],1,0,'C');
$alf = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(case when ket='A' then 1 else 0 end) as a from absensi where tanggal like '%$hrini%';"));
$pdf->Cell(10,9,$alf['a'],1,0,'C');
$tlt = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(case when ket='T' then 1 else 0 end) as t from absensi where tanggal like '%$hrini%';"));
$pdf->Cell(10,9,$tlt['t'],1,0,'C');
$hkut = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(CASE WHEN ket='T' then 1 else 0 end)+SUM(case when ket='H' then 1 else 0 end)-
SUM(case when ket='T' then 1 else 0 end) as hkut from absensi where tanggal like '%$hrini%';"));
$pdf->Cell(10,9,$hkut['hkut'],1,0,'C');
$jut = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(case when ket='H' then 1 else 0 end)*uang_tp as jut from absensi left join jabatan_karyawan on absensi.nik = jabatan_karyawan.nik left join jabatan on jabatan.kd_jabatan = jabatan_karyawan.kd_jabatan where tanggal like '%$hrini%';"));
$pdf->Cell(15,9,number_format($jut['jut']),1,0,'C');

$hkum = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(CASE WHEN ket='H' then 1 else 0 end)+SUM(CASE WHEN ket='I' then 1 else 0 end)+SUM(CASE WHEN ket='T' then 1 else 0 end)as hkum from absensi where tanggal like '%$hrini%';"));
$pdf->Cell(10,9, number_format($hkum['hkum']),1,0,'C');
$jum = mysqli_fetch_array(mysqli_query($con,"SELECT (SUM(CASE WHEN ket='H' then 1 else 0 end)+SUM(CASE WHEN ket='I' then 1 else 0 end)+SUM(CASE WHEN ket='T' then 1 else 0 end))*uang_mkn as jum from absensi left join jabatan_karyawan on absensi.nik = jabatan_karyawan.nik left join jabatan on jabatan.kd_jabatan = jabatan_karyawan.kd_jabatan where tanggal like '%$hrini%';"));
$pdf->Cell(15,9, number_format($jum['jum']),1,0,'C');
$iq = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(IF(hadir>=18,200000,0)) as iq from penggajian where bulan like '%$hrini%';"));
$pdf->Cell(20,9, number_format($iq['iq']),1,0,'C');
$totalall = $jum['jum']+$jut['jut']+$iq['iq'];
$pdf->Cell(20,9, number_format($totalall),1,1,'C');

$pdf->SetFont('Times','BU',8);
$pdf->Cell(10,4,'Keterangan : ',0,1);
$pdf->SetFont('Times','',8);
$pdf->Cell(10,3,'1. HK = Hari Kerja; HKE = Hari Kerja Efektif;',0,1);
$pdf->Cell(10,3,'2. I = Izin; A = Alpha; T = Telat;',0,1);
$pdf->Cell(10,3,'3. UT = Uang Transport; UM = Uang Makan; IQ = Intensif Quality',0,1);


$pdf->SetFont('Times','B',8);
$pdf->Cell(10,10,'',0,1);
$tgl = strftime("%d %B %Y");
$pdf->Cell(18,5,'Banjarmasin, Tgl. '.$tgl,0,1,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(32,5,'Dibuat Oleh :',0,0,'C');
$pdf->Cell(60,0,'',0,0);
$pdf->Cell(18,5,'Mengetahui :',0,1,'L');
$pdf->Cell(10,15,'',0,1);
$pdf->Cell(32,6,'Staff HRD',0,0,'C');
$pdf->Cell(60,0,'',0,0);
$pdf->Cell(18,5,'Manager HRD',0,1,'L');

$pdf->Output("Absensi-".$hrini.".pdf",'I');
?>