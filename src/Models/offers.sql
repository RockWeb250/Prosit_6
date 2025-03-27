-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 26 mars 2025 à 19:11
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `prosit7`
--

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

DROP TABLE IF EXISTS `offres`;
CREATE TABLE IF NOT EXISTS `offres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `offer` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Rejected','Accepted') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `offres`
--

INSERT INTO `offres` (`id`, `offer`, `status`) VALUES
(1, 'Stage - Administrateur Système et Réseau H/F', 'Rejected'),
(2, 'Stage - Analyste Cybersécurité', 'Pending'),
(3, 'Stage - Ingénieur en Intelligence Artificielle', 'Rejected'),
(4, 'Stage - Chef de Projet Digital', 'Rejected'),
(5, 'Stage - Développeur Mobile iOS/Android', 'Pending'),
(6, 'Stage - Consultant en Stratégie', 'Accepted'),
(7, 'Stage - Graphiste UI/UX Designer', 'Rejected'),
(8, 'Stage - Ingénieur DevOps', 'Accepted'),
(9, 'Stage - Data Analyst', 'Accepted'),
(10, 'Stage - Simulation en Laboratoire', 'Rejected'),
(11, 'Stage - Analyste Financier', 'Rejected'),
(12, 'Stage - Ingénieur en Systèmes Embarqués', 'Accepted'),
(13, 'Stage - Data Scientist', 'Rejected'),
(14, 'Stage - Développeur Web Full-Stack', 'Rejected'),
(15, 'Stage - Consultant Marketing Digital', 'Pending'),
(16, 'Stage - Développeur Blockchain', 'Pending'),
(17, 'Stage - Chargé de Communication', 'Pending'),
(18, 'Stage - Ingénieur Cloud & DevOps', 'Rejected'),
(19, 'Stage - Responsable Énergies Renouvelables', 'Accepted'),
(20, 'Stage - Consultant Supply Chain', 'Accepted');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `nom`) VALUES
(1, 'admin'),
(2, 'pilote'),
(3, 'étudiant');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `civilite` varchar(10) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `role_id` int NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_role` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=902 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `email`, `motDePasse`, `civilite`, `nom`, `prenom`, `role_id`) VALUES
(100, 'alice@example.com', '$2y$10$PT4zxyxPOYHZaGkOIqn0ruzBBlQInv9sjsf9SB3VherPsLol5S8uO', 'Mme', 'Durand', 'Alice', 1),
(200, 'bob@example.com', '$2y$10$cZV5R8jVMH.WYdjtAWygDuev3EThO02MGiIfB0A35pOK2zH15yH1y', 'M.', 'Martin', 'Bob', 3),
(300, 'carla@example.com', '$2y$10$OmdFe6Xtq1S6h0ekl1EDn.8PgAvx7iaeFsMVH4G50Z5YZRnuctLF2', 'Mme', 'Lemoine', 'Carla', 2),
(400, 'david@example.com', '$2y$10$k1pRjS0Yjd/tD65K9zhfm.0169m4jxuK7VtfwNaDqB.69tSCZPm5m', 'M.', 'Petit', 'David', 3),
(500, 'emma@example.com', '$2y$10$IRYs1DJ8IZ.q8V1umORnZ.3b0mVUEqFinmAUc2A8y46mJ9I7MMXN.', 'Mme', 'Moreau', 'Emma', 1),
(600, 'felix@example.com', '$2y$10$E3PHK4Rqsgi7YS0LuTlon.22ZNkJerqRsVvSTlzH9Pnn15bmh5n5S', 'M.', 'Garcia', 'Felix', 3),
(700, 'gina@example.com', '$2y$10$N5up/rQzYNh8zljET8uHhuVfv6hMdLrceyNpFnvxkadefpniTEJS2', 'Mme', 'Roux', 'Gina', 2),
(800, 'hugo@example.com', '$2y$10$YLlTNPiPvKNBeqEMeZeE5ewowpT6pkj0DuiZFqMauJI0i81O9mbKq', 'M.', 'Lopez', 'Hugo', 2),
(900, 'iris@example.com', '$2y$10$IoZ4zEEeXFg4S5T.T6/6UOEuIc9Ozi.bNl8wFnNCKQktNFAi91NFG', 'Mme', 'Leroy', 'Iris', 3),
(111, 'julien@example.com', '$2y$10$LypcHQajx.ttdl9TUSemjeDNNIzawIYYdr1H42ejx8RhIsM4cilS6', 'M.', 'Bernard', 'Julien', 1),
(901, 'virgil@example.com', '$2y$10$FOr4qyXHZ4.EuTCY3NPHnuDvAATQDgf9B3eaoE6I9YeoLHzBAM12G', 'monsieur', 'Gregoire', 'Virgil', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
