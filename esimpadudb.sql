-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2018 at 07:05 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `esimpadudb`
--

-- --------------------------------------------------------

--
-- Table structure for table `jnslayanan`
--

CREATE TABLE IF NOT EXISTS `jnslayanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nmlayanan` varchar(80) DEFAULT '',
  `waktu` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `jnslayanan`
--

INSERT INTO `jnslayanan` (`id`, `nmlayanan`, `waktu`) VALUES
(2, 'e-KTP', 4),
(3, 'AKTA KELAHIRAN', 7),
(4, 'AKTA KEMATIAN', 4),
(5, 'AKTA PERKAWINAN', 7),
(6, 'AKTA PERCERAIAN', 4),
(7, 'AKTA PENGESAHAN ANAK', 4),
(8, 'ADOPSI ANAK', 4),
(9, 'MUTASI PENDUDUK', 7),
(10, 'KARTU KELUARGA', 5);

-- --------------------------------------------------------

--
-- Table structure for table `layanan_tb`
--

CREATE TABLE IF NOT EXISTS `layanan_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noregister` varchar(12) DEFAULT NULL,
  `tglberkas` datetime NOT NULL,
  `pemohon` varchar(80) NOT NULL,
  `jenis` int(11) NOT NULL,
  `tglselesai` datetime DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL,
  `stts` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `layanan_tb`
--

INSERT INTO `layanan_tb` (`id`, `noregister`, `tglberkas`, `pemohon`, `jenis`, `tglselesai`, `keterangan`, `telp`, `stts`) VALUES
(4, NULL, '2016-03-01 00:00:00', 'SARIONO', 9, NULL, 'Loket 2 Oke', NULL, 1),
(5, NULL, '2016-03-02 00:00:00', 'AIRLANGGA', 3, NULL, 'PROSES SELESAI', NULL, 99),
(6, NULL, '2016-03-02 00:00:00', 'MARHABAN', 10, NULL, 'Loket 4 Oke', NULL, 3),
(7, '6JN43G3DA5PB', '2016-04-12 00:00:00', 'ALI BIN ABAN', 8, NULL, 'loket 2 oke', '082155342367', 1),
(8, 'S9R0PKM9F5HR', '2016-05-08 00:00:00', 'JARWO', 2, NULL, 'TERDAFTAR', '0808080808080', 0),
(9, 'F4EJ61B2JU11', '2018-04-18 00:00:00', 'ASDFAS', 10, NULL, 'PEMINDAHAN KARTU KELUARGA', '085735547770', 1),
(10, '73EB885E015G', '2018-04-20 00:00:00', 'SARMILI', 9, NULL, 'TERDAFTAR', '085735547770', 0),
(11, '58S26CH696H8', '2018-04-27 00:00:00', 'SURYANI', 10, NULL, 'TERDAFTAR', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pemroses`
--

CREATE TABLE IF NOT EXISTS `pemroses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idlayanan` int(18) NOT NULL,
  `telp` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pemroses`
--

INSERT INTO `pemroses` (`id`, `idlayanan`, `telp`) VALUES
(1, 2, '085735547770'),
(2, 3, '081256000141'),
(3, 4, '654654123112'),
(4, 5, '654654123112'),
(5, 6, '654654123112'),
(6, 7, '654654123112'),
(7, 8, '654654123112'),
(8, 9, '081256000141'),
(9, 10, '085735547770'),
(11, 11, '085735547770');

-- --------------------------------------------------------

--
-- Table structure for table `tbproses`
--

CREATE TABLE IF NOT EXISTS `tbproses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prosesno` int(11) NOT NULL DEFAULT '0',
  `idlayanan` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `tglproses` datetime NOT NULL,
  `userent` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbproses`
--

INSERT INTO `tbproses` (`id`, `prosesno`, `idlayanan`, `keterangan`, `tglproses`, `userent`) VALUES
(1, 1, 5, 'Loket I Oke ', '2016-05-07 00:00:00', 'admin'),
(2, 2, 5, 'Loket 2 Oke', '2016-05-07 00:00:00', 'admin'),
(3, 3, 5, 'Loket 3 Oke', '2016-05-07 00:00:00', 'admin'),
(4, 4, 5, 'Loket 4 Oke', '2016-05-07 00:00:00', 'admin'),
(5, 1, 4, 'Loket 2 Oke', '2016-05-07 00:00:00', 'admin'),
(6, 5, 5, 'Loket 5 Oke', '2016-05-07 00:00:00', 'admin'),
(7, 1, 6, 'Loket I Oke', '2016-05-07 00:00:00', 'admin'),
(8, 2, 6, 'Loket 2 Oke', '2016-05-07 00:00:00', 'admin'),
(9, 3, 6, 'Loket 4 Oke', '2016-05-07 00:00:00', 'admin'),
(10, 1, 9, 'PEMINDAHAN KARTU KELUARGA', '2018-04-18 00:00:00', 'admin'),
(11, 6, 5, 'SEDANG DALAM PROSES', '2018-04-18 00:00:00', 'admin'),
(12, 99, 5, 'PROSES SELESAI', '2018-04-20 00:00:00', 'admin'),
(13, 1, 7, 'loket 2 oke', '2018-04-26 00:00:00', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE IF NOT EXISTS `user_tb` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(18) DEFAULT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `telp` varchar(13) CHARACTER SET latin1 NOT NULL,
  `user_level` int(5) NOT NULL,
  `user_role` varchar(15) NOT NULL DEFAULT 'operator',
  `inst_kerja` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`user_id`, `nip`, `user_nama`, `user_username`, `user_password`, `telp`, `user_level`, `user_role`, `inst_kerja`, `status`, `last_login`) VALUES
(34, '13456789012345678', 'administrator', 'admin', 'd8578edf8458ce06fbc5bb76a58c5ca4', '081256000141', 0, 'admin', 0, 0, '2018-04-28 20:47:22'),
(35, '12345685', 'Operator', 'operator', '4b583376b2767b923c3e1da60d10de59', '085735547770', 0, 'op1', 0, 0, '2018-04-19 21:51:25');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
