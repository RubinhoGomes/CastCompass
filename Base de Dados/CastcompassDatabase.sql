-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16-Dez-2024 às 14:58
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
  `item_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '2', 1733356457);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
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
('admin', 1, NULL, NULL, NULL, 1733356457, 1733356457),
('categoriaCreateBO', 2, 'Create a category in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('categoriaDeleteBO', 2, 'Delete a category in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('categoriaIndexBO', 2, 'List of categories, index, in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('categoriaUpdateBO', 2, 'Update a category in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('categoriaViewBO', 2, 'View a category in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('client', 1, NULL, NULL, NULL, 1733356457, 1733356457),
('ivaCreateBO', 2, 'Create a IVA in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('ivaDeleteBO', 2, 'Delete a IVA in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('ivaIndexBO', 2, 'List of IVA, index, in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('ivaUpdateBO', 2, 'Update a IVA in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('ivaViewBO', 2, 'View a IVA in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('loginBO', 2, 'Login to the BackOffice', NULL, NULL, 1733356457, 1733356457),
('produtoCreateBO', 2, 'Create a product in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('produtoDeleteBO', 2, 'Delete a product in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('produtoIndexBO', 2, 'List of products, index, in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('produtoUpdateBO', 2, 'Update a product in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('produtoViewBO', 2, 'View a product in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('userCreateBO', 2, 'Create a user in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('userDeleteBO', 2, 'Delete a user in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('userIndexBO', 2, 'List of users, index, in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('userUpdateBO', 2, 'Update a user in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('userViewBO', 2, 'View a user in the BackOffice', NULL, NULL, 1733356457, 1733356457),
('worker', 1, NULL, NULL, NULL, 1733356457, 1733356457);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'categoriaCreateBO'),
('admin', 'categoriaDeleteBO'),
('admin', 'categoriaIndexBO'),
('admin', 'categoriaUpdateBO'),
('admin', 'categoriaViewBO'),
('admin', 'ivaCreateBO'),
('admin', 'ivaDeleteBO'),
('admin', 'ivaIndexBO'),
('admin', 'ivaUpdateBO'),
('admin', 'ivaViewBO'),
('admin', 'loginBO'),
('worker', 'loginBO'),
('admin', 'produtoCreateBO'),
('admin', 'produtoDeleteBO'),
('admin', 'produtoIndexBO'),
('admin', 'produtoUpdateBO'),
('admin', 'produtoViewBO'),
('admin', 'userCreateBO'),
('admin', 'userDeleteBO'),
('admin', 'userIndexBO'),
('admin', 'userUpdateBO'),
('admin', 'userViewBO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `genero` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `genero`) VALUES
(1, 'Nome Updated', 'Genero'),
(2, 'Pesca Desportiva', 'Pesca Desportiva');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fatura`
--

DROP TABLE IF EXISTS `fatura`;
CREATE TABLE IF NOT EXISTS `fatura` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `profileID` int NOT NULL,
  `produtoID` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profileID` (`profileID`),
  KEY `produtoID` (`produtoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

DROP TABLE IF EXISTS `imagem`;
CREATE TABLE IF NOT EXISTS `imagem` (
  `id` int NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `produtoID` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produtoID` (`produtoID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `imagem`
--

INSERT INTO `imagem` (`id`, `filename`, `produtoID`) VALUES
(5, 'HTR3Ojh9Tn0qRJahwJwcV0G6aEyCfmWf.png', 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemscarrinho`
--

DROP TABLE IF EXISTS `itemscarrinho`;
CREATE TABLE IF NOT EXISTS `itemscarrinho` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `valor` decimal(5,2) NOT NULL,
  `label` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `iva`
--

INSERT INTO `iva` (`id`, `valor`, `label`) VALUES
(1, '0.23', 'IVA'),
(2, '0.12', 'Bens Essenciais');

-- --------------------------------------------------------

--
-- Estrutura da tabela `linhafatura`
--

DROP TABLE IF EXISTS `linhafatura`;
CREATE TABLE IF NOT EXISTS `linhafatura` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `metodopagamento`
--

DROP TABLE IF EXISTS `metodopagamento`;
CREATE TABLE IF NOT EXISTS `metodopagamento` (
  `id` int NOT NULL AUTO_INCREMENT,
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
('m140506_102106_rbac_init', 1731344065),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1731344065),
('m180523_151638_rbac_updates_indexes_without_prefix', 1731344065),
('m190124_110200_add_verification_token_column_to_user_table', 1729595191),
('m200409_110543_rbac_update_mssql_trigger', 1731344065),
('m241111_165133_init_rbac', 1731344028);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `descricao` text NOT NULL,
  `categoriaID` int NOT NULL,
  `ivaID` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoriaID` (`categoriaID`),
  KEY `ivaID` (`ivaID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `marca`, `preco`, `stock`, `descricao`, `categoriaID`, `ivaID`) VALUES
(8, 'Nome', 'Marca', '14.76', 12, 'Descricao', 2, 1),
(15, 'Nome', 'Marca', '1.23', 1, 'Descricao', 1, 1),
(16, 'Nome', 'Marca', '11.20', 12, 'Descricao', 2, 2),
(17, 'Nome', 'Marca', '17.22', 12, 'Descricao', 2, 1),
(18, 'proc', 'marc', '5.00', 2, 'Pracascasc', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `nif` varchar(50) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `dtaNascimento` date NOT NULL,
  `genero` varchar(50) NOT NULL,
  `telemovel` varchar(20) NOT NULL,
  `morada` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `profile`
--

INSERT INTO `profile` (`id`, `userID`, `nif`, `nome`, `dtaNascimento`, `genero`, `telemovel`, `morada`) VALUES
(1, 27, '1', 'user', '2024-11-27', 'Masculino', '123', '123'),
(2, 28, '1', 'Dinis', '2024-11-13', 'Masculino', '123', 'Morada'),
(3, 1, '1', 'ASD', '2024-11-22', 'Masculino', '1234', 'Morada'),
(4, 2, '1', 'admin', '2014-11-01', 'Masculino', '1', 'Morada'),
(13, 44, '1', 'teste', '2024-11-18', '1', '123', 'teste teste'),
(19, 50, '1', 'Client', '2024-11-20', 'Masculino', '1', 'Client'),
(20, 51, '1', 'Funcionario', '2024-11-25', 'Masculino', '1', 'Funcionario'),
(21, 52, '1', 'Worker', '2024-11-22', 'Masculino', '123456789', 'morada'),
(22, 53, '12345', 'Carolina', '2024-11-26', 'Feminino', '12345', 'Morada');

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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'asd', '1YdAK-Hw--whrllUEJSuLomKaqo0bO5a', '$2y$13$LD580.7UvVVvJIL3fKH7VudFHOvbHS6Ytk7J7mNqKE41snJS99IPG', NULL, 'qweas@sapo.pt', 9, 1729595637, 1732235220, 'zrqx9d-jIp1UJtjhzumfvPvwhI6oMwDe_1729595637'),
(2, 'admin', 'YHN_E5_VxYvTV5OR1-J8qwrE2pD30h-6', '$2y$13$3mB2vnqPN58UJnncMUbKt.CmcTzXe7avZ90nmBuKLwn22.07qSwhC', NULL, 'admin@admin.com', 10, 1731079276, 1731079276, 'Ad4nnqn0frGypUpJfJoHsSPc9FONkxTh_1731079276'),
(27, 'Snoppy', 'ytcegCPHN0VlZO8bDuQQmkcdUjwnMC0j', '$2y$13$7k7SwFAQy9AY40B21BLHE.WjAyrnn5FtnsXrvxg8u9oJCeY6beBsm', NULL, 'user@user.com', 10, 1731523900, 1732742912, 'JwunoJH1aPOlHiwDWtO93qXPDDhGr9HE_1731523900'),
(28, 'Dinis', 'YOgHhjAuO02df7qtgsB4HN9OM0o4gc78', '$2y$13$njpCmsFLTIyw7piN7P1WyuO1HF01ZKXFN01JMtpz4JsxrRkUEoA0e', NULL, 'dinis@hotmail.com', 10, 1731536961, 1731536961, '1QveOH-fA0SkudlSyp24tGa-_AoVtrMV_1731536961'),
(44, 'Teste', 'p1qLkeN0O0HQ5oATAtPf-x1kO6rC7BmZ', '$2y$13$1exSKF0cKcfpm0KDB9Xgwu89C/GD.furvGdICVuj7OWxyB/HqRQk2', NULL, 'teste@teste.com', 10, 1731959318, 1731959318, 'WeYhm2AfN-T31fT8dG-EN3iPAmYpD5uB_1731959318'),
(50, 'Client', 'WoWn01AZoGGdlsIXoMStv9TNkwokunZ4', '$2y$13$w07sAUWemYqjwYY.HeZmmu.BGyimNvcyevAA2cGyB6m33UgtJT.xW', NULL, 'client@client.com', 10, 1732145687, 1732145687, '7MiZBFY_gcAdcBOOAnrLvoZeYCTX1geI_1732145687'),
(51, 'Funcionario', 'NtiL1-Qf2wWIlV8MF8h5aM76xLAtKBVs', '$2y$13$DqW5O0lXA4XzeZ18zIYyU.A52HNgc/BuuVW92QOhxCohnYx.9U/CS', NULL, 'funcionario@funcionario.com', 10, 1732145803, 1732550129, 'pbMNFNBuhQ4VmRD2Cak7-TmMs8vPubBV_1732145803'),
(52, 'Worker', 'XOmF-9HSiJLNGHOMCDES27hHGtvkiHC6', '$2y$13$MWaNeYyb9kOOsihajlVFhO212qyAhdR7El58Zc7tuSiXcTajwYkM.', NULL, 'worker@worker.com', 10, 1732289597, 1732289597, 'qhlW_ktl_mRniHt4OKAlFl7xGyJJqe76_1732289597'),
(53, 'Carolina', 'to-0GuXrsZX4XsP-W6bOHfHmEQRAIr4S', '$2y$13$V0tfVlIZ5YSuUkf0L3cc/ufsOqqglB/nBrScGc.qHlbdMhCVO3M5C', NULL, 'Carolina@carolina.pt', 10, 1732647176, 1732647176, 'O8J2_r5llmUuBas0Gxga9D1_8bvuoFWg_1732647176');

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
-- Limitadores para a tabela `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `imagem_ibfk_1` FOREIGN KEY (`produtoID`) REFERENCES `produto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`categoriaID`) REFERENCES `categoria` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`ivaID`) REFERENCES `iva` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
