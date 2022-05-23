-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 23 mai 2022 à 22:23
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `devmobile`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `IDCat` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`IDCat`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`IDCat`, `name`) VALUES
(8, 'Air Jordan'),
(9, 'lifestyle'),
(13, 'sport'),
(15, 'tennis'),
(16, 'basketball');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `IDCommande` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `number` int(11) NOT NULL,
  `amountOutMargin` double NOT NULL,
  `comMargin` double NOT NULL,
  `totalAmount` double NOT NULL,
  `user_ID` int(11) NOT NULL,
  PRIMARY KEY (`IDCommande`),
  KEY `user_ID` (`user_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `IDProduit` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `unitPrice` double NOT NULL,
  `picture` varchar(250) NOT NULL,
  `categorie_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDProduit`),
  KEY `categorie_ID` (`categorie_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`IDProduit`, `reference`, `name`, `unitPrice`, `picture`, `categorie_ID`) VALUES
(20, '0001', 'Jordan Series ES', 84.99, 'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/df30701f-090c-42b9-9154-d3d62ccfde90/chaussure-jordan-series-es-pour-zPGmm0.png', 8),
(21, '0002', 'Air Jordan 1 Low SE', 119.99, 'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/60d885c6-c70b-4202-b978-c6ae431bc295/chaussures-air-jordan-1-low-se-11m0zP.png', 8),
(28, '0003', 'Air Jordan 1 Acclimate', 149.99, 'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/52c3b515-b43a-4d62-b11c-d6392fe1b81a/chaussures-air-jordan-1-acclimate-pour-jvc8f1.png', 8),
(29, '0004', 'Jordan MA2', 99.99, 'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/44f0cc37-b44e-4e5d-8870-368cb2febe35/chaussure-jordan-ma2-pour-plus-age-5mbdCS.png', 8),
(30, '0005', 'Air Jordan 1 Mid', 119.99, 'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/3270b875-2d46-4000-ab1d-e72864df223a/chaussure-air-jordan-1-mid-QJTvQh.png', 8),
(31, '0006', 'Jordan Delta 2', 129.99, 'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/604c98a7-f0c3-4d44-8bd1-c0308aebbf6a/chaussure-jordan-delta-2-pour-m9K80z.png', 8),
(32, '0007', 'Jordan 6 Rings', 119.99, 'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/2c3c7498-5fa7-4e84-8066-a903728cbd53/chaussure-jordan-6-rings-pour-plus-age-tgp097.png', 8),
(33, '0008', 'Air Jordan 1 Mid', 119.99, 'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/00af1c33-f280-446d-97e0-97056c96473d/chaussure-air-jordan-1-mid-pour-Ct9zLk.png', 8),
(34, '0009', '574v2', 120, 'https://nb.scene7.com/is/image/NB/ml574nbi_nb_02_i?$pdpflexf2MD2x$&fmt=webp&wid=1026&hei=1026', 9),
(35, '0010', 'CT300V3', 90, 'https://nb.scene7.com/is/image/NB/ct300wy3_nb_02_i?$pdpflexf2MD2x$&fmt=webp&wid=1026&hei=1026', 9),
(36, '0011', 'NUMERIC 440 HIGH TOM KNOX', 90, 'https://nb.scene7.com/is/image/NB/nm440hrk_nb_02_i?$pdpflexf2MD2x$&fmt=webp&wid=1026&hei=1026', 9),
(37, '0012', '997H', 110, 'https://nb.scene7.com/is/image/NB/cm997hte_nb_02_i?$pdpflexf2MD2x$&fmt=webp&wid=1026&hei=1026', 9),
(38, '0013', 'Made in US 990v5', 200, 'https://nb.scene7.com/is/image/NB/w990gl5_nb_02_i?$pdpflexf2MD2x$&fmt=webp&wid=1026&hei=1026', 9),
(39, '0014', '327', 100, 'https://nb.scene7.com/is/image/NB/ws327pa_nb_02_i?$pdpflexf2MD2x$&fmt=webp&wid=1026&hei=1026', 9),
(40, '0015', '574v2', 120, 'https://nb.scene7.com/is/image/NB/wl574la2_nb_02_i?$pdpflexf2MD2x$&fmt=webp&wid=1026&hei=1026', 9),
(41, '0016', '327', 120, 'https://nb.scene7.com/is/image/NB/ws327lag_nb_02_i?$pdpflexf2MD2x$&fmt=webp&wid=1026&hei=1026', 9),
(106, '0039', 'CHAUSSURES DE FITNESS 100 FEMME NOIR', 19, 'https://contents.mediadecathlon.com/p1815213/k$9ba44a667acc04c53675ba500497b337/sq/chaussures-de-fitness-100-femme-noir.jpg?format=auto&f=646x646', 13),
(107, '0040', 'CHAUSSURES DE FITNESS 500 NOIR STRAPES SANS LACETS', 22, 'https://contents.mediadecathlon.com/p1959125/k$1ce7fdd569fa7d4d5ee216f1da136e80/sq/chaussures-de-fitness-500-noir-strapes-sans-lacets.jpg?format=auto&f=646x646', 13),
(108, '0041', 'CHAUSSURES RUNNING ASICS GEL WINDHAWK HOMME 21', 70, 'https://contents.mediadecathlon.com/p2028182/k$fb70822e3b5d12701f4c6f001b550676/sq/chaussures-running-asics-gel-windhawk-homme-21.jpg?format=auto&f=646x646', 13),
(109, '0042', 'CHAUSSURE MARCHE URBAINE HOMME REEBOK ', 50, 'https://contents.mediadecathlon.com/p1781302/k$0b38a1e2ea761aa312391252cd1b5b4c/sq/chaussure-marche-urbaine-homme-reebok-royal-classic-blanc.jpg?format=auto&f=646x646', 13),
(110, '0043', 'CHAUSSURE DE FOOTBALL ADULTE TERRAINS SECS', 25, 'https://contents.mediadecathlon.com/p1671692/k$8c468b08be79942bbc3ea286a87bbc0a/sq/chaussure-de-football-adulte-terrains-secs-agility-500-mg-bordeaux-and-orange.jpg?format=auto&f=646x646', 13),
(111, '0044', 'CHAUSSURES DE RANDONNÉE NATURE', 35, 'https://contents.mediadecathlon.com/p1976131/k$7122a42d19d02fdc51a16b92e754e97a/sq/chaussures-de-randonnee-nature-nh500-fresh-homme.jpg?format=auto&f=646x646', 13),
(112, '0045', 'CHAUSSURES DE RUNNING KIPRUN ULTRALIGHT ', 70, 'https://contents.mediadecathlon.com/p1766323/k$a383153e3234d792b08b1297e1804fe2/sq/chaussures-de-running-kiprun-ultralight-homme-rouge-jaune.jpg?format=auto&f=646x646', 13),
(114, '0111', 'Asics Gel Resolution 8 Homme PE22', 140, 'https://www.protennis.fr/20323-tm_large_default/asics-gel-resolution-8-homme-pe22.jpg', 15),
(115, '0112', 'Babolat Jet Tere Toutes Surfaces Homme', 100, 'https://www.protennis.fr/20224-tm_large_default/babolat-jete-tere-toutes-surfaces-homme.jpg', 15),
(116, '0113', 'Nike Air Zoom GP Turbo Homme Hiver 2021', 140, 'https://www.protennis.fr/20010-tm_large_default/nike-air-zoom-gp-turbo-homme-hiver-2021.jpg', 15),
(117, '0114', 'Nike Vapor Pro Femme Hiver 2021', 120, 'https://www.protennis.fr/19945-home_default/nike-vapor-pro-femme-hiver-2021.jpg', 15),
(118, '0115', 'Wilson Rush Pro 3.5 Homme AH21', 140, 'https://www.protennis.fr/19799-home_default/wilson-rush-pro-35-homme-ah21.jpg', 15),
(119, '0116', 'Wilson Rush Pro 3.5 Femme AH21', 140, 'https://www.protennis.fr/19791-home_default/wilson-rush-pro-35-femme-ah21.jpg', 15),
(120, '0117', 'Nike Vapor Pro Femme Automne 2021', 120, 'protennis.fr/18742-home_default/nike-vapor-pro-femme-automne-2021.jpg', 15),
(121, '0118', 'Nike Zoom Vapor Cage 4 Rafa Homme Automne 2021', 150, 'https://www.protennis.fr/18770-tm_large_default/nike-zoom-vapor-cage-4-rafa-homme-automne-2021.jpg', 15),
(122, '0121', 'Adidas Dame 8 4th Quarter KO', 120, 'https://cdn2.basket4ballers.com/135773-thickbox_default/adidas-dame-8-4th-quarter-knockout-gy0383.jpg', 16),
(123, '0122', 'Kyrie Flytrap 5 Black Cool Grey', 90, 'https://cdn1.basket4ballers.com/137196-thickbox_default/kyrie-flytrap-5-black-cool-grey-cz4100-002.jpg', 16),
(124, '0123', 'Reebok Shaqnosis x adidas Dame', 160, 'https://cdn2.basket4ballers.com/137279-thickbox_default/reebok-shaqnosis-x-adidas-damenosis.jpg', 16),
(125, '0124', 'Nike Kyrie 8 Chrome Grey Enfant GS', 110, 'https://cdn1.basket4ballers.com/136176-thickbox_default/nike-kyrie-8-chrome-grey-enfant-gs-dd0335-108.jpg', 16),
(126, '0125', 'Under Armour Curry 9 Sesame Street The Count', 160, 'https://cdn1.basket4ballers.com/132544-thickbox_default/under-armour-curry-9-sesame-street-the-count-3024248-002.jpg', 16),
(127, '0125', 'Nike PG 5 Clippers', 120, 'https://cdn1.basket4ballers.com/128635-thickbox_default/nike-pg-5-clippers-nba-cw3143-005.jpg', 16),
(128, '0126', 'NIke Giannis Immortality Dark Star', 80, 'https://cdn1.basket4ballers.com/135967-thickbox_default/nike-giannis-immortality-dark-star-dh4470-001.jpg', 16),
(129, '0127', 'Nike LeBron 19 XMAS QS', 190, 'https://cdn1.basket4ballers.com/135158-thickbox_default/nike-lebron-19-xmas.jpg', 16);

-- --------------------------------------------------------

--
-- Structure de la table `products_in_basket`
--

DROP TABLE IF EXISTS `products_in_basket`;
CREATE TABLE IF NOT EXISTS `products_in_basket` (
  `IDPib` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Size` char(1) NOT NULL,
  `ShoesSize` int(2) NOT NULL,
  PRIMARY KEY (`IDPib`),
  KEY `product_ID` (`product_ID`),
  KEY `user_ID` (`user_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `product_ordered`
--

DROP TABLE IF EXISTS `product_ordered`;
CREATE TABLE IF NOT EXISTS `product_ordered` (
  `IDPo` int(11) NOT NULL AUTO_INCREMENT,
  `product_ID` int(11) NOT NULL,
  `commande_ID` int(11) NOT NULL,
  `ShoesSize` int(2) NOT NULL,
  `Size` char(1) NOT NULL,
  `Quantite` int(100) NOT NULL,
  PRIMARY KEY (`IDPo`),
  KEY `product_ID` (`product_ID`),
  KEY `order_ID` (`commande_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `margin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `last_name`, `level`, `margin`) VALUES
(1, 'noe.guedet@epsi.fr', NULL, '$2y$10$FPUb7URZN0h.eEecg6eA8.54n42W0mReyj9jo6ZLLiIS6Sr6MlYFu', 'noe', 'guedet', 1, 40),
(4, 'jade.domasvasserot@epsi.fr', NULL, '$2y$10$gS9YygcLMjLBWkeiXYMUv.TSZXwPfVpa9CIemT22wt1nk16dDagBS', 'Jade', 'Domas-Vasserot', 1, 40),
(6, 'admin@gmail.com', NULL, '$2y$10$FPUb7URZN0h.eEecg6eA8.54n42W0mReyj9jo6ZLLiIS6Sr6MlYFu', 'admin', 'admin', 2, 40),
(7, 'berard.erine@gmail.com', NULL, '$2y$10$6r9Y8JCdtC54ZS7eRtxOaur4.1mpIq2JCvl1/wofB.TEypeLXP75e', 'erine', 'berard', 1, 40);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `categorie_ID` FOREIGN KEY (`categorie_ID`) REFERENCES `category` (`IDCat`);

--
-- Contraintes pour la table `products_in_basket`
--
ALTER TABLE `products_in_basket`
  ADD CONSTRAINT `products_in_basket_ibfk_1` FOREIGN KEY (`product_ID`) REFERENCES `product` (`IDProduit`),
  ADD CONSTRAINT `products_in_basket_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `product_ordered`
--
ALTER TABLE `product_ordered`
  ADD CONSTRAINT `product_ordered_ibfk_1` FOREIGN KEY (`commande_ID`) REFERENCES `commande` (`IDCommande`),
  ADD CONSTRAINT `product_ordered_ibfk_2` FOREIGN KEY (`product_ID`) REFERENCES `product` (`IDProduit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
