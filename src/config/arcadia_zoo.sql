-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 21 juil. 2024 à 21:22
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
-- Base de données : `arcadia_zoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

CREATE TABLE `animal` (
  `animal_id` int(11) NOT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `habitat_id` int(11) DEFAULT NULL,
  `race_id` int(11) DEFAULT NULL,
  `etat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`animal_id`, `prenom`, `habitat_id`, `race_id`, `etat_id`) VALUES
(2, 'Sky', 1, 1, 1),
(3, 'Malik', 1, 2, 1),
(4, 'Silver', 1, 3, 1),
(5, 'Rambo', 2, 4, 1),
(6, 'Alfred', 2, 5, 1),
(7, 'Boubi', 3, 6, 1),
(8, 'Sob', 3, 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `texte_avis` text NOT NULL,
  `valide` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `pseudo`, `texte_avis`, `valide`) VALUES
(1, 'Jean', 'Super zoo, à visiter absolument !', 1),
(4, 'Marie', 'Une expérience inoubliable.', 1),
(5, 'Pierre', 'Très bien organisé et propre.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `avis_attente`
--

CREATE TABLE `avis_attente` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `texte_avis` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `etat_id` int(11) NOT NULL,
  `etat_label` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`etat_id`, `etat_label`) VALUES
(2, 'bon'),
(1, 'excellent'),
(4, 'mauvais'),
(3, 'moyen');

-- --------------------------------------------------------

--
-- Structure de la table `habitat`
--

CREATE TABLE `habitat` (
  `habitat_id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `commentaire_habitat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `habitat`
--

INSERT INTO `habitat` (`habitat_id`, `nom`, `description`, `commentaire_habitat`) VALUES
(1, 'Savane', 'Description de la Savane', 'La savane d\'Arcadia est une vaste étendue parsemée'),
(2, 'Jungle', 'Description de la Jungle', 'Plongez dans la jungle luxuriante d\'Arcadia, un en'),
(3, 'Aquarium', 'Description de l\'Aquarium', 'L\'écosystème aquatique d\'Arcadia est une merveille');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `habitat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`image_id`, `image_path`, `habitat_id`) VALUES
(2, 'src/images/habitats/enclot-savane-2.webp', 1),
(3, 'src/images/habitats/enclot-jungle.webp', 2),
(4, 'src/images/habitats/aquarium-2.webp', 3);

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE `race` (
  `race_id` int(11) NOT NULL,
  `label` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`race_id`, `label`) VALUES
(1, 'Girafe'),
(2, 'Eléphant'),
(3, 'Suricate'),
(4, 'Tigre'),
(5, 'Reptile'),
(6, 'Raie'),
(7, 'Tortue');

-- --------------------------------------------------------

--
-- Structure de la table `rapport_veterinaire`
--

CREATE TABLE `rapport_veterinaire` (
  `rapport_id` int(11) NOT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `nourriture` varchar(255) DEFAULT NULL,
  `grammage` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `etat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rapport_veterinaire`
--

INSERT INTO `rapport_veterinaire` (`rapport_id`, `animal_id`, `nourriture`, `grammage`, `date`, `etat_id`) VALUES
(1, 2, 'feuilles d’acacia', '300000Kg', '2024-01-01', 1),
(2, 3, 'feuilles de bambou', '500 T', '2024-01-01', 1),
(3, 4, 'Fourmies', '500g', '2024-01-01', 2),
(4, 5, 'Viande', '25Kg', '2024-01-01', 3),
(5, 6, 'Viande', '25Kg', '2024-01-01', 2),
(6, 7, 'Crevettes', '700g', '2024-02-02', 3),
(7, 8, 'sans plomb 95', '1 L', '2024-02-02', 3);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `label` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`role_id`, `label`) VALUES
(1, 'Administrateur'),
(2, 'Employé'),
(3, 'Vétérinaire');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `horaires` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`service_id`, `nom`, `description`, `horaires`) VALUES
(1, 'Restaurant', 'Cuisine Variée : Notre restaurant propose une cuisine variée et de qualité, adaptée à tous les goûts et besoins alimentaires. \r\nVous pouvez choisir parmi une sélection de plats savoureux, des options végétariennes aux plats régionaux, préparés avec des ingrédients frais et locaux. \r\nEspaces de Détente : Profitez de nos espaces de restauration confortables et accueillants, parfaits pour se reposer et se restaurer entre deux explorations. \r\nVue sur la Nature : Certains espaces offrent une vue panoramique sur les habitats naturels d\'Arcadia, vous permettant de savourer votre repas tout en observant nos animaux.', '11h30 - 14h30 / 18h30 - 22h30'),
(2, 'Visite guidée gratuite', 'Informations Expertes : Nos guides expérimentés vous accompagnent à travers le zoo, partageant des informations détaillées sur nos animaux, leur comportement, leur habitat naturel et les efforts de conservation. \r\nVisites Thématiques : Découvrez nos visites thématiques spéciales qui mettent en lumière des aspects particuliers de la faune et de la flore, enrichissant votre expérience avec des anecdotes fascinantes et des faits intéressants.\r\nInteractivité : Les visites guidées offrent une interaction directe avec nos guides, vous permettant de poser des questions et d\'en apprendre davantage sur la vie quotidienne des animaux à Arcadia.', '12h - 15h'),
(3, 'Petit-train', 'Confort et Commodité : Notre petit train offre un moyen confortable et pratique de découvrir le zoo, idéal pour tous les âges. \r\nVous pouvez profiter d\'une vue panoramique tout en écoutant les commentaires enregistrés sur les différents habitats et animaux. \r\nAccessibilité : Le train est accessible aux visiteurs de tous âges et capacités physiques, assurant une expérience agréable pour toute la famille. \r\nFréquence des Départs : Les départs sont réguliers tout au long de la journée, facilitant votre exploration du zoo à votre propre rythme.', '9h - 18h');

-- --------------------------------------------------------

--
-- Structure de la table `suivi_veterinaire`
--

CREATE TABLE `suivi_veterinaire` (
  `suivi_id` int(11) NOT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `etat` varchar(255) DEFAULT NULL,
  `nourriture` varchar(255) DEFAULT NULL,
  `grammage` varchar(255) DEFAULT NULL,
  `date_passage` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `suivi_veterinaire`
--

INSERT INTO `suivi_veterinaire` (`suivi_id`, `animal_id`, `etat`, `nourriture`, `grammage`, `date_passage`) VALUES
(1, 2, 'Moyen', 'Olivier', '5 T', '2024-07-20');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`username`, `password`, `nom`, `prenom`, `role_id`) VALUES
('josébové', 'ArcaAdmin', 'bové', 'josé', 1),
('MartinMatin', 'ArcaEmploye', 'Matin', 'Martin', 2),
('MH', 'ArcaVeto', 'Miyazaki', 'Hidetaka', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_id`),
  ADD KEY `habitat_id` (`habitat_id`),
  ADD KEY `race_id` (`race_id`),
  ADD KEY `fk_etat_animal` (`etat_id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `avis_attente`
--
ALTER TABLE `avis_attente`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`etat_id`),
  ADD UNIQUE KEY `etat_label` (`etat_label`);

--
-- Index pour la table `habitat`
--
ALTER TABLE `habitat`
  ADD PRIMARY KEY (`habitat_id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `habitat_id` (`habitat_id`);

--
-- Index pour la table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`race_id`);

--
-- Index pour la table `rapport_veterinaire`
--
ALTER TABLE `rapport_veterinaire`
  ADD PRIMARY KEY (`rapport_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `fk_etat_rapport` (`etat_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Index pour la table `suivi_veterinaire`
--
ALTER TABLE `suivi_veterinaire`
  ADD PRIMARY KEY (`suivi_id`),
  ADD KEY `animal_id` (`animal_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `avis_attente`
--
ALTER TABLE `avis_attente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `etat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `habitat`
--
ALTER TABLE `habitat`
  MODIFY `habitat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `race_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `rapport_veterinaire`
--
ALTER TABLE `rapport_veterinaire`
  MODIFY `rapport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `suivi_veterinaire`
--
ALTER TABLE `suivi_veterinaire`
  MODIFY `suivi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`habitat_id`),
  ADD CONSTRAINT `animal_ibfk_2` FOREIGN KEY (`race_id`) REFERENCES `race` (`race_id`),
  ADD CONSTRAINT `fk_etat_animal` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`etat_id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`habitat_id`);

--
-- Contraintes pour la table `rapport_veterinaire`
--
ALTER TABLE `rapport_veterinaire`
  ADD CONSTRAINT `fk_etat_rapport` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`etat_id`),
  ADD CONSTRAINT `rapport_veterinaire_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`);

--
-- Contraintes pour la table `suivi_veterinaire`
--
ALTER TABLE `suivi_veterinaire`
  ADD CONSTRAINT `suivi_veterinaire_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
