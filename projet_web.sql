-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 09:19 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `date_avis` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`id`, `id_user`, `rate`, `date_avis`) VALUES
(4, 1, 5, '2021-12-14 19:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `ban`
--

CREATE TABLE `ban` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `motif` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_avis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` (`id`, `commentaire`, `date`, `id_avis`) VALUES
(4, 'test', '2021-12-14 19:16:56', 4);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `iduser` int(11) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `iduser`, `etat`) VALUES
(1, 'PR1OZAW0E4', 4, 0),
(2, 'PRQ5ZBH7QP', 1, 0),
(3, 'PRCBWA43BF', 4, 0),
(4, 'PR1F0LIZ61', 1, 0),
(5, 'PR43BE4I9Z', 1, 0),
(6, 'PRUGHMK5N8', 4, 0),
(7, 'PRG8TYY1A4', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `entretient`
--

CREATE TABLE `entretient` (
  `id` int(11) NOT NULL,
  `TimeDateEntretient` timestamp NULL DEFAULT current_timestamp(),
  `Remarque` varchar(255) NOT NULL,
  `prix` int(11) DEFAULT NULL,
  `idAgentEntretient` int(11) DEFAULT NULL,
  `idAppartement` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entretient`
--

INSERT INTO `entretient` (`id`, `TimeDateEntretient`, `Remarque`, `prix`, `idAgentEntretient`, `idAppartement`, `status`) VALUES
(5, '2021-12-29 20:23:00', 'yuihkjhgyuikh', 50, 1, 1, 2),
(6, NULL, 'Probleme tuyeaux', NULL, NULL, 1, 0),
(7, '2021-12-01 00:00:00', 'probleme electricite', 70, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `maxParticipant` int(11) NOT NULL,
  `participant` int(11) NOT NULL,
  `isComplete` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `datetime`, `maxParticipant`, `participant`, `isComplete`, `image`, `image2`, `image3`, `image4`, `description`) VALUES
(1, 'Journee de l\'ecologie', '2021-11-18 15:27:09', 50, 0, 0, '', '', '', '', 'testateasdads');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_avis` int(11) NOT NULL,
  `isLike` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `idLogement` int(11) NOT NULL,
  `idLocataire` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `remarques` varchar(255) NOT NULL,
  `DebutLocation` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `idLogement`, `idLocataire`, `prix`, `remarques`, `DebutLocation`, `etat`) VALUES
(1, 1, 1, 200, 'tesat', '2021-11-18 16:28:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `logement`
--

CREATE TABLE `logement` (
  `id` int(11) NOT NULL,
  `bloc` varchar(1) NOT NULL,
  `numero` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `nbChambre` int(11) NOT NULL,
  `prixLoyer` int(11) NOT NULL,
  `idLocataire` int(11) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logement`
--

INSERT INTO `logement` (`id`, `bloc`, `numero`, `type`, `nbChambre`, `prixLoyer`, `idLocataire`, `description`, `image`) VALUES
(1, 'A', 20, 'Appartement', 2, 500, 1, 'Description Random Du site', ''),
(2, 'B', 25, 'Maison', 5, 1000, NULL, 'Description maison', '');

-- --------------------------------------------------------

--
-- Table structure for table `offres`
--

CREATE TABLE `offres` (
  `id` int(11) NOT NULL,
  `idLogement` int(11) NOT NULL,
  `promotion` int(11) NOT NULL,
  `PrixInitiale` int(11) NOT NULL,
  `PrixFinale` int(11) NOT NULL,
  `DateFin` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `typeLogement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offres`
--

INSERT INTO `offres` (`id`, `idLogement`, `promotion`, `PrixInitiale`, `PrixFinale`, `DateFin`, `typeLogement`) VALUES
(4, 2, 234, 12, 11, '2021-12-01 23:00:00', 'maison'),
(5, 4, 500, 12, 1234, '2021-12-30 23:00:00', 'appartement'),
(6, 2, 50, 123, 11, '2021-12-12 23:00:00', 'maison');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `eventId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `dateInscription` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT 0,
  `typeCompte` int(11) NOT NULL DEFAULT 0,
  `datecreation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `photo`, `email`, `password`, `isAdmin`, `typeCompte`, `datecreation`) VALUES
(1, 'Bitri', 'Othman', '', 'othman.bitri@gmail.com', '0209cd4b0daf7404c29f46532c79e3611a57937b', 1, 0, '2021-11-17 18:27:31'),
(4, 'Zrig', 'Mouhamed', '', 'mohamedamine.chtioui@esprit.tn', '251f18d4e6b31f7e8ee5bbc62db713101e85a8c9', 0, 0, '2021-11-24 10:18:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entretient`
--
ALTER TABLE `entretient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logement`
--
ALTER TABLE `logement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ban`
--
ALTER TABLE `ban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `entretient`
--
ALTER TABLE `entretient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logement`
--
ALTER TABLE `logement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offres`
--
ALTER TABLE `offres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
