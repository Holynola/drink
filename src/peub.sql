-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 01 avr. 2025 à 12:38
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
-- Base de données : `peub`
--

-- --------------------------------------------------------

--
-- Structure de la table `benefice`
--

CREATE TABLE `benefice` (
  `idBf` int(11) NOT NULL,
  `serviceBf` int(11) NOT NULL COMMENT 'Lieu de service',
  `ventBf` int(11) NOT NULL COMMENT 'Inventaire',
  `boissonBf` int(3) NOT NULL COMMENT 'Boisson',
  `qteBf` int(4) NOT NULL COMMENT 'Quantité',
  `mtvBf` bigint(20) NOT NULL COMMENT 'Montant de vente',
  `mtaBf` bigint(20) NOT NULL COMMENT 'Montant d''achat',
  `datesaveBf` datetime NOT NULL COMMENT 'Date d''enregistrement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `bevanda`
--

CREATE TABLE `bevanda` (
  `idBv` int(2) NOT NULL,
  `libelleBv` varchar(50) NOT NULL COMMENT 'Libellé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bevanda`
--

INSERT INTO `bevanda` (`idBv`, `libelleBv`) VALUES
(1, 'Bière'),
(2, 'Vin'),
(3, 'Liqueur'),
(4, 'Eau'),
(5, 'Sucrerie'),
(6, 'Energie'),
(7, 'Champagne'),
(8, 'Jus'),
(9, 'Sans alcool');

-- --------------------------------------------------------

--
-- Structure de la table `boisson`
--

CREATE TABLE `boisson` (
  `idB` int(3) NOT NULL,
  `serviceB` int(1) NOT NULL COMMENT 'Lieu de service',
  `imageB` varchar(150) NOT NULL COMMENT 'Image de la boisson',
  `designB` varchar(100) NOT NULL COMMENT 'Désignation',
  `prixvB` int(10) NOT NULL COMMENT 'Prix de vente',
  `typeB` int(2) NOT NULL COMMENT 'Type de boisson',
  `contenantB` int(1) NOT NULL COMMENT 'Type de contenant',
  `emballageB` int(1) NOT NULL COMMENT 'Type d''emballage',
  `nbreB` int(3) NOT NULL COMMENT 'Nombre de bouteilles par casier/carton',
  `kitB` varchar(3) NOT NULL COMMENT 'Kit',
  `prixkitB` int(10) DEFAULT NULL COMMENT 'Prix du kit',
  `btekitB` int(2) DEFAULT NULL COMMENT 'Bouteilles par kit',
  `statutB` varchar(3) NOT NULL COMMENT 'Statut',
  `savebyB` int(2) NOT NULL COMMENT 'Enregistré par',
  `datesaveB` datetime NOT NULL COMMENT 'Date d''enregistrement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idC` int(11) NOT NULL,
  `serviceC` int(1) NOT NULL COMMENT 'Lieu de service',
  `mttC` bigint(20) NOT NULL COMMENT 'Montant total',
  `mtrC` bigint(20) NOT NULL COMMENT 'Montant réglé',
  `fourC` int(2) NOT NULL COMMENT 'Fournisseur',
  `factureC` varchar(10) DEFAULT NULL COMMENT 'Facture',
  `madebyC` int(2) NOT NULL COMMENT 'Effectuée par',
  `datemadeC` date NOT NULL COMMENT 'Date de commande',
  `savebyC` int(2) NOT NULL COMMENT 'Enregistrée par',
  `pointC` int(11) DEFAULT NULL COMMENT 'Point',
  `datesaveC` datetime NOT NULL COMMENT 'Date d''enregistrement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `consign`
--

CREATE TABLE `consign` (
  `idCs` int(11) NOT NULL,
  `serviceCs` int(1) NOT NULL COMMENT 'Lieu de service',
  `boissonCs` int(3) NOT NULL COMMENT 'Boisson',
  `nbrebteCs` int(3) NOT NULL COMMENT 'Nombre de bouteilles',
  `detailCs` varchar(200) DEFAULT NULL COMMENT 'Détails',
  `savebyCs` int(2) NOT NULL COMMENT 'Enregistré par',
  `datesaveCs` datetime NOT NULL COMMENT 'Date d''enregistrement',
  `statutCs` varchar(2) NOT NULL COMMENT 'Récupéré par le Client',
  `madebyCs` int(2) DEFAULT NULL COMMENT 'récupéré par',
  `datemadeCs` datetime DEFAULT NULL COMMENT 'Date de récupération'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenant`
--

CREATE TABLE `contenant` (
  `idCt` int(1) NOT NULL,
  `libelleCt` varchar(25) NOT NULL COMMENT 'Libellé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contenant`
--

INSERT INTO `contenant` (`idCt`, `libelleCt`) VALUES
(1, 'Bouteille'),
(2, 'Canette');

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

CREATE TABLE `depense` (
  `idDp` int(11) NOT NULL,
  `serviceDp` int(1) NOT NULL COMMENT 'Lieu de service',
  `mttDp` bigint(20) NOT NULL COMMENT 'Montant dépensé',
  `mtrDp` bigint(20) NOT NULL COMMENT 'Montant réglé',
  `detailDp` varchar(255) NOT NULL COMMENT 'Détails',
  `madebyDp` int(2) NOT NULL COMMENT 'Effectuée par',
  `datemadeDp` date NOT NULL COMMENT 'Date de dépense',
  `savebyDp` int(2) NOT NULL COMMENT 'Enregistré par',
  `pointDp` int(11) DEFAULT NULL COMMENT 'Point',
  `datesaveDp` datetime NOT NULL COMMENT 'Date d''enregistrement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `emballage`
--

CREATE TABLE `emballage` (
  `idEm` int(1) NOT NULL,
  `libelleEm` varchar(25) NOT NULL COMMENT 'Libellé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emballage`
--

INSERT INTO `emballage` (`idEm`, `libelleEm`) VALUES
(1, 'Casier'),
(2, 'Carton');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `idF` int(2) NOT NULL,
  `nomF` varchar(100) NOT NULL COMMENT 'Nom du fournisseur',
  `localF` varchar(150) NOT NULL COMMENT 'Localisation',
  `numF` varchar(10) NOT NULL COMMENT 'Contact',
  `statutF` varchar(3) NOT NULL COMMENT 'Statut',
  `savebyF` int(2) NOT NULL COMMENT 'Enregistré par',
  `datesaveF` datetime NOT NULL COMMENT 'Date d''enregistrement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inventory`
--

CREATE TABLE `inventory` (
  `idV` int(11) NOT NULL,
  `serviceV` int(1) NOT NULL COMMENT 'Lieu de service',
  `mttV` bigint(20) NOT NULL COMMENT 'Montant recette',
  `mtrV` bigint(20) NOT NULL COMMENT 'Montant reçu',
  `detailV` varchar(255) DEFAULT NULL COMMENT 'Détails',
  `getbyV` int(2) DEFAULT NULL COMMENT 'Caissier/ière',
  `madebyV` int(2) NOT NULL COMMENT 'Effectué par',
  `datemadeV` date NOT NULL COMMENT 'Date d''inventaire',
  `savebyV` int(2) NOT NULL COMMENT 'Enregistré par',
  `pointV` int(11) DEFAULT NULL COMMENT 'Point',
  `datesaveV` datetime NOT NULL COMMENT 'Date d''enregistrement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `IdLg` int(11) NOT NULL,
  `serviceLg` int(1) NOT NULL COMMENT 'Lieu de service',
  `userLg` int(2) NOT NULL COMMENT 'Utilisateur',
  `posteLg` int(1) NOT NULL COMMENT 'Poste',
  `datesaveLg` datetime NOT NULL COMMENT 'Date d''enregistrement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `modif`
--

CREATE TABLE `modif` (
  `idM` int(11) NOT NULL,
  `tableM` varchar(20) NOT NULL COMMENT 'Table modifiée',
  `idtableM` int(11) NOT NULL COMMENT 'ID dans la table modifiée',
  `actionM` varchar(100) NOT NULL COMMENT 'Action',
  `auteurM` int(5) NOT NULL COMMENT 'Auteur',
  `datesaveM` datetime NOT NULL COMMENT 'Date de modification'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `idPay` int(11) NOT NULL,
  `servicePay` int(1) NOT NULL COMMENT 'Lieu de service',
  `idTablePay` int(11) NOT NULL COMMENT 'ID Table',
  `tablePay` varchar(30) NOT NULL COMMENT 'Table',
  `mttPay` bigint(20) NOT NULL COMMENT 'Montant payé',
  `madebyPay` int(2) NOT NULL COMMENT 'Effectué par',
  `datemadePay` date NOT NULL COMMENT 'Date de paiement',
  `savebyPay` int(2) NOT NULL COMMENT 'Enregistré par',
  `pointPay` int(11) DEFAULT NULL COMMENT 'Point',
  `datesavePay` datetime NOT NULL COMMENT 'Date d''enregistrement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

CREATE TABLE `points` (
  `idP` int(11) NOT NULL,
  `serviceP` int(1) NOT NULL COMMENT 'Lieu de service',
  `mttP` bigint(20) NOT NULL COMMENT 'Montant à recevoir',
  `mtvP` bigint(20) NOT NULL COMMENT 'Montant versé',
  `mankP` bigint(20) NOT NULL COMMENT 'Manquant',
  `observP` varchar(255) DEFAULT NULL COMMENT 'Observation',
  `getbyP` int(2) NOT NULL COMMENT 'Gérant',
  `madebyP` int(2) NOT NULL COMMENT 'Effectué par',
  `datemadeP` date NOT NULL COMMENT 'Date du point',
  `savebyP` int(2) NOT NULL COMMENT 'Enregistré par',
  `datesaveP` datetime NOT NULL COMMENT 'Date d''enregistrement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE `poste` (
  `idPo` int(1) NOT NULL,
  `libellePo` varchar(50) NOT NULL COMMENT 'Libellé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `poste`
--

INSERT INTO `poste` (`idPo`, `libellePo`) VALUES
(1, 'Propriétaire'),
(2, 'Gestionnaire'),
(3, 'Gérant(e)'),
(4, 'Caissier/ière'),
(5, 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idPr` int(11) NOT NULL,
  `servicePr` int(1) NOT NULL COMMENT 'Lieu de service',
  `ventPr` int(11) NOT NULL COMMENT 'Inventaire',
  `boissonPr` int(3) NOT NULL COMMENT 'Boisson',
  `qtePr` int(4) NOT NULL COMMENT 'Quantité',
  `mttPr` int(10) NOT NULL COMMENT 'Montant de vente',
  `datesavePr` datetime NOT NULL COMMENT 'Date d''enregistrement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

CREATE TABLE `reglement` (
  `idR` int(11) NOT NULL,
  `serviceR` int(1) NOT NULL COMMENT 'Lieu de service',
  `ventR` int(11) NOT NULL COMMENT 'Inventaire',
  `mttR` bigint(20) NOT NULL COMMENT 'Montant réglé',
  `madebyR` int(2) NOT NULL COMMENT 'Reçu par',
  `datemadeR` date NOT NULL COMMENT 'Date de reception',
  `savebyR` int(2) NOT NULL COMMENT 'Enregistré par',
  `pointR` int(11) DEFAULT NULL COMMENT 'Point',
  `datesaveR` datetime NOT NULL COMMENT 'Date d''enregistrement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `idSt` int(11) NOT NULL,
  `serviceSt` int(1) NOT NULL COMMENT 'Lieu de service',
  `BoissonSt` int(3) NOT NULL COMMENT 'Boisson',
  `cmdSt` int(11) DEFAULT NULL COMMENT 'Commande',
  `qteSt` int(4) NOT NULL COMMENT 'Quantité (Nombre de bouteilles)',
  `nbrebtleSt` int(3) DEFAULT NULL COMMENT 'Nombre de bouteilles par casier/carton',
  `nbrecarsSt` int(4) DEFAULT NULL COMMENT 'Nombre de casier/carton',
  `prixcSt` int(11) DEFAULT NULL COMMENT 'Prix du casier/carton',
  `prixaSt` int(11) DEFAULT NULL COMMENT 'Prix d''achat par bouteille',
  `savebySt` int(2) DEFAULT NULL COMMENT 'Enregistré par',
  `datesaveSt` datetime NOT NULL COMMENT 'Date d''enregistrement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idU` int(2) NOT NULL,
  `serviceU` int(1) NOT NULL COMMENT 'Lieu de service',
  `titleU` varchar(15) NOT NULL COMMENT 'Titre',
  `nomU` varchar(20) NOT NULL COMMENT 'Nom',
  `prenomsU` varchar(30) NOT NULL COMMENT 'Prénoms',
  `posteU` int(1) NOT NULL COMMENT 'Poste',
  `contactU` varchar(10) NOT NULL COMMENT 'Contact',
  `userU` varchar(30) NOT NULL COMMENT 'Identifiant',
  `passU` varchar(255) NOT NULL COMMENT 'Mot de passe',
  `statutU` varchar(3) NOT NULL COMMENT 'Statut du compte',
  `savebyU` int(2) NOT NULL COMMENT 'Enregistré par',
  `datesaveU` datetime NOT NULL COMMENT 'Date d''enregistrement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idU`, `serviceU`, `titleU`, `nomU`, `prenomsU`, `posteU`, `contactU`, `userU`, `passU`, `statutU`, `savebyU`, `datesaveU`) VALUES
(1, 3, 'mr', 'Dev', 'Appli', 5, '0710203040', 'holynola', '$2y$10$PG4h4ZRcuFFKP9DEwgIrRuIyZD/fzSm38YvgHPtfVOdHZhYiCBI0e', 'ON', 1, '2025-02-21 16:18:03'),
(2, 2, 'monsieur', 'Kouadio', 'Jean', 3, '0704154222', 'gestion', '$2y$10$AxZQXO/u8OpyVBy8ci.yX.HHADvn43f.K6UbIQd05LpSTCj.TF56G', 'ON', 1, '2025-02-21 22:52:17'),
(3, 2, 'madame', 'N\'dri', 'Adjoua', 4, '0145484848', 'aya', '$2y$10$BJuDSx9qahrxIykH.u/nSuH4UqsqjvFUK4xidLm4BNpL56A7r/CLq', 'ON', 1, '2025-02-23 09:50:00'),
(4, 2, 'monsieur', 'Kouassi', 'Yao Didier', 3, '0709077253', 'president', '$2y$10$VksaTXw2vjqfwDGmAhvkP.NA5MU.fNym/onp7NLMpEWJQX/uD0bWq', 'ON', 3, '2025-02-25 15:37:25'),
(5, 2, 'monsieur', 'Kouakou', 'Armael', 2, '0705662244', 'first', '$2y$10$cyrkeM4x3i.ZwO7j8yotFey4kqcXyfh53saaRmBEBXg/FNgEbTD5.', 'ON', 1, '2025-03-27 22:42:43');

-- --------------------------------------------------------

--
-- Structure de la table `work`
--

CREATE TABLE `work` (
  `idW` int(1) NOT NULL,
  `libelleW` varchar(25) NOT NULL COMMENT 'Libellé',
  `lieuW` varchar(100) NOT NULL COMMENT 'Lieu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `benefice`
--
ALTER TABLE `benefice`
  ADD PRIMARY KEY (`idBf`);

--
-- Index pour la table `bevanda`
--
ALTER TABLE `bevanda`
  ADD PRIMARY KEY (`idBv`);

--
-- Index pour la table `boisson`
--
ALTER TABLE `boisson`
  ADD PRIMARY KEY (`idB`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idC`);

--
-- Index pour la table `consign`
--
ALTER TABLE `consign`
  ADD PRIMARY KEY (`idCs`);

--
-- Index pour la table `contenant`
--
ALTER TABLE `contenant`
  ADD PRIMARY KEY (`idCt`);

--
-- Index pour la table `depense`
--
ALTER TABLE `depense`
  ADD PRIMARY KEY (`idDp`);

--
-- Index pour la table `emballage`
--
ALTER TABLE `emballage`
  ADD PRIMARY KEY (`idEm`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`idF`);

--
-- Index pour la table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`idV`);

--
-- Index pour la table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`IdLg`);

--
-- Index pour la table `modif`
--
ALTER TABLE `modif`
  ADD PRIMARY KEY (`idM`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`idPay`);

--
-- Index pour la table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`idP`);

--
-- Index pour la table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`idPo`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idPr`);

--
-- Index pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD PRIMARY KEY (`idR`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idSt`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idU`);

--
-- Index pour la table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`idW`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `benefice`
--
ALTER TABLE `benefice`
  MODIFY `idBf` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bevanda`
--
ALTER TABLE `bevanda`
  MODIFY `idBv` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `boisson`
--
ALTER TABLE `boisson`
  MODIFY `idB` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `idC` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `consign`
--
ALTER TABLE `consign`
  MODIFY `idCs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contenant`
--
ALTER TABLE `contenant`
  MODIFY `idCt` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `depense`
--
ALTER TABLE `depense`
  MODIFY `idDp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `emballage`
--
ALTER TABLE `emballage`
  MODIFY `idEm` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `idF` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `idV` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `logs`
--
ALTER TABLE `logs`
  MODIFY `IdLg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `modif`
--
ALTER TABLE `modif`
  MODIFY `idM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `idPay` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `points`
--
ALTER TABLE `points`
  MODIFY `idP` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `poste`
--
ALTER TABLE `poste`
  MODIFY `idPo` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `idPr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reglement`
--
ALTER TABLE `reglement`
  MODIFY `idR` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `idSt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idU` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `work`
--
ALTER TABLE `work`
  MODIFY `idW` int(1) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
