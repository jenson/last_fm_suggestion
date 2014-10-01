-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2014 at 12:07 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jobtasks`
--

-- --------------------------------------------------------

--
-- Table structure for table `last_fm_user`
--

CREATE TABLE IF NOT EXISTS `last_fm_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `last_fm_user`
--

INSERT INTO `last_fm_user` (`id`, `uname`, `passwd`, `status`) VALUES
(1, 'jenson', 'bb61a3b1016c4afdbcbae99392796bfd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `last_fm_user_search`
--

CREATE TABLE IF NOT EXISTS `last_fm_user_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `last_fm_user_search`
--

INSERT INTO `last_fm_user_search` (`id`, `uid`, `keyword`, `time`) VALUES
(1, 1, 'michael jackson', '2014-10-01 11:54:06'),
(2, 1, 'ricky martin', '2014-10-01 11:54:25');
