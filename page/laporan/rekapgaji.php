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

$pdf->Cell(0,22,'REKAP GAJIH BULANAN',0,1,'C');

$pdf->SetFont('Times','B',10);

$pdf->Cell(15,6,'Priode :',0,0,'L');
$pdf->Cell(18,6,strftime("%B %Y"),0,1,'L');

$pdf->Cell(10,4,'',0,1);

$pdf->Cell(2,6,'',0,0,'C');
$pdf->Cell(8,6,'No',1,0,'C');
$pdf->Cell(30,6,'NIK',1,0,'C');
$pdf->Cell(35,6,'Nama',1,0,'C');
$pdf->Cell(20,6,'Bulan',1,0,'C');
$pdf->Cell(25,6,'Tunjangan',1,0,'C');
$pdf->Cell(25,6,'Insentif Quality',1,0,'C');
$pdf->Cell(25,6,'Gapok',1,0,'C');
$pdf->Cell(25,6,'Total Gajih',1,1,'C');
$pdf->SetFont('Times','',10);

//Membuat Koneksi ke database akademik
include '../../aset/connection.php';

$no=1;
setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set('Asia/Kuala_Lumpur');
$hrini= strftime(" %B %Y");
//Query untuk mengambil data mahasiswa pada tabel mahasiswa
$hasil = mysqli_query($con, "SELECT penggajian.nik,nama,bulan,((SUM(CASE WHEN ket='H' then 1 else 0 end)+SUM(CASE WHEN ket='I' then 1 else 0 end)+SUM(CASE WHEN ket='T' then 1 else 0 end))*uang_mkn)+
SUM(case when ket='H' then 1 else 0 end)*uang_tp as tunjangan,SUM(IF(hadir>=18,200000,0)) iq,gapok,total_gajih from penggajian left join absensi on absensi.nik=penggajian.nik 
left join jabatan_karyawan on absensi.nik = jabatan_karyawan.nik left join jabatan on jabatan.kd_jabatan = jabatan_karyawan.kd_jabatan where penggajian.nik NOT IN 
(SELECT nik FROM penggajian WHERE total_gajih IS NULL OR total_gajih = '')and tanggal like '%$hrini%';");
while ($data = mysqli_fetch_array($hasil)){
    $pdf->Cell(2,6,'',0,0,'C');
    $pdf->Cell(8,6,$no,1,0,'C');
    $pdf->Cell(30,6,$data['nik'],1,0);
    $pdf->Cell(35,6,$data['nama'],1,0);
    $pdf->Cell(20,6,$data['bulan'],1,0,'C');
    $pdf->Cell(25,6,"Rp. ".number_format($data['tunjangan']),1,0,'C');
    $pdf->Cell(25,6,$data['iq'],1,0,'C');
    $pdf->Cell(25,6,"Rp. ".number_format($data['gapok']),1,0,'C');
    $pdf->Cell(25,6,"Rp. ".number_format($data['total_gajih']),1,1,'C');
    $no++;
}
$qry = mysqli_query($con, "SELECT SUM(total_gajih) AS total from penggajian;");
$total = mysqli_fetch_array($qry);
$pdf->SetFont('Times','B',10);
$pdf->Cell(2,6,'',0,0,'C');
$pdf->SetFillColor(255, 255, 0);
$pdf->SetDrawColor(128,0,0);
$pdf->Cell(168,6,'TOTAL GAJIH YANG HARUS DIBAYARKAN',1,0,'L',true);
$pdf->SetFillColor(210,0,0);
$pdf->SetDrawColor(128,0,0);
$pdf->Cell(25,6,"Rp. ".number_format($total['total']),1,1,'C',true);

$pdf->SetFont('Times','B',10);
$pdf->Cell(23,13,'',0,1);
$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(23,5,'Mengetahui :',0,0,'L');
$pdf->Cell(56,0,'',0,0);
$pdf->Cell(18,5,'Tertanda :',0,1,'L');
$pdf->Cell(10,15,'',0,1);
$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(18,6,'Manager HRD',0,0,'L');
$pdf->Cell(61,0,'',0,0);
$pdf->Cell(18,6,'Staff HRD',0,1,'L');

$pdf->Output("Gajih-".$hrini.".pdf",'I');
?>