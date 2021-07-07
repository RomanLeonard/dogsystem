-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql108.byetcluster.com
-- Generation Time: Jul 07, 2021 at 04:03 AM
-- Server version: 5.7.34-37
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b14_29068390_db_dogs`
--

-- --------------------------------------------------------

--
-- Table structure for table `catei_tabel`
--

CREATE TABLE `catei_tabel` (
  `c_id` int(11) NOT NULL,
  `c_microcip` text NOT NULL,
  `c_identificare` text,
  `c_datacapt` date NOT NULL,
  `c_loccapt` varchar(512) NOT NULL,
  `c_datcazare` datetime NOT NULL,
  `c_caracteristici` text NOT NULL,
  `c_fsprinsi` varchar(128) NOT NULL,
  `c_fsrevendicati` varchar(128) NOT NULL,
  `c_fsadoptati` varchar(128) NOT NULL,
  `c_cmentinuti` varchar(128) NOT NULL,
  `c_cadoptati` varchar(128) NOT NULL,
  `c_eutanasiati` varchar(128) NOT NULL,
  `c_motiveutan` text NOT NULL,
  `c_substeutan` text NOT NULL,
  `c_numperseutan` text NOT NULL,
  `c_nrfisaadoptie` int(128) NOT NULL,
  `c_datdeparazit` date NOT NULL,
  `c_datvacc` date NOT NULL,
  `c_steril` date NOT NULL,
  `c_persmanopera` text NOT NULL,
  `c_decedati` date NOT NULL,
  `c_proprietar` varchar(255) NOT NULL,
  `c_dataaddsite` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catei_tabel`
--

INSERT INTO `catei_tabel` (`c_id`, `c_microcip`, `c_identificare`, `c_datacapt`, `c_loccapt`, `c_datcazare`, `c_caracteristici`, `c_fsprinsi`, `c_fsrevendicati`, `c_fsadoptati`, `c_cmentinuti`, `c_cadoptati`, `c_eutanasiati`, `c_motiveutan`, `c_substeutan`, `c_numperseutan`, `c_nrfisaadoptie`, `c_datdeparazit`, `c_datvacc`, `c_steril`, `c_persmanopera`, `c_decedati`, `c_proprietar`, `c_dataaddsite`) VALUES
(1, '945000001369532', '1/854/2019', '2016-05-12', 'Balotesti', '2016-05-12 00:00:00', 'coada intoarsa', '1', '', '', '', '', '', '', '', '', 1, '2016-05-12', '2016-07-08', '2016-10-11', '', '0000-00-00', 'Fundatia Adapostul Speranta', '2019-01-24 08:04:49'),
(2, '642090001015495', '2/752/2019', '2014-08-21', 'Snagov', '2014-08-21 00:00:00', 'Cu tremur', '1', '', '', '', '', '', '', '', '', 2, '2014-08-21', '2014-09-04', '2015-08-17', '', '0000-00-00', 'Fundatia Adapostul Speranta', '2019-01-24 08:29:08'),
(3, '945000001369531', '111/111/2021', '2021-07-06', 'Sos. Stefan cel Mare', '2021-07-06 14:39:00', 'Dungi albe', '', '', '', '', '', '', '', '', '', 3, '2021-07-06', '2021-07-06', '2021-07-06', '', '0000-00-00', '', '2021-07-06 14:41:24'),
(4, '945000001369533', '112/112/2021', '2021-07-01', 'Theodor Pallady 11', '2021-07-01 12:00:00', 'Zgarda roz', '', '', '', '', '', '', '', '', '', 4, '2021-07-01', '2021-07-05', '0000-00-00', '', '0000-00-00', '', '2021-07-06 14:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `catei_tabel_arhiva`
--

CREATE TABLE `catei_tabel_arhiva` (
  `c_id` int(11) NOT NULL,
  `c_microcip` text NOT NULL,
  `c_identificare` text NOT NULL,
  `c_datacapt` date NOT NULL,
  `c_loccapt` varchar(255) NOT NULL,
  `c_datcazare` datetime NOT NULL,
  `c_caracteristici` text NOT NULL,
  `c_fsprinsi` varchar(128) NOT NULL,
  `c_fsrevendicati` varchar(128) NOT NULL,
  `c_fsadoptati` varchar(128) NOT NULL,
  `c_cmentinuti` varchar(128) NOT NULL,
  `c_cadoptati` varchar(128) NOT NULL,
  `c_eutanasiati` varchar(128) NOT NULL,
  `c_motiveutan` text NOT NULL,
  `c_substeutan` text NOT NULL,
  `c_numperseutan` text NOT NULL,
  `c_nrfisaadoptie` int(128) NOT NULL,
  `c_datdeparazit` date NOT NULL,
  `c_datvacc` date NOT NULL,
  `c_steril` date NOT NULL,
  `c_persmanopera` text NOT NULL,
  `c_decedati` date NOT NULL,
  `c_adopted` int(11) NOT NULL,
  `c_dead` int(11) NOT NULL,
  `c_proprietar` varchar(255) NOT NULL,
  `c_dataaddsite` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `det_serie` text NOT NULL,
  `det_nume` varchar(255) NOT NULL,
  `det_img` int(11) NOT NULL,
  `det_nrmatricol` varchar(255) NOT NULL,
  `det_tronson` varchar(255) NOT NULL,
  `det_cusca` varchar(255) NOT NULL,
  `det_varsta` varchar(255) NOT NULL,
  `det_sex` varchar(255) NOT NULL,
  `det_culoare` varchar(255) NOT NULL,
  `det_semnpartic` text NOT NULL,
  `det_sterilizat` int(11) NOT NULL,
  `det_dataadopt` date NOT NULL,
  `det_numpersadopt` varchar(255) NOT NULL,
  `det_datadecedat` date NOT NULL,
  `det_observatii` text NOT NULL,
  `det_datultdep` date NOT NULL,
  `det_datultvacc` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `det_serie`, `det_nume`, `det_img`, `det_nrmatricol`, `det_tronson`, `det_cusca`, `det_varsta`, `det_sex`, `det_culoare`, `det_semnpartic`, `det_sterilizat`, `det_dataadopt`, `det_numpersadopt`, `det_datadecedat`, `det_observatii`, `det_datultdep`, `det_datultvacc`) VALUES
(1, '945000001369532', 'LILI', 0, 'B 3065743', '1', '1', '15-03-2016', 'Femela', 'Maro inspicat-roscata', '', 0, '0000-00-00', '', '0000-00-00', 'Adus de Cutare Cutarescu', '0000-00-00', '0000-00-00'),
(2, '642090001015495', 'Maru', 0, 'B 3065732', '1', '1', '2014-06-20', 'Mascul', 'Maro inspicat-roscata', '', 0, '0000-00-00', '', '0000-00-00', 'Adus din Snagov', '0000-00-00', '0000-00-00'),
(3, '945000001369531', 'Max', 0, '10', '3', 'A', '', 'Mascul', 'Maro', 'Dungi albe', 0, '0000-00-00', '', '0000-00-00', '', '0000-00-00', '0000-00-00'),
(4, '945000001369533', 'Dungata', 0, '11', '3', 'B', '2020', 'Femela', 'Alb', 'Zgarda roz', 0, '0000-00-00', '', '0000-00-00', '', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `specific_details`
--

CREATE TABLE `specific_details` (
  `id` int(11) NOT NULL,
  `spec_serie` text NOT NULL,
  `spec_data` varchar(255) NOT NULL,
  `spec_semneclinice` text NOT NULL,
  `spec_diagnostic` text NOT NULL,
  `spec_tratament` text NOT NULL,
  `spec_vaccin` text NOT NULL,
  `spec_observatii` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specific_details`
--

INSERT INTO `specific_details` (`id`, `spec_serie`, `spec_data`, `spec_semneclinice`, `spec_diagnostic`, `spec_tratament`, `spec_vaccin`, `spec_observatii`) VALUES
(1, '642090001015495', '', 'SEMN.CLINIC.EX', '', '', '', ''),
(2, '945000001369532', '', 'AD2', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_adapost`
--

CREATE TABLE `tabel_adapost` (
  `id` int(11) NOT NULL,
  `tab_serie` text NOT NULL,
  `tab_data` date NOT NULL,
  `tab_datacazarii` date NOT NULL,
  `tab_caracteristici` text NOT NULL,
  `tab_nrcprinsi` int(11) NOT NULL,
  `tab_nrcrevendic` int(11) NOT NULL,
  `tab_nrcadopt` int(11) NOT NULL,
  `tab_nrcmentin` int(11) NOT NULL,
  `tab_nrcdecedati` int(11) NOT NULL,
  `tab_motiv` varchar(255) NOT NULL,
  `tab_nrident` text NOT NULL,
  `tab_nrfisa` int(11) NOT NULL,
  `tab_datavacc` date NOT NULL,
  `tab_datadeparat` date NOT NULL,
  `tab_datasteriliz` date NOT NULL,
  `tab_medic` varchar(255) NOT NULL,
  `tab_datapredarii` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_adapost`
--

INSERT INTO `tabel_adapost` (`id`, `tab_serie`, `tab_data`, `tab_datacazarii`, `tab_caracteristici`, `tab_nrcprinsi`, `tab_nrcrevendic`, `tab_nrcadopt`, `tab_nrcmentin`, `tab_nrcdecedati`, `tab_motiv`, `tab_nrident`, `tab_nrfisa`, `tab_datavacc`, `tab_datadeparat`, `tab_datasteriliz`, `tab_medic`, `tab_datapredarii`) VALUES
(1, '945000001369532', '0000-00-00', '2016-05-12', 'coada intoarsa', 1, 0, 0, 0, 0, '', '945000001369532', 1, '2016-07-08', '2016-05-12', '2016-10-11', '', '0000-00-00'),
(2, '642090001015495', '2014-08-21', '2014-08-21', 'Par rar', 1, 0, 0, 0, 0, '', '642090001015495', 2, '2014-09-04', '2014-08-21', '2015-08-17', '', '0000-00-00'),
(3, '945000001369531', '2021-07-06', '2021-07-06', 'Dungi albe', 0, 0, 0, 0, 0, '', '945000001369531', 0, '2021-07-06', '2021-07-06', '2021-07-06', 'Dr. Cutare Cutare', '0000-00-00'),
(4, '945000001369533', '2021-07-01', '2021-07-01', 'Zgarda roz', 0, 0, 0, 0, 0, '', '945000001369533', 0, '2021-07-05', '2021-07-01', '0000-00-00', 'Dr. Cutare Cutare', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`) VALUES
(1, 'admin', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori_istoric`
--

CREATE TABLE `utilizatori_istoric` (
  `user_id` int(11) NOT NULL,
  `user_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_name` varchar(255) NOT NULL,
  `user_actions` text NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_modify` int(11) NOT NULL,
  `user_trat` int(11) NOT NULL,
  `user_arhive` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilizatori_istoric`
--

INSERT INTO `utilizatori_istoric` (`user_id`, `user_date`, `user_name`, `user_actions`, `user_add`, `user_modify`, `user_trat`, `user_arhive`) VALUES
(1, '2020-05-14 12:38:45', 'admin', '', 0, 0, 0, 0),
(2, '2020-05-14 12:39:42', 'admin', '', 0, 0, 0, 0),
(3, '2020-05-14 12:48:02', 'leonard roman', '', 0, 0, 0, 0),
(4, '2020-05-14 12:48:31', 'leonard roman', 'A adaugat in fisa cainelui 945000001369532: semne clinice: ad2.', 0, 0, 1, 0),
(5, '2021-07-06 13:56:17', 'admin', '', 0, 0, 0, 0),
(6, '2021-07-06 14:37:02', 'admin', '', 0, 0, 0, 0),
(7, '2021-07-06 14:37:22', 'admin', '', 0, 0, 0, 0),
(8, '2021-07-06 14:41:24', 'admin', 'A adaugat cainele 945000001369531.', 1, 0, 0, 0),
(9, '2021-07-06 14:43:24', 'admin', 'A adaugat cainele 945000001369533.', 1, 0, 0, 0),
(10, '2021-07-06 08:38:25', 'admin', '', 0, 0, 0, 0),
(11, '2021-07-06 08:43:00', 'admin', '', 0, 0, 0, 0),
(12, '2021-07-06 08:45:18', 'admin', '', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catei_tabel`
--
ALTER TABLE `catei_tabel`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `catei_tabel_arhiva`
--
ALTER TABLE `catei_tabel_arhiva`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specific_details`
--
ALTER TABLE `specific_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_adapost`
--
ALTER TABLE `tabel_adapost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `utilizatori_istoric`
--
ALTER TABLE `utilizatori_istoric`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catei_tabel`
--
ALTER TABLE `catei_tabel`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `catei_tabel_arhiva`
--
ALTER TABLE `catei_tabel_arhiva`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `specific_details`
--
ALTER TABLE `specific_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tabel_adapost`
--
ALTER TABLE `tabel_adapost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `utilizatori_istoric`
--
ALTER TABLE `utilizatori_istoric`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
