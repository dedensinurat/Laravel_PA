-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 26, 2024 at 04:04 PM
-- Server version: 10.4.11-MariaDB-log
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smpn3_laguboti`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` INT(11) NOT NULL,
  `tanggal_absensi` DATE NOT NULL,
  `kelas_id` INT(11) NOT NULL,
  `mata_pelajaran_id` INT(11) NOT NULL,
  `guru_id` INT(11) NOT NULL,
  `id_user` INT(11) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_foto` INT(11) NOT NULL,
  `id_user` INT(12) NOT NULL,
  `nama_foto` VARCHAR(255) NOT NULL,
  `deskripsi_foto` TEXT DEFAULT NULL,
  `tanggal_foto` DATE DEFAULT NULL,
  `kategori_foto` VARCHAR(50) DEFAULT NULL,
  `file_foto` VARCHAR(255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` INT(11) NOT NULL,
  `nip` VARCHAR(20) NOT NULL,
  `nama` VARCHAR(255) NOT NULL,
  `alamat` TEXT NOT NULL,
  `jenis_kelamin` VARCHAR(10) NOT NULL,
  `foto_profil` VARCHAR(255) DEFAULT NULL,
  `id_user` INT(11) NOT NULL,
  `id_mata_pelajaran` INT(11) NOT NULL,
  `updated_at` DATETIME NOT NULL,
  `created_at` DATETIME NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nama`, `alamat`, `jenis_kelamin`, `foto_profil`, `id_user`, `id_mata_pelajaran`, `updated_at`, `created_at`) VALUES
(1, '1234567890', 'John Doe', 'Jl. Contoh No. 123', 'Laki-laki', 'john_doe.jpg', 7, 3, '2024-04-26 19:47:53', '2024-04-26 19:47:53'),
(2, '0987654321', 'Jane Smith', 'Jl. Contoh No. 456', 'Perempuan', 'jane_smith.jpg', 7, 2, '2024-04-26 19:47:53', '2024-04-26 19:47:53'),
(3, '1357924680', 'David Johnson', 'Jl. Contoh No. 789', 'Laki-laki', 'david_johnson.jpg', 7, 5, '2024-04-26 19:47:53', '2024-04-26 19:47:53'),
(62, '12345678', 'Yonatan silalahi', 'siantar tanah jawa', 'Laki-laki', 'storage/img/XpVbZYd5EWg6XFDef7Y5EoVawc7l9CvSSa94cTxG.png', 7, 2, '2024-04-21 12:39:19', '2024-04-21 12:24:03'),
(63, '1231231231', 'yguhk', 'cvbjkm', 'Laki-laki', NULL, 7, 2, '2024-04-22 09:08:23', '2024-04-22 09:08:23'),
(64, '12', 'gurusekolah', '4recwdxedx', 'Laki-laki', NULL, 7, 2, '2024-04-25 08:18:19', '2024-04-25 08:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id_inbox` INT(11) NOT NULL,
  `id_pengunjung` INT(11) NOT NULL,
  `tanggal` DATE NOT NULL,
  `subjek` VARCHAR(255) NOT NULL,
  `isi_pesan` TEXT NOT NULL,
  `status_inbox` VARCHAR(50) NOT NULL,
  `id_user` INT(11) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pelajaran`
--

CREATE TABLE `jadwal_pelajaran` (
  `id_jadwal` INT(11) NOT NULL,
  `kelas_id` INT(11) NOT NULL,
  `hari` VARCHAR(20) NOT NULL,
  `jam_mulai` TIME NOT NULL,
  `jam_selesai` TIME NOT NULL,
  `mata_pelajaran_id` INT(11) NOT NULL,
  `guru_id` INT(11) NOT NULL,
  `id_user` INT(11) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jam_mata_pelajaran`
--

CREATE TABLE `jam_mata_pelajaran` (
  `id_jam` INT(11) NOT NULL,
  `mata_pelajaran_id` INT(11) DEFAULT NULL,
  `hari` ENUM('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') DEFAULT NULL,
  `jam_mulai` TIME DEFAULT NULL,
  `jam_selesai` TIME DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `jam_mata_pelajaran`
ADD COLUMN `jam` TIME DEFAULT NULL AFTER `hari`;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_siswa`
--

CREATE TABLE `kegiatan_siswa` (
  `id_kegiatan` INT(11) NOT NULL,
  `judul_kegiatan` VARCHAR(255) NOT NULL,
  `isi_kegiatan` TEXT NOT NULL,
  `tanggal_kegiatan` DATE NOT NULL,
  `waktu_kegiatan` TIME DEFAULT NULL,
  `tempat_kegiatan` VARCHAR(255) DEFAULT NULL,
  `foto_kegiatan` varchar(255) DEFAULT NULL,
  `kategori_kegiatan` varchar(50) DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `tingkat_kelas` varchar(20) NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `tingkat_kelas`, `tahun_ajaran`, `id_user`, `updated_at`, `created_at`) VALUES
(1, 'X IPA 1', 'X IPA', '2023/2024', 7, '2024-04-26 19:48:44', '2024-04-26 19:48:44'),
(2, 'X IPA 2', 'X IPA', '2023/2024', 7, '2024-04-26 19:48:44', '2024-04-26 19:48:44'),
(3, 'XI IPA 1', 'XI IPA', '2023/2024', 7, '2024-04-26 19:48:44', '2024-04-26 19:48:44'),
(4, 'VII-B', '3', '2022/2023', 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'VII-A', '2', '2023/2024', 7, '2024-04-18 09:58:34', '2024-04-18 09:58:34'),
(8, 'jenis kelamin', '20', '1212121', 7, '2024-04-21 15:05:35', '2024-04-21 15:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_mata_pelajaran` int(11) NOT NULL,
  `nama_mata_pelajaran` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `deskripsi_mata_pelajaran` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mata_pelajaran`, `nama_mata_pelajaran`, `id_user`, `deskripsi_mata_pelajaran`, `updated_at`, `created_at`) VALUES
(2, 'Bahasa Indonesia', 7, 'Mata Pelajaran yang membingungkan', '2024-04-10 16:01:19', '0000-00-00 00:00:00'),
(3, 'Ilmu Pengetahuan Sosial', 7, 'Mempelajari mengenai sejarah dan sosial di masyarakat juga tata negara', '2024-04-10 15:37:40', '2024-04-10 15:37:40'),
(5, 'Bahasa Indonesia', 7, 'kogona', '2024-04-25 08:26:35', '2024-04-25 08:26:35'),
(6, 'Matematika', 7, 'Mata pelajaran mengenai konsep dasar matematika.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Bahasa Inggris', 7, 'Mata pelajaran yang mempelajari bahasa Inggris secara mendalam.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'IPA', 7, 'Mata pelajaran Ilmu Pengetahuan Alam yang mencakup fisika, kimia, dan biologi.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'IPS', 7, 'Mata pelajaran Ilmu Pengetahuan Sosial yang mencakup sejarah, geografi, dan sosiologi.', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `judul_pengumuman` varchar(255) NOT NULL,
  `isi_pengumuman` text NOT NULL,
  `tanggal_pengumuman` date NOT NULL,
  `waktu_pengumuman` time DEFAULT NULL,
  `penulis` varchar(50) NOT NULL,
  `kategori_pengumuman` varchar(50) DEFAULT NULL,
  `file_pengumuman` varchar(255) DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_pengunjung` int(11) NOT NULL,
  `nama_pengunjung` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `jenis_prestasi` varchar(255) NOT NULL,
  `tingkat_prestasi` varchar(50) NOT NULL,
  `tahun_prestasi` varchar(10) NOT NULL,
  `deskripsi_prestasi` text DEFAULT NULL,
  `foto_prestasi` varchar(255) DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `profil_sekolah`
--

CREATE TABLE `profil_sekolah` (
  `id_profil` int(11) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `no_telepon_sekolah` varchar(20) NOT NULL,
  `email_sekolah` varchar(100) NOT NULL,
  `logo_sekolah` varchar(255) NOT NULL,
  `visi_sekolah` text NOT NULL,
  `misi_sekolah` text NOT NULL,
  `sambutan_kepsek` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil_sekolah`
--

INSERT INTO `profil_sekolah` (`id_profil`, `nama_sekolah`, `alamat_sekolah`, `no_telepon_sekolah`, `email_sekolah`, `logo_sekolah`, `visi_sekolah`, `misi_sekolah`, `sambutan_kepsek`, `id_user`, `updated_at`) VALUES
(1, 'SMP NEGERI 3 LAGUBOTI', 'Sitoluama, Sitoluama, Kec. Lagu Boti, Kab. Toba Prov. Sumatera Utara', '081261391469', 'smpn3lgb@gmail.com', 'img/logoTutWuri_1712843779.png', '<p>Menjadi lembaga pendidikan yang unggul dalam pengembangan potensi siswa dan menciptakan lingkungan belajar yang kondusif untuk <strong>menghasilkan</strong> generasi yang berkualitas dan mampu bersaing secara global</p>', '<p>Menciptakan lingkungan belajar yang inklusif dan mendukung bagi semua siswa. Memberikan pendidikan berkualitas yang berfokus pada pengembangan akademik, karakter, dan keterampilan siswa. Menyediakan fasilitas dan sumber daya yang memadai untuk mendukung kegiatan pembelajaran dan pengembangan siswa. Melibatkan aktif orang tua, guru, dan masyarakat dalam proses pendidikan untuk mendukung pertumbuhan dan perkembangan siswa. Mendorong inovasi dan penelitian dalam pendidikan untuk terus meningkatkan mutu sekolah dan hasil belajar siswa. Menanamkan nilai-nilai moral, etika, dan kepemimpinan dalam setiap aspek kegiatan sekolah.</p>', '<p>Assalamu\'alaikum Wr. Wb. Yang saya hormati Bapak/Ibu Guru, para siswa-siswi yang saya cintai, serta orang tua dan wali murid yang kami hormati. Puji syukur kita panjatkan ke hadirat Allah SWT, atas limpahan rahmat dan karunia-Nya kita semua dapat berkumpul di hari ini dalam keadaan sehat walafiat. Hari ini, saya merasa sangat bangga dan bersyukur bisa berdiri di hadapan kalian semua sebagai Kepala Sekolah dari [Nama Sekolah]. Saat kita berkumpul di sini, kita berbagi suka cita dan semangat untuk menjalani perjalanan pendidikan yang bermakna dan berarti. Para siswa yang saya cintai, kalian adalah harapan masa depan bangsa. Di sini, di [Nama Sekolah], kami bertekad untuk memberikan pendidikan yang terbaik untuk membantu kalian mencapai potensi penuh kalian. Kami ingin melihat kalian tumbuh dan berkembang tidak hanya dalam hal akademis, tetapi juga dalam hal karakter, kepemimpinan, dan keterampilan sosial. Saya ingin mengajak para orang tua dan wali murid untuk terlibat aktif dalam perjalanan pendidikan anak-anak kita. Kolaborasi antara sekolah dan rumah merupakan kunci keberhasilan pendidikan yang holistik. Mari kita jalin kerjasama yang erat demi kebaikan bersama. Bapak/Ibu Guru yang saya hormati, Anda semua adalah pilar utama dalam perjalanan pendidikan di [Nama Sekolah]. Dengan dedikasi dan komitmen Anda, kita dapat menciptakan lingkungan belajar yang menyenangkan dan memberdayakan bagi para siswa. Terakhir, saya ingin mengucapkan selamat bergabung kepada para siswa baru dan selamat datang kembali kepada para siswa yang sudah menjadi bagian dari keluarga besar [Nama Sekolah]. Mari kita bersama-sama menjadikan tahun ajaran ini sebagai tahun yang penuh prestasi dan kebahagiaan. Sekian sambutan dari saya, terima kasih atas perhatian dan semangat kalian semua. Mari kita mulai perjalanan ini dengan niat yang baik dan tekad yang kuat. Semoga Allah SWT senantiasa memberkahi langkah-langkah kita semua. Wassalamu\'alaikum Wr. Wb.</p>', 7, '2024-04-11 13:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_lengkap`, `nisn`, `jenis_kelamin`, `kelas_id`, `id_user`) VALUES
(1, 'Budi Santoso', '1234567890', 'L', 7, 7),
(2, 'Ani Rahayu', '1234567891', 'P', 7, 7),
(3, 'Joko Widodo', '1234567892', 'L', 7, 7),
(4, 'Siti Aisyah', '1234567893', 'P', 7, 7),
(5, 'Agus Setiawan', '1234567894', 'L', 7, 7),
(6, 'Rini Wulandari', '1234567895', 'P', 7, 7),
(7, 'Eko Prasetyo', '1234567896', 'L', 7, 7),
(8, 'Linda Sari', '1234567897', 'P', 7, 7),
(9, 'Dodi Susanto', '1234567898', 'L', 7, 7),
(10, 'Nina Kurnia', '1234567899', 'P', 7, 7),
(111, 'pertri', '4232342', 'Perempuan', 4, 7),
(112, 'yonatan', '1234543', 'Laki-Laki', 4, 7),
(113, 'Yonatan Rizky Partogi Silitonga ya', '12343231', 'Laki-laki', 4, 7),
(114, 'yonatan', '1234543', 'Laki-Laki', 4, 7),
(115, 'kekara', '1242123', 'Laki-Laki', 7, 7),
(116, 'kekara', '1142123', 'Laki-Laki', 7, 7),
(117, 'kekara', '1442123', 'Laki-Laki', 7, 7),
(118, 'kekara', '1542123', 'Laki-Laki', 7, 7),
(119, 'kekara', '1642123', 'Laki-Laki', 7, 7),
(120, 'kekara', '1742123', 'Laki-Laki', 7, 7),
(121, 'kekara', '1842123', 'Laki-Laki', 7, 7),
(122, 'kekara', '1942123', 'Laki-Laki', 7, 7),
(123, 'kekara', '142123', 'Laki-Laki', 7, 7),
(124, 'kekara', '1312123', 'Laki-Laki', 7, 7),
(125, 'pertri', '4222342', 'Perempuan', 4, 7),
(128, 'tobrut', '1422323', 'Laki-Laki', 4, 7),
(129, 'jawir', '11123', 'Laki-Laki', 4, 7),
(130, 'tobrut', '1422323', 'Laki-Laki', 4, 7),
(131, 'jawir', '11123', 'Laki-Laki', 4, 7),
(132, 'jappy', '2141', 'Laki-Laki', 4, 7),
(133, 'jawir', '11123', 'Laki-Laki', 4, 7),
(134, 'jappy', '2141', 'Laki-Laki', 4, 7),
(135, 'jawir', '1123', 'Laki-Laki', 4, 7),
(136, 'afwappy', '141', 'Laki-Laki', 4, 7),
(137, 'jafir', '123', 'Laki-Laki', 4, 7),
(138, 'japsfpy', '141', 'Laki-Laki', 4, 7),
(139, 'awir', '23', 'Laki-Laki', 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_web`
--

CREATE TABLE `user_web` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','guru','staf') NOT NULL,
  `image` varchar(225) DEFAULT NULL,
  `no_telepon` bigint(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_web`
--

INSERT INTO `user_web` (`id_user`, `username`, `password`, `email`, `role`, `image`, `no_telepon`, `alamat`, `created_at`, `updated_at`, `last_login`) VALUES
(7, 'admin', '$2y$10$HS.3.Xq6onr0CgOkJt8EBuEXYGtBBAQAwer7rc1VjNsa5J1GI6ufG', 'admin@gmail.com', 'admin', 'images/admin_logo_1713344446.png', 81201234213, 'jl.siantar', '2024-04-07 01:33:29', '2024-04-26 01:23:52', '2024-04-26 01:23:52'),
(31, 'Yonatan silalahi', '$2y$10$kvU9sNyYAF0ky5psOx05Y.Y30v39rLWP/PS6zusvC2khDmKAP7j/y', 'yonatansilitonga@gmail.com', 'guru', 'images/abang joel_1713703065.jpg', 1234567890, 'siantar tanah jawa', '2024-04-21 12:24:03', '2024-04-21 12:40:36', '2024-04-21 12:40:36'),
(32, 'yguhk', '$2y$10$mNa3nPbFNxK0B8DED9CknutWTop2rtWwe/FLxQkjsssQzbjcKMmLa', 'yguhk@gmail.com', 'guru', NULL, 1234567890, 'cvbjkm', '2024-04-22 09:08:23', '2024-04-22 09:08:23', NULL),
(33, 'gurusekolah', '$2y$10$b4EWfX52Go2svpR1z7gyj.K0at9YVNc191cbdCVBkIduM6XOSnfCO', 'gurusekolah@gmail.com', 'guru', NULL, 1234567890, '4recwdxedx', '2024-04-25 08:18:19', '2024-04-25 08:18:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `guru_ibfk_2` (`id_mata_pelajaran`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id_inbox`),
  ADD KEY `id_pengunjung` (`id_pengunjung`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `jadwal_pelajaran`
--
ALTER TABLE `jadwal_pelajaran`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `jam_mata_pelajaran`
--
ALTER TABLE `jam_mata_pelajaran`
  ADD PRIMARY KEY (`id_jam`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`);

--
-- Indexes for table `kegiatan_siswa`
--
ALTER TABLE `kegiatan_siswa`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_mata_pelajaran`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id_pengunjung`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  ADD PRIMARY KEY (`id_profil`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `siswa_ibfk_2` (`kelas_id`);

--
-- Indexes for table `user_web`
--
ALTER TABLE `user_web`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id_inbox` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_pelajaran`
--
ALTER TABLE `jadwal_pelajaran`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jam_mata_pelajaran`
--
ALTER TABLE `jam_mata_pelajaran`
  MODIFY `id_jam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kegiatan_siswa`
--
ALTER TABLE `kegiatan_siswa`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_mata_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id_pengunjung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `user_web`
--
ALTER TABLE `user_web`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_web` (`id_user`),
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `absensi_ibfk_3` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`),
  ADD CONSTRAINT `absensi_ibfk_4` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id_guru`);

--
-- Constraints for table `galeri`
--
ALTER TABLE `galeri`
  ADD CONSTRAINT `galeri` FOREIGN KEY (`id_user`) REFERENCES `user_web` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_web` (`id_user`),
  ADD CONSTRAINT `guru_ibfk_2` FOREIGN KEY (`id_mata_pelajaran`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inbox`
--
ALTER TABLE `inbox`
  ADD CONSTRAINT `inbox_ibfk_1` FOREIGN KEY (`id_pengunjung`) REFERENCES `pengunjung` (`id_pengunjung`),
  ADD CONSTRAINT `inbox_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user_web` (`id_user`);

--
-- Constraints for table `jadwal_pelajaran`
--
ALTER TABLE `jadwal_pelajaran`
  ADD CONSTRAINT `jadwal_pelajaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_web` (`id_user`),
  ADD CONSTRAINT `jadwal_pelajaran_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `jadwal_pelajaran_ibfk_3` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`),
  ADD CONSTRAINT `jadwal_pelajaran_ibfk_4` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id_guru`);

--
-- Constraints for table `jam_mata_pelajaran`
--
ALTER TABLE `jam_mata_pelajaran`
  ADD CONSTRAINT `jam_mata_pelajaran_ibfk_1` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`);

--
-- Constraints for table `kegiatan_siswa`
--
ALTER TABLE `kegiatan_siswa`
  ADD CONSTRAINT `kegiatan_siswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_web` (`id_user`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_web` (`id_user`);

--
-- Constraints for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD CONSTRAINT `mata_pelajaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_web` (`id_user`);

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_web` (`id_user`);

--
-- Constraints for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `prestasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_web` (`id_user`),
  ADD CONSTRAINT `prestasi_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  ADD CONSTRAINT `profil_sekolah_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_web` (`id_user`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_web` (`id_user`),
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
