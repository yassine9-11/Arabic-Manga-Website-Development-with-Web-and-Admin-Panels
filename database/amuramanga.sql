-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20230109.7cde53ed0d
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 avr. 2024 à 19:22
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `amuramanga`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `RegistrationDate` datetime NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Email`, `PasswordHash`, `RegistrationDate`, `image`) VALUES
(15, 'adam ouabbi', 'adamouabbi22@gmail.com', 'adam1', '2023-05-06 23:52:10', 'user_15.jpg'),
(16, 'mohamed ouabbbi', 'simo@gmail.com', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', '2023-05-06 23:54:31', 'user_16.jpg'),
(17, 'ysf ouabbi ', 'sosoouab@gmail.com', 'simo', '2023-05-06 23:55:05', 'user_17.jpg'),
(18, 'mohamed simo', 'user', 'b6589fc6ab0dc82cf12099d1c2d40ab994e8410c', '2023-05-07 14:08:36', 'user_default.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
