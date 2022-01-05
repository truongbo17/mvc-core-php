-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 02 jan. 2022 à 23:41
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `update_at`) VALUES
(1, 'Quan ao nam', '2021-12-26 08:52:04', '2021-12-26 08:52:04'),
(2, 'Quan ao nu', '2021-12-26 08:52:04', '2021-12-26 08:52:04'),
(5, 'ao den mau hong', '2021-12-26 09:25:41', '2021-12-26 09:25:41'),
(6, 'ao den mau hong', '2021-12-26 09:32:35', '2021-12-26 09:32:35'),
(7, 'ao den mau hong', '2021-12-26 09:32:35', '2021-12-26 09:32:35'),
(8, 'ao den mau hong', '2021-12-26 09:32:35', '2021-12-26 09:32:35'),
(9, 'ao den mau hong', '2021-12-26 09:32:35', '2021-12-26 09:32:35'),
(10, 'ao den mau hong', '2021-12-26 09:32:36', '2021-12-26 09:32:36'),
(11, 'ao den mau hong', '2021-12-26 09:32:46', '2021-12-26 09:32:46'),
(12, 'ao den mau hong', '2021-12-26 09:32:46', '2021-12-26 09:32:46'),
(13, 'ao den mau hong', '2021-12-26 09:32:46', '2021-12-26 09:32:46'),
(14, 'ao den mau hong', '2021-12-26 09:32:46', '2021-12-26 09:32:46'),
(15, 'ao den mau hong', '2021-12-26 10:25:40', '2021-12-26 10:25:40'),
(16, 'ao den mau hong', '2021-12-26 10:25:41', '2021-12-26 10:25:41');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `created_at`, `update_at`, `category_id`, `slug`) VALUES
(1, 'Quan bo nam mau xanh', 100000, 'quan bo nam chat lieu vai tron dep', '2021-12-26 08:52:58', '2021-12-26 08:52:58', 1, 'quan-no-nam-mau-xanh'),
(2, 'Vay nu cuc dep ', 250000, 'vay nua duoc lam tu to tam', '2021-12-26 08:52:58', '2021-12-26 08:52:58', 2, 'vay-nu-cuc-xinh'),
(3, 'Quan au nam', 100000, 'quan bo nam chat lieu vai tron dep', '2021-12-26 08:52:58', '2021-12-26 08:52:58', 1, 'quan-au'),
(4, 'Quan nu', 250000, 'vay nua duoc lam tu to tam', '2021-12-26 08:52:58', '2021-12-26 08:52:58', 2, 'quan-nu'),
(5, 'Quan vest', 100000, 'quan bo nam chat lieu vai tron dep', '2021-12-26 08:52:58', '2021-12-26 08:52:58', 1, 'quan-vest'),
(6, 'Dam nu', 250000, 'vay nua duoc lam tu to tam', '2021-12-26 08:52:58', '2021-12-26 08:52:58', 2, 'dam-nu');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Quang Trường', 'truongisgay5@gmail.com', 'truong', '2021-12-31 08:00:27', '2021-12-31 08:00:27'),
(2, 'Nguyễn Quang Trung', 'truongisgay4@gmail.com', 'truongbo', '2021-12-31 08:00:27', '2021-12-31 08:00:27');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
