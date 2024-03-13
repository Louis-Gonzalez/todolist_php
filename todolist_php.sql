-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 13 mars 2024 à 14:37
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `todolist_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `title`, `description`, `email`, `create_at`, `update_at`) VALUES
(1, 'Envoyer du soutien', 'frfrfr', 'gonzalezlouis1981@gmail.com', '2024-03-11 14:53:43', '2024-03-11 15:02:07'),
(2, 'Rencontrer un problème', 'je rencontre une problème pour envoyer un message', 'gonzalezlouis1981@gmail.com', '2024-03-11 15:35:26', '2024-03-11 15:35:26'),
(5, 'Rencontrer un problème', 'Je rencontre un problème pour factoriser le new message', 'gonzalezlouis1981@gmail.com', '2024-03-12 12:35:41', '2024-03-12 12:35:41'),
(6, 'Poser une question', 'J\'aimerais réussi cette factorisation, mais comment faire ?', 'gonzalezlouis1981@gmail.com', '2024-03-12 13:50:55', '2024-03-12 13:50:55');

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `who` varchar(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id`, `title`, `description`, `duration`, `who`, `status`, `create_at`, `update_at`) VALUES
(2, 'Faites bien attention au typage', 'Cela permet d\'éviter les erreurs dans les comparaisons', 'Moyen terme', 'Louis', 'Termine', '2024-03-08 14:13:33', '2024-03-12 16:06:33'),
(3, 'Faire bien attention à la synthaxe', 'Cela permet d\'éviter de perdre du temps', 'Long terme', 'Adam', 'Termine', '2024-03-08 14:14:02', '2024-03-12 16:06:24'),
(4, 'faire de la veille informatique', 'Rester en alerte des dernières nouveautés sur le domaine PHP', 'Long terme', 'Thomas', 'En cours', '2024-03-08 15:04:50', '2024-03-13 14:19:31'),
(11, 'Retravailler son javascript', 'Il faut faire de temps  à autre un peu de javasrcipt pour ne pas le perdre.', 'Long terme', 'Marc', 'En cours', '2024-03-08 16:21:14', '2024-03-13 14:33:34'),
(12, 'Préparation des dossiers pour l\'examen', 'Présentation personnelle, présentation de l\'entreprise et présentation du projet', 'Court terme', 'Louis', 'En attente', '2024-03-08 16:27:06', '2024-03-13 14:35:02'),
(14, 'test à update', 'pépépépépép', 'Court terme', 'Julien', 'Termine', '2024-03-11 09:13:41', '2024-03-12 10:32:22'),
(16, 'test ajout refactorisé', 'héhéhé', 'Court terme', 'Adam', 'En cours', '2024-03-11 16:52:32', '2024-03-12 10:32:16'),
(18, 'test ajout assignation d\'une tache à une personne', 'je donne la tâche à Cédric', 'Court terme', 'Cédric', 'En cours', '2024-03-12 10:20:11', '2024-03-12 10:39:59'),
(19, 'test de status par defaut', 'fkjfkldjflkmdjfklsdjflkjù', 'Court terme', 'Louis', 'En attente', '2024-03-12 10:42:00', '2024-03-12 10:43:08'),
(20, 'test modification de status automatique à en attente', 'test modification de status automatique à en attente', 'Court terme', 'Thomas', 'En attente', '2024-03-12 10:45:46', '2024-03-12 17:00:13'),
(21, 'test de status par defaut', 'test de status par defaut', 'Court terme', 'Julien', 'Termine', '2024-03-12 10:48:33', '2024-03-12 16:39:59'),
(22, 'test2 menu déroulant', 'test2 menu déroulant', 'Moyen terme', 'Marc', 'Termine', '2024-03-12 10:51:34', '2024-03-12 16:18:31'),
(23, 'nouvelle tache', 'description de la nouvelle tache', 'Long terme', 'Cédric', 'Termine', '2024-03-12 14:05:33', '2024-03-12 16:41:43');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
