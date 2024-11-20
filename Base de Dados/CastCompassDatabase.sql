-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 18, 2024 at 05:27 PM
-- Server version: 8.0.35
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `castcompass`
--
CREATE DATABASE IF NOT EXISTS `castcompass` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `castcompass`;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '2', 1731945801);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1731945801, 1731945801),
('client', 1, NULL, NULL, NULL, 1731945801, 1731945801),
('loginBO', 2, 'Login to the BackOffice', NULL, NULL, 1731945801, 1731945801),
('userCreateBO', 2, 'Create a user in the BackOffice', NULL, NULL, 1731945801, 1731945801),
('userDeleteBO', 2, 'Delete a user in the BackOffice', NULL, NULL, 1731945801, 1731945801),
('userIndexBO', 2, 'List of users, index, in the BackOffice', NULL, NULL, 1731945801, 1731945801),
('userUpdateBO', 2, 'Update a user in the BackOffice', NULL, NULL, 1731945801, 1731945801),
('userViewBO', 2, 'View a user in the BackOffice', NULL, NULL, 1731945801, 1731945801),
('worker', 1, NULL, NULL, NULL, 1731945801, 1731945801);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'loginBO'),
('admin', 'userCreateBO'),
('admin', 'userDeleteBO'),
('admin', 'userIndexBO'),
('admin', 'userUpdateBO'),
('admin', 'userViewBO');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carrinhocompra`
--

CREATE TABLE `carrinhocompra` (
  `id` int NOT NULL,
  `profileID` int NOT NULL,
  `dataCompra` date NOT NULL,
  `valorTotal` decimal(10,2) NOT NULL,
  `quantidade` int NOT NULL,
  `metodoExpedicaoID` int NOT NULL,
  `metodoPagamentoID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `genero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fatura`
--

CREATE TABLE `fatura` (
  `id` int NOT NULL,
  `carrinhoID` int NOT NULL,
  `valorTotal` decimal(10,2) NOT NULL,
  `ivaTotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorito`
--

CREATE TABLE `favorito` (
  `id` int NOT NULL,
  `profileID` int NOT NULL,
  `produtoID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itemscarrinho`
--

CREATE TABLE `itemscarrinho` (
  `id` int NOT NULL,
  `carrinhoID` int NOT NULL,
  `produtoID` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `quantidade` int NOT NULL,
  `valorTotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iva`
--

CREATE TABLE `iva` (
  `id` int NOT NULL,
  `valor` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `linhafatura`
--

CREATE TABLE `linhafatura` (
  `id` int NOT NULL,
  `faturaID` int NOT NULL,
  `ivaID` int NOT NULL,
  `quantidade` int NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `valorIva` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metodoexpedicao`
--

CREATE TABLE `metodoexpedicao` (
  `id` int NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metodopagamento`
--

CREATE TABLE `metodopagamento` (
  `id` int NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migration`
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
-- Table structure for table `produto`
--

CREATE TABLE `produto` (
  `id` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `descricao` text NOT NULL,
  `categoriaID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int NOT NULL,
  `userID` int NOT NULL,
  `nif` varchar(50) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `dtaNascimento` date NOT NULL,
  `genero` varchar(50) NOT NULL,
  `telemovel` varchar(20) NOT NULL,
  `morada` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `userID`, `nif`, `nome`, `dtaNascimento`, `genero`, `telemovel`, `morada`) VALUES
(1, 27, '1', 'user', '2024-11-13', 'Masculino', '1', '1'),
(2, 28, '1', 'Dinis', '2024-11-13', 'Masculino', '123', 'Morada'),
(3, 1, '1', 'ASD', '2024-11-01', 'Masculino', '1234', 'Morada'),
(4, 2, '1', 'admin', '2014-11-01', 'Masculino', '1', 'Morada');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'asd', '1YdAK-Hw--whrllUEJSuLomKaqo0bO5a', '$2y$13$LD580.7UvVVvJIL3fKH7VudFHOvbHS6Ytk7J7mNqKE41snJS99IPG', NULL, 'qweas@sapo.pt', 9, 1729595637, 1729595637, 'zrqx9d-jIp1UJtjhzumfvPvwhI6oMwDe_1729595637'),
(2, 'admin', 'YHN_E5_VxYvTV5OR1-J8qwrE2pD30h-6', '$2y$13$3mB2vnqPN58UJnncMUbKt.CmcTzXe7avZ90nmBuKLwn22.07qSwhC', NULL, 'admin@admin.com', 10, 1731079276, 1731079276, 'Ad4nnqn0frGypUpJfJoHsSPc9FONkxTh_1731079276'),
(27, 'User', 'ytcegCPHN0VlZO8bDuQQmkcdUjwnMC0j', '$2y$13$7k7SwFAQy9AY40B21BLHE.WjAyrnn5FtnsXrvxg8u9oJCeY6beBsm', NULL, 'user@user.com', 10, 1731523900, 1731523900, 'JwunoJH1aPOlHiwDWtO93qXPDDhGr9HE_1731523900'),
(28, 'Dinis', 'YOgHhjAuO02df7qtgsB4HN9OM0o4gc78', '$2y$13$njpCmsFLTIyw7piN7P1WyuO1HF01ZKXFN01JMtpz4JsxrRkUEoA0e', NULL, 'dinis@hotmail.com', 10, 1731536961, 1731536961, '1QveOH-fA0SkudlSyp24tGa-_AoVtrMV_1731536961');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `carrinhocompra`
--
ALTER TABLE `carrinhocompra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profileID` (`profileID`),
  ADD KEY `metodoExpedicaoID` (`metodoExpedicaoID`),
  ADD KEY `metodoPagamentoID` (`metodoPagamentoID`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fatura`
--
ALTER TABLE `fatura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrinhoID` (`carrinhoID`);

--
-- Indexes for table `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profileID` (`profileID`),
  ADD KEY `produtoID` (`produtoID`);

--
-- Indexes for table `itemscarrinho`
--
ALTER TABLE `itemscarrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrinhoID` (`carrinhoID`),
  ADD KEY `produtoID` (`produtoID`);

--
-- Indexes for table `iva`
--
ALTER TABLE `iva`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `linhafatura`
--
ALTER TABLE `linhafatura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faturaID` (`faturaID`),
  ADD KEY `ivaID` (`ivaID`);

--
-- Indexes for table `metodoexpedicao`
--
ALTER TABLE `metodoexpedicao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metodopagamento`
--
ALTER TABLE `metodopagamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoriaID` (`categoriaID`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
-- Constraints for table `carrinhocompra`
--
ALTER TABLE `carrinhocompra`
  ADD CONSTRAINT `carrinhocompra_ibfk_1` FOREIGN KEY (`profileID`) REFERENCES `profile` (`id`),
  ADD CONSTRAINT `carrinhocompra_ibfk_2` FOREIGN KEY (`metodoExpedicaoID`) REFERENCES `metodoexpedicao` (`id`),
  ADD CONSTRAINT `carrinhocompra_ibfk_3` FOREIGN KEY (`metodoPagamentoID`) REFERENCES `metodopagamento` (`id`);

--
-- Constraints for table `fatura`
--
ALTER TABLE `fatura`
  ADD CONSTRAINT `fatura_ibfk_1` FOREIGN KEY (`carrinhoID`) REFERENCES `carrinhocompra` (`id`);

--
-- Constraints for table `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `favorito_ibfk_1` FOREIGN KEY (`profileID`) REFERENCES `profile` (`id`),
  ADD CONSTRAINT `favorito_ibfk_2` FOREIGN KEY (`produtoID`) REFERENCES `produto` (`id`);

--
-- Constraints for table `itemscarrinho`
--
ALTER TABLE `itemscarrinho`
  ADD CONSTRAINT `itemscarrinho_ibfk_1` FOREIGN KEY (`carrinhoID`) REFERENCES `carrinhocompra` (`id`),
  ADD CONSTRAINT `itemscarrinho_ibfk_2` FOREIGN KEY (`produtoID`) REFERENCES `produto` (`id`);

--
-- Constraints for table `linhafatura`
--
ALTER TABLE `linhafatura`
  ADD CONSTRAINT `linhafatura_ibfk_1` FOREIGN KEY (`faturaID`) REFERENCES `fatura` (`id`),
  ADD CONSTRAINT `linhafatura_ibfk_2` FOREIGN KEY (`ivaID`) REFERENCES `iva` (`id`);

--
-- Constraints for table `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`categoriaID`) REFERENCES `categoria` (`id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
