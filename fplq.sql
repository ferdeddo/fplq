-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 17 jan. 2019 à 16:42
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `fplq`
--

-- --------------------------------------------------------

--
-- Structure de la table `boisson`
--

CREATE TABLE `boisson` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `prix` double NOT NULL,
  `photo` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `boisson`
--

INSERT INTO `boisson` (`id`, `restaurant_id`, `nom`, `description`, `prix`, `photo`) VALUES
(1, 1, 'Lassi-sucré-à-la-rose', 'Boisson à base de yaourt au sirop de rose', 4, NULL),
(2, 2, 'Coca-Cola-33 cl', 'Goût original', 2, 'coca-cola-33-cl.png'),
(3, 3, 'Oasis-Tropical-33cl', NULL, 2, 'oasis-tropical-33cl.png'),
(4, 4, 'San-Pellegrino-50 cl', NULL, 2, NULL),
(5, 4, 'Asahi-33 cl', 'Bière japonaise', 4, NULL),
(6, 1, 'Lassi-Mangue-50 cl', NULL, 4, NULL),
(7, 1, 'Lassi-Banane-50 cl', NULL, 4, NULL),
(8, 2, 'Coca-Cola-light-33 cl', 'Sans sucres. Goût léger', 2, 'coca-cola-light-33-cl.png'),
(9, 2, 'Fanta-Orange-33-cl', 'Boisson rafraîchissante au jus d\'orange. Goût fruité et savoureux', 2, 'fanta-orange-33-cl.png'),
(11, 3, 'Coca-Cola-cherry-33 cl', 'Boisson rafraîchissante aux extraits végétaux et arôme cerise', 2, 'coca-cola-cherry-33-cl.png'),
(12, 3, 'Fanta-Orange-33 cl', 'Boisson rafraîchissante au jus d\'orange. Goût fruité et savoureux', 2, 'fanta-orange-33-cl.png'),
(13, 4, 'Jus-de-Pomme', NULL, 2, NULL),
(14, 5, 'Bouteille-d\'eau-minérale', NULL, 5, NULL),
(15, 5, 'Bouteille-de-vin', NULL, 14, NULL),
(16, 5, 'Café', NULL, 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  `etat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `membre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dessert`
--

CREATE TABLE `dessert` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `prix` double NOT NULL,
  `photo` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `dessert`
--

INSERT INTO `dessert` (`id`, `restaurant_id`, `nom`, `description`, `prix`, `photo`) VALUES
(1, 1, 'Kulfi-pistache', 'Glace populaire indienne à base de pistache et noix de cajou', 5, NULL),
(2, 2, 'Tiramisu', '', 5, NULL),
(3, 3, 'Tiramisu-Caramel-Spéculoos', '', 4, NULL),
(4, 4, 'Perle-de-Coco-x2', NULL, 3, NULL),
(5, 4, 'Pêche-au-Sirop', NULL, 3, NULL),
(6, 1, 'Gujrela', 'Gâteau maison aux carottes, pistaches, noix de coco et amandes', 3, NULL),
(7, 1, 'Gulab-Jamun', 'Farine, lait, amandes, coco et sirop de safran', 4, NULL),
(8, 2, 'Brownie', NULL, 4, NULL),
(9, 2, 'Tarte-au-Daim', NULL, 4, NULL),
(10, 3, 'Tiramisu-Chocolat-Noisettes', NULL, 4, NULL),
(11, 4, 'Gingembre-Confit', NULL, 3, NULL),
(12, 5, 'Tiramisu', NULL, 6, NULL),
(13, 5, 'Calzone-au-Nutella', NULL, 7, NULL),
(14, 5, 'Panna-Cota', NULL, 6, NULL),
(15, 6, 'Mousse-au-chocolat', NULL, 6, NULL),
(16, 6, 'Cheese-cake', 'Gâteau au fromage blanc comme à New York', 6, NULL),
(17, 6, 'Pancakes', 'Crêpes américaines servies avec du sirop d\'érable ou du chocolat chaud', 6, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `details_commande_menu`
--

CREATE TABLE `details_commande_menu` (
  `details_commande_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entree`
--

CREATE TABLE `entree` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `prix` double NOT NULL,
  `photo` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entree`
--

INSERT INTO `entree` (`id`, `restaurant_id`, `nom`, `description`, `prix`, `photo`) VALUES
(1, 1, 'Cheese-naan', 'Pâte à pain levée fourrée au fromage', 4, NULL),
(2, 4, 'Soupe-Miso', NULL, 2, 'soupe-miso.png'),
(3, 4, 'Salade-de-Choux', NULL, 2, 'salade-de-choux.png'),
(4, 1, 'Oignons-Bhaji', 'Beignets d\'oignons à la farine de pois chiches', 4, NULL),
(5, 1, 'Poisson-Tikka', 'Poisson saumon grillé dans tandoor avec 1 sauce aux épices', 7, NULL),
(8, 4, 'Nêm-au-Poulet-x4', NULL, 4, 'nem-au-poulet-x4.png'),
(9, 5, 'Légumes-grillés-et-burrata', NULL, 9, NULL),
(10, 5, 'Fritto-Misto', NULL, 6, NULL),
(11, 5, 'Assiette-de-charcuterie-Italienne', 'à partager', 10, NULL),
(12, 6, 'Quesadillas', 'Galettes de blé, cheddar fondu, salade, tomates, guacamole', 6, NULL),
(13, 6, 'Caesar-Salad', 'Croûtons grillés, parmesan frais, tomates', 6, NULL),
(14, 6, 'Mixed-vegetables', 'Légumes frais sautés', 6, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id` int(11) NOT NULL,
  `adresse` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complement` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `membre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `mdp` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `mdp`, `nom`, `prenom`, `email`, `telephone`, `photo`, `roles`) VALUES
(1, '$2y$13$6TqA8PO9KQ.i.0wCztq8x.pns.NRQCYLLOPBmQDQn87az0HMKTCTi', 'AMAR', 'Vincent', 'vinceamar@msn.com', '0677791689', 'vincent-amar.jpeg', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(2, '$2y$13$GaYb.Tb4dLRul.q81zhoq.pw5lR9EIFL4.aCq4CArk4I0FO4T/QyK', 'AISSA', 'Mohamed', 'moaissa@outlook.fr', '0658912525', 'mohamed-aissa.jpeg', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(3, '$2y$13$FsXy.H7z14Gk/rDAKmNK0.ojlB7B2669pTM1/vxUjnfaAWLeKxvfW', 'ALLAOUAT', 'Farid', 'ferdeddo@gmail.com', '0636685467', 'farid-allaouat.jpeg', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(4, '$2y$13$NSLvCkEWS.LCBzfvJkeAcukeP3hraz8lB5dhQ8/6U/O7LxAVa/KBG', 'M\'SA', 'Hachimia', 'hachimia.msa@gmail.com', '0651935521', 'hachimia-m-sa.jpeg', 'a:1:{i:0;s:11:\"ROLE_MEMBRE\";}'),
(5, '$2y$13$Pcdiq70PIVTxJPMkdWo9Beu/mPIk0y.353pWmLJtLdalokzquNE.y', 'GUEUDRE', 'Alexis', 'alexis.gueudre@hotmail.com', '0634606310', 'alexis-gueudre.jpeg', 'a:1:{i:0;s:11:\"ROLE_MEMBRE\";}'),
(6, '$2y$13$xsJ7RQaBs7UQ2oqmtK.i5OovhYO5V/FV3ZBneNtLtA2PDeq4Mmqxy', 'SECQ', 'Christopher', 'christopher.secq@gmail.com', '0663585914', 'christopher-secq.jpeg', 'a:1:{i:0;s:11:\"ROLE_MEMBRE\";}');

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `prix` double NOT NULL,
  `photo` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `nom`, `description`, `prix`, `photo`, `restaurant_id`) VALUES
(1, 'Poulet-Kashmir', 'Morceaux de poulet, noix de cajou, crème fraîche, Le riz n\'est pas compris avec le plat', 12, NULL, 1),
(2, 'Menu-Big-Chicken', 'Double poulet pané, salade, tomates, oignons, 1 frites et 1 boisson 33cl au choix', 9, NULL, 2),
(3, 'O\'Tacos-M', '1 Tortilla, 1 viande et 2 sauces au choix. Garni de frites et de sauce fromagère', 5, 'otacos-l.png', 3),
(4, 'Menu-Mixte', '6 sashimi saumon, 4 sushi (2 saumon, 1 thon, 1 daurade) 6 maki saumon, 5 brochettes variées (1 poulet, 1 boulettes de poulet, 1 boeuf, 1 boeuf au fromage, 1 ailes de poulet), soja avec 1 soupe miso, 1 salade à la japonaise et 1 riz nature', 20, 'menu-mixte.png', 4),
(5, 'Agneau-Sagwala', 'Curry d\'agneau aux épinards', 13, NULL, 1),
(6, 'Poisson-Shahi-Korma', 'Curry de saumon aux noix de cajou, crème fraîche et raisins secs', 13, NULL, 1),
(7, 'Menu-Wrap-Tenders', 'Salade, tomates, oignons, tortilla, tender chicken, 1 frites et 1 boisson 33cl au choix', 10, NULL, 2),
(8, 'Menu-Chicken-Mixte-1', '3 tenders chicken, 1 pilon, 1 frites et 1 boisson 33cl au choix', 10, NULL, 2),
(9, 'OTacos-L', '1 Tortilla, 2 viandes et 2 sauces au choix. Garni de frites et de sauce fromagère', 6, 'otacos-l.png', 3),
(10, 'Formule-Découverte-à-2', 'L\'Original M (escalope de poulet, sauce algérienne, cheddar) + Le Montagnard M (escalope de poulet, jambon de dinde, gratiné raclette et lardons) + 1 Frit\'OTacos + 2 boissons au choix', 22, 'formule-decouverte-a-2.png', 3),
(12, 'Menu-Chirashi', 'Assortiment de poisson cru dans un bol de riz vinaigré avec 1 soupe miso et 1 salade', 15, 'menu-chirashi.png', 4),
(13, 'Menu-Brochette', '5 brochettes variées (1 poulet, 1 boulettes de poulet, 1 boeuf, 1 boeuf au fromage, 1 ailes de poulet), soja avec 1 soupe, 1 salade à la japonaise et 1 riz nature', 10, 'menu-brochette.png', 4),
(14, 'Burger-Italien', 'Foccacia, Provola fumé', 13, NULL, 5),
(15, 'Pizza-San-Daniele', 'Tomate, Mozzarella, crème fraiche, jambon de Parme, roquette, copeaux de Parmesan', 14, NULL, 5),
(16, 'Linguine-La-Vendemmia', 'Crème saveur truffe, Jambon Speck, copeaux de Parmesan', 14, NULL, 5),
(17, 'Special-Sister', 'Bœuf haché grillé, cheddar fondu, sauce barbecue', 11, NULL, 6),
(18, 'BBQ', 'Bœuf haché grill, cheddar fondu, sauce barbecue', 11, NULL, 6),
(19, 'Chili-con-carne', 'Bœuf haché, haricots rouges, poivrons, tomates, avec ou sans chedar', 11, NULL, 6);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20190116164506'),
('20190116164749');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `horaires` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commande_min` double NOT NULL,
  `prix_livraison` double NOT NULL,
  `photo` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `restaurant`
--

INSERT INTO `restaurant` (`id`, `nom`, `slug`, `adresse`, `code_postal`, `ville`, `horaires`, `commande_min`, `prix_livraison`, `photo`, `note`, `description`, `type_id`) VALUES
(1, 'Taj Mahal', '', '7, rue de Brie                                                                  ', 78310, 'MAUREPAS', '11:30 - 23:00', 20, 5, 'indien.jpg', 1, 'Fines spécialités indiennes, dont grillades tandoori au four, dans un cadre feutré avec boiseries et statues.', 1),
(2, 'Chicken Minute', '', '56, rue Jean Jaurès                                                             ', 78190, 'TRAPPES', '12:00 - 00:00', 10, 0, 'chicken.jpg', 1, 'Créé en 2009, Chicken Minute est un fast food au concept innovant spécialisé dans le Fried Chicken. Etant notre composant principal, notre viande de poulet est garantie Halal, sélectionnée pour sa qualité. Décliné au grès de vos envie, le Fried Chicken compose l\'ensemble de nos recettes, de la plus classique à la plus gourmande !   Habillé le Fried Chicken d\'un savoureux Naan, c\'est notre spécialité ! Cette recette tant appréciée de nos clients est aujourd\'hui déclinée à toutes les sauces, pour le plaisir de tous : bolognaise, orientalen curry ... ', 2),
(3, 'O\'Tacos', '', '25, rue du gros caillou                                                         ', 78340, 'LES CLAYES SOUS BOIS', '11:30 - 23:00', 10, 0, 'tacos.jpg', 1, 'Créée en 2007, O’Tacos est la première chaîne de restaurants #FrenchTacos.\r\n\r\nDans chaque otacos, retrouvez notre recette originale de sauce fromagère et choisissez parmi 5 viandes certifiées HALAL, rigoureusement sélectionnées pour leur qualité premium.\r\n\r\nPour satisfaire tout le monde, nous avons créé des otacos de toutes les tailles, allant même jusqu’à 2kg500 pour les plus courageux.', 3),
(4, 'Sushi Lin ', '', '79, Voie Latérale Sud                                                           ', 78310, 'COIGNIERES ', '12:00 - 00:00', 20, 7, 'jap.jpg', 1, 'Venez déguster  nos spécialités japonaises  dans notre restaurant Sushi Lin à Coignières. Vous êtes à la recherche de notre carte variée : Maki, sushi, tempura, yakitori, soupes et salades japonaises, ainsi que nos assortiments de brochettes, de poissons cru et de nombreux autres plats japonais qui réveilleront vos papilles!', 4),
(5, 'La Vendemmia', '', '13, Place du Beffroi', 78990, 'ELANCOURT', '11:30 - 23:00', 15, 5, 'pizza.jpg', 1, 'Vendemmia est une pizzéria en plus de proposer dans sa carte quelques recettes d’inspiration italienne. L’établissement se trouve à Élancourt, du côté de La Clef de St Pierre. L’offre se structure en antipasti (entrées), insalata (salade), pasta (pâtes), piatti (plats), pizza, dessert et gelati (glace). En entrée, vous pouvez commander du carpaccio de bresaola, des spécialités de parmesan, des calamars, du saumon, des charcuteries italiennes et des ravioles. Les pâtes sont gorgées soit de sauce tomate, soit de crème fraîche soit de crème de truffe. En plat, l’enseigne fait honneur aux escalopes, au pavé de rumsteck, aux hamburgers ou encore aux Tartares. Le Menu Bambino est dédié aux enfants.', 5),
(6, 'Sister\'s Café', '', '15, rue des Réservoirs', 78000, 'VERSAILLES', '12:00 - 00:00', 10, 0, 'burger.jpg', 1, 'Le Sister’s Café est une invitation pour un « road-trip » gustatif à l’Américaine. Dès votre entrée, vous sentirez l’influence des Etats-Unis : le décor fait de banquettes de cuir marron, les murs jaunes et les mythiques plaques de voitures rappellent celui des bars des années 1950.\r\n\r\nIci, retrouvez toutes les spécialités d\'outre-Atlantique. Au programme, l’incontournable burger, mais aussi de nombreuses grillades qui feront le plaisir des amateurs de viande. Vous aurez aussi la possibilité de manger de belles salades ou des célèbres quesadillas mexicaines ! Sans parler des desserts gourmands : ne partez pas sans goûtez le cheesecake !\r\n\r\nLes beaux jours venus, prenez place sur la terrasse pour un déjeuner ensoleillé.', 6);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `nom`, `slug`) VALUES
(1, 'Indien', 'indien'),
(2, 'Poulet', 'poulet'),
(3, 'Tacos', 'tacos'),
(4, 'Japonais', 'japonais'),
(5, 'Pizza', 'pizza'),
(6, 'Burger', 'burger');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `boisson`
--
ALTER TABLE `boisson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8B97C84DB1E7706E` (`restaurant_id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67D6A99F74A` (`membre_id`);

--
-- Index pour la table `dessert`
--
ALTER TABLE `dessert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_79291B96B1E7706E` (`restaurant_id`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4BCD5F682EA2E54` (`commande_id`);

--
-- Index pour la table `details_commande_menu`
--
ALTER TABLE `details_commande_menu`
  ADD PRIMARY KEY (`details_commande_id`,`menu_id`),
  ADD KEY `IDX_5EF664AEE99004AB` (`details_commande_id`),
  ADD KEY `IDX_5EF664AECCD7E912` (`menu_id`);

--
-- Index pour la table `entree`
--
ALTER TABLE `entree`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_598377A6B1E7706E` (`restaurant_id`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A60C9F1F6A99F74A` (`membre_id`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7D053A93B1E7706E` (`restaurant_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EB95123FC54C8C93` (`type_id`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `boisson`
--
ALTER TABLE `boisson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `dessert`
--
ALTER TABLE `dessert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entree`
--
ALTER TABLE `entree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `boisson`
--
ALTER TABLE `boisson`
  ADD CONSTRAINT `FK_8B97C84DB1E7706E` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D6A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `dessert`
--
ALTER TABLE `dessert`
  ADD CONSTRAINT `FK_79291B96B1E7706E` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Contraintes pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `FK_4BCD5F682EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`);

--
-- Contraintes pour la table `details_commande_menu`
--
ALTER TABLE `details_commande_menu`
  ADD CONSTRAINT `FK_5EF664AECCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5EF664AEE99004AB` FOREIGN KEY (`details_commande_id`) REFERENCES `details_commande` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `entree`
--
ALTER TABLE `entree`
  ADD CONSTRAINT `FK_598377A6B1E7706E` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Contraintes pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD CONSTRAINT `FK_A60C9F1F6A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_7D053A93B1E7706E` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Contraintes pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `FK_EB95123FC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);