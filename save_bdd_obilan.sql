-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 30 sep. 2018 à 03:10
-- Version du serveur :  5.5.57-MariaDB
-- Version de PHP :  5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `obilan`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_admin_adm`
--

CREATE TABLE `t_admin_adm` (
  `adm_id` int(11) NOT NULL,
  `adm_pseudo` varchar(32) NOT NULL,
  `adm_mdp` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_admin_adm`
--

INSERT INTO `t_admin_adm` (`adm_id`, `adm_pseudo`, `adm_mdp`) VALUES
(1, 'admin', '06f5366a7c906b343d7eafe764963d4cf094c47b');

-- --------------------------------------------------------

--
-- Structure de la table `t_compte_cpt`
--

CREATE TABLE `t_compte_cpt` (
  `cpt_id` int(11) NOT NULL,
  `cpt_pseudo` varchar(32) NOT NULL,
  `cpt_mdp` varchar(64) NOT NULL,
  `cpt_mail` varchar(64) NOT NULL,
  `cpt_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_compte_cpt`
--

INSERT INTO `t_compte_cpt` (`cpt_id`, `cpt_pseudo`, `cpt_mdp`, `cpt_mail`, `cpt_date`) VALUES
(1, 'thetest', '5f2bb42e3a738728bae4dc3ef2783610f4b9275b', 'test@thetest.fr', '2018-09-19'),
(2, 'thetest2', '5f2bb42e3a738728bae4dc3ef2783610f4b9275b', 'test@thetest.fr', '2018-09-19'),
(8, 'Ociraider', 'ba6a77734de1bc36fb8319f546a3bba884bcbfb2', 'yoann.zaragosa@gmail.com', '2018-09-18'),
(9, 'hyperlunchboxguy', '24267ece14fc015eeaa9200debc9fcb38e066972', 'fabien.nicolas@gmail.com', '2018-09-18'),
(10, 'My Angel Yarride', '3cd571e83a5fc21877d5cf47960fef8539edd607', 'gael.cabioch@gmail.com', '2018-09-18'),
(11, 'SORS TA LOCHE', '49d09147215523b03b8ee8c7d24480045fde9819', 'quentin.marc@rennes-sb.com', '2018-09-18'),
(12, 'JohnnyOBreizhIle', 'f3008e97adf91babac033237a268585383c98b8e', 'mat.leforestier@gmail.com', '2018-09-18'),
(13, 'Geno', '3e632d30375ae2593723b9fc3f59b841e6771017', 'clement.gourcuff@gmail.com', '2018-09-18'),
(14, 'DAB ONYOURCORPSE', 'dbce7750b54add8388e6644762edf91b855dc8fb', 'tachiaruu@gmail.com', '2018-09-18'),
(15, 'Zwei Zero', '390710b30ecdb719e5e0814f5bb40b0c677ddee3', 'lefourngaetan@gmail.com', '2018-09-18'),
(16, 'Stonz', '6a49e0cd82b784b271c3cbf2b5004a0ba7e30960', 'max090@hotmail.fr', '2018-09-19'),
(17, 'iCrew', 'c5d79bc67c1c9aa2b24619e97ebae5a102412fbe', 'pgmdu29200@hotmail.com', '2018-09-19'),
(18, 'NAT\'', '11b483279f8567f29854d15b251079c0038408e0', 'jeanjeandu29200@gmail.com', '2018-09-19'),
(19, 'Alexzec', '892c98a33648e2d7e72e99429af3822c3a117fe8', 'alexzec56@gmail.com', '2018-09-19'),
(20, 'FeelGood', '6f2861281d647b0e8bc04d866595ae387a021651', 'alex.stasse@gmail.com', '2018-09-19'),
(21, 'spacenem', 'b03550e0c3b9feb132f44bb7be2eee8d3df5ce40', 'sly.thunders@gmail.com', '2018-09-19'),
(22, 'Pello El Dozo', 'ce07bd056aef5f865fb28a78529b7ce2f08c7e37', 'jolan.pello@gmail.com', '2018-09-19'),
(23, 'alex35', 'e7d863a3bbd27ec75935ca6d4ec332bb26601022', 'chevalier.alex2@orange.fr', '2018-09-19'),
(24, 'RsK', '4c39b4a21bac405ed585b3fcff95fba9d4836888', 'dima.p29@hotmail.com', '2018-09-19'),
(25, 'PRED', '9b6863e4022613d7db0daaa4977051765bde047f', 'contactpredcs@gmail.com', '2018-09-19'),
(26, 'JiMnZ', '2492e8c7fb16527eb51bb45a7ae3de12b62e1854', 'romain.jimenez29@gmail.com', '2018-09-19'),
(27, 'Zedju', 'f6e3150e6f558151694ee9e6aecffc78ebbd79fc', 'arthur.ln@hotmail.fr', '2018-09-19'),
(28, 'MichelCastr0', '62c200d019f80e9527d851d2280ea80f3abdaaeb', 'hugo293092@gmail.com', '2018-09-19'),
(29, 'ValTiger', 'd7536cd1047ae1fbbf0073e55b145e7eb1f5f10f', 'valtiger.pro@gmail.com', '2018-09-19'),
(30, 'Jamy Hollow', '07895ef6bc840a8375c5e48e8ff8a773281c1015', 'hal314@hotmail.fr', '2018-09-20'),
(31, 'Jaaws', '151dc14d9b0f55c881aa4ff1eb1863dd2a03bb64', 'clement.stephant@outlook.fr', '2018-09-20'),
(32, 'Torii', 'a6427cbe9cd210de31dce898369401f4953779f5', 'louissalque01@hotmail.fr', '2018-09-20'),
(33, 'Nono', '79a903061a85c3133d42f1e66fb48f97c83756af', 'norbertparker@hotmail.fr', '2018-09-21'),
(34, 'PunisheRwZz', '00c7945fc66e2a5a8517c82cb53e2a575c626932', 'jimerdu29@hotmail.fr', '2018-09-21'),
(35, 'BlueSky', 'b297a2a6120cf60f85608e48c22a4126ba383ca9', 'flowlb29@gmail.com', '2018-09-22'),
(36, 'GROUBISAUCEGOD', '4451ae61c3ab2352fd7c2c4e5b7dde09fac93fff', 'iwaterwave@gmail.com', '2018-09-22'),
(37, 'Fack spectros', '04dfaccb320f6bec8087db9fe02ec3f0909b6363', 'Gabrielmorand@gmail.com', '2018-09-22'),
(38, 'z1player', '15f984b5cc2cb4bb131995513725050e352249ea', 'kryzzeryt@gmail.com', '2018-09-22'),
(39, 'Il Maestro', 'b3f594e10a9edcf5413cf1190121d45078c62290', 'jerems91@hotmail.fr', '2018-09-22'),
(40, 'Star Guard Urgot', '9267828507b317043229e68dcfb8483fa5ee0e3f', 'freezywanted29@gmail.com', '2018-09-23'),
(41, 'tadtom', 'fc36ca676cd7bd33c24df1bf4141f31e3320b696', 'tomkimsour@gmail.com', '2018-09-27'),
(42, 'Cairn', '480b30a3ee3bfaf51e41da9e9276c0583e909bc0', 'vincent.maguer29@orange.fr', '2018-09-27'),
(43, 'Badkaneki', '365127b303ec9f144829c97fe5326b4af6582e4a', 'adrien.lgl29@gmail.com', '2018-09-27'),
(44, 'Alicia Vikander', '824c588cf90c3d58f78dd6b8454386e937da731f', 'samuel.luguern@gmail.com', '2018-09-27'),
(45, 'Nymeloss', '223773b5ee66d0dbe08574bcd67c7ff79630235a', 'alexandre.lorric@free.fr', '2018-09-27'),
(46, 'FISHR', '529765cfd5596f55218652991812823c28b7e605', 'bongouvertaxel@gmail.com', '2018-09-28'),
(47, 'tukifpointcom', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'mehdi.inouss@gmail.com', '2018-09-29'),
(48, 'Spacîo', '52da51e01a6288aaef2a6b8643db52aa815810b2', 'alexpolard@orange.fr', '2018-09-29');

-- --------------------------------------------------------

--
-- Structure de la table `t_equipe_equ`
--

CREATE TABLE `t_equipe_equ` (
  `equ_id` int(11) NOT NULL,
  `equ_nom` varchar(32) NOT NULL,
  `equ_acronyme` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_equipe_equ`
--

INSERT INTO `t_equipe_equ` (`equ_id`, `equ_nom`, `equ_acronyme`) VALUES
(1, '', ''),
(2, 'testequ', 'TE'),
(5, 'Hearthstone', 'HS'),
(6, 'Dab obligatoire, Zéro objectif ', 'DOZO'),
(7, 'FritesAuFourSalées', 'FAFS'),
(8, 'TEAMGROUBI', 'GIBI'),
(9, 'Bongocat', 'BONG'),
(10, 'Zephyr', 'zep'),
(11, 'EpiLep\'GeeK', 'EL\'GK'),
(12, 'Zephyr Ac-Mix', 'Zephyr'),
(13, 'Mangemorts', 'M.'),
(14, 'LoLFR', 'LoLFR'),
(15, 'FC International', 'FC INT');

-- --------------------------------------------------------

--
-- Structure de la table `t_jeu_jeu`
--

CREATE TABLE `t_jeu_jeu` (
  `jeu_id` int(11) NOT NULL,
  `jeu_nom` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_jeu_jeu`
--

INSERT INTO `t_jeu_jeu` (`jeu_id`, `jeu_nom`) VALUES
(1, 'League of Legends'),
(2, 'Hearthstone'),
(3, 'Counter-Strike');

-- --------------------------------------------------------

--
-- Structure de la table `t_joint_equ_jeu`
--

CREATE TABLE `t_joint_equ_jeu` (
  `jeu_id` int(11) NOT NULL,
  `equ_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_joint_equ_jeu`
--

INSERT INTO `t_joint_equ_jeu` (`jeu_id`, `equ_id`) VALUES
(1, 6),
(1, 8),
(1, 9),
(1, 11),
(1, 14),
(2, 5),
(3, 7),
(3, 10),
(3, 12),
(3, 13),
(1, 15);

-- --------------------------------------------------------

--
-- Structure de la table `t_joint_piz_jou`
--

CREATE TABLE `t_joint_piz_jou` (
  `piz_id` int(11) NOT NULL,
  `jou_id` int(11) NOT NULL,
  `piz_date` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_joint_piz_jou`
--

INSERT INTO `t_joint_piz_jou` (`piz_id`, `jou_id`, `piz_date`) VALUES
(1, 2, 'VS1'),
(2, 2, 'VS2'),
(2, 2, 'SM1');

-- --------------------------------------------------------

--
-- Structure de la table `t_joueur_jou`
--

CREATE TABLE `t_joueur_jou` (
  `jou_id` int(11) NOT NULL,
  `jou_nom` varchar(32) NOT NULL,
  `jou_prenom` varchar(32) NOT NULL,
  `jou_telephone` varchar(32) DEFAULT NULL,
  `jou_capitaine` int(11) NOT NULL,
  `equ_id` int(11) NOT NULL,
  `cpt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_joueur_jou`
--

INSERT INTO `t_joueur_jou` (`jou_id`, `jou_nom`, `jou_prenom`, `jou_telephone`, `jou_capitaine`, `equ_id`, `cpt_id`) VALUES
(1, 'nomtest', 'pretest', '0622222222', 1, 2, 1),
(2, 'nomtest', 'pretest', '0622222222', 0, 2, 2),
(8, 'ZARAGOSA', 'Yoann', '0669645960', 1, 6, 8),
(9, 'Nicolas ', 'Fabien', '0786704009', 0, 6, 9),
(10, 'Cabioch', 'Gaël', '0603544805', 1, 7, 10),
(11, 'Marc', 'Quentin', '0620317438', 1, 8, 11),
(12, 'Leforestier', 'Mathieu', '0679269023', 1, 9, 12),
(13, 'Gourcuff', 'Clément', '0699718532', 0, 9, 13),
(14, 'Demarecaux', 'Vincent', '0659685799', 0, 9, 14),
(15, 'LE FOURN', 'Gaëtan', '0659941389', 0, 9, 15),
(16, 'Vivot', 'Maxime', '0644250503', 1, 10, 16),
(17, 'MOINE', 'Jérémy', '0646883863', 0, 10, 17),
(18, 'BALAY', 'Hugo', '0689292739', 0, 10, 18),
(19, 'KERUZEC', 'Alexandre', '0604183923', 0, 10, 19),
(20, 'STASSE', 'Alexandre', '0631184765', 0, 10, 20),
(21, 'brenner', 'vincent', '0603401028', 1, 11, 21),
(22, 'Pello', 'Jolan', '0659547868', 0, 11, 22),
(23, 'Chevalier', 'Alex', '0688003171', 0, 5, 23),
(24, 'Pichon', 'Dima', '0778804325', 1, 12, 24),
(25, 'Le Pape', 'Martin', '0671696544', 0, 12, 25),
(26, 'Jimenez', 'Romain', '0648550630', 1, 13, 26),
(27, 'Le Nader', 'Arthur', '0677603913', 0, 13, 27),
(28, 'cloerec', 'hugo', '0670575377', 0, 12, 28),
(29, 'Flageul', 'Valentin', '0684235126', 0, 12, 29),
(30, 'Halleguen', 'Pierre-Yves', '0673786997', 1, 14, 30),
(31, 'STEPHANT', 'Clément', '0630239463', 0, 5, 31),
(32, 'Salque', 'Louis', '0636223943', 0, 12, 32),
(33, 'PARKER', 'Norbert', '0632833501', 0, 12, 33),
(34, 'Jimenez', 'Sébastien', '0782525627', 0, 13, 34),
(35, 'LE BRAS', 'Florian', '0760762508', 0, 9, 35),
(36, 'Le Fur', 'Brieuc', '0637328866', 0, 8, 36),
(37, 'Morand', 'Gabriel', '0602229350', 0, 8, 37),
(38, 'HOREL', 'Nicolas', '0666173981', 0, 13, 38),
(39, 'Roy', 'jeremy', '0684686308', 0, 13, 39),
(40, 'SIMON', 'Meriadeg', '0658855298', 0, 11, 40),
(41, 'UNG', 'Thomas', '0609359627', 1, 15, 41),
(42, 'Maguer', 'Vincent', '0677842173', 0, 15, 42),
(43, 'Le Gall', 'Adrien', '0608729037', 0, 15, 43),
(44, 'Luguern', 'Samuel', '0698494429', 0, 14, 44),
(45, 'Lorric', 'Alexandre', '0761251289', 0, 11, 45),
(46, 'Bongouvert', 'Axel', '0778049217', 0, 15, 46),
(47, 'Inouss', 'Mehdi', '0659438425', 0, 8, 47),
(48, 'Polard', 'Alexandre', '0298441808', 0, 9, 48);

-- --------------------------------------------------------

--
-- Structure de la table `t_pizza_piz`
--

CREATE TABLE `t_pizza_piz` (
  `piz_id` int(11) NOT NULL,
  `piz_nom` varchar(32) NOT NULL,
  `piz_prix` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_pizza_piz`
--

INSERT INTO `t_pizza_piz` (`piz_id`, `piz_nom`, `piz_prix`) VALUES
(1, 'test1', '10.00'),
(2, 'test2', '16.80');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_admin_adm`
--
ALTER TABLE `t_admin_adm`
  ADD PRIMARY KEY (`adm_id`);

--
-- Index pour la table `t_compte_cpt`
--
ALTER TABLE `t_compte_cpt`
  ADD PRIMARY KEY (`cpt_id`);

--
-- Index pour la table `t_equipe_equ`
--
ALTER TABLE `t_equipe_equ`
  ADD PRIMARY KEY (`equ_id`);

--
-- Index pour la table `t_jeu_jeu`
--
ALTER TABLE `t_jeu_jeu`
  ADD PRIMARY KEY (`jeu_id`);

--
-- Index pour la table `t_joint_equ_jeu`
--
ALTER TABLE `t_joint_equ_jeu`
  ADD KEY `FK_ASS_2` (`jeu_id`),
  ADD KEY `FK_ASS_3` (`equ_id`);

--
-- Index pour la table `t_joint_piz_jou`
--
ALTER TABLE `t_joint_piz_jou`
  ADD KEY `FK_ASS_5` (`piz_id`),
  ADD KEY `FK_ASS_6` (`jou_id`);

--
-- Index pour la table `t_joueur_jou`
--
ALTER TABLE `t_joueur_jou`
  ADD PRIMARY KEY (`jou_id`),
  ADD KEY `t_compte_cpt_FK` (`cpt_id`),
  ADD KEY `t_equipe_equ_FK` (`equ_id`);

--
-- Index pour la table `t_pizza_piz`
--
ALTER TABLE `t_pizza_piz`
  ADD PRIMARY KEY (`piz_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_admin_adm`
--
ALTER TABLE `t_admin_adm`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_compte_cpt`
--
ALTER TABLE `t_compte_cpt`
  MODIFY `cpt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `t_equipe_equ`
--
ALTER TABLE `t_equipe_equ`
  MODIFY `equ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `t_jeu_jeu`
--
ALTER TABLE `t_jeu_jeu`
  MODIFY `jeu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_joueur_jou`
--
ALTER TABLE `t_joueur_jou`
  MODIFY `jou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `t_pizza_piz`
--
ALTER TABLE `t_pizza_piz`
  MODIFY `piz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_joint_equ_jeu`
--
ALTER TABLE `t_joint_equ_jeu`
  ADD CONSTRAINT `FK_ASS_3` FOREIGN KEY (`equ_id`) REFERENCES `t_equipe_equ` (`equ_id`),
  ADD CONSTRAINT `FK_ASS_2` FOREIGN KEY (`jeu_id`) REFERENCES `t_jeu_jeu` (`jeu_id`);

--
-- Contraintes pour la table `t_joint_piz_jou`
--
ALTER TABLE `t_joint_piz_jou`
  ADD CONSTRAINT `FK_ASS_6` FOREIGN KEY (`jou_id`) REFERENCES `t_joueur_jou` (`jou_id`),
  ADD CONSTRAINT `FK_ASS_5` FOREIGN KEY (`piz_id`) REFERENCES `t_pizza_piz` (`piz_id`);

--
-- Contraintes pour la table `t_joueur_jou`
--
ALTER TABLE `t_joueur_jou`
  ADD CONSTRAINT `t_equipe_equ_FK` FOREIGN KEY (`equ_id`) REFERENCES `t_equipe_equ` (`equ_id`),
  ADD CONSTRAINT `t_compte_cpt_FK` FOREIGN KEY (`cpt_id`) REFERENCES `t_compte_cpt` (`cpt_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
