-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2019 at 06:42 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ambulance_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `adm_id` int(11) NOT NULL,
  `adm_name` text NOT NULL,
  `adm_mob` text NOT NULL,
  `adm_mail_id` text NOT NULL,
  `adm_pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`adm_id`, `adm_name`, `adm_mob`, `adm_mail_id`, `adm_pass`) VALUES
(1, 'Shrinath Gupta', '8433530825', 'guptashrinath9@gmail.com', 'password123'),
(2, 'Ayush Sawant ', '8169528775', 'ayushsawant@gmail.com', '$2y$10$CFK/9axVNHJ2xkURNiyVy.50.kdMVT/zGYfJP3xpyCJx2dIPEHo8u'),
(3, 'Marzook Khatri', '9619373036', 'marzookkhatri@gmail.com', '$2y$10$Z5iyyDwtB5ym799uzHKvjOU9uOWOydpG/Li6XVHPMQt2IQpO/wbwm');

-- --------------------------------------------------------

--
-- Table structure for table `doc_details`
--

CREATE TABLE `doc_details` (
  `doc_id` int(11) NOT NULL,
  `doc_name` text NOT NULL,
  `doc_mail_id` text NOT NULL,
  `doc_mob` text NOT NULL,
  `doc_hos` text NOT NULL,
  `doc_pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_details`
--

INSERT INTO `doc_details` (`doc_id`, `doc_name`, `doc_mail_id`, `doc_mob`, `doc_hos`, `doc_pass`) VALUES
(1, 'Shrinath Gupta', 'guptashrinath9@gmail.com', '8433530825', 'K J Somaiya', '$2y$10$OGIJI2TrEyRrnjnnV/.couiO2xnaQs0j0kmds1sKA./g1L1EQxs/2'),
(2, 'guptaaa', 'guptashrinaath9@gmail.com', '1234567658', 'ting tongaaaasd', 'a$iLWUUHr'),
(3, 'asddsaa', 'guptashrinaaath9@gmail.com', '123456785', 'asdsa', 'ih&Jtsoh^'),
(4, 'asdsad', 'suassadwdhant@gmail.com', '12345676', 'asdasd', 'fsk6vtKP3'),
(5, 'Susasda', 'asda@fsd.ccom', '1234585965', 'K', '$2y$10$FhZDtMyhXql/QVVEwoScpOxL6dscgbpXMJqjTYFOZn2iEZFNzAgpi'),
(6, 'Sushantasaas', 'asdaa@fsd.ccom', '7894561338', 'sasa', '$2y$10$SJ8BRsrn20P58r6Pwf0KPuhMt5HUt470FDy8IcNFRSDpwkJIZP736');

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `track_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `driver_name` text NOT NULL,
  `vehicle` text NOT NULL,
  `hos_id` int(11) NOT NULL,
  `hos_name` text NOT NULL,
  `lat` text NOT NULL,
  `lang` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alert` tinyint(1) NOT NULL,
  `des_lat` text NOT NULL,
  `des_lang` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hospital_details`
--

CREATE TABLE `hospital_details` (
  `hos_id` int(11) NOT NULL,
  `hos_name` text NOT NULL,
  `hos_mail_id` text NOT NULL,
  `hos_pass` varchar(225) NOT NULL,
  `hos_add` longtext NOT NULL,
  `hos_pin` int(11) NOT NULL,
  `hos_contact` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital_details`
--

INSERT INTO `hospital_details` (`hos_id`, `hos_name`, `hos_mail_id`, `hos_pass`, `hos_add`, `hos_pin`, `hos_contact`) VALUES
(1, 'Rajawadi Hospital', 'rajawadihospital@gmail.com', 'rajawadi', '7, M G Road, Near Somaiya College, Ghatkopar East, Mumbai, Maharashtra ', 400077, '02221025610'),
(2, 'K.J. Somaiya Hospital', 'kj@gmail.com', 'kj', 'Somaiya Ayurvihar Complex, Eastern Express Highway, Sion East, Mumbai, Maharashtra ', 400022, ' 02224090253'),
(3, 'JJ hospital', 'jj@gmail.com', 'jj', 'JJ Hospital Road, Off Jijabhoy Road, Mazgaon, Mumbai, Maharashtra ', 400008, '02223735555'),
(4, 'Hiranadani', 'hira@gmail.com', '$2y$10$k.IHI.8itiB91C/1smA4Z.ATBu4Rlw9O8KCcSK/8q1YdDtjmUiOD2', 'hira', 400024, '2225658945'),
(5, 'aisa', 'aisa@gmail.com', '$2y$10$i62r/AY5ng2Nbcj0L73Wf.TWVyys/UHcnfu6uj8GB6Xfglfk8qKrO', 'aisa', 400024, '2225658945'),
(6, 'mk', 'mk@gmail.com', '$2y$10$LawH65HWVmlGC0VhfYfpKumFSZt40MNqHrowqlErW.uMvmSUF6eCy', 'hwhdiwidwed', 400031, '9485632148');

-- --------------------------------------------------------

--
-- Table structure for table `otp_table`
--

CREATE TABLE `otp_table` (
  `otp_id` int(11) NOT NULL,
  `otp` text NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `otp_table`
--

INSERT INTO `otp_table` (`otp_id`, `otp`, `phone`) VALUES
(1, '1957', '8433530825'),
(2, '1431', 'android.support.v7.widget.AppCompatEditText{d16f0d7 VFED..CL. .F...... 174,733-906,851 #7f09004b app:id/edittext}'),
(3, '7217', '8097387422'),
(4, '8822', '8433530805'),
(5, '3473', '9619373036'),
(6, '9354', '999999999');

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `p_id` int(11) NOT NULL,
  `p_name` text NOT NULL,
  `p_age` text NOT NULL,
  `p_con` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`p_id`, `p_name`, `p_age`, `p_con`) VALUES
(1, 'Shrinath Gupta', '18', 0),
(2, 'Test', '18', 0),
(3, 'dsasa', '50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `traffic_details`
--

CREATE TABLE `traffic_details` (
  `tra_id` int(11) NOT NULL,
  `tra_name` text NOT NULL,
  `tra_mob` text NOT NULL,
  `tra_mail_id` text NOT NULL,
  `tra_pass` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `traffic_details`
--

INSERT INTO `traffic_details` (`tra_id`, `tra_name`, `tra_mob`, `tra_mail_id`, `tra_pass`) VALUES
(1, 'Shrinath Gupta', '9892402758', 'guptashrinath9@gmail.com', 'password'),
(2, 'Prasad Koyande', '9987263652', 'prasadkoyande19@gmail.com', '-!!!23'),
(3, 'Marzook Khatri', '9619373036', 'marzookkhatri@gmail.com', 'marzookk'),
(5, 'aisa', '5689231245', 'aisa@gmail.com', '$2y$10$FnK51VPTmEMZg1Nrj7cZ9.RxvgzBZuB3uHwfDM8vKHAdgJrF0cpNq'),
(6, 'kaisa', '5689231248', 'kaisa@gmail.com', '$2y$10$lqayjZFGjl/MgXLZC3CoGevexkwrbkj7OyK7Z7kB1zziZitqvu6H6'),
(7, 'mr', '4656567891', 'mr@gmail.com', '$2y$10$2HkcxRA21E2mha1QTWuDw.b5Oa3uxTwa.g0nM.VqV/3wEmMY5BEeC');

-- --------------------------------------------------------

--
-- Table structure for table `userdetailshosp`
--

CREATE TABLE `userdetailshosp` (
  `a_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `hospital` varchar(5000) NOT NULL,
  `vehicle` varchar(20) NOT NULL,
  `mobile` text NOT NULL,
  `car` varchar(50) NOT NULL,
  `aadhar` text NOT NULL,
  `pass` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetailshosp`
--

INSERT INTO `userdetailshosp` (`a_id`, `name`, `hospital`, `vehicle`, `mobile`, `car`, `aadhar`, `pass`) VALUES
(10, 'Marzook Khatri', 'Vidyalankar polytechnic', 'MH-01-CJ-0048', '7977026089', 'Alto', '658611102314', '$2y$10$PYa.TFoUBB2bET3F4xMqPOgGRomNLiUn1mY2PsXZqPiVcR4RgFqIe'),
(8, 'Shrinath Gupta', 'Rajawadi Hospital', 'MH-03-AX-5444', '8433530825', 'EICHER', '872548952245', '$2y$10$/yq5tHojLKI2wTOeJl9Wee3anuAxWmZ0XTgl14XAlJFTQJ2tDJ5R6'),
(9, 'aisaasbs', 'asjnaskjdn', 'askljnafj', '8956237845', 'basisabdsal', '741852963321', 'password123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `doc_details`
--
ALTER TABLE `doc_details`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`track_id`);

--
-- Indexes for table `hospital_details`
--
ALTER TABLE `hospital_details`
  ADD PRIMARY KEY (`hos_id`);

--
-- Indexes for table `otp_table`
--
ALTER TABLE `otp_table`
  ADD PRIMARY KEY (`otp_id`);

--
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `traffic_details`
--
ALTER TABLE `traffic_details`
  ADD PRIMARY KEY (`tra_id`);

--
-- Indexes for table `userdetailshosp`
--
ALTER TABLE `userdetailshosp`
  ADD PRIMARY KEY (`a_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doc_details`
--
ALTER TABLE `doc_details`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
  MODIFY `track_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospital_details`
--
ALTER TABLE `hospital_details`
  MODIFY `hos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `otp_table`
--
ALTER TABLE `otp_table`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient_details`
--
ALTER TABLE `patient_details`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `traffic_details`
--
ALTER TABLE `traffic_details`
  MODIFY `tra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userdetailshosp`
--
ALTER TABLE `userdetailshosp`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
