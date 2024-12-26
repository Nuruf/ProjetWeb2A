-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 05:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skillswap`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `idCat` int(11) NOT NULL,
  `nomCat` varchar(20) DEFAULT NULL,
  `descriptionCat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`idCat`, `nomCat`, `descriptionCat`) VALUES
(15, 'programming', 'Apprenez divers langages de programmation comme JavaScript, Python, Java, C++, etc.\r\n'),
(16, 'Design Graphique', 'Échangez vos compétences sur des outils comme Photoshop, Illustrator, Canva, et Figma.'),
(19, 'Cuisine & Gastronomi', 'Échangez vos recettes préférées ou apprenez les techniques de cuisine avec d\'autres passionnés.');

-- --------------------------------------------------------

--
-- Table structure for table `contenu`
--

CREATE TABLE `contenu` (
  `idContenu` int(11) NOT NULL,
  `nomContenu` varchar(255) NOT NULL,
  `descriptionContenu` text NOT NULL,
  `idCat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contenu`
--

INSERT INTO `contenu` (`idContenu`, `nomContenu`, `descriptionContenu`, `idCat`) VALUES
(19, 'Creation affiche avec canva', 'Découvrez comment utiliser Canva pour créer des affiches professionnelles en quelques étapes simples.\r\n', 16),
(22, 'testttt id 19', 'test id 19 I LIKE', 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCat`);

--
-- Indexes for table `contenu`
--
ALTER TABLE `contenu`
  ADD PRIMARY KEY (`idContenu`),
  ADD KEY `idCat` (`idCat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `idCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contenu`
--
ALTER TABLE `contenu`
  MODIFY `idContenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contenu`
--
ALTER TABLE `contenu`
  ADD CONSTRAINT `contenu_ibfk_1` FOREIGN KEY (`idCat`) REFERENCES `categories` (`idCat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
