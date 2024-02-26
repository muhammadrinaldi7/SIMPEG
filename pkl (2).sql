-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Feb 2022 pada 19.27
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `tanggal` varchar(40) NOT NULL,
  `jam_masuk` varchar(10) NOT NULL,
  `jam_pulang` varchar(10) NOT NULL,
  `ket` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `nik`, `tanggal`, `jam_masuk`, `jam_pulang`, `ket`) VALUES
(4, '6372040408000001', 'Selasa, 11 Januari 2022', '02:40', '06:13', 'H'),
(5, '6372040408000001', 'Senin, 17 Januari 2022', '03:13', '17:00', 'H'),
(6, '6372040408000001', 'Selasa, 18 Januari 2022', '10:36', '07:26', 'H'),
(7, '6372040408000001', 'Kamis, 20 Januari 2022', '08:00', '17:00', 'H'),
(8, '6372040408000001', 'Jumat, 21 Januari 2022', '08:01', '17:00', 'H'),
(9, '6372040408000001', 'Sabtu, 22 Januari 2022', '09:29', '17:00', 'H'),
(15, '6372040408000001', 'Rabu, 26 Januari 2022', '11:45', '17:00', 'H'),
(16, '6372040408000001', 'Kamis, 27 Januari 2022', '12:22', '17:00', 'H'),
(17, '6372040408000001', 'Jumat, 28 Januari 2022', '02:03', '17:00', 'H'),
(18, '6372040408000001', 'Sabtu, 29 Januari 2022', '12:52', '17:00', 'H'),
(19, '6372040508000001', 'Sabtu, 29 Januari 2022', '08:16', '', 'I'),
(21, '6372040408000001', 'Minggu, 30 Januari 2022', '11:49', '', 'I'),
(22, '6372040408000001', 'Selasa, 01 Februari 2022', '12:31', '', 'H'),
(23, '6372040408000001', 'Rabu, 02 Februari 2022', '01:30', '', 'H'),
(24, '6372040408000001', 'Kamis, 03 Februari 2022', '02:30', '', 'H'),
(25, '6372040408000001', 'Jumat, 04 Februari 2022', '01:03', '', 'H'),
(26, '6372040408000001', 'Sabtu, 05 Februari 2022', '12:03', '', 'H'),
(27, '6372060609002007', 'Sabtu, 05 Februari 2022', '', '', 'I'),
(28, '6372040408000001', 'Minggu, 06 Februari 2022', '12:33', '', 'H'),
(29, '6372040408000001', 'Senin, 07 Februari 2022', '01:14', '05:38', 'H'),
(31, '6372040408000001', 'Selasa, 08 Februari 2022', '00:12', '', 'T'),
(32, '6372040508000001', 'Selasa, 08 Februari 2022', '09:44', '', 'T'),
(33, '6372080804000001', 'Selasa, 08 Februari 2022', '', '', 'A'),
(34, '6372060609002007', 'Selasa, 08 Februari 2022', '', '', 'A'),
(35, '6372040408000001', 'Rabu, 09 Februari 2022', '15:06', '', 'T'),
(36, '6372060609002007', 'Rabu, 09 Februari 2022', '', '', 'I'),
(37, '6372080804000001', 'Rabu, 09 Februari 2022', '', '', 'A'),
(38, '6372040508000001', 'Rabu, 09 Februari 2022', '', '', 'A'),
(39, '6372040408000001', 'Kamis, 10 Februari 2022', '00:11', '12:29', 'H'),
(40, '6372040508000001', 'Kamis, 10 Februari 2022', '13:51', '', 'H'),
(41, '6372040408000001', 'Jumat, 11 Februari 2022', '16:21', '', 'T'),
(42, '6372040408000001', 'Sabtu, 12 Februari 2022', '00:12', '', 'H'),
(43, '6372040508000001', 'Sabtu, 12 Februari 2022', '00:12', '', 'H'),
(44, '6372060609002007', 'Senin, 14 Februari 2022', '16:04', '', 'T'),
(45, '6372040408000001', 'Senin, 14 Februari 2022', '16:33', '', 'T'),
(46, '6372040508000001', 'Senin, 14 Februari 2022', '17:38', '', 'T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `kd_jabatan` varchar(4) NOT NULL,
  `nama_jabatan` varchar(30) NOT NULL,
  `gapok` double NOT NULL,
  `uang_tp` double NOT NULL,
  `uang_mkn` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `kd_jabatan`, `nama_jabatan`, `gapok`, `uang_tp`, `uang_mkn`) VALUES
(4, 'NS', 'Non Staff', 2906473, 18000, 20000),
(5, 'M', 'Manager', 7200000, 18000, 20000),
(7, 'S', 'Staff', 3500000, 18000, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan_karyawan`
--

CREATE TABLE `jabatan_karyawan` (
  `id` int(11) NOT NULL,
  `nik` varchar(18) NOT NULL,
  `kd_jabatan` varchar(10) NOT NULL,
  `tanggal_mulai` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan_karyawan`
--

INSERT INTO `jabatan_karyawan` (`id`, `nik`, `kd_jabatan`, `tanggal_mulai`) VALUES
(1, '6372040408000001', 'S', '2022-01-22'),
(2, '6372060609002007', 'NS', '2022-02-01'),
(3, '6372080804000001', 'NS', '2022-02-08'),
(4, '6372040508000001', 'M', '2022-02-08'),
(5, '6372040308000002', 'S', '2022-02-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `tanggal_lahir` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `nik`, `nama`, `telp`, `email`, `alamat`, `agama`, `tanggal_lahir`) VALUES
(2, '6372040508000001', 'Kamil', '081250302237', 'kamil007@gmail.com', 'jl. hawai', 'Islam', '2004-05-18'),
(6, '6372040408000001', 'Muhammad Rinaldi', '0895705038835', 'muhammad.rinaldi007.mr@gmail.com', 'Jl. Kelurahan', 'Islam', '2000-08-04'),
(7, '6372080804000001', 'Malik', '0853247852044', 'malik@gmail.com', 'Jl. Kelurahan', 'Islam', '2000-06-14'),
(8, '6372060609002007', 'Muh Asya\'ri', '08785669878', 'muhasyari@gmail.com', 'Jl. Mutiara', 'Islam', '1996-05-21'),
(11, '6372040308000002', 'Muhammad Kamal', '0879050204001', 'kamal@gmial.com', 'jl. keruing', 'islam', '2022-07-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggajian`
--

CREATE TABLE `penggajian` (
  `id` int(11) NOT NULL,
  `nik` varchar(18) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `hadir` varchar(8) NOT NULL,
  `izin` varchar(8) NOT NULL,
  `alpha` varchar(8) NOT NULL,
  `telat` varchar(5) NOT NULL,
  `bulan` varchar(15) NOT NULL,
  `iq` double NOT NULL,
  `total_gajih` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penggajian`
--

INSERT INTO `penggajian` (`id`, `nik`, `nama`, `hadir`, `izin`, `alpha`, `telat`, `bulan`, `iq`, `total_gajih`) VALUES
(690, '6372040508000001', 'Kamil', '', '', '', '', '', 0, 0),
(691, '6372040408000001', 'Muhammad Rinaldi', '13', '0', '0', '4', 'Februari', 0, 7622000),
(692, '6372080804000001', 'Malik', '', '', '', '', '', 0, 0),
(693, '6372060609002007', 'Muh Asya\'ri', '', '', '', '', '', 0, 0),
(694, '6372040308000002', 'Muhammad Kamal', '', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nik`, `level`) VALUES
(1, 'admin', 'admin12', '6372040408000001', 'admin'),
(2, 'kamil', 'kamil12', '6372040508000001', 'user'),
(3, 'asyari', 'asyari123', '6372060609002007', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan_karyawan`
--
ALTER TABLE `jabatan_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penggajian`
--
ALTER TABLE `penggajian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jabatan_karyawan`
--
ALTER TABLE `jabatan_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `penggajian`
--
ALTER TABLE `penggajian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=695;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
