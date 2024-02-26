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

$pdf->Cell(0,22,'LAPORAN ABSENSI HARI INI',0,1,'C');

$pdf->SetFont('Times','B',10);

$pdf->Cell(18,6,'Tanggal :',0,0,'L');
$pdf->Cell(20,6,strftime("%d %B %Y"),0,1,'L');

$pdf->Cell(10,4,'',0,1);

$pdf->Cell(13,6,'',0,0,'C');
$pdf->Cell(8,6,'No',1,0,'C');
$pdf->Cell(40,6,'NIK',1,0,'C');
$pdf->Cell(40,6,'Nama',1,0,'C');
$pdf->Cell(30,6,'Jam Masuk',1,0,'C');
$pdf->Cell(30,6,'Jam Pulang',1,0,'C');
$pdf->Cell(25,6,'Keterangan',1,1,'C');

$pdf->SetFont('Times','',10);

//Membuat Koneksi ke database akademik
include '../../aset/connection.php';

$no=1;
setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set('Asia/Kuala_Lumpur');
$hrini= strftime("%d %B %Y");
//Query untuk mengambil data mahasiswa pada tabel mahasiswa
$hasil = mysqli_query($con, "SELECT k.nik,k.nama, a.tanggal, a.jam_masuk, a.jam_pulang, a.ket from karyawan k LEFT JOIN absensi a ON k.nik=a.nik and a.tanggal like '%$hrini%'");
while ($data = mysqli_fetch_array($hasil)){
    $pdf->Cell(13,6,'',0,0,'C');
    $pdf->Cell(8,6,$no,1,0,'C');
    $pdf->Cell(40,6,$data['nik'],1,0);
    $pdf->Cell(40,6,$data['nama'],1,0);
    $pdf->Cell(30,6,$data['jam_masuk'],1,0,'C');
    $pdf->Cell(30,6,$data['jam_pulang'],1,0,'C');
    $pdf->Cell(25,6,$data['ket'],1,1,'C');
    $no++;
}
$pdf->SetFont('Times','B',10);
$pdf->Cell(10,10,'',0,1);
$pdf->Cell(18,5,'Dibuat Oleh :',0,0,'L');
$pdf->Cell(60,0,'',0,0);
$pdf->Cell(18,5,'Mengetahui :',0,1,'L');
$pdf->Cell(10,15,'',0,1);
$pdf->Cell(18,6,'Staff HRD',0,0,'L');
$pdf->Cell(60,0,'',0,0);
$pdf->Cell(18,5,'Manager HRD',0,1,'L');

$pdf->Output("Absensi-".$hrini.".pdf",'I');
?>