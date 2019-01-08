-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 08 jan. 2019 à 18:03
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `fplq`
--

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int(11) NOT NULL,
  `horaires` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commande_min` int(11) NOT NULL,
  `prix_livraison` int(11) NOT NULL,
  `photo` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `restaurant`
--

INSERT INTO `restaurant` (`id`, `nom`, `adresse`, `code_postal`, `ville`, `telephone`, `horaires`, `commande_min`, `prix_livraison`, `photo`, `note`, `description`, `type_id`) VALUES
(1, 'Taj Mahal', '7 Rue de Brie                                                                   ', 78310, 'MAUREPAS', 143434343, '11:30 - 23:00', 20, 5, 'indien.jpg', 1, 'Fines spécialités indiennes, dont grillades au four tandooti, dans un cadre feutré avec boiseries et statues.', 1),
(2, 'Chicken Minute', '56 Rue Jean Jaurès                                                              ', 78190, 'TRAPPES', 143434343, '12:00 - 00:00', 10, 0, 'chicken.jpg', 1, 'Chicken Minute est un fast food au concept innovant spécialisé dans le Fried Chicken. Etant notre...', 2),
(3, 'O\'Tacos', '7 Rue de Brie                                                                   ', 78310, 'MAUREPAS', 143434343, '11:30 - 23:00', 10, 0, 'tacos.jpg', 1, 'Some quick example text to build on the card title and make up the bulk of the card\'s content.', 3),
(4, 'Asian Food', '7 Rue de Brie                                                                   ', 78310, 'MAUREPAS', 143434343, '12:00 - 00:00', 20, 7, 'jap.jpg', 1, 'Some quick example text to build on the card title and make up the bulk of the card\'s content.', 4),
(5, 'Trappito', '7 Rue de Brie ', 78310, 'MAUREPAS', 143434343, '11:30 - 23:00', 15, 5, 'pizza.jpg', 1, 'Some quick example text to build on the card title and make up the bulk of the card\'s content.', 5),
(6, 'Eat\'s Time', '7 Rue de Brie ', 78310, 'MAUREPAS', 143434343, '12:00 - 00:00', 10, 0, 'burger.jpg', 1, 'Some quick example text to build on the card title and make up the bulk of the card\'s content.', 6);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EB95123FC54C8C93` (`type_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `FK_EB95123FC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);