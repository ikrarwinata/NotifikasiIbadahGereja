-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 13 Jul 2021 pada 13.22
-- Versi Server: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ibadahgereja`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE IF NOT EXISTS `jadwal` (
  `kode` varchar(100) NOT NULL,
  `jenis` int(11) NOT NULL,
  `rayon` int(11) NOT NULL,
  `tgl` int(11) NOT NULL,
  `tempat` text NOT NULL,
  `pemimpin` text NOT NULL,
  `pesan` text,
  `terkirim` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`kode`, `jenis`, `rayon`, `tgl`, `tempat`, `pemimpin`, `pesan`, `terkirim`) VALUES
('IBD16258568151', 1, 1, 1626173580, 'sadasdas', 'dasdasdasd', 'Hai, %{nama_jemaat}\r\nIni adalah pengingat %{jenis_ibadah} pada %{tanggal_jadwal}.\r\nTempat Ibadah : %{tempat_ibadah}\r\nPemimpin Ibadah : %{pemimpin_ibadah}', 1),
('IBD16258568732', 2, 3, 1625966280, 'sadsad', 'qwdqwdqwd', 'Hai, %{nama_jemaat}\r\nIni adalah pengingat %{jenis_ibadah} pada %{tanggal_jadwal}.\r\nTempat Ibadah : %{tempat_ibadah}\r\nPemimpin Ibadah : %{pemimpin_ibadah}', 0),
('IBD16258634773', 2, 1, 1625966220, 'qwdqw', 'wqdwqwqd', 'Hai, %{nama_jemaat}\r\nIni adalah pengingat %{jenis_ibadah} pada %{tanggal_jadwal}.\r\nTempat Ibadah : %{tempat_ibadah}\r\nPemimpin Ibadah : %{pemimpin_ibadah}', 0),
('IBD16260039494', 3, 1, 1626018480, 'jhggggggv', 'cgxyxycuf', 'Hai, %{nama_jemaat}\r\nIni adalah pengingat %{jenis_ibadah} pada %{tanggal_jadwal}.\r\nTempat Ibadah : %{tempat_ibadah}\r\nPemimpin Ibadah : %{pemimpin_ibadah}', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `jadwal_view`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `jadwal_view`;
CREATE TABLE IF NOT EXISTS `jadwal_view` (
`kode` varchar(100)
,`id_jenis_ibadah` int(11)
,`jenis` varchar(250)
,`id_rayon` int(11)
,`rayon` varchar(250)
,`tgl` int(11)
,`tempat` text
,`pemimpin` text
,`pesan` text
,`terkirim` tinyint(1)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_ibadah`
--

DROP TABLE IF EXISTS `jenis_ibadah`;
CREATE TABLE IF NOT EXISTS `jenis_ibadah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_ibadah`
--

INSERT INTO `jenis_ibadah` (`id`, `jenis`) VALUES
(1, 'Pw'),
(2, 'Pkb'),
(3, 'Pam'),
(4, 'Par'),
(5, 'Keluarga'),
(6, 'Tunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

DROP TABLE IF EXISTS `notifikasi`;
CREATE TABLE IF NOT EXISTS `notifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hp` varchar(25) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_ibadah` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `hp`, `nama`, `jenis_ibadah`) VALUES
(1, '6281532380661', 'Sofuwan pkb2', '2'),
(2, '6281532380661', 'Sofuwan pw', '1'),
(3, '6281532380661', 'Sofuwan pkb1', '2'),
(4, '6282398300463', 'rendy', '1');

-- --------------------------------------------------------

--
-- Stand-in structure for view `notifikasi_view`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `notifikasi_view`;
CREATE TABLE IF NOT EXISTS `notifikasi_view` (
`id` int(11)
,`hp` varchar(25)
,`nama` varchar(100)
,`id_jenis_ibadah` int(11)
,`jenis_ibadah` varchar(250)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rayon`
--

DROP TABLE IF EXISTS `rayon`;
CREATE TABLE IF NOT EXISTS `rayon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rayon` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rayon`
--

INSERT INTO `rayon` (`id`, `rayon`) VALUES
(1, 'Rayon 1'),
(2, 'Rayon 2'),
(3, 'Rayon 3'),
(4, 'Rayon 4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tata_ibadah`
--

DROP TABLE IF EXISTS `tata_ibadah`;
CREATE TABLE IF NOT EXISTS `tata_ibadah` (
  `kode` varchar(100) NOT NULL,
  `waktu` int(11) NOT NULL,
  `file_path` text,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tata_ibadah`
--

INSERT INTO `tata_ibadah` (`kode`, `waktu`, `file_path`) VALUES
('TTB16258575401', 1626087900, './files/tata_ibadah/Tata_ibadah_1625857550.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tentang`
--

DROP TABLE IF EXISTS `tentang`;
CREATE TABLE IF NOT EXISTS `tentang` (
  `nama` varchar(150) NOT NULL,
  `nilai` text NOT NULL,
  PRIMARY KEY (`nama`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tentang`
--

INSERT INTO `tentang` (`nama`, `nilai`) VALUES
('slider1', 'bg.jpg'),
('slider2', 'bg.jpg'),
('visi', 'Lorem ipsum sit dolor amet...'),
('misi', 'Lorem ipsum sit dolor amet...'),
('nama_aplikasi', 'GKI SKION KLABALA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `level` enum('admin','superadmin') NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`, `nama`, `level`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin'),
('superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'Super Admin', 'superadmin');

-- --------------------------------------------------------

--
-- Struktur untuk view `jadwal_view`
--
DROP TABLE IF EXISTS `jadwal_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jadwal_view`  AS  (select `jadwal`.`kode` AS `kode`,`jenis_ibadah`.`id` AS `id_jenis_ibadah`,`jenis_ibadah`.`jenis` AS `jenis`,`rayon`.`id` AS `id_rayon`,`rayon`.`rayon` AS `rayon`,`jadwal`.`tgl` AS `tgl`,`jadwal`.`tempat` AS `tempat`,`jadwal`.`pemimpin` AS `pemimpin`,`jadwal`.`pesan` AS `pesan`,`jadwal`.`terkirim` AS `terkirim` from ((`jadwal` join `jenis_ibadah` on((`jadwal`.`jenis` = `jenis_ibadah`.`id`))) join `rayon` on((`jadwal`.`rayon` = `rayon`.`id`)))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `notifikasi_view`
--
DROP TABLE IF EXISTS `notifikasi_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `notifikasi_view`  AS  (select `notifikasi`.`id` AS `id`,`notifikasi`.`hp` AS `hp`,`notifikasi`.`nama` AS `nama`,`jenis_ibadah`.`id` AS `id_jenis_ibadah`,`jenis_ibadah`.`jenis` AS `jenis_ibadah` from (`notifikasi` join `jenis_ibadah` on((`notifikasi`.`jenis_ibadah` = `jenis_ibadah`.`id`)))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
