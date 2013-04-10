-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2013 at 12:26 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chabibcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `ch_user`
--

CREATE TABLE IF NOT EXISTS `ch_user` (
  `id_user` int(7) NOT NULL AUTO_INCREMENT,
  `jk_user` enum('Laki-laki','Perempuan') NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `sandi_user` varchar(50) NOT NULL,
  `tanggal_user` date NOT NULL,
  `id_level` int(2) NOT NULL DEFAULT '1',
  `status_user` enum('Active','Pending','Deactive') NOT NULL DEFAULT 'Pending',
  `keycode_user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ch_user`
--

INSERT INTO `ch_user` (`id_user`, `jk_user`, `email_user`, `nama_user`, `sandi_user`, `tanggal_user`, `id_level`, `status_user`, `keycode_user`) VALUES
(1, 'Laki-laki', 'admin@chabibcms', 'Administrator', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1991-10-11', 1, 'Active', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
