-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221022.e89ebe179c
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 02:54 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `calon`
--

CREATE TABLE `calon` (
  `nomor` int(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `foto` text NOT NULL,
  `total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calon`
--

INSERT INTO `calon` (`nomor`, `nama`, `visi`, `misi`, `foto`, `total`) VALUES
(1, ' Zulfan Adha & Muhammad Fadhil', 'pengurus hmps yang profesional dan aspiratif guna mewujudkan keluarga mahasiswa elektro bersinar berlandaskan asas kebermanfaatan', ' - meningkatkan kualitas kader hmps yang berkarakter \r\n- mengoptimalkan fungsi hmps sebagai tempat bediskusi \r\n- menguatkan sinergi dengan mahasiswa serta seluruh civitas politeknik', 'paslon1.jpg', 1),
(2, 'T. M Al fandi Zuhri & Muhammad S.Ramadhan', 'mewujudkan hmps listrik sebagai organsasi yang profesional, unggul, berintegritas, solid, memiliki daya tarik yang tinggi terhadap lingkungan kampus dan luar kampus, mewujudkan mahasiswa listrik yang aktif, kreatif, aktif dan inovatif serta berpijak pada moral yang baik.', '   - menjadikan hmps listrik sebagai tempat jembatan aspirasi seluruh mahasiswa listrik\r\n- menjalin jiwa persaudaraan yang erat sesama mahasiswa maupun dosen serta alumni teknik listrik dan menjalin relasi yang baik dengan orang-orang sudah duduk di instansi\r\n- mampu menjadi wadah pengembangan minat bakat dan kompetensi yang di miliki\r\npara mahasiswa listrik\r\n- menumbuhkan rasa solidaritas tinggi memiliki peduli antara sesama tanpa pandag rasa, suku, budaya dan agama\r\n- mengadakan kegiatan bakti sosial dan pengajian di internal maupun eksternal', 'paslon2.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `hak_akses` varchar(10) NOT NULL,
  `pilihan` int(5) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `nama`, `password`, `hak_akses`, `pilihan`, `status`) VALUES
(1, '2105102003', 'ILHAM ZUKHRI', 'admin', 'admin', 0, 'open'),
(2, '2105031001', 'ABDILLAH TAMA', 'user123', 'user', 1, 'closed'),
(3, '2105031003', 'METILLA MAESI', 'user123', 'user', 0, 'open'),
(4, '2105031008', 'NATALIA NATASYA', 'user123', 'user', 0, 'open'),
(5, '2105031009', 'M. REZA FIRDAUS', 'user123', 'user', 0, 'open'),
(6, '2105031012', 'MUHAMMAD YOGA PRAYUDA', 'user123', 'user', 0, 'open'),
(7, '2105031022', 'MHD. DZAKY', 'user123', 'user', 0, 'open'),
(8, '2105031029', 'MUHAMMAD ADLI', 'user123', 'user', 0, 'open'),
(9, '2105031047', 'ARDIANSYAH PASARIBU', 'user123', 'user', 0, 'open'),
(10, '2105031049', 'ZULFAN ADHA', 'user123', 'user', 0, 'open'),
(11, '2105031050', 'SILVI BEAKIA HASIGUAN', 'user123', 'user', 0, 'open');

-- --------------------------------------------------------

--
-- Table structure for table `waktu`
--

CREATE TABLE `waktu` (
  `tanggal` date DEFAULT NULL,
  `jam` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `waktu`
--

INSERT INTO `waktu` (`tanggal`, `jam`) VALUES
('2023-05-26', '15:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
