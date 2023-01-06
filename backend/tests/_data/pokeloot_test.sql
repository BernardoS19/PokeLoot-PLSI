-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 05, 2023 at 11:53 AM
-- Server version: 8.0.27
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pokeloot_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1672914339),
('avaliador', '2', 1672914549),
('avaliador', '4', 1672914584),
('cliente', '3', 1672914493),
('cliente', '5', 1672914712);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1672914339, 1672914339),
('avaliador', 1, NULL, NULL, NULL, 1672914339, 1672914339),
('cliente', 1, NULL, NULL, NULL, 1672914339, 1672914339),
('createCarta', 2, 'Cria uma Carta', NULL, NULL, 1672914339, 1672914339),
('createColecao', 2, 'Cria uma Colecao', NULL, NULL, 1672914339, 1672914339),
('createElemento', 2, 'Cria um elemento de Carta', NULL, NULL, 1672914339, 1672914339),
('createEvento', 2, 'Cria um evento', NULL, NULL, 1672914339, 1672914339),
('createPedido', 2, 'Cria um Pedido', NULL, NULL, 1672914339, 1672914339),
('createPerfil', 2, 'Cria um perfil', NULL, NULL, 1672914339, 1672914339),
('createTipo', 2, 'Cria um tipo de carta', NULL, NULL, 1672914339, 1672914339),
('createUser', 2, 'Criar um utilizador', NULL, NULL, 1672914339, 1672914339),
('deleteCarta', 2, 'Elimina uma Carta', NULL, NULL, 1672914339, 1672914339),
('deleteColecao', 2, 'Elimina uma Colecao', NULL, NULL, 1672914339, 1672914339),
('deleteElemento', 2, 'Elimina um elemento de Carta', NULL, NULL, 1672914339, 1672914339),
('deleteEvento', 2, 'Elimina um Evento', NULL, NULL, 1672914339, 1672914339),
('deletePedido', 2, 'Elimina um Pedido', NULL, NULL, 1672914339, 1672914339),
('deleteTipo', 2, 'Elimina um Tipo de Carta', NULL, NULL, 1672914339, 1672914339),
('deleteUser', 2, 'Elimina um utilizador', NULL, NULL, 1672914339, 1672914339),
('readCarta', 2, 'Ler uma Carta', NULL, NULL, 1672914339, 1672914339),
('readColecao', 2, 'Ler uma Colecao', NULL, NULL, 1672914339, 1672914339),
('readElemento', 2, 'Ler um elemento de Carta', NULL, NULL, 1672914339, 1672914339),
('readEvento', 2, 'Ler um evento', NULL, NULL, 1672914339, 1672914339),
('readPedido', 2, 'ler um Pedido', NULL, NULL, 1672914339, 1672914339),
('readTipo', 2, 'Ler um tipo de carta', NULL, NULL, 1672914339, 1672914339),
('readUser', 2, 'Ler um utilizador', NULL, NULL, 1672914339, 1672914339),
('updateCarta', 2, 'Altera uma Carta', NULL, NULL, 1672914339, 1672914339),
('updateColecao', 2, 'Altera uma colecao', NULL, NULL, 1672914339, 1672914339),
('updateElemento', 2, 'Altera um elemento de Carta', NULL, NULL, 1672914339, 1672914339),
('updateEvento', 2, 'Altera um evento', NULL, NULL, 1672914339, 1672914339),
('updatePedido', 2, 'Altera um Pedido', NULL, NULL, 1672914339, 1672914339),
('updatePerfil', 2, 'Altera um perfil', NULL, NULL, 1672914339, 1672914339),
('updateTipo', 2, 'Altera um tipo de carta', NULL, NULL, 1672914339, 1672914339),
('updateUser', 2, 'Alterar um utilizador', NULL, NULL, 1672914339, 1672914339);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'createCarta'),
('admin', 'createColecao'),
('admin', 'createElemento'),
('admin', 'createEvento'),
('admin', 'createPedido'),
('avaliador', 'createPedido'),
('admin', 'createTipo'),
('admin', 'createUser'),
('admin', 'deleteCarta'),
('admin', 'deleteColecao'),
('admin', 'deleteElemento'),
('admin', 'deleteEvento'),
('admin', 'deletePedido'),
('avaliador', 'deletePedido'),
('admin', 'deleteTipo'),
('admin', 'deleteUser'),
('admin', 'readCarta'),
('avaliador', 'readCarta'),
('cliente', 'readCarta'),
('admin', 'readColecao'),
('admin', 'readElemento'),
('avaliador', 'readElemento'),
('cliente', 'readElemento'),
('admin', 'readEvento'),
('admin', 'readPedido'),
('avaliador', 'readPedido'),
('admin', 'readTipo'),
('avaliador', 'readTipo'),
('cliente', 'readTipo'),
('admin', 'readUser'),
('admin', 'updateCarta'),
('avaliador', 'updateCarta'),
('admin', 'updateColecao'),
('admin', 'updateElemento'),
('admin', 'updateEvento'),
('admin', 'updatePedido'),
('avaliador', 'updatePedido'),
('cliente', 'updatePerfil'),
('admin', 'updateTipo'),
('admin', 'updateUser');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `baralho`
--

DROP TABLE IF EXISTS `baralho`;
CREATE TABLE IF NOT EXISTS `baralho` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `fk_baralho_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `baralho_carta`
--

DROP TABLE IF EXISTS `baralho_carta`;
CREATE TABLE IF NOT EXISTS `baralho_carta` (
  `baralho_id` int NOT NULL,
  `carta_id` int NOT NULL,
  PRIMARY KEY (`baralho_id`,`carta_id`),
  KEY `fk_baralho_has_carta_carta1_idx` (`carta_id`),
  KEY `fk_baralho_has_carta_baralho1_idx` (`baralho_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carta`
--

DROP TABLE IF EXISTS `carta`;
CREATE TABLE IF NOT EXISTS `carta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `preco` decimal(8,2) NOT NULL,
  `descricao` text NOT NULL,
  `verificado` tinyint NOT NULL DEFAULT '0',
  `imagem_id` int NOT NULL,
  `tipo_id` int NOT NULL,
  `elemento_id` int NOT NULL,
  `colecao_id` int NOT NULL,
  PRIMARY KEY (`id`,`imagem_id`,`tipo_id`,`elemento_id`,`colecao_id`),
  UNIQUE KEY `imagem_id_UNIQUE` (`imagem_id`),
  KEY `fk_carta_imagem1_idx` (`imagem_id`),
  KEY `fk_carta_tipo1_idx` (`tipo_id`),
  KEY `fk_carta_elemento1_idx` (`elemento_id`),
  KEY `fk_carta_colecao1_idx` (`colecao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `carta`
--

INSERT INTO `carta` (`id`, `nome`, `preco`, `descricao`, `verificado`, `imagem_id`, `tipo_id`, `elemento_id`, `colecao_id`) VALUES
(1, 'Bulbasaur', '0.99', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac elit et risus vehicula scelerisque. Praesent aliquet pretium tempor. Phasellus fermentum urna tortor, eget finibus turpis molestie ac.', 0, 1, 1, 1, 1),
(2, 'Cubone', '2.70', 'Donec dapibus sed ante nec posuere. In hac habitasse platea dictumst. Praesent finibus ante id nisl porttitor, at molestie ante suscipit.', 1, 2, 1, 6, 1),
(3, 'Squirtle', '1.70', 'Proin blandit tristique pharetra. Nulla quis pretium ipsum. Fusce non tellus justo. Cras risus tellus, elementum et diam sit amet, consequat volutpat justo.', 0, 3, 1, 3, 1),
(4, 'Ivysaur', '2.30', 'Ut ornare dui quis enim consectetur pulvinar. Quisque tempus elit lacus. Pellentesque rhoncus quis justo id blandit. ', 0, 4, 1, 1, 2),
(5, 'Mr. Briney’s Compassion', '1.50', 'You can play only one Supporter card each turn. When you play this card, put it next to your Active  Pokémon. When your turn ends, discard this card. Choose 1 of your Pokémon in play (excluding Pokémon-ex). Return that Pokémon and all cards attached  to it to your hand.', 0, 5, 2, 12, 2),
(6, 'Suicune', '4.90', 'Vestibulum sit amet risus sed magna efficitur dictum. In vehicula sollicitudin iaculis. Fusce venenatis diam id orci volutpat, sit amet luctus dolor congue. Cras ultrices blandit odio, vitae pellentesque ipsum dictum id.', 0, 6, 1, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `colecao`
--

DROP TABLE IF EXISTS `colecao`;
CREATE TABLE IF NOT EXISTS `colecao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `colecao`
--

INSERT INTO `colecao` (`id`, `nome`) VALUES
(1, 'EX Team Magma vs. Team Aqua'),
(2, 'POP Series 2');

-- --------------------------------------------------------

--
-- Table structure for table `elemento`
--

DROP TABLE IF EXISTS `elemento`;
CREATE TABLE IF NOT EXISTS `elemento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `elemento`
--

INSERT INTO `elemento` (`id`, `nome`) VALUES
(1, 'Grass'),
(2, 'Fire'),
(3, 'Water'),
(4, 'Lightning'),
(5, 'Psychic'),
(6, 'Fighting'),
(7, 'Darkness'),
(8, 'Metal'),
(9, 'Colorless'),
(10, 'Fairy'),
(11, 'Dragon'),
(12, 'Treinador');

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
CREATE TABLE IF NOT EXISTS `evento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` text NOT NULL,
  `data` date NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `carta_id` int NOT NULL,
  PRIMARY KEY (`id`,`carta_id`),
  UNIQUE KEY `carta_id_UNIQUE` (`carta_id`),
  KEY `fk_evento_carta1_idx` (`carta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `evento`
--

INSERT INTO `evento` (`id`, `descricao`, `data`, `longitude`, `latitude`, `carta_id`) VALUES
(1, 'Este evento decorrerá no Jardim Luís de Camões em Leiria, sendo também o local onde se encontra a carta secreta. Boa sorte para a busca do QR Code que permite resgatar a carta.', '2023-05-19', '-8.806404057437444', '39.74451462517762', 6);

-- --------------------------------------------------------

--
-- Table structure for table `fatura`
--

DROP TABLE IF EXISTS `fatura`;
CREATE TABLE IF NOT EXISTS `fatura` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `pago` tinyint NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `fk_fatura_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fatura`
--

INSERT INTO `fatura` (`id`, `data`, `pago`, `user_id`) VALUES
(1, '2023-01-05 11:42:53', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `imagem`
--

DROP TABLE IF EXISTS `imagem`;
CREATE TABLE IF NOT EXISTS `imagem` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `imagem`
--

INSERT INTO `imagem` (`id`, `nome`) VALUES
(1, '010523105906.png'),
(2, '010523110051.png'),
(3, '010523110155.png'),
(4, '010523110441.png'),
(5, '010523110912.png'),
(6, '010523111922.png');

-- --------------------------------------------------------

--
-- Table structure for table `linha_fatura`
--

DROP TABLE IF EXISTS `linha_fatura`;
CREATE TABLE IF NOT EXISTS `linha_fatura` (
  `fatura_id` int NOT NULL,
  `carta_id` int NOT NULL,
  `preco` decimal(8,2) DEFAULT NULL,
  `verificado` tinyint DEFAULT NULL,
  PRIMARY KEY (`fatura_id`,`carta_id`),
  KEY `fk_fatura_has_carta_carta1_idx` (`carta_id`),
  KEY `fk_fatura_has_carta_fatura1_idx` (`fatura_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `linha_fatura`
--

INSERT INTO `linha_fatura` (`fatura_id`, `carta_id`, `preco`, `verificado`) VALUES
(1, 1, '0.99', 0),
(1, 3, '1.70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lista_desejo`
--

DROP TABLE IF EXISTS `lista_desejo`;
CREATE TABLE IF NOT EXISTS `lista_desejo` (
  `user_id` int NOT NULL,
  `carta_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`carta_id`),
  KEY `fk_user_has_carta_carta1_idx` (`carta_id`),
  KEY `fk_user_has_carta_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lista_desejo`
--

INSERT INTO `lista_desejo` (`user_id`, `carta_id`) VALUES
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1672914283),
('m130524_201442_init', 1672914287),
('m190124_110200_add_verification_token_column_to_user_table', 1672914287),
('m140506_102106_rbac_init', 1672914317),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1672914317),
('m180523_151638_rbac_updates_indexes_without_prefix', 1672914317),
('m200409_110543_rbac_update_mssql_trigger', 1672914317);

-- --------------------------------------------------------

--
-- Table structure for table `pedido_avaliacao`
--

DROP TABLE IF EXISTS `pedido_avaliacao`;
CREATE TABLE IF NOT EXISTS `pedido_avaliacao` (
  `user_id` int NOT NULL,
  `carta_id` int NOT NULL,
  `estado` enum('Por Autorizar','Autorizado','Avaliado','Cancelado') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `valor_avaliado` decimal(8,2) DEFAULT NULL,
  `data_avaliacao` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`carta_id`),
  KEY `fk_user_has_carta_carta2_idx` (`carta_id`),
  KEY `fk_user_has_carta_user2_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pedido_avaliacao`
--

INSERT INTO `pedido_avaliacao` (`user_id`, `carta_id`, `estado`, `valor_avaliado`, `data_avaliacao`) VALUES
(2, 2, 'Avaliado', '2.70', '2023-01-05 11:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `telefone` varchar(9) DEFAULT NULL,
  `morada` varchar(128) DEFAULT NULL,
  `cod_postal` varchar(8) DEFAULT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  KEY `fk_perfil_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `perfil`
--

INSERT INTO `perfil` (`id`, `nome`, `telefone`, `morada`, `cod_postal`, `user_id`) VALUES
(1, 'admin', NULL, NULL, NULL, 1),
(2, 'avaliador', NULL, NULL, NULL, 2),
(3, 'cliente', '939191919', 'Rua de Leiria, nº6', '2400-000', 3),
(4, 'avaliador2', NULL, NULL, NULL, 4),
(5, 'cliente2', NULL, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tipo`
--

INSERT INTO `tipo` (`id`, `nome`) VALUES
(1, 'Pokémon'),
(2, 'Treinador'),
(3, 'Energia');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', '51wOVsoSMSDMlcwbd1r7hd-21XsHwu9L', '$2y$13$rGWyDAzOoMlDr4ObMOQX5ONKZMWzN03EpWLYcsWKIMZy1s/l7viLy', NULL, 'admin@pokeloot.pt', 10, 1672914449, 1672914449, NULL),
(2, 'avaliador', 'wmSdvuhHnPTB2Y02u0Zx2oxcLBCJXb7B', '$2y$13$mkyrB0zKPmPgJvuupDmwLOYLXGNpaKaZCYTuLSfXDeAHXuCqdy0B6', NULL, 'avaliador@pokeloot.pt', 10, 1672914478, 1672914478, NULL),
(3, 'cliente', 'J85ssimjN7v2C0dq0woVB_DkvPCwkUnM', '$2y$13$YEW66X4AEsdl4/ub.8u0MuIa5/EgAeHMr8fPHnqpeR8F6aWRNyTmq', NULL, 'cliente@gmail.com', 10, 1672914493, 1672914493, NULL),
(4, 'avaliador2', 'kE_CFmxRxwQXkHIGXvNCPdblTt_mF3BH', '$2y$13$jqr..izhNmxskeEGVGWXEerxWAoCOs03TxD5fwLHV27p49Ls51QC.', NULL, 'avaliador2@pokeloot.pt', 10, 1672914584, 1672914584, NULL),
(5, 'cliente2', 'LqEuVylQnD0F9loXOwohOY67iYXMbokS', '$2y$13$dVX9aFAqPW7YEaS5Q8kSyOsEy4nQ64JRoSgblFkNLpdSMPMrRYuhO', NULL, 'cliente2@gmail.com', 10, 1672914712, 1672914712, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `baralho`
--
ALTER TABLE `baralho`
  ADD CONSTRAINT `fk_baralho_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `baralho_carta`
--
ALTER TABLE `baralho_carta`
  ADD CONSTRAINT `fk_baralho_has_carta_baralho1` FOREIGN KEY (`baralho_id`) REFERENCES `baralho` (`id`),
  ADD CONSTRAINT `fk_baralho_has_carta_carta1` FOREIGN KEY (`carta_id`) REFERENCES `carta` (`id`);

--
-- Constraints for table `carta`
--
ALTER TABLE `carta`
  ADD CONSTRAINT `fk_carta_colecao1` FOREIGN KEY (`colecao_id`) REFERENCES `colecao` (`id`),
  ADD CONSTRAINT `fk_carta_elemento1` FOREIGN KEY (`elemento_id`) REFERENCES `elemento` (`id`),
  ADD CONSTRAINT `fk_carta_imagem1` FOREIGN KEY (`imagem_id`) REFERENCES `imagem` (`id`),
  ADD CONSTRAINT `fk_carta_tipo1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`id`);

--
-- Constraints for table `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `fk_evento_carta1` FOREIGN KEY (`carta_id`) REFERENCES `carta` (`id`);

--
-- Constraints for table `fatura`
--
ALTER TABLE `fatura`
  ADD CONSTRAINT `fk_fatura_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `linha_fatura`
--
ALTER TABLE `linha_fatura`
  ADD CONSTRAINT `fk_fatura_has_carta_carta1` FOREIGN KEY (`carta_id`) REFERENCES `carta` (`id`),
  ADD CONSTRAINT `fk_fatura_has_carta_fatura1` FOREIGN KEY (`fatura_id`) REFERENCES `fatura` (`id`);

--
-- Constraints for table `lista_desejo`
--
ALTER TABLE `lista_desejo`
  ADD CONSTRAINT `fk_user_has_carta_carta1` FOREIGN KEY (`carta_id`) REFERENCES `carta` (`id`),
  ADD CONSTRAINT `fk_user_has_carta_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `pedido_avaliacao`
--
ALTER TABLE `pedido_avaliacao`
  ADD CONSTRAINT `fk_user_has_carta_carta2` FOREIGN KEY (`carta_id`) REFERENCES `carta` (`id`),
  ADD CONSTRAINT `fk_user_has_carta_user2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `fk_perfil_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
