-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Des 2024 pada 14.55
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi-pegawai-smkmuhkawali`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_attendance`
--

CREATE TABLE `data_attendance` (
  `attendance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_break` time NOT NULL,
  `time_out` time NOT NULL,
  `latlong` varchar(128) NOT NULL,
  `location` varchar(128) NOT NULL,
  `status` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `confirm` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `data_attendance`
--

INSERT INTO `data_attendance` (`attendance_id`, `user_id`, `date`, `time_in`, `time_break`, `time_out`, `latlong`, `location`, `status`, `description`, `confirm`) VALUES
(40626, 349, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40627, 350, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40628, 351, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40629, 352, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40630, 353, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40631, 354, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40632, 355, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40633, 356, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40634, 357, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40635, 358, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40636, 359, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40637, 360, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40638, 361, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40639, 362, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40640, 363, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40641, 364, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40642, 365, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '1', '', 1),
(40643, 366, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40644, 367, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40645, 368, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40646, 369, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40647, 370, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40648, 371, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40649, 372, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40650, 373, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40651, 374, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40652, 375, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40653, 376, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40654, 377, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40655, 378, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40656, 379, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40657, 380, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40658, 381, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40659, 382, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40660, 383, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40661, 384, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40662, 385, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40663, 386, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40664, 387, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40665, 388, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40666, 389, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1),
(40667, 390, '2024-11-24', '00:00:00', '00:00:00', '00:00:00', '-6.9530251697747545, 108.46944914599598', 'belum ada lokasi', '0', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_geolocation`
--

CREATE TABLE `data_geolocation` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `place_id` varchar(255) NOT NULL,
  `date_create` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_holiday`
--

CREATE TABLE `data_holiday` (
  `id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jarak`
--

CREATE TABLE `data_jarak` (
  `id` int(11) NOT NULL,
  `jarak` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `data_jarak`
--

INSERT INTO `data_jarak` (`id`, `jarak`, `status`) VALUES
(1, 500, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_mac_address`
--

CREATE TABLE `data_mac_address` (
  `mac_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mac_address` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_mac_address`
--

INSERT INTO `data_mac_address` (`mac_id`, `user_id`, `email`, `mac_address`) VALUES
(0, 19, 'edwin.erdiyana.96@gmail.com', '		</p>\n\n		\n	\n\n</d');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_picture`
--

CREATE TABLE `data_picture` (
  `id` bigint(20) NOT NULL,
  `data_attendance` bigint(20) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `data_picture`
--

INSERT INTO `data_picture` (`id`, `data_attendance`, `image`) VALUES
(6, 2568, 'image_1661335647.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ketidakhadiran`
--

CREATE TABLE `ketidakhadiran` (
  `id_tidakhadir` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `document` text NOT NULL,
  `status` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `qr`
--

CREATE TABLE `qr` (
  `id` int(11) NOT NULL,
  `qr_token` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `qr`
--

INSERT INTO `qr` (`id`, `qr_token`) VALUES
(65, 'nG6HygdI03Lsu4vqDxvl'),
(66, 'hM1DmAF1awWFIkComrYs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rank_attendance`
--

CREATE TABLE `rank_attendance` (
  `rank_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attendance_id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) NOT NULL,
  `logo` longtext NOT NULL,
  `sampul` longtext NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `kode_group` text NOT NULL,
  `wa_target` varchar(15) NOT NULL,
  `bot_telegram` text NOT NULL,
  `token_telegram` longtext NOT NULL,
  `chat_id_telegram` longtext NOT NULL,
  `address` longtext NOT NULL,
  `langitude` text NOT NULL,
  `longitude` text NOT NULL,
  `maps_enabled` int(11) NOT NULL,
  `uuid_enabled` int(11) NOT NULL,
  `metode_laporan` varchar(50) NOT NULL,
  `bg-qrcode` longtext NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `logo`, `sampul`, `name`, `phone`, `kode_group`, `wa_target`, `bot_telegram`, `token_telegram`, `chat_id_telegram`, `address`, `langitude`, `longitude`, `maps_enabled`, `uuid_enabled`, `metode_laporan`, `bg-qrcode`, `url`) VALUES
(1, 'assets/images/profile.jpg', 'assets/images/sampul.jpg', 'SMK MUHAMMADIYAH KAWALI', '6283823948689', 'kodegrup@g.us', '628', 'bot7765753428', 'AAHmGMASRUwMPTqh4kISKbVGG16f_Yz8_yk', '1002315282781', 'Jl. Poronggol Raya No.18, Kawalimukti, Kec. Kawali, Kabupaten Ciamis, Jawa Barat 46253', '-7.1871632', '108.3655518', 0, 0, 'Telegram', 'assets/images/qr-template/QR-TEMPLATE.png', 'https://smkmuhkawali.id/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `time_attendance`
--

CREATE TABLE `time_attendance` (
  `id` int(11) NOT NULL,
  `time_schedule` varchar(128) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `time_attendance`
--

INSERT INTO `time_attendance` (`id`, `time_schedule`, `time_start`, `time_end`) VALUES
(1, 'Jam Masuk', '01:00:00', '06:45:00'),
(2, 'Jam Telat', '06:45:01', '11:20:01'),
(3, 'Jam Pulang', '11:20:01', '21:59:00'),
(4, 'Jam Istirahat', '09:21:00', '09:30:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `department` varchar(256) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `address` text NOT NULL,
  `is_flexible` int(11) NOT NULL DEFAULT 0,
  `view_tepat_waktu` int(11) NOT NULL,
  `view_telat` int(11) NOT NULL,
  `view_sakit` int(11) NOT NULL,
  `view_izin` int(11) NOT NULL,
  `view_alpha` int(11) NOT NULL,
  `view_khusus` int(11) NOT NULL,
  `view_hadir` int(11) NOT NULL,
  `view_tidak_hadir` int(11) NOT NULL,
  `view_persentase` int(11) NOT NULL,
  `view_persentase_telat` int(11) NOT NULL,
  `view_persentase_tepat_waktu` int(11) NOT NULL,
  `qr_code` varchar(50) NOT NULL,
  `uuid` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`, `department`, `phone`, `gender`, `address`, `is_flexible`, `view_tepat_waktu`, `view_telat`, `view_sakit`, `view_izin`, `view_alpha`, `view_khusus`, `view_hadir`, `view_tidak_hadir`, `view_persentase`, `view_persentase_telat`, `view_persentase_tepat_waktu`, `qr_code`, `uuid`) VALUES
(1, 'Administrator Sistem Absensi', 'admin@gmail.com', 'LOGO_SMK_MUHAMMADIYAH_KAWALI.png', '$2y$10$jO2/FIjBMAfw.vTclVKMDe3NFlypJrShKBHQmQIYgZE.Kooiy.zbq', 1, 1, '0000-00-00', 'Admin', '0812-2425-8566', 'L', 'SMK MUHAMMADIYAH KAWALI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'OK', ''),
(348, 'NIA HARYANI, S.KOM., M.PD.', 'haryani0701@gmail.com ', '', '$2y$10$l9gIVr4O6NfyTdtA8j48UOc66J2supdMW41CQf1TTZP8wcu6L5FX6', 19, 1, '0000-00-00', 'Kepala Sekolah', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(349, 'UDIN', 'udinajjah1965@gmail.com', '', '$2y$10$Ht2KuEFblRoZTmyG3v/2WOl76a2.jLWel1j9I1zdtezmR7b3VQjj.', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(350, 'AAN ISTIANAH, M.PD.', 'aanistianah134@gmail.com  ', '', '$2y$10$VGgvltyrOvTZEQZZe6KoJ.K1jRUB.Aw3WrwvU1Ec4nIBaJXaHgMvS', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(351, 'AYI SAEPUL MILLAH, S.T.', 'ayisaeful1994@gmail.com ', '', '$2y$10$oj2WFKTxquy4AGfTctzC5.tr2JkyOH.stNsXqmPM19iPTpcqDHe1u', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(352, 'H. DEPI KHARISMAWAN, S.KOM., M.PD.', 'depikharismawan@gmail.com ', '', '$2y$10$BUHUfquynidY.09yP14/tOP3eV8LOywPVPlAXu/i6JQW.0tcVXXw6', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(353, 'ERDIS RUSMAYADI, S.PD.', 'rusmayadierdis@gmail.com ', '', '$2y$10$..5sggLSDC9o/Qy20wh34uzXCDTOUU15GojaNQ4WGRCLriAaZbx1u', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(354, 'IDA FARIDA, S.PD.', 'aiidafarida087@gmail.com ', '', '$2y$10$cJKkDciKsg7VYDCAEzB/IubkTxGC1JVGvNkJD.h8zwk.j/hvR40x2', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(355, 'IMRON ROSADI, S.T', 'rosadiimron1997@gmail.com ', '', '$2y$10$l3Ue4w2N.tmpNHIiDp6mi.Fu05qm.L/hGdLTS9Jw7uVk.gKJpjWqK', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(356, 'MUHAMAD RAMDAN, S.KOM.', 'ramdhanmuh.smkmuhaka@gmail.com ', '', '$2y$10$H1dZIuyyPo5Nm4EOXyU4a.1dAenAacwTLvB8mlDgEt57Ln5zi/d8e', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(357, 'YULI YULIAWATI, SH.', 'yuliyuliawatii977@gmail.com ', '', '$2y$10$pwl4cP.pitwHGBqE2Kgpi.bnuzm3YavK.ZxREL4r8TjEwI/4nYTxS', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(358, 'YUSUF ALI HAMZAH, S.PD.', 'yusufalihamzah8@gmail.com ', '', '$2y$10$qqEdI/.pyPzmr6EKp/Yhz.mukuZ0bs10PIQrUm0LeDAu1j5P9vgUq', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(359, 'LINDA PARIDA, S.PD.', 'linda.parida@gmail.com', '', '$2y$10$1xxI1.TxGUlwFCGq.QmCgus.V0SGtbfm0mcw6MtWUhrIHDzbc4zqC', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(360, 'DEWI BULCI FL., S.SOS', 'dewibulcifl015@gmail.com', '', '$2y$10$UPechURvYG1T2S/33JgW5OPTnhdNetBlBi4sBflfBQQARQFNmRZKa', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(361, 'RINI LESTRIANI, S.PD.', 'rinilestriani@student.upi.edu', '', '$2y$10$dt4SvKzg1T8gjOeLt77E6.J8qeUE/T33TA2AWgIdC4T03wqCnP/me', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(362, 'SRI DEWI APRIANTI, S.T', 'sridewia45@gmail.com', '', '$2y$10$ASnD/nVBE46yOjmqyuMmhuLDMGpD1CJUm6DvRI84w7f9AwAkumAU2', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(363, 'RUDI MEITUR, S.PD.', 'rudimeitur3@gmail.com', '', '$2y$10$Yucqne42UqDtBRcPpjl1DuScPvydIDB923sCtzbj5a4Kro0AXuv/e', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(364, 'ERNI SITI NURAENI, S.SOS.', 'sitierninuraeni.991@gmail.com', '', '$2y$10$6zwUgJIGfslGOmz34bGbFuVUfI4Ty3Zq7SyIlMk8vsIgxPJgPxqoq', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(365, 'ASEP RIZKA ABDUL GHOFUR, S.T.', 'aseprizka1@gmail.com', '', '$2y$10$wTIBsr5.zVUf5Lr/WL..ouZDaKfuEOhprvIiXT.PnAURw52c/NluS', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(366, 'DEWI PURNAMASARI, S.PD.', 'purnamasaridewi987@gmail.com', '', '$2y$10$p67McXmCN4b53s5eUdNtLOnzqZa3QskbdmapGjBTM8ZaTrUySSfpK', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(367, 'IQBAL MAULANA GHOZALI', 'iqbalmaulanagozali@gmail.com', '', '$2y$10$pCkGaU3qhavjQ3lfinEIEeS86wZWkk1y9FPlVQ9DKReSVo0tRjUga', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(368, 'DHEA IKRIMA, S.PD.', 'dheaikrima15@gmail.com', '', '$2y$10$Ha3OpdO0kyxvQJtYeZAkdufWMJPUT4/NAR7lGf2wRMJI7zVYOJRsO', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(369, 'DERI HERFIANSYAH', 'deriherfiansyah97@gmail.com', '', '$2y$10$scHPWpLCagZ9vr2GEwf68uvGoHGiugTdN5/LOw7YJ6LU1JtEVaDXO', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(370, 'SRI APRILIANTI, S.E', 'sriaprilianti1999@gmail.com', '', '$2y$10$G0d3W8q4tbcQzy2PEjOkCukeHHDq6HJg6nuqP.AdQs.hWhh8ssxz6', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(371, 'BUDI SYHABUDDIN ALGHIFARI, S.PD.', 'budisyhabuddinalgifari@gmail.com ', '', '$2y$10$scof9seaHqgRfLlkyadoseBmLzGa.V7wBE9oGPvWJ8feHVXbgRk2y', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(372, 'ALDI MAULANA, A.MD. KOM.', 'maualdi42@gmail.com ', '', '$2y$10$HsGO7R/XAyGrpXvnEeCzLONiA9WfEdiMCep0ya4qgO7..6MzGfxqC', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(373, 'DINAR MAHARANI, S.E.', 'dinarmaharani98@gmail.com ', '', '$2y$10$qcBaYd5NzHI2qpAPV.fFmughALj6Yw3RtT.fVoV3IOAu698QzI.R2', 22, 1, '0000-00-00', 'Guru', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(374, 'LINA SOFYAH, S.PD.', 'linaciamis14@gmail.com ', '', '$2y$10$7f0OXu3UQcj4DKmw7MiL8usBmUe9JOBJMqz0t0r/xUcYZcEmGeWEO', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(375, 'RESI FARIDA, S.PD.', 'resifarida.rf@gmail.com ', '', '$2y$10$LOrRNjailGRRSctpHa8oP.gNZmEcb8F88GpX8F4YJ7.VKz.j5p2ra', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(376, 'SYADILLA HASRAH A. S.PD.', 'syadillahasrah@gmail.com ', '', '$2y$10$7.SjZu3I2AFVZX9vdiq3X.UbP5ZcKz9Xmtu.azWJmM8XwPooXnw7S', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(377, 'SYIFA FAUZIAH', 'sifafauziahard@gmail.com ', '', '$2y$10$7401FR3EmPvyyZ.U72K2Ae/a7EZRtabqMWwWe7hRrgQt0BFShAN8e', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(378, 'DESI NUR FULLI, S.PD.', 'Nurfullidesi@gmail.com ', '', '$2y$10$qsZTLFB9Jr1GKmbpv/GI6O6icHBZGNXdtuh3QQwYHvlGbELU05nba', 22, 1, '0000-00-00', 'Guru', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(379, 'YUNI ARYANTI, S.PD.', 'yuniaryanti04@gmail.com ', '', '$2y$10$ASkICqLCweJhK8JhWCjeTOfKZB/MTgmoVoJKBdWEx9INgYzaO1KO.', 17, 1, '0000-00-00', 'Staff', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(380, 'ACENG KARSO', 'acengkarso1990@gmail.com ', '', '$2y$10$rwfXigITRFpyBMcaCtiQoOpWAW4d9awUC4kYFbGRDNQtkvKeBhv3e', 17, 1, '0000-00-00', 'Staff', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(381, 'EVA ANNURUFAIDAH', 'evaannurufaidah@gmail.com ', '', '$2y$10$ERzoYUz0lZUp/pjj/LSE7uAWWCDYAXTXwQs547s3FmCEvm4cQ3g3.', 17, 1, '0000-00-00', 'Staff', '8', 'P', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(382, 'ADE CAHYADI', 'adecmzqq@gmail.com ', '', '$2y$10$yk/P7FGeElxktriSi7lAPe18PuhIas8c2jj5c.Zpgtj06PICjb34u', 17, 1, '0000-00-00', 'Staff', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(383, 'ANDI SUHENDI', 'suhendiandi489@gmail.com ', '', '$2y$10$A4YERLBvxBxfbvSTMGvyU.QnavDa0YQQCekKr.1T0kWhIum2J0Olu', 17, 1, '0000-00-00', 'Staff', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(384, 'SAMSU', 'chualfarizi70@gmail.com ', '', '$2y$10$mjJOgLGsib5eVk0Mz2//oOHzKsgLnFLBbi58dIJdVnA/XEn.gdu2m', 17, 1, '0000-00-00', 'Staff', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(385, 'TANTAN DIWA NUGRAHA', 'tantandn2018@gmail.com', '', '$2y$10$SVtjJ/Oq2KQ.i6tv.EBcmuIT9Ztl09VzLGxWrJ6EqijMTtMVkUAUe', 17, 1, '0000-00-00', 'Staff', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(386, 'IWAN KARTIWAN', 'joeyilathea@gmail.com', '', '$2y$10$ZpWG6mNsW7B/pOXk6ZJ7EeodZxXGjQ4ADlFUAl.wpHCpdjKJBPffi', 17, 1, '0000-00-00', 'Staff', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(387, 'ZAKI FADILAH', 'zakifadillah30@gmail.com', '', '$2y$10$6oDORgvIq7IStTUz3kfAGutOOFaL/M7iZ/QtokwQbIPd.mILDqFZS', 17, 1, '0000-00-00', 'Staff', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(388, 'YUDI AGUSTIAR', 'yudiagustiar5@gmail.com', '', '$2y$10$LJh6c8KpJKWdi1B1S9F3c.Oj6IitllhP/57H3ym4SsWy9nOxe4yYy', 17, 1, '0000-00-00', 'Staff', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(389, 'ADE TRIANTI APRILIA, S.E.', 'adetriantiaprilia2145@gmail.com ', '', '$2y$10$yJICRCYAvLhhQNcQU/5ODeA.gk6G/2Lwzv92wdo9Mz1Ln9zqM4may', 17, 1, '0000-00-00', 'Staff', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(390, 'DODITA AGUSTIAN', 'doditaagustiandodita@gmail.com ', '', '$2y$10$NQ0r4zb4rJTi9TzZ0crkc.xK/KloyBaiJ0VUyAuuvtkAY.YRAG4HW', 17, 1, '0000-00-00', 'Staff', '8', 'L', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(49, 1, 2),
(50, 1, 3),
(51, 1, 6),
(53, 2, 2),
(55, 1, 9),
(56, 1, 10),
(57, 1, 11),
(58, 15, 14),
(59, 1, 12),
(60, 1, 13),
(61, 1, 14),
(63, 3, 15),
(66, 1, 17),
(67, 16, 17),
(69, 19, 18),
(70, 20, 19),
(71, 20, 20),
(72, 17, 20),
(73, 16, 20),
(75, 1, 18),
(77, 1, 20),
(78, 1, 19),
(79, 22, 20),
(83, 24, 20),
(85, 38, 19),
(87, 38, 20),
(88, 37, 20),
(89, 29, 20),
(90, 28, 20),
(91, 27, 20),
(92, 26, 20),
(93, 35, 20),
(94, 34, 20),
(95, 31, 20),
(96, 30, 20),
(97, 39, 20),
(98, 40, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Administrator'),
(3, 'Menu Management'),
(6, 'User Management'),
(17, 'Operator'),
(18, 'Kepala Sekolah '),
(19, 'Wakil Kepala Sekolah'),
(20, 'Pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'superadmin'),
(16, 'Operator'),
(17, 'Staff'),
(19, 'Kepala Sekolah'),
(20, 'Wakil Kepala Sekolah'),
(22, 'Guru'),
(26, 'Petugas Kebersihan'),
(27, 'Petugas Keamanan'),
(28, 'Bimbingan Konseling'),
(29, 'Manajer Kesiswaan'),
(30, 'Manajer Kurikulum'),
(31, 'Hubungan Industri'),
(32, 'BKK'),
(33, 'Supir'),
(34, 'BKK'),
(35, 'Bekerja Di Bagian Yayasan'),
(36, 'Kepala Staf'),
(37, 'Recepsionist'),
(38, 'Tim Pengembang Mutu'),
(39, 'Manager Sarana'),
(40, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', '<i class=\"fas fa-fw fa-tachometer-alt\"></i>', 1),
(2, 2, 'My Profile', 'user', '<i class=\"fas fa-user\"></i>', 1),
(3, 2, 'Edit Profile', 'user/edit', '<i class=\"fas fa-user-edit\"></i>', 1),
(4, 3, 'Menu Management', 'menu', '<i class=\"fas fa-folder\"></i>', 1),
(5, 3, 'Submenu Management', 'menu/submenu', '<i class=\"fas fa-folder-minus\"></i>', 1),
(9, 1, 'Role', 'admin/role', '<i class=\"fas fa-user-cog\"></i>', 1),
(10, 2, 'Change Password', 'user/changepassword', '<i class=\"fas fa-key\"></i>', 1),
(11, 6, 'Manage User', 'admin/manage', '<i class=\"fas fa-users-cog\"></i>', 1),
(17, 9, 'Manage Sosmed', 'sosmed/', '<i class=\"fas fa-thumbs-up\"></i>', 1),
(18, 10, 'Manage Mitra', 'mitra', '<i class=\"fas fa-building\"></i>', 1),
(19, 11, 'Manage Service', 'service/index', '<i class=\"fas fa-users-cog\"></i>', 1),
(20, 11, 'Add Service', 'service/addService', '<i class=\"fas fa-plus-square\"></i>', 1),
(21, 15, 'Data Keuangan', '#', '<i class=\"fas fa-fw fa-folder\"></i>', 1),
(22, 17, 'Dashboard', 'operator', '<i class=\"fas fa-fw fa-tachometer-alt\"></i>', 1),
(24, 17, 'Rekap Absen', 'absensi/rekap', '<i class=\"fas fa-folder\"></i>', 1),
(25, 17, 'Jam Absensi', 'operator/jam_absen', '<i class=\"fas fa-folder\"></i>', 1),
(26, 17, 'Ketidakhadiran', 'operator/absensi_manual', '<i class=\"fas fa-folder\"></i>', 1),
(27, 18, 'Dashboard', 'kepsek', '<i class=\"fas fa-fw fa-tachometer-alt\"></i>', 1),
(28, 18, 'Rekap Absen', 'absensi/rekap', '<i class=\"fas fa-folder\"></i>', 1),
(29, 19, 'Dashboard', 'wakasek', '<i class=\"fas fa-fw fa-tachometer-alt\"></i>', 1),
(30, 19, 'Rekap Absen', 'absensi/rekap', '<i class=\"fas fa-folder\"></i>', 1),
(31, 20, 'Dashboard', 'user/dashboard', '<i class=\"fas fa-fw fa-tachometer-alt\"></i>', 1),
(33, 20, 'Rekap Absen', 'pegawai/rekap', '<i class=\"fas fa-folder\"></i>', 1),
(34, 17, 'Manage User', 'admin/manage', '<i class=\"fa fa-users\" aria-hidden=\"true\"></i>', 1),
(35, 1, 'QR Code', 'operator/qr', '<i class=\"fas fa-folder\"></i>', 1),
(38, 17, 'Data Hari Ini', 'operator/kehadiran', '<i class=\"fas fa-folder\"></i>', 1),
(39, 18, 'Data Hari Ini', 'operator/kehadiran', '<i class=\"fas fa-folder\"></i>', 1),
(40, 19, 'Data Hari Ini', 'operator/kehadiran', '<i class=\"fas fa-folder\"></i>', 1),
(41, 17, 'Absen Libur', 'operator/libur', '<i class=\"fas fa-folder\"></i>', 1),
(42, 20, 'KetidakHadiran', 'pegawai/ketidakhadiran', '<i class=\"fas fa-folder\"></i>', 1),
(43, 1, 'Rekap Absensi di Admin', 'admin/rekap', '<i class=\"fas fa-user-cog\"></i>', 1),
(44, 1, 'Batch Insert Attendance', 'auto/', '<i class=\"fas fa-folder\"></i>', 1),
(45, 1, 'Kirim Ke Telegram', 'telegram/', '<i class=\"fas fa-folder\"></i>', 1),
(46, 1, 'Rank Attendance', 'rank/', '<i class=\"fas fa-folder\"></i>', 1),
(47, 18, 'Kehadiran Terbaik', 'rank/', '<i class=\"fas fa-trophy\"></i>', 1),
(48, 19, 'Kehadiran Terbaik', 'rank/', '<i class=\"fas fa-trophy\"></i>', 1),
(49, 17, 'Absen Khusus', 'operator/absen_khusus', '<i class=\"fas fa-folder\"></i>', 1),
(50, 1, 'Kehadiran', 'admin/kehadiran', '<i class=\"fas fa-folder\"></i>', 1),
(51, 1, 'Data Jarak', 'operator/jarak', '<i class=\"fa fa-location-arrow\" aria-hidden=\"true\"></i>', 1),
(52, 1, 'Absensi Pusat', 'operator/absen_pusat', '<i class=\"fas fa-folder\"></i>', 1),
(53, 20, 'QR Code', 'pegawai/qrcode', '<i class=\"fas fa-folder\"></i>', 1),
(54, 17, 'Laporan Absensi Pusat', 'operator/laporan_absen_pusat', '<i class=\"fas fa-folder\"></i>', 1),
(55, 1, 'Pengaturan', 'admin/settings', '<i class=\"fa fa-cog\" aria-hidden=\"true\"></i>', 1),
(57, 1, 'Pengaturan API', 'admin/settings_api', '<i class=\"fa fa-cog\" aria-hidden=\"true\"></i>', 1),
(58, 1, 'Data Group WhatsApp', 'whatsapp/group', '<i class=\"fa fa-whatsapp\" aria-hidden=\"true\"></i>', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_attendance`
--
ALTER TABLE `data_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `data_geolocation`
--
ALTER TABLE `data_geolocation`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_holiday`
--
ALTER TABLE `data_holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_jarak`
--
ALTER TABLE `data_jarak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_mac_address`
--
ALTER TABLE `data_mac_address`
  ADD PRIMARY KEY (`mac_id`);

--
-- Indeks untuk tabel `data_picture`
--
ALTER TABLE `data_picture`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ketidakhadiran`
--
ALTER TABLE `ketidakhadiran`
  ADD PRIMARY KEY (`id_tidakhadir`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `qr`
--
ALTER TABLE `qr`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rank_attendance`
--
ALTER TABLE `rank_attendance`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `time_attendance`
--
ALTER TABLE `time_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_attendance`
--
ALTER TABLE `data_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40668;

--
-- AUTO_INCREMENT untuk tabel `data_geolocation`
--
ALTER TABLE `data_geolocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `data_holiday`
--
ALTER TABLE `data_holiday`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT untuk tabel `data_jarak`
--
ALTER TABLE `data_jarak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `data_picture`
--
ALTER TABLE `data_picture`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `ketidakhadiran`
--
ALTER TABLE `ketidakhadiran`
  MODIFY `id_tidakhadir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT untuk tabel `qr`
--
ALTER TABLE `qr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `rank_attendance`
--
ALTER TABLE `rank_attendance`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `time_attendance`
--
ALTER TABLE `time_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
