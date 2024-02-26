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

$pdf->Cell(0,22,'LAPORAN REKAP PRESENSI BULAN INI',0,1,'C');

$pdf->SetFont('Times','B',10);

$pdf->Cell(18,6,'Bulan :',0,0,'L');
$pdf->Cell(20,6,strftime(" %B %Y"),0,1,'L');

$pdf->Cell(10,4,'',0,1);

$pdf->Cell(13,6,'',0,0,'C');
$pdf->Cell(8,6,'No',1,0,'C');
$pdf->Cell(40,6,'NIK',1,0,'C');
$pdf->Cell(40,6,'Nama',1,0,'C');
$pdf->Cell(20,6,'Hadir',1,0,'C');
$pdf->Cell(20,6,'Telat',1,0,'C');
$pdf->Cell(20,6,'Izin',1,0,'C');
$pdf->Cell(20,6,'Alpha',1,1,'C');

$pdf->SetFont('Times','',10);

//Membuat Koneksi ke database akademik
include '../../aset/connection.php';

$no=1;
setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set('Asia/Kuala_Lumpur');
$bulanini= strftime("%B %Y");
//Query untuk mengambil data mahasiswa pada tabel mahasiswa
$hasil = mysqli_query($con, "SELECT k.nik,k.nama,SUM(CASE when ket= 'H' then 1 else 0 end) jumlah_hadir, SUM(case when ket='I' then 1 else 0 end) jumlah_izin, SUM(CASE WHEN ket='A' then 1 else 0 end) jumlah_alpha,SUM(CASE WHEN ket='T' then 1 else 0 end) jumlah_telat from karyawan k left join absensi a on k.nik=a.nik and a.tanggal like '%$bulanini%' group by k.nama;");
while ($data = mysqli_fetch_array($hasil)){
    $pdf->Cell(13,6,'',0,0,'C');
    $pdf->Cell(8,6,$no,1,0,'C');
    $pdf->Cell(40,6,$data['nik'],1,0);
    $pdf->Cell(40,6,$data['nama'],1,0);
    $pdf->Cell(20,6,$data['jumlah_hadir'],1,0,'C');
    $pdf->Cell(20,6,$data['jumlah_telat'],1,0,'C');
    $pdf->Cell(20,6,$data['jumlah_izin'],1,0,'C');
    $pdf->Cell(20,6,$data['jumlah_alpha'],1,1,'C');
    $no++;
}
$pdf->SetFont('Times','B',10);
$pdf->Cell(13,6,'',0,0,'C');
$pdf->SetFillColor(255,255,0);
$pdf->SetDrawColor(128,0,0);
$pdf->Cell(88,6,'TOTAL : ',1,0,'L',true);
$total = mysqli_query($con,"SELECT SUM(CASE when ket='H' then 1 else 0 end) total_hadir, SUM(CASE when ket='I' then 1 else 0 end) total_izin, SUM(CASE when ket='A' then 1 else 0 end) total_alpha,SUM(CASE when ket='T' then 1 else 0 end) total_telat from absensi where tanggal like '%$bulanini%';");
$row = mysqli_fetch_array($total);
$pdf->Cell(20,6,$row['total_hadir'],1,0,'C');
$pdf->Cell(20,6,$row['total_telat'],1,0,'C');
$pdf->Cell(20,6,$row['total_izin'],1,0,'C');
$pdf->Cell(20,6,$row['total_alpha'],1,1,'C');
$pdf->Cell(10,10,'',0,1);
$pdf->Cell(18,5,'Mengetahui :',0,0,'L');
$pdf->Cell(60,0,'',0,0);
$pdf->Cell(18,5,'Dibuat Oleh :',0,1,'L');
$pdf->Cell(10,15,'',0,1);
$pdf->Cell(18,6,'Manager HRD',0,0,'L');
$pdf->Cell(60,0,'',0,0);
$pdf->Cell(18,5,'Staff HRD',0,1,'L');

$pdf->Output("Rekap-".$bulanini.".pdf",'I');
?>