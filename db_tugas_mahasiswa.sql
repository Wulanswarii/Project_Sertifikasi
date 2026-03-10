-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2026 at 02:30 PM
-- Server version: 8.0.30
-- PHP Version: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tugas_mahasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_mk` int NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `dosen` varchar(100) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `id_dosen` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_mk`, `nama_mk`, `dosen`, `semester`, `id_dosen`) VALUES
(1, 'Pemrograman Web', 'Pak Made', '4', 173),
(2, 'Basis Data', 'Bu Sari', '3', 173),
(3, 'Pemrograman Berorientasi Objek', 'Pak Agus', '4', 174),
(4, 'Pemrograman Web', 'Pak Made', '4', 174),
(5, 'Basis Data', 'Bu Sari', '3', 175),
(6, 'Pemrograman Berorientasi Objek', 'Pak Agus', '4', 175),
(7, 'Algoritma dan Struktur Data', 'Pak Wayan', '2', 176),
(8, 'Pemrograman Mobile', 'Bu Komang', '5', 176),
(9, 'Sistem Operasi', 'Pak Budi', '3', 177),
(10, 'Jaringan Komputer', 'Pak Arta', '4', 177),
(11, 'Rekayasa Perangkat Lunak', 'Bu Ayu', '5', 178),
(12, 'Kecerdasan Buatan', 'Pak Surya', '6', 178),
(13, 'Machine Learning', 'Bu Ratna', '6', 179),
(14, 'Cloud Computing', 'Pak Jaya', '5', 179),
(15, 'Big Data', 'Bu Sinta', '6', 180),
(16, 'Keamanan Informasi', 'Pak Putra', '5', 180),
(17, 'Manajemen Proyek TI', 'Bu Dewi', '5', 181),
(18, 'UI UX Design', 'Pak Yoga', '4', 181),
(19, 'Pengolahan Citra Digital', 'Bu Mira', '6', 182),
(20, 'Pemrograman Python', 'Pak Dika', '3', 182),
(21, 'Pemrograman Java', 'Pak Hendra', '3', 173),
(22, 'Pemrograman PHP', 'Pak Made', '4', 174),
(23, 'Pemrograman JavaScript', 'Bu Sari', '4', 175),
(24, 'Framework Laravel', 'Pak Agus', '5', 176),
(25, 'Framework React', 'Pak Wayan', '5', 177),
(26, 'Framework VueJS', 'Bu Komang', '5', NULL),
(27, 'Database Lanjut', 'Pak Budi', '6', NULL),
(28, 'Analisis Sistem Informasi', 'Pak Arta', '4', NULL),
(29, 'Perancangan Sistem Informasi', 'Bu Ayu', '4', NULL),
(30, 'Audit Sistem Informasi', 'Pak Surya', '6', NULL),
(31, 'Manajemen Basis Data', 'Bu Ratna', '5', NULL),
(32, 'Pemrograman Android', 'Pak Jaya', '5', NULL),
(33, 'Pemrograman iOS', 'Bu Sinta', '6', NULL),
(34, 'Teknologi Multimedia', 'Pak Putra', '4', NULL),
(35, 'Game Development', 'Bu Dewi', '6', NULL),
(36, 'Internet of Things', 'Pak Yoga', '6', NULL),
(37, 'Blockchain Technology', 'Bu Mira', '6', NULL),
(38, 'Data Mining', 'Pak Dika', '6', NULL),
(39, 'Statistika Komputasi', 'Pak Hendra', '3', NULL),
(40, 'Logika Informatika', 'Pak Made', '1', NULL),
(41, 'Matematika Diskrit', 'Bu Sari', '2', NULL),
(42, 'Kalkulus', 'Pak Agus', '1', NULL),
(43, 'Linear Algebra', 'Pak Wayan', '2', NULL),
(44, 'Metodologi Penelitian', 'Bu Komang', '5', NULL),
(45, 'Technopreneurship', 'Pak Budi', '5', NULL),
(46, 'Manajemen Sistem Informasi', 'Pak Arta', '5', NULL),
(47, 'Pengujian Perangkat Lunak', 'Bu Ayu', '6', NULL),
(48, 'Arsitektur Komputer', 'Pak Surya', '3', NULL),
(49, 'Sistem Informasi Geografis', 'Bu Ratna', '6', NULL),
(50, 'Teknologi Web Lanjut', 'Pak Jaya', '6', NULL),
(51, 'Pemrograman API', 'Bu Sinta', '5', NULL),
(52, 'DevOps', 'Pak Putra', '6', NULL),
(53, 'Computer Vision', 'Bu Dewi', '6', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengumpulan_tugas`
--

CREATE TABLE `pengumpulan_tugas` (
  `id_pengumpulan` int NOT NULL,
  `id_tugas` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `file_tugas` varchar(255) DEFAULT NULL,
  `tanggal_upload` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengumpulan_tugas`
--

INSERT INTO `pengumpulan_tugas` (`id_pengumpulan`, `id_tugas`, `id_user`, `file_tugas`, `tanggal_upload`) VALUES
(1, 4, 14, '1773067454_soal praktek pg.pdf', '2026-03-09 22:44:14'),
(2, 5, 29, '1773117026_soal praktek pg.pdf', '2026-03-10 12:30:26'),
(3, 5, 30, '1773126345_soal praktek pg.pdf', '2026-03-10 15:05:45'),
(4, 5, 183, '1773143164_soal praktek pg.pdf', '2026-03-10 19:46:04'),
(5, 9, 183, '1773147218_soal praktek pg.pdf', '2026-03-10 20:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_mk` int DEFAULT NULL,
  `judul_tugas` varchar(200) NOT NULL,
  `deskripsi` text,
  `deadline` date DEFAULT NULL,
  `status` enum('Belum Selesai','Selesai') DEFAULT 'Belum Selesai',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `id_user`, `id_mk`, `judul_tugas`, `deskripsi`, `deadline`, `status`, `created_at`) VALUES
(1, 2, 1, 'Membuat Website CRUD', 'Membuat aplikasi CRUD menggunakan PHP', '2026-03-20', 'Belum Selesai', '2026-03-09 04:26:32'),
(2, 2, 2, 'Normalisasi Database', 'Mengerjakan soal normalisasi hingga 3NF', '2026-03-18', 'Belum Selesai', '2026-03-09 04:26:32'),
(3, 2, 1, 'Membuat Website CRUD', 'Membuat aplikasi CRUD menggunakan PHP', '2026-03-20', 'Belum Selesai', '2026-03-09 04:26:32'),
(4, 2, 2, 'Normalisasi Database', 'Mengerjakan soal normalisasi hingga 3NF', '2026-03-18', 'Belum Selesai', '2026-03-09 04:26:32'),
(5, NULL, 19, 'Membuat Website CRUD', '111111111111', '2026-03-09', 'Belum Selesai', '2026-03-09 13:29:54'),
(7, NULL, 15, 'Analisis Data Menggunakan Hadoop', 'Mahasiswa diminta melakukan analisis dataset besar menggunakan framework Hadoop atau Spark serta membuat laporan hasil analisis data.', '2026-03-30', 'Belum Selesai', '2026-03-10 07:00:38'),
(8, NULL, 15, 'Implementasi Apache Spark untuk Analisis Data', 'Mahasiswa diminta mengolah dataset berukuran besar menggunakan Apache Spark dan menampilkan hasil analisis dalam bentuk grafik atau tabel.', '2026-03-14', 'Belum Selesai', '2026-03-10 07:03:19'),
(9, NULL, 13, 'Klasifikasi Dataset Iris Menggunakan Decision Tree', 'Mahasiswa diminta membuat model klasifikasi menggunakan algoritma Decision Tree untuk dataset Iris dan menampilkan hasil evaluasi model seperti accuracy dan confusion matrix.', '2026-03-28', 'Belum Selesai', '2026-03-10 12:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `semester` int DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dosen','mahasiswa') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `email`, `semester`, `password`, `role`, `created_at`) VALUES
(1, 'Admin Sistem', NULL, 'admin@gmail.com', NULL, '123456', 'admin', '2026-03-09 04:25:41'),
(2, 'Mahasiswa 1', NULL, 'mahasiswa@gmail.com', NULL, '123456', 'mahasiswa', '2026-03-09 04:25:41'),
(3, 'Andi Saputra', 'andi', 'andi@gmail.com', 1, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(4, 'Budi Santoso', 'budi', 'budi@gmail.com', 1, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(5, 'Cahya Pratama', 'cahya', 'cahya@gmail.com', 1, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(6, 'Dimas Setiawan', 'dimas', 'dimas@gmail.com', 1, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(7, 'Eka Putra', 'eka', 'eka@gmail.com', 1, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(8, 'Fajar Nugroho', 'fajar', 'fajar@gmail.com', 1, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(9, 'Gilang Ramadhan', 'gilang', 'gilang@gmail.com', 2, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(10, 'Hendra Wijaya', 'hendra', 'hendra@gmail.com', 2, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(11, 'Indra Saputra', 'indra', 'indra@gmail.com', 2, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(12, 'Joko Susanto', 'joko', 'joko@gmail.com', 2, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(13, 'Kevin Pratama', 'kevin', 'kevin@gmail.com', 3, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(14, 'Lukman Hakim', 'lukman', 'lukman@gmail.com', 3, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(15, 'Mochamad Rizki', 'rizki', 'rizki@gmail.com', 3, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(16, 'Nanda Prasetyo', 'nanda', 'nanda@gmail.com', 3, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(17, 'Oka Mahendra', 'oka', 'oka@gmail.com', 3, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(18, 'Putra Mahardika', 'putra', 'putra@gmail.com', 3, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(19, 'Raka Wijaya', 'raka', 'raka@gmail.com', 4, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(20, 'Satria Nugraha', 'satria', 'satria@gmail.com', 4, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(21, 'Taufik Hidayat', 'taufik', 'taufik@gmail.com', 4, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(22, 'Umar Dani', 'umar', 'umar@gmail.com', 4, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(23, 'Vino Saputra', 'vino', 'vino@gmail.com', 5, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(24, 'Wahyu Setiawan', 'wahyu', 'wahyu@gmail.com', 5, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(25, 'Yoga Pratama', 'yoga', 'yoga@gmail.com', 5, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(26, 'Zaki Ramadhan', 'zaki', 'zaki@gmail.com', 5, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(27, 'Agus Setiawan', 'agus', 'agus@gmail.com', 5, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(28, 'Bagus Prakoso', 'bagus', 'bagus@gmail.com', 5, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(29, 'Chandra Aditya', 'chandra', 'chandra@gmail.com', 6, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(30, 'Denny Saputra', 'denny', 'denny@gmail.com', 6, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(31, 'Eko Prasetyo', 'eko', 'eko@gmail.com', 6, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(32, 'Fauzan Hidayat', 'fauzan', 'fauzan@gmail.com', 6, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(33, 'Gerry Mahendra', 'gerry', 'gerry@gmail.com', 6, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(34, 'Haris Pratama', 'haris', 'haris@gmail.com', 7, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(35, 'Iqbal Maulana', 'iqbal', 'iqbal@gmail.com', 7, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(36, 'Jefri Saputra', 'jefri', 'jefri@gmail.com', 7, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(37, 'Kurniawan', 'kurnia', 'kurnia@gmail.com', 7, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(38, 'Luthfi Ramadhan', 'luthfi', 'luthfi@gmail.com', 7, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(39, 'Miftahul Huda', 'miftah', 'miftah@gmail.com', 8, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(40, 'Naufal Hidayat', 'naufal', 'naufal@gmail.com', 8, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(41, 'Omar Dani', 'omar', 'omar@gmail.com', 8, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(42, 'Prasetyo Adi', 'prasetyo', 'prasetyo@gmail.com', 8, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(43, 'Rendi Saputra', 'rendi', 'rendi@gmail.com', 8, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(44, 'Sandi Wijaya', 'sandi', 'sandi@gmail.com', 5, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(45, 'Teguh Prasetyo', 'teguh', 'teguh@gmail.com', 4, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(46, 'Udin Setiawan', 'udin', 'udin@gmail.com', 3, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(47, 'Vicky Saputra', 'vicky', 'vicky@gmail.com', 2, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(48, 'Wira Mahendra', 'wira', 'wira@gmail.com', 1, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(49, 'Yudi Prakoso', 'yudi', 'yudi@gmail.com', 2, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(50, 'Zulfikar', 'zulfikar', 'zulfikar@gmail.com', 3, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(51, 'Ardiansyah', 'ardi', 'ardi@gmail.com', 4, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(52, 'Bayu Saputra', 'bayu', 'bayu@gmail.com', 5, '123456', 'mahasiswa', '2026-03-09 11:48:37'),
(173, 'Pak Made', 'made', 'made.dosen@gmail.com', NULL, '123456', 'dosen', '2026-03-09 12:01:58'),
(174, 'Bu Sari', 'sari', 'sari.dosen@gmail.com', NULL, '123456', 'dosen', '2026-03-09 12:01:58'),
(175, 'Pak Agus', 'agus', 'agus.dosen@gmail.com', NULL, '123456', 'dosen', '2026-03-09 12:01:58'),
(176, 'Pak Wayan', 'wayan', 'wayan.dosen@gmail.com', NULL, '123456', 'dosen', '2026-03-09 12:01:58'),
(177, 'Bu Komang', 'komang', 'komang.dosen@gmail.com', NULL, '123456', 'dosen', '2026-03-09 12:01:58'),
(178, 'Pak Budi', 'budi', 'budi.dosen@gmail.com', NULL, '123456', 'dosen', '2026-03-09 12:01:58'),
(179, 'Pak Arta', 'arta', 'arta.dosen@gmail.com', NULL, '123456', 'dosen', '2026-03-09 12:01:58'),
(180, 'Bu Ayu', 'ayu', 'ayu.dosen@gmail.com', NULL, '123456', 'dosen', '2026-03-09 12:01:58'),
(181, 'Pak Surya', 'surya', 'surya.dosen@gmail.com', NULL, '123456', 'dosen', '2026-03-09 12:01:58'),
(182, 'Bu Ratna', 'ratna', 'ratna.dosen@gmail.com', NULL, '123456', 'dosen', '2026-03-09 12:01:58'),
(183, 'Wulanswari', 'wulanswari', 'wulanswari@gmail.com', 6, '123456', 'mahasiswa', '2026-03-10 07:09:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_mk`),
  ADD KEY `fk_dosen` (`id_dosen`);

--
-- Indexes for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD PRIMARY KEY (`id_pengumpulan`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_mk` (`id_mk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_mk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  MODIFY `id_pengumpulan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `fk_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `tugas_ibfk_2` FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id_mk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
