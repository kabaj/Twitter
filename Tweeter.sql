-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 14, 2016 at 09:48 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Tweeter`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` varchar(60) NOT NULL,
  `comment_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tweet_id` (`tweet_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`id`, `tweet_id`, `user_id`, `comment_text`, `comment_date`) VALUES
(1, 7, 2, 'nie prawda', '2016-02-11 20:58:27'),
(2, 7, 2, 'jjj', '2016-02-11 21:22:18'),
(3, 7, 1, 'blbllbb', '2016-02-11 21:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `Messages`
--

CREATE TABLE IF NOT EXISTS `Messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send_id` int(11) NOT NULL,
  `receive_id` int(11) NOT NULL,
  `text` varchar(500) DEFAULT NULL,
  `datesend` date DEFAULT NULL,
  `przeczytana` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `send_id` (`send_id`),
  KEY `receive_id` (`receive_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `Messages`
--

INSERT INTO `Messages` (`id`, `send_id`, `receive_id`, `text`, `datesend`, `przeczytana`) VALUES
(16, 1, 2, 'Fajny dzis obiad zjadlem', '2016-02-14', 1),
(17, 1, 2, 'Hej hej co tam robiles w weekend', '2016-02-14', 1),
(18, 2, 1, 'Bylem w kinie', '2016-02-14', 1),
(19, 2, 1, 'A co jadles na obiad?', '2016-02-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Tweets`
--

CREATE TABLE IF NOT EXISTS `Tweets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `tweet_text` varchar(140) NOT NULL,
  `post_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `Tweets`
--

INSERT INTO `Tweets` (`id`, `user_id`, `tweet_text`, `post_date`) VALUES
(3, 1, 'hshhshsh', '2016-02-10'),
(7, 2, 'djdjdjdj', '2016-02-11'),
(11, 1, 'jdjdjdjdjdd', '2016-02-11'),
(13, 2, 'jsjs jsjsjsjsjsjduduud u enp sndas ndsj ndjsand jnakjandjndjn ajsd jns dja;dj na;snd', '2016-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `password` char(60) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `name`, `mail`, `password`, `description`) VALUES
(1, 'filip', 'filip@filip.pl', '$2y$11$LRf5gNn.7ah21oIYex9eHe7kxHWJy9rGZDahpRZ.VFiOYdBYvwDPm', 'to ja'),
(2, 'kabaj', 'kabaj@kabaj', '$2y$11$f7XBYDwXIRXy.bjcIc0cS.PjWQm6JDdbLu5VIQ2HncnqnaIlJKyPK', 'kabaj');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`tweet_id`) REFERENCES `Tweets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`);

--
-- Constraints for table `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`send_id`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`receive_id`) REFERENCES `Users` (`id`);

--
-- Constraints for table `Tweets`
--
ALTER TABLE `Tweets`
  ADD CONSTRAINT `Tweets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
