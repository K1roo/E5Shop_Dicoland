-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 29 mars 2023 à 00:07
-- Version du serveur :  5.7.11
-- Version de PHP : 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dicoland_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(70, 3, 'livre 2', 60, 1, 'be_well_bee.jpg'),
(71, 3, 'livre 1 ', 30, 1, 'book-4.png'),
(72, 3, 'livre 3 ', 15, 1, 'the_girl_of_ink_and_stars.jpg'),
(74, 1, 'livre 1 ', 30, 1, 'book-4.png'),
(76, 1, 'livre 3 ', 15, 1, 'the_girl_of_ink_and_stars.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(10, 3, 'kirolos', 'kirolos@user.com', '012200924', 'Bonjour ceci est un test du formulaire'),
(11, 1, 'kirolos', 'kirolos@useer.com', '012388746', 'bonjour test test - 01 ');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(11, 1, 'kirolos_user', '0148595431', 'kirolos@user.com', 'cash on delivery', 'appartement 69 , Rue de Turbigo, Paris, France - 75003', ', livre 2 (1) , livre 1  (1) ', 90, '15-Mar-2023', 'completed'),
(12, 3, 'kirolos user 2', '014487665', 'kirolos@user2.com', 'EspÃ¨ces', 'appartement 63 , rue de paris, Paris, France - 75017', ', livre 2 (6) , livre 3  (4) ', 420, '16-Mar-2023', 'completed'),
(14, 3, 'kirolos_user2', '12354894', 'kirolos@user2.com', 'paypal', 'appartement 21 , rue de paris, Paris, France - 75011', ', livre 2 (1) ', 60, '16-Mar-2023', 'pending');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'livre 1 ', 30, 'book-4.png'),
(2, 'livre 2', 60, 'be_well_bee.jpg'),
(3, 'livre 3 ', 15, 'the_girl_of_ink_and_stars.jpg'),
(4, 'livre 4', 5, 'clever_lands.jpg'),
(5, 'livre 5', 18, 'book-2.png'),
(6, 'livre 6', 10, 'the_happy_lemon.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `reset_token` varchar(255) DEFAULT NULL,
  `password_changed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `reset_token`, `password_changed`) VALUES
(1, 'kirolos_userr', 'kirolos@user.com', '$2y$10$Aj3KsimkWM/oXwXg5M0tKehhAlBdUxXr8vCmSI.0cd2TYNsfcxnJa', 'user', NULL, 0),
(2, 'kirolos_admin', 'kirolos@admin.com', '$2y$10$IeL0/LMgYzzIrK2hPefXeOMyYzL.7c6UarqwiGCqr/tk04Zi6/kFi', 'admin', NULL, 0),
(3, 'kirolos_user2', 'kirolos@user2.com', 'cbca549dd6360505780f290ffbe4e4a9', 'user', NULL, 0),
(4, 'Kiro', 'kiromaher625@gmail.com', '$2y$10$HBOd.S96JQ4L6f./BuYB7O.sbqN8hcY.LUqFLkOBhQx1gPePsM2E6', 'user', NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
