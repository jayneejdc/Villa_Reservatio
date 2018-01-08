-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2018 at 12:10 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `villa_reservatio`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `adel` (`temp` INT)  BEGIN
DELETE FROM reservation WHERE reservation_id=temp;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `aupd` (IN `temp` INT, IN `lastname` VARCHAR(100), IN `firstname` VARCHAR(100), IN `checkin` VARCHAR(100), IN `contact` VARCHAR(100))  BEGIN
UPDATE chalet SET lastname=lastname, firstname=firstname, checkin=checkin, contact=contact where num = temp;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delcha` (`temp` INT)  BEGIN
DELETE FROM chalet WHERE id=temp;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delchan` (IN `temp` INT)  BEGIN
DELETE FROM chalet WHERE num=temp;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delroom` (IN `temp` INT)  BEGIN
DELETE FROM rooms WHERE rid=temp;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ihis` (IN `num` INT(11), IN `firstname` VARCHAR(100), IN `lastname` VARCHAR(100), IN `checkin` VARCHAR(100), IN `price` BIGINT(20), IN `temp` ENUM('0','1'), IN `contact` VARCHAR(11))  BEGIN
INSERT INTO history (num, firstname, lastname, checkin, bill, status, contact) VALUES (num, firstname, lastname, checkin, price , temp, contact);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert1` (IN `temp` INT, IN `lname` VARCHAR(50), IN `fname` VARCHAR(50), IN `checkin` DATE, IN `contact` VARCHAR(11))  begin
UPDATE chalet SET lastname=lname, firstname=fname, checkin=checkin, contact=contact 
WHERE num=temp;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ires` (IN `firstname` VARCHAR(100), IN `lastname` VARCHAR(100), IN `checkin` VARCHAR(100), IN `price` BIGINT(20), IN `temp` ENUM('0','1'), IN `contact` VARCHAR(11), IN `type` VARCHAR(100))  BEGIN
INSERT INTO reservation ( firstname, lastname, checkin, bill, status, contact, picked) VALUES ( firstname, lastname, checkin, price, status, contact , type);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `irooms` (IN `name` VARCHAR(100), IN `price` INT(11), IN `descr` TEXT, IN `avatar_path` VARCHAR(100), IN `tot` INT(11))  BEGIN
INSERT INTO  rooms (name, price, description, avatar, total) VALUES (name, price, descr, avatar_path, tot );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login_p` ()  begin
select * from admin;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `upcha` (IN `temp` INT, IN `did` INT)  BEGIN
UPDATE chalet SET id=temp WHERE num=did;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `upro` (IN `name` VARCHAR(100), IN `price` INT(11), IN `descr` TEXT, IN `avatar_path` VARCHAR(100), IN `picked` INT(11))  BEGIN
UPDATE  rooms  SET  name = name, price = price, description = descr, avatar = avatar_path WHERE rid =picked;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `uprooms` (IN `temp` INT, IN `did` INT)  BEGIN
UPDATE rooms SET total=temp WHERE rid=did;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `lastname`, `firstname`) VALUES
(1, 'admin@admin.com', 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `reserve_id` int(11) NOT NULL,
  `ci_date` varchar(20) NOT NULL,
  `a_bill` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`reserve_id`, `ci_date`, `a_bill`) VALUES
(6, '01/12/2018', 500),
(5, '01/12/2018', 500),
(4, '01/08/2018', 500),
(3, '01/08/2018', 500),
(2, '01/07/2018', 1000),
(1, '01/16/2018', 500);

-- --------------------------------------------------------

--
-- Table structure for table `chalet`
--

CREATE TABLE `chalet` (
  `num` int(3) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `checkin` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chalet`
--

INSERT INTO `chalet` (`num`, `firstname`, `lastname`, `checkin`, `contact`, `status`, `id`) VALUES
(202, '', '', '', '', '0', 2),
(203, '', '', '', '', '0', 2),
(204, '', '', '', '', '0', 2),
(205, '', '', '', '', '0', 2),
(301, '', '', '', '', '0', 3),
(302, '', '', '', '', '0', 3),
(303, '', '', '', '', '0', 3),
(304, '', '', '', '', '0', 3),
(305, '', '', '', '', '0', 3),
(405, '', '', '', '', '0', 4),
(404, '', '', '', '', '0', 4),
(403, '', '', '', '', '0', 4),
(402, '', '', '', '', '0', 4),
(401, '', '', '', '', '0', 4),
(105, '', '', '', '', '0', 1),
(104, '', '', '', '', '0', 1),
(103, '', '', '', '', '0', 1),
(102, '', '', '', '', '0', 1),
(101, '', '', '', '', '0', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `chalet_rooms`
-- (See below for the actual view)
--
CREATE TABLE `chalet_rooms` (
`num` int(3)
,`firstname` varchar(100)
,`lastname` varchar(100)
,`checkin` varchar(100)
,`contact` varchar(100)
,`status` enum('0','1')
,`id` int(11)
,`rid` int(11)
,`name` varchar(100)
,`price` int(11)
,`description` text
,`avatar` varchar(100)
,`total` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `num` int(11) DEFAULT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `checkin` varchar(100) DEFAULT NULL,
  `bill` bigint(20) DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `contact` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `num`, `firstname`, `lastname`, `checkin`, `bill`, `status`, `contact`) VALUES
(1, 101, 'Jayson', 'Landero', '01/16/2018', 500, '0', '09238465321'),
(2, 201, 'Jayson', 'De Claro', '01/07/2018', 1000, '0', '0987654321'),
(3, 103, 'Kyle', 'Martinez', '01/08/2018', 500, '0', '1234'),
(4, 101, 'Kyle', 'Martinez', '01/08/2018', 500, '0', '1234'),
(5, 102, 'Kyle', 'Martinez', '01/12/2018', 500, '0', '1234'),
(6, 102, 'Kyle', 'Martinez', '01/12/2018', 500, '0', '1234');

--
-- Triggers `history`
--
DELIMITER $$
CREATE TRIGGER `after_audit` AFTER INSERT ON `history` FOR EACH ROW BEGIN
    INSERT INTO audit
    SET reserve_id = new.history_id,
    	ci_date = new.checkin,
        a_bill = new.bill;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `checkin` varchar(100) DEFAULT NULL,
  `bill` bigint(20) DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `contact` varchar(11) DEFAULT NULL,
  `picked` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `firstname`, `lastname`, `checkin`, `bill`, `status`, `contact`, `picked`) VALUES
(2, 'Kyle', 'Martinez', '01/12/2018', NULL, '0', '1234', '1'),
(3, 'Kyle', 'Martinez', '01/12/2018', 500, '0', '1234', '1');

-- --------------------------------------------------------

--
-- Stand-in structure for view `reservation_chalet`
-- (See below for the actual view)
--
CREATE TABLE `reservation_chalet` (
);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `rid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text,
  `avatar` varchar(100) DEFAULT NULL,
  `total` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`rid`, `name`, `price`, `description`, `avatar`, `total`) VALUES
(1, 'Chalet 1', 500, 'Swiss dwelling with unconcealed structural members and a wide overhang at the front and sides.', 'Images/10.jpg', 5),
(2, 'Chalet 2', 1000, 'A wooden dwelling with a sloping roof and widely overhanging eaves, common in Switzerland and other Alpine regions.', 'Images/12.jpg', 4),
(3, 'Chalet 3', 1500, 'Resort-like homes or residential properties as beach cabin located at seaside resorts.', 'Images/13.jpg', 5),
(4, 'Chalet 4', 2500, 'Alpine style of wooden building with a sloping roof and overhanging eaves.', 'Images/20.jpg', 5);

-- --------------------------------------------------------

--
-- Structure for view `chalet_rooms`
--
DROP TABLE IF EXISTS `chalet_rooms`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `chalet_rooms`  AS  select `chalet`.`num` AS `num`,`chalet`.`firstname` AS `firstname`,`chalet`.`lastname` AS `lastname`,`chalet`.`checkin` AS `checkin`,`chalet`.`contact` AS `contact`,`chalet`.`status` AS `status`,`chalet`.`id` AS `id`,`rooms`.`rid` AS `rid`,`rooms`.`name` AS `name`,`rooms`.`price` AS `price`,`rooms`.`description` AS `description`,`rooms`.`avatar` AS `avatar`,`rooms`.`total` AS `total` from (`chalet` join `rooms` on((`chalet`.`id` = `rooms`.`rid`))) ;

-- --------------------------------------------------------

--
-- Structure for view `reservation_chalet`
--
DROP TABLE IF EXISTS `reservation_chalet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reservation_chalet`  AS  select `reservation`.`res_id` AS `res_id`,`reservation`.`firstname` AS `firstname`,`reservation`.`lastname` AS `lastname`,`reservation`.`checkin` AS `checkin`,`reservation`.`bill` AS `bill`,`reservation`.`status` AS `status`,`reservation`.`contact` AS `contact`,`reservation`.`picked` AS `picked`,`rooms`.`rid` AS `rid`,`rooms`.`name` AS `name`,`rooms`.`price` AS `price`,`rooms`.`description` AS `description`,`rooms`.`avatar` AS `avatar`,`rooms`.`total` AS `total` from (`reservation` left join `rooms` on((`reservation`.`picked` = `rooms`.`rid`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`,`email`);

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`reserve_id`);

--
-- Indexes for table `chalet`
--
ALTER TABLE `chalet`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`rid`,`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
