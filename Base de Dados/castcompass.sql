-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 12-Nov-2024 às 12:07
-- Versão do servidor: 8.2.0
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `castcompass`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '2', 1731412739);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1731412739, 1731412739),
('loginBO', 2, 'Login to the BackOffice', NULL, NULL, 1731412739, 1731412739);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'loginBO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinhocompra`
--

DROP TABLE IF EXISTS `carrinhocompra`;
CREATE TABLE IF NOT EXISTS `carrinhocompra` (
  `id` int NOT NULL,
  `profileID` int NOT NULL,
  `dataCompra` date NOT NULL,
  `valorTotal` decimal(10,2) NOT NULL,
  `quantidade` int NOT NULL,
  `metodoExpedicaoID` int NOT NULL,
  `metodoPagamentoID` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profileID` (`profileID`),
  KEY `metodoExpedicaoID` (`metodoExpedicaoID`),
  KEY `metodoPagamentoID` (`metodoPagamentoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `genero` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fatura`
--

DROP TABLE IF EXISTS `fatura`;
CREATE TABLE IF NOT EXISTS `fatura` (
  `id` int NOT NULL,
  `carrinhoID` int NOT NULL,
  `valorTotal` decimal(10,2) NOT NULL,
  `ivaTotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `carrinhoID` (`carrinhoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorito`
--

DROP TABLE IF EXISTS `favorito`;
CREATE TABLE IF NOT EXISTS `favorito` (
  `id` int NOT NULL,
  `profileID` int NOT NULL,
  `produtoID` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profileID` (`profileID`),
  KEY `produtoID` (`produtoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemscarrinho`
--

DROP TABLE IF EXISTS `itemscarrinho`;
CREATE TABLE IF NOT EXISTS `itemscarrinho` (
  `id` int NOT NULL,
  `carrinhoID` int NOT NULL,
  `produtoID` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `quantidade` int NOT NULL,
  `valorTotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `carrinhoID` (`carrinhoID`),
  KEY `produtoID` (`produtoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `iva`
--

DROP TABLE IF EXISTS `iva`;
CREATE TABLE IF NOT EXISTS `iva` (
  `id` int NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `linhafatura`
--

DROP TABLE IF EXISTS `linhafatura`;
CREATE TABLE IF NOT EXISTS `linhafatura` (
  `id` int NOT NULL,
  `faturaID` int NOT NULL,
  `ivaID` int NOT NULL,
  `quantidade` int NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `valorIva` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `faturaID` (`faturaID`),
  KEY `ivaID` (`ivaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `metodoexpedicao`
--

DROP TABLE IF EXISTS `metodoexpedicao`;
CREATE TABLE IF NOT EXISTS `metodoexpedicao` (
  `id` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `metodopagamento`
--

DROP TABLE IF EXISTS `metodopagamento`;
CREATE TABLE IF NOT EXISTS `metodopagamento` (
  `id` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1729593937),
('m130524_201442_init', 1729595190),
('m140506_102106_rbac_init', 1731412102),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1731412102),
('m180523_151638_rbac_updates_indexes_without_prefix', 1731412102),
('m190124_110200_add_verification_token_column_to_user_table', 1729595191),
('m200409_110543_rbac_update_mssql_trigger', 1731412102),
('m241111_165133_init_rbac', 1731412096);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `descricao` text NOT NULL,
  `categoriaID` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoriaID` (`categoriaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int NOT NULL,
  `userID` int NOT NULL,
  `nif` varchar(50) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `dtaNascimento` date NOT NULL,
  `genero` varchar(50) NOT NULL,
  `telemovel` varchar(20) NOT NULL,
  `morada` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'asd', '1YdAK-Hw--whrllUEJSuLomKaqo0bO5a', '$2y$13$LD580.7UvVVvJIL3fKH7VudFHOvbHS6Ytk7J7mNqKE41snJS99IPG', NULL, 'qweas@sapo.pt', 9, 1729595637, 1729595637, 'zrqx9d-jIp1UJtjhzumfvPvwhI6oMwDe_1729595637'),
(2, 'admin', 'Zxgi4XQg-Q7-Q71gKzaIolx-4V5Uynx1', '$2y$13$0lYGEziu6LTNed5PjLKuoOPXv81Cm/xFplD7WDQFOwkKeczeH4l7y', NULL, 'admin@sapo.pt', 10, 1731002182, 1731002182, 'RFIBUNcc5xSIKGWZ5XRmo0IIASGLrmf2_1731002182'),
(3, 'pao', 'uh-NWbTo2q-zEv29B_GOjm-o9vDOH1j5', '$2y$13$cBD1YyN69.YsInCSZZwqaetxiW8ZhXaArTD4zq/tGqkkeV9zGLRSS', NULL, 'pao@s.p', 10, 1731266957, 1731266957, '6zUtv8rThSBYTG1-8aiqXlpwIQ2Ar879_1731266957');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `carrinhocompra`
--
ALTER TABLE `carrinhocompra`
  ADD CONSTRAINT `carrinhocompra_ibfk_1` FOREIGN KEY (`profileID`) REFERENCES `profile` (`id`),
  ADD CONSTRAINT `carrinhocompra_ibfk_2` FOREIGN KEY (`metodoExpedicaoID`) REFERENCES `metodoexpedicao` (`id`),
  ADD CONSTRAINT `carrinhocompra_ibfk_3` FOREIGN KEY (`metodoPagamentoID`) REFERENCES `metodopagamento` (`id`);

--
-- Limitadores para a tabela `fatura`
--
ALTER TABLE `fatura`
  ADD CONSTRAINT `fatura_ibfk_1` FOREIGN KEY (`carrinhoID`) REFERENCES `carrinhocompra` (`id`);

--
-- Limitadores para a tabela `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `favorito_ibfk_1` FOREIGN KEY (`profileID`) REFERENCES `profile` (`id`),
  ADD CONSTRAINT `favorito_ibfk_2` FOREIGN KEY (`produtoID`) REFERENCES `produto` (`id`);

--
-- Limitadores para a tabela `itemscarrinho`
--
ALTER TABLE `itemscarrinho`
  ADD CONSTRAINT `itemscarrinho_ibfk_1` FOREIGN KEY (`carrinhoID`) REFERENCES `carrinhocompra` (`id`),
  ADD CONSTRAINT `itemscarrinho_ibfk_2` FOREIGN KEY (`produtoID`) REFERENCES `produto` (`id`);

--
-- Limitadores para a tabela `linhafatura`
--
ALTER TABLE `linhafatura`
  ADD CONSTRAINT `linhafatura_ibfk_1` FOREIGN KEY (`faturaID`) REFERENCES `fatura` (`id`),
  ADD CONSTRAINT `linhafatura_ibfk_2` FOREIGN KEY (`ivaID`) REFERENCES `iva` (`id`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`categoriaID`) REFERENCES `categoria` (`id`);

--
-- Limitadores para a tabela `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
