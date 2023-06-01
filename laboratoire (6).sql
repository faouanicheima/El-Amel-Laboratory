-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 01 juin 2023 à 09:37
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laboratoire`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `matriculeAdministrateur` int(5) NOT NULL,
  `nomA` varchar(25) NOT NULL,
  `prénomA` varchar(25) NOT NULL,
  `emailA` varchar(30) NOT NULL,
  `mdpA` varchar(32) NOT NULL,
  `codeLabo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`matriculeAdministrateur`, `nomA`, `prénomA`, `emailA`, `mdpA`, `codeLabo`) VALUES
(1, 'Faouani', 'Chaima', 'cheimafaouani@gmail.com', '0cb2c485bab4ff6dca1482f126f9bc57', 1);

-- --------------------------------------------------------

--
-- Structure de la table `analyse`
--

CREATE TABLE `analyse` (
  `idAnalyse` int(5) NOT NULL,
  `nomA` varchar(25) NOT NULL,
  `référencesA` varchar(100) NOT NULL,
  `conditionsA` varchar(100) NOT NULL,
  `unitéA` int(10) NOT NULL,
  `prixA` float NOT NULL,
  `délaiA` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `analyse`
--

INSERT INTO `analyse` (`idAnalyse`, `nomA`, `référencesA`, `conditionsA`, `unitéA`, `prixA`, `délaiA`) VALUES
(1, 'test', '20', '0', 0, 300, 'mois'),
(2, 'TEST0', '321', '0', 0, 100, 'jour'),
(3, 'test03', '30', 'Rien', 0, 300, '1 Jour');

-- --------------------------------------------------------

--
-- Structure de la table `analysesconv`
--

CREATE TABLE `analysesconv` (
  `num-conv` int(5) NOT NULL,
  `id-analyse` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `convention`
--

CREATE TABLE `convention` (
  `numConv` int(5) NOT NULL,
  `réductionC` int(10) NOT NULL,
  `dateDC` date NOT NULL,
  `dateFC` date NOT NULL,
  `objetC` varchar(50) NOT NULL,
  `codeLabo` int(5) NOT NULL,
  `idOrg` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `convention`
--

INSERT INTO `convention` (`numConv`, `réductionC`, `dateDC`, `dateFC`, `objetC`, `codeLabo`, `idOrg`) VALUES
(1, 30, '2023-05-07', '2030-10-20', 'none', 1, 1),
(4, 30, '2023-05-10', '2024-01-10', 'test', 1, 3),
(5, 30, '2023-05-10', '2024-09-10', 'test', 1, 3),
(6, 30, '2023-05-10', '2024-09-10', 'test', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `détail_test`
--

CREATE TABLE `détail_test` (
  `idAnalyse` int(8) NOT NULL,
  `numTest` int(8) NOT NULL,
  `résultat` varchar(100) DEFAULT '/',
  `décision` varchar(50) NOT NULL DEFAULT 'valide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `détail_test`
--

INSERT INTO `détail_test` (`idAnalyse`, `numTest`, `résultat`, `décision`) VALUES
(1, 1, '20', 'valide'),
(1, 1, '20', 'valide'),
(1, 1, '20', 'valide'),
(1, 2, '/', ''),
(1, 2, '/', ''),
(1, 2, '/', ''),
(1, 3, '30', 'oui'),
(2, 3, '300', 'oui'),
(2, 3, '300', 'oui'),
(2, 4, '40', 'valide'),
(1, 4, '30', 'valide'),
(2, 4, '40', 'valide'),
(2, 6, '30', ''),
(3, 6, '40', 'valide'),
(2, 7, '12', ''),
(3, 7, '15', 'valide'),
(2, 8, '8', 'valide'),
(3, 8, '13', 'valide'),
(1, 8, '34', ''),
(1, 8, '34', ''),
(2, 8, '8', 'valide'),
(3, 8, '13', 'valide'),
(1, 8, '34', ''),
(2, 8, '8', 'valide'),
(2, 8, '8', 'valide'),
(3, 8, '13', 'valide'),
(1, 9, '7', ''),
(2, 9, '11', 'valide'),
(3, 9, '2', 'valide'),
(1, 10, '10', ''),
(2, 10, '7', 'valide');

-- --------------------------------------------------------

--
-- Structure de la table `laboratoire`
--

CREATE TABLE `laboratoire` (
  `codeLabo` int(5) NOT NULL,
  `nomLabo` varchar(30) NOT NULL,
  `logoLabo` varchar(50) NOT NULL,
  `emailLabo` varchar(30) NOT NULL,
  `télLabo` int(13) NOT NULL,
  `fixeLabo` int(13) NOT NULL,
  `faxLabo` int(13) NOT NULL,
  `adresseLabo` varchar(30) NOT NULL,
  `villeLabo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `laboratoire`
--

INSERT INTO `laboratoire` (`codeLabo`, `nomLabo`, `logoLabo`, `emailLabo`, `télLabo`, `fixeLabo`, `faxLabo`, `adresseLabo`, `villeLabo`) VALUES
(1, 'EL Amel Labo', '/style/logo.jpg', 'elamellaboratoire23@gmail.com', 5555555, 3333335, 3333332, 'enface  de direction de la Jeu', 'Chétaibi');

-- --------------------------------------------------------

--
-- Structure de la table `organisme`
--

CREATE TABLE `organisme` (
  `idOrg` int(5) NOT NULL,
  `désignationOrg` varchar(30) NOT NULL,
  `adresseOrg` varchar(30) NOT NULL,
  `villeOrg` varchar(20) NOT NULL,
  `télOrg` int(13) NOT NULL,
  `faxOrg` int(13) NOT NULL,
  `emailOrg` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `organisme`
--

INSERT INTO `organisme` (`idOrg`, `désignationOrg`, `adresseOrg`, `villeOrg`, `télOrg`, `faxOrg`, `emailOrg`) VALUES
(1, 'EL AM', 'EN VUE', 'ANNABA', 55555555, 55555555, 'sharef'),
(2, 'test', '60 logts Ain Touta', 'Annaba', 67677232, 67677232, 'sharefeddinearar@gmail.com'),
(3, 'TET', 'la fontaine romaine', 'Chetaïbi', 55565654, 55565654, 'cheimafaouani@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `idPatient` int(8) NOT NULL,
  `nomP` varchar(25) NOT NULL,
  `prénomP` varchar(25) NOT NULL,
  `datenaissP` date NOT NULL,
  `sexeP` varchar(1) NOT NULL,
  `adresseP` varchar(40) NOT NULL,
  `villeP` varchar(20) NOT NULL,
  `emailP` varchar(40) NOT NULL,
  `télP` int(13) NOT NULL,
  `numCon` int(8) NOT NULL DEFAULT 0,
  `MDPP` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`idPatient`, `nomP`, `prénomP`, `datenaissP`, `sexeP`, `adresseP`, `villeP`, `emailP`, `télP`, `numCon`, `MDPP`) VALUES
(1, 'Faouani ', 'Chaima', '2001-10-06', 'f', 'Rue avenue ', 'Chetaïbi', 'cheimafaouani@gmail.com', 665430656, 0, '0cb2c485bab4ff6dca1482f126f9bc57'),
(2, 'Faouani ', 'Mourad', '2002-01-09', 'm', '60 logts Ain Touta', 'Annaba', 'sharefeddinearar@gmail.com', 657253953, 0, '0cb2c485bab4ff6dca1482f126f9bc57'),
(3, 'Faouani ', 'Mourad', '2002-09-01', 'm', '60 logts Ain Touta', 'Annaba', 'sharefeddinearar@gmail.com', 657253952, 0, '0cb2c485bab4ff6dca1482f126f9bc57'),
(4, 'Faouani ', 'AbdelHamid', '2002-09-10', 'm', '60 logts Ain Touta', 'Annaba', 'cheimafaouani1@gmail.com', 657253951, 0, '0cb2c485bab4ff6dca1482f126f9bc57'),
(5, 'faouani', 'rayan', '2001-10-06', 'f', 'la fontaine romaine', 'Chetaïbi', 'faouaniriyan@gmail.com', 665430622, 4, '0cb2c485bab4ff6dca1482f126f9bc57'),
(8, 'faouani', 'hamadan', '1956-12-07', 'm', 'la city', 'Annaba', 'cfaouani@gmail.com', 775458462, 0, '0ac6cd34e2fac333bf0ee3cd06bdcf96'),
(9, 'faouani', 'amen', '2000-07-11', 'm', 'la city', 'Annaba', 'chaimami2020@gmail.com', 665430656, 0, 'ccda1683d8c97f8f2dff2ea7d649b42c'),
(12, 'faouani', 'aman', '2001-07-11', 'm', 'la city', 'Annaba', 'amanfaouani@gmail.com', 665430656, 0, '497eace26d63f56fdf236be490d5f722'),
(13, 'boutarfa', 'oumaima', '1997-05-28', 'f', 'la bai west', 'Annaba', 'cfaouani@gmail.com', 657853022, 0, 'c2b2dc5b0ffeb96aedae6f93b01ff353');

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `idPatient` int(8) NOT NULL,
  `dateR` date NOT NULL,
  `heureR` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`idPatient`, `dateR`, `heureR`) VALUES
(1, '2023-05-02', '21:10:00'),
(3, '2023-05-10', '10:00:00'),
(4, '2023-05-10', '10:00:00'),
(5, '2023-05-18', '09:00:00'),
(1, '2023-05-10', '23:57:00'),
(8, '2023-05-12', '10:00:00'),
(8, '2023-05-12', '10:00:00'),
(9, '2023-05-15', '09:00:00'),
(12, '2023-05-21', '09:00:00'),
(13, '2023-06-04', '10:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `secrétaire`
--

CREATE TABLE `secrétaire` (
  `matriculeSecrétaire` int(5) NOT NULL,
  `nomS` varchar(25) NOT NULL,
  `prénomS` varchar(25) NOT NULL,
  `emailS` varchar(30) NOT NULL,
  `mdpS` varchar(32) NOT NULL,
  `codeLabo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `secrétaire`
--

INSERT INTO `secrétaire` (`matriculeSecrétaire`, `nomS`, `prénomS`, `emailS`, `mdpS`, `codeLabo`) VALUES
(1, 'Faouani', 'Chaima', 'cheimafaouani@gmail.com', '0cb2c485bab4ff6dca1482f126f9bc57', 1);

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `numTest` int(8) NOT NULL,
  `noTest` int(8) NOT NULL,
  `dateTest` date NOT NULL,
  `DateRésultatT` date DEFAULT NULL,
  `médecinTraitant` varchar(30) NOT NULL DEFAULT '/',
  `typePrélèvement` varchar(7) NOT NULL DEFAULT 'interne',
  `status` varchar(50) NOT NULL DEFAULT 'en attente de consultations',
  `idPatient` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `test`
--

INSERT INTO `test` (`numTest`, `noTest`, `dateTest`, `DateRésultatT`, `médecinTraitant`, `typePrélèvement`, `status`, `idPatient`) VALUES
(1, 3, '2023-05-02', NULL, '1', 'interne', 'complete', 1),
(2, 3, '2023-05-10', '2023-05-07', '1', 'interne', 'en attente dimpression', 3),
(3, 3, '2023-05-10', '2023-05-08', '1', 'interne', 'complete', 4),
(4, 3, '2023-05-18', '2023-05-10', '1', 'interne', 'en attente de resulat', 5),
(5, 1, '2023-05-10', NULL, '1', 'interne', 'en attente de consultations', 1),
(6, 2, '2023-05-12', '2023-05-11', '1', 'interne', 'complete', 8),
(7, 2, '2023-05-12', '2023-05-11', '1', 'interne', 'en attente dimpression', 8),
(8, 4, '2023-05-15', '2023-05-12', '1', 'interne', 'en attente dimpression', 9),
(9, 3, '2023-05-21', '2023-05-12', '1', 'interne', 'complete', 12),
(10, 2, '2023-06-04', '2023-05-28', '1', 'interne', 'complete', 13);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`matriculeAdministrateur`),
  ADD UNIQUE KEY `email` (`emailA`),
  ADD KEY `ALBID` (`codeLabo`);

--
-- Index pour la table `analyse`
--
ALTER TABLE `analyse`
  ADD PRIMARY KEY (`idAnalyse`),
  ADD UNIQUE KEY `nom-analyse` (`nomA`);

--
-- Index pour la table `analysesconv`
--
ALTER TABLE `analysesconv`
  ADD PRIMARY KEY (`num-conv`,`id-analyse`),
  ADD KEY `ANACONID` (`id-analyse`),
  ADD KEY `ANACONNUM` (`num-conv`);

--
-- Index pour la table `convention`
--
ALTER TABLE `convention`
  ADD PRIMARY KEY (`numConv`),
  ADD KEY `ConLabID` (`codeLabo`),
  ADD KEY `ConOrgID` (`idOrg`);

--
-- Index pour la table `détail_test`
--
ALTER TABLE `détail_test`
  ADD KEY `DT-TestID` (`numTest`),
  ADD KEY `DTAnaID` (`idAnalyse`);

--
-- Index pour la table `laboratoire`
--
ALTER TABLE `laboratoire`
  ADD PRIMARY KEY (`codeLabo`);

--
-- Index pour la table `organisme`
--
ALTER TABLE `organisme`
  ADD PRIMARY KEY (`idOrg`),
  ADD UNIQUE KEY `désignation` (`désignationOrg`,`télOrg`,`faxOrg`,`emailOrg`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`idPatient`),
  ADD UNIQUE KEY `email` (`emailP`,`télP`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD KEY `RDVPAID` (`idPatient`);

--
-- Index pour la table `secrétaire`
--
ALTER TABLE `secrétaire`
  ADD PRIMARY KEY (`matriculeSecrétaire`),
  ADD UNIQUE KEY `email` (`emailS`),
  ADD KEY `SECLABID` (`codeLabo`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`numTest`),
  ADD KEY `TESTPAID` (`idPatient`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `matriculeAdministrateur` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `analyse`
--
ALTER TABLE `analyse`
  MODIFY `idAnalyse` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `convention`
--
ALTER TABLE `convention`
  MODIFY `numConv` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `organisme`
--
ALTER TABLE `organisme`
  MODIFY `idOrg` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `idPatient` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `secrétaire`
--
ALTER TABLE `secrétaire`
  MODIFY `matriculeSecrétaire` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `test`
--
ALTER TABLE `test`
  MODIFY `numTest` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `ALBID` FOREIGN KEY (`codeLabo`) REFERENCES `laboratoire` (`codeLabo`);

--
-- Contraintes pour la table `analysesconv`
--
ALTER TABLE `analysesconv`
  ADD CONSTRAINT `ANACONID` FOREIGN KEY (`id-analyse`) REFERENCES `analyse` (`idAnalyse`),
  ADD CONSTRAINT `ANACONNUM` FOREIGN KEY (`num-conv`) REFERENCES `convention` (`numConv`);

--
-- Contraintes pour la table `convention`
--
ALTER TABLE `convention`
  ADD CONSTRAINT `ConLabID` FOREIGN KEY (`codeLabo`) REFERENCES `laboratoire` (`codeLabo`),
  ADD CONSTRAINT `ConOrgID` FOREIGN KEY (`idOrg`) REFERENCES `organisme` (`idOrg`);

--
-- Contraintes pour la table `détail_test`
--
ALTER TABLE `détail_test`
  ADD CONSTRAINT `DT-TestID` FOREIGN KEY (`numTest`) REFERENCES `test` (`numTest`),
  ADD CONSTRAINT `DTAnaID` FOREIGN KEY (`idAnalyse`) REFERENCES `analyse` (`idAnalyse`);

--
-- Contraintes pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `RDVPAID` FOREIGN KEY (`idPatient`) REFERENCES `patient` (`idPatient`);

--
-- Contraintes pour la table `secrétaire`
--
ALTER TABLE `secrétaire`
  ADD CONSTRAINT `SECLABID` FOREIGN KEY (`codeLabo`) REFERENCES `laboratoire` (`codeLabo`);

--
-- Contraintes pour la table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `TESTPAID` FOREIGN KEY (`idPatient`) REFERENCES `patient` (`idPatient`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
