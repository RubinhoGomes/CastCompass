-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08-Jan-2025 às 23:50
-- Versão do servidor: 8.0.31
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
CREATE DATABASE IF NOT EXISTS `castcompass` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `castcompass`;

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
('admin', '2', 1736364639),
('client', '1', 1736376816),
('client', '71', 1736369769),
('client', '72', 1736370179),
('worker', '51', 1736365002);

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
('admin', 1, NULL, NULL, NULL, 1736364639, 1736364639),
('categoriaCreateBO', 2, 'Create a category in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('categoriaDeleteBO', 2, 'Delete a category in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('categoriaIndexBO', 2, 'List of categories, index, in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('categoriaUpdateBO', 2, 'Update a category in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('categoriaViewBO', 2, 'View a category in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('client', 1, NULL, NULL, NULL, 1736364639, 1736364639),
('encomendaCreateBO', 2, 'Create a order in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('encomendaDeleteBO', 2, 'Delete a order in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('encomendaIndexBO', 2, 'List of all orders, index, in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('encomendaUpdateBO', 2, 'Update a order in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('encomendaViewBO', 2, 'View a order in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('faturaIndexBO', 2, 'List of all invoices, index, in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('faturaViewBO', 2, 'View a invoice in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('ivaCreateBO', 2, 'Create a IVA in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('ivaDeleteBO', 2, 'Delete a IVA in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('ivaIndexBO', 2, 'List of IVA, index, in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('ivaUpdateBO', 2, 'Update a IVA in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('ivaViewBO', 2, 'View a IVA in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('loginBO', 2, 'Login to the BackOffice', NULL, NULL, 1736364639, 1736364639),
('mpCreateBO', 2, 'Create a Payment Method in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('mpDeleteBO', 2, 'Delete a Payment Method in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('mpIndexBO', 2, 'List of Payment Methods, index, in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('mpUpdateBO', 2, 'Update a Payment Method in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('mpViewBO', 2, 'View the Payment Methods in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('produtoCreateBO', 2, 'Create a product in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('produtoDeleteBO', 2, 'Delete a product in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('produtoIndexBO', 2, 'List of products, index, in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('produtoUpdateBO', 2, 'Update a product in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('produtoViewBO', 2, 'View a product in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('userCreateBO', 2, 'Create a user in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('userDeleteBO', 2, 'Delete a user in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('userIndexBO', 2, 'List of users, index, in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('userUpdateBO', 2, 'Update a user in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('userViewBO', 2, 'View a user in the BackOffice', NULL, NULL, 1736364639, 1736364639),
('worker', 1, NULL, NULL, NULL, 1736364639, 1736364639);

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
('admin', 'encomendaCreateBO'),
('admin', 'encomendaDeleteBO'),
('admin', 'encomendaIndexBO'),
('admin', 'encomendaUpdateBO'),
('admin', 'encomendaViewBO'),
('admin', 'faturaIndexBO'),
('worker', 'faturaIndexBO'),
('admin', 'faturaViewBO'),
('worker', 'faturaViewBO'),
('admin', 'ivaCreateBO'),
('admin', 'ivaDeleteBO'),
('admin', 'ivaIndexBO'),
('admin', 'ivaUpdateBO'),
('admin', 'ivaViewBO'),
('admin', 'loginBO'),
('worker', 'loginBO'),
('admin', 'mpCreateBO'),
('admin', 'mpDeleteBO'),
('admin', 'mpIndexBO'),
('admin', 'mpUpdateBO'),
('admin', 'mpViewBO'),
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
-- Estrutura da tabela `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
CREATE TABLE IF NOT EXISTS `carrinho` (
  `id` int NOT NULL AUTO_INCREMENT,
  `profileID` int NOT NULL,
  `valorTotal` decimal(10,2) DEFAULT NULL,
  `quantidade` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profileID` (`profileID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `profileID`, `valorTotal`, `quantidade`) VALUES
(2, 32, NULL, NULL),
(3, 22, '0.00', 5),
(5, 4, '0.00', 0),
(14, 41, '0.00', 0),
(15, 19, '115.61', 1),
(16, 20, '115.61', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `genero`) VALUES
(1, 'Tenda', 'Tendas'),
(2, 'Pesca Desportiva', 'Pesca Desportiva'),
(3, 'Colchões', 'Colchões'),
(4, 'Saco Cama', 'Saco Cama'),
(5, 'Bomba', 'Bomba'),
(6, 'Almofada', 'Almofada'),
(7, 'Cobertor', 'Cobertor');

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
  `metodoExpedicaoID` int NOT NULL,
  `data` int NOT NULL,
  `metodoPagamentoID` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `carrinhoID` (`carrinhoID`),
  KEY `metodoExpedicaoID` (`metodoExpedicaoID`),
  KEY `metodoPagamentoID` (`metodoPagamentoID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `fatura`
--

INSERT INTO `fatura` (`id`, `carrinhoID`, `valorTotal`, `ivaTotal`, `metodoExpedicaoID`, `data`, `metodoPagamentoID`) VALUES
(30, 14, '171.75', '32.12', 1, 1736294400, 1),
(31, 5, '153.73', '28.75', 1, 1736294400, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `favorito`
--

INSERT INTO `favorito` (`id`, `profileID`, `produtoID`) VALUES
(1, 39, 21),
(2, 19, 21),
(3, 41, 21),
(4, 4, 22);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `imagem`
--

INSERT INTO `imagem` (`id`, `filename`, `produtoID`) VALUES
(15, 'uI4-d5_8aXpNP-3raozVJZ8MRLMfVjf2.jpg', 21),
(16, 'YsY9xJfuRpiPlB3v87ynTa9T-ZmB3HcF.jpg', 22),
(17, 'U6yVjbauJOUumvCmUJ4u1uJClbvK0DGj.jpg', 23),
(18, '81OFc7owq3eXJZPSJWcZDCpnT_JnCLRm.jpg', 24),
(19, 'QQ9Af6Zj5P0Xc5m-46rQAyJi7LBB_fWI.jpg', 25),
(20, 'OOGXx7xe-S4Ga9INkeO2IEaBETMVQsAN.jpg', 26),
(21, 'L0W2mUbM-H7O1nkL6V0qW_rfc-QVMH6N.jpg', 27);

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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `itemscarrinho`
--

INSERT INTO `itemscarrinho` (`id`, `carrinhoID`, `produtoID`, `nome`, `quantidade`, `valorTotal`) VALUES
(55, 15, 21, 'Tenda de campismo cúpula para 4 pessoas impermeável azul', 1, '115.61'),
(56, 16, 21, 'Tenda de campismo cúpula para 4 pessoas impermeável azul', 1, '115.61');

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
  `produtoID` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `faturaID` (`faturaID`),
  KEY `ivaID` (`ivaID`),
  KEY `produtoID` (`produtoID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `linhafatura`
--

INSERT INTO `linhafatura` (`id`, `faturaID`, `ivaID`, `quantidade`, `valor`, `valorIva`, `produtoID`) VALUES
(13, 30, 1, 1, '115.61', '21.62', 21),
(14, 30, 1, 1, '56.14', '10.50', 22),
(15, 31, 1, 1, '115.61', '21.62', 21),
(16, 31, 1, 1, '38.12', '7.13', 23);

-- --------------------------------------------------------

--
-- Estrutura da tabela `metodoexpedicao`
--

DROP TABLE IF EXISTS `metodoexpedicao`;
CREATE TABLE IF NOT EXISTS `metodoexpedicao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `metodoexpedicao`
--

INSERT INTO `metodoexpedicao` (`id`, `nome`) VALUES
(1, 'CTT');

-- --------------------------------------------------------

--
-- Estrutura da tabela `metodopagamento`
--

DROP TABLE IF EXISTS `metodopagamento`;
CREATE TABLE IF NOT EXISTS `metodopagamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `metodopagamento`
--

INSERT INTO `metodopagamento` (`id`, `nome`) VALUES
(1, 'MBWay');

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `marca`, `preco`, `stock`, `descricao`, `categoriaID`, `ivaID`) VALUES
(21, 'Tenda de campismo cúpula para 4 pessoas impermeável azul', 'VIDAXL', '115.61', 10, 'Esta tenda de campismo com aspeto moderno protege-o de intempéries e proporciona um local confortável para aventuras de todo o tipo.\r\n\r\nDesign totalmente à prova de água: esta tenda de campismo, feita de poliéster com revestimento de PU, é à prova de água e resistente ao vento.\r\nAs costuras coladas evitam eficazmente a infiltração da água da chuva, enquanto a cobertura de chão resistente ajuda a manter o interior seco e confortável.\r\n\r\nBoa ventilação e proteção contra mosquitos: as paredes de malha não só oferecem uma excelente ventilação, como também mantêm eficazmente os insetos afastados, garantindo aos utilizadores uma experiência confortável e livre de insetos.\r\n\r\nCobertura impermeável removível: a cobertura impermeável removível pode ser anexada ao topo da tenda para proteção contra intempéries e privacidade.\r\n\r\nLeve e portátil: o design dobrável e leve permite-lhe embalar facilmente a tenda e guardá-la no saco de transporte incluído para facilitar o transporte.\r\n\r\nFácil montagem e desmontagem: montar e desmontar a tenda é muito fácil graças aos postes de fibra de vidro altamente flexíveis e leves e ao conveniente sistema de conexão por pinos e anéis.\r\n\r\nAtenção: Mantenha todas as chamas e fontes de calor afastadas do tecido deste produto.\r\n\r\nCor: azul\r\nMaterial da tenda: poliéster 185T revestido a PU\r\nMaterial de rede: poliéster 68D\r\nMaterial da base: PE\r\nDimensões internas da tenda: 200 x 234 x 122 cm (C x L x A) Dimensões externas: 300 x 250 x 132 cm (C x L x A)\r\nDimensões da embalagem: 58 x 16,5 x 16,5 cm (C x L x A)\r\nQuantidade de utilizadores: 4 pessoas\r\nPeso: 5 kg\r\nTipo de tenda: tenda de campismo\r\nForma: cúpula\r\nQuantidade de quartos: 1\r\nNúmero de portas: 1\r\nQuantidade de janelas: 2\r\nCom acesso duplo com fecho de correr e cobertura impermeável removível\r\nInclui porta e Montagem necessária: sim\r\n\r\nA entrega inclui: 1 x Toldo 1 x Cobertura impermeável para tenda 1 x Saco de transporte', 1, 1),
(22, 'Saco-cama Bestway', 'PAVILLO', '56.14', 26, 'Se procura as novidades mais procuradas no mercado, apresentamos-lhe Saco-cama Bestway Azul\r\n\r\nTipo: Saco-cama\r\nInclui: Bolsa de transporte\r\nTemperatura aprox.: 3º - 8 ºC\r\nMedidas aprox.: 190 x 84 cm\r\nCor: Azul\r\nMaterial: Plástico e Poliéster\r\nCaracterísticas: Exterior\r\nLimpar com pano húmido\r\nUso recomendado: Praia, Jardim e Camping\r\nForma: Quadrado\r\nTipo de fecho: Fecho de correr\r\nGénero: Unissexo adultos\r\nIdade recomendada: Todas as idades', 4, 1),
(23, 'Bomba Elétrica Desportos Outdoor Adulto Preto', 'BESTWAY', '38.12', 41, 'Bomba de Ar Elétrica\r\nDescrição\r\nA Bomba de Ar Elétrica é a escolha ideal para inflar rapidamente seus equipamentos esportivos aquáticos. Com um design elegante, esta bomba elétrica de alta qualidade garante eficiência e praticidade em suas atividades ao ar livre.\r\n\r\nCaracterísticas Principais\r\n• Alta eficiência: Infla bóias, colchões de ar, piscinas infláveis e outros equipamentos aquáticos com facilidade e rapidez.\r\n• Fácil de usar: Compatível com tomadas padrão, é simples de operar e transportar.\r\n• Leve e compacta: Ideal para levar em suas aventuras ao ar livre.\r\nBenefícios\r\n• Rapidez e praticidade: Nunca mais perca tempo inflando manualmente e aproveite ao máximo suas atividades na água.\r\n• Portabilidade: Leve e fácil de transportar, podendo ser utilizada em diversos locais.\r\n• Durabilidade: Construída com materiais de alta qualidade para garantir longa vida útil.\r\nUtilização\r\nEsta bomba elétrica é perfeita para desportos outdoor, proporcionando momentos de lazer e diversão sem preocupações. Seja na praia, piscina ou acampamento, tenha sempre à disposição esta bomba eficiente e durável.\r\n\r\nCompra Segura\r\nAdquira agora a Bomba de Ar Elétrica e garanta inflar seus equipamentos esportivos de forma rápida e conveniente. Leve sua diversão aquática a um novo nível com esta bomba de alto desempenho.\r\n\r\nNão perca mais tempo e invista na Bomba de Ar Elétrica para garantir momentos de lazer inesquecíveis e práticos. Aproveite a liberdade de inflar seus equipamentos onde quer que esteja, de maneira rápida e eficiente.', 5, 1),
(24, 'Almofada de viagem', 'HIGHLANDER', '17.21', 12, 'Almofada\r\n\r\nDescanse a sua cabeça numa almofada de viagem macia e confortável.\r\n\r\nVantagens:\r\nLeve e muito compacta\r\nFácil de utilizar\r\nConcebida para utilização em actividades de lazer no exterior\r\nCaracterísticas:\r\nPeso: 165g\r\nTamanho: 22 cm x 30 cm x 7 cm\r\nMaterial: Tecido - 65% poliéster, 35% algodão - Enchimento - 450g/m2 de fibra oca de poliéster', 6, 1),
(25, 'Colchão de campismo Intex Dura-Beam Deluxe Ultra Plush com cabeceira', 'INTEX', '122.94', 33, 'Dura-Beam Deluxe Series INTEX modelo Ultra Plush Headbed Airbed com cabeceira e medidas: 152 x 236 x 46 cm. Superfície flocada e nervurada, estrutura interior com tecnologia Fiber-Tech. Possui bomba elétrica integrada para inflar e esvaziar, pronta em apenas 5 minutos. Inclui bolsa de transporte com alças. Colchão de fácil dobragem, em vinil resistente. Projetado para duas pessoas, peso máximo 272 kg.\r\n\r\n• Cama insuflável INTEX para duas pessoas, série Dura-Beam Deluxe modleo Ultra Plush com cabeceiro, medidas: 152x236x46 cm, suporta um peso máximo de 272 kg\r\n• Construção interior com tecnologia Fiber-Tech, maior adaptação, rigidez e conforto, a cama não deforma com as utilizações, superfície e borda flocadas\r\n• Cabeceiro embutido de tato suave e estrutura afunilada para maior conforto, perfeita para ler, ver televisão ou evitar que as almofadas caiam no solo\r\n• Bomba elétrica embutida de enchimento e esvaziamento, tempo de enchimento aproximado: 5 minutos, inclui-se saco de transporte com asas\r\n• Fabricada em vinil de elevada qualidade e resistência, a altura da cama facilitao acesso e a saída, perfeita como cama de convidados ou para viajar', 3, 1),
(26, 'Cobertor elétrico - Manta de aquecimento - 200 x 180 cm', 'Rockerz Fitness', '98.34', 18, 'Quer manter-se bem quente durante o inverno? Então o cobertor elétrico de dupla face Rockerz Home é a solução ideal! O cobertor é perfeito para uma noite agradável no sofá ou como cobertor extra na sua cama. Com nada menos que 9 ajustes de temperatura, pode definir exatamente o calor que mais lhe convém. Quer precise de um calor subtil para dormir confortavelmente ou de um calor intenso para vencer o frio do inverno, este cobertor é a sua fonte de calor fiável. Além disso, o cobertor elétrico é um investimento inteligente porque pode baixar um pouco a temperatura do termóstato, o que pode ajudar a reduzir os seus custos de energia.\r\n\r\n9 definições de aquecimento e desligamento automático\r\nCom o prático comando à distância, tem controlo total sobre o calor do seu cobertor de aquecimento elétrico. Desfrute de nada menos que 9 configurações de calor diferentes, que variam entre uns agradáveis ​​29 °C e uns aconchegantes 43 °C, tudo ao seu alcance com o toque de um botão. A definição da função de desligamento automático é igualmente fácil, com 9 definições de tempo disponíveis, que variam entre 20 minutos e 3 horas. Após este tempo, o cobertor desligar-se-á automaticamente. O cobertor está também equipado com proteção contra sobreaquecimento, tornando-o à prova de fogo. E para maior facilidade de utilização, este cobertor elétrico tem um cabo generoso de nada mais nada menos que 2,3 metros.\r\n\r\nMaterial excecionalmente macio para um conforto ideal\r\nEste cobertor elétrico é cuidadosamente feito de 100% flanela (exterior) e lã sherpa (interior). A flanela proporciona uma camada exterior macia e sedosa, enquanto o velo sherpa acrescenta uma camada extra de calor e suavidade. Com a sua combinação única de flanela e lã sherpa, o cobertor elétrico aquecido Rockerz Home envolve-o num oásis de conforto. Graças ao material grosso com forro quente, este é um item essencial para enfrentar os dias frios com conforto!\r\n\r\nOs benefícios do cobertor elétrico Rockerz Home:\r\n• O must-have para os dias frios\r\n• Tecido macio e sedoso\r\n• Eficiência energética - bom para a sua carteira\r\n• 9 regulações de calor (29° C a 43° C)\r\n• Desligamento automático até 3 horas\r\n• Tamanho ideal - 180 x 200 cm (duplo)\r\n• Cabo XL - 2,3 metros\r\n• Adapta-se a qualquer interior\r\n• Lavável: lavar à mão\r\n\r\nConteúdo da embalagem\r\n➜ 1 x cobertor elétrico\r\n➜ 1 x Comando à distância com cabo\r\n➜ 1 x Manual\r\n\r\nEspecificações\r\nVoltagem: 220V-240V\r\nFrequência: 50-60Hz\r\nWatts: 160 watts\r\nLavável: Lavar à mão\r\nCertificados: CE, FC, RoHS', 7, 1),
(27, 'Pesca de Fundo no Mar SEACOAST 500 350 80-150 G (Conjunto)', 'CAPERLAN', '73.80', 26, 'Características da Cana SEACOAST-500 350 Telescópica\r\n- Comprimento: 3,50 m\r\n- Volume: 1,03 m\r\n- Número de secções: 6 elementos\r\n- Peso: 430 g\r\n- Potência: 80-150 g\r\n- Peso otimizado para lançar: 110 g\r\n- Material: carbono e fibra de vidro\r\n- Passadores: 4 passadores ligados + 1 passador de cabeça colado\r\n- Porta-carreto: tubular de enroscar\r\n- Ação semiparabólica', 2, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `profile`
--

INSERT INTO `profile` (`id`, `userID`, `nif`, `nome`, `dtaNascimento`, `genero`, `telemovel`, `morada`) VALUES
(1, 27, '1', 'user', '2024-11-27', 'Masculino', '123', '123'),
(3, 1, '1', 'ASD', '2025-01-08', 'Masculino', '1234', 'Morada'),
(4, 2, '1', 'admin', '2014-11-01', 'Masculino', '1', 'Morada'),
(13, 44, '1', 'teste', '2024-11-18', '1', '123', 'teste teste'),
(19, 50, '1', 'Client', '2024-11-20', 'Masculino', '1', 'Client'),
(20, 51, '1', 'Funcionario', '2025-01-08', 'Masculino', '1', 'Funcionario'),
(21, 52, '1', 'Worker', '2024-11-22', 'Masculino', '123456789', 'morada'),
(22, 53, '12345', 'Carolina', '2024-11-26', 'Feminino', '12345', 'Morada'),
(27, 58, '12345678', 'Teste', '2024-12-20', 'Masculino', '123456789', 'Morada'),
(32, 63, '12345678', 'TesteCarrinho', '2024-12-21', 'Masculino', '123456789', 'Morada'),
(41, 72, '12435', 'ze', '2025-01-08', 'Masculino', '723456', 'ghusdf');

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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'asd', '1YdAK-Hw--whrllUEJSuLomKaqo0bO5a', '$2y$13$LD580.7UvVVvJIL3fKH7VudFHOvbHS6Ytk7J7mNqKE41snJS99IPG', NULL, 'qweas@sapo.pt', 9, 1729595637, 1736376816, 'zrqx9d-jIp1UJtjhzumfvPvwhI6oMwDe_1729595637'),
(2, 'admin', 'YHN_E5_VxYvTV5OR1-J8qwrE2pD30h-6', '$2y$13$3mB2vnqPN58UJnncMUbKt.CmcTzXe7avZ90nmBuKLwn22.07qSwhC', NULL, 'admin@admin.com', 10, 1731079276, 1731079276, 'Ad4nnqn0frGypUpJfJoHsSPc9FONkxTh_1731079276'),
(27, 'Snoppy', 'ytcegCPHN0VlZO8bDuQQmkcdUjwnMC0j', '$2y$13$7k7SwFAQy9AY40B21BLHE.WjAyrnn5FtnsXrvxg8u9oJCeY6beBsm', NULL, 'user@user.com', 10, 1731523900, 1732742912, 'JwunoJH1aPOlHiwDWtO93qXPDDhGr9HE_1731523900'),
(44, 'Teste', 'p1qLkeN0O0HQ5oATAtPf-x1kO6rC7BmZ', '$2y$13$1exSKF0cKcfpm0KDB9Xgwu89C/GD.furvGdICVuj7OWxyB/HqRQk2', NULL, 'teste@teste.com', 10, 1731959318, 1731959318, 'WeYhm2AfN-T31fT8dG-EN3iPAmYpD5uB_1731959318'),
(50, 'Client', 'WoWn01AZoGGdlsIXoMStv9TNkwokunZ4', '$2y$13$w07sAUWemYqjwYY.HeZmmu.BGyimNvcyevAA2cGyB6m33UgtJT.xW', NULL, 'client@client.com', 10, 1732145687, 1732145687, '7MiZBFY_gcAdcBOOAnrLvoZeYCTX1geI_1732145687'),
(51, 'Funcionario', 'NtiL1-Qf2wWIlV8MF8h5aM76xLAtKBVs', '$2y$13$DqW5O0lXA4XzeZ18zIYyU.A52HNgc/BuuVW92QOhxCohnYx.9U/CS', NULL, 'funcionario@funcionario.com', 10, 1732145803, 1736365002, 'pbMNFNBuhQ4VmRD2Cak7-TmMs8vPubBV_1732145803'),
(52, 'Worker', 'XOmF-9HSiJLNGHOMCDES27hHGtvkiHC6', '$2y$13$MWaNeYyb9kOOsihajlVFhO212qyAhdR7El58Zc7tuSiXcTajwYkM.', NULL, 'worker@worker.com', 10, 1732289597, 1732289597, 'qhlW_ktl_mRniHt4OKAlFl7xGyJJqe76_1732289597'),
(53, 'Carolina', 'to-0GuXrsZX4XsP-W6bOHfHmEQRAIr4S', '$2y$13$V0tfVlIZ5YSuUkf0L3cc/ufsOqqglB/nBrScGc.qHlbdMhCVO3M5C', NULL, 'Carolina@carolina.pt', 10, 1732647176, 1732647176, 'O8J2_r5llmUuBas0Gxga9D1_8bvuoFWg_1732647176'),
(58, 'TesteCarrinho', 'RI67ZlEShy3xsUnOjWygxWN-MOJQo7Si', '$2y$13$/bysTsjPh5uFp7H5B8mngen5IgN1Rl7Ozd8S7Je3XJIql/z44X0zm', NULL, 'testeCarrinho@teste.com', 10, 1734709117, 1734709117, 'kHpP7U6YvGUZIXXwE4LwDa-FweoGeKJq_1734709117'),
(63, 'TesteCarrinho2', 'B9i393yLMh3y3VkOEm6bXPlWtaac7wmB', '$2y$13$gUXNvOCECaij4gP1OMi/te1owzf/hvFGBTR3e8J3POLAgHKSFnN0K', NULL, 'testecarrinho@hotmail.com', 10, 1734809462, 1734809462, 'nkAYsosM6DBzCAkpEBq21Htgra92q9FE_1734809462'),
(72, 'ze', 'R_XJGzcf_y80bsY4lmN7t26YNr06H3KX', '$2y$13$B6/dvGZGB2trA/2UHuJS.umYiihQKuNK.dCOmeDBIWBsmMDHj8ksu', NULL, 'ze@gmail.com', 10, 1736370179, 1736370179, '-2nWbHDvWnwHlyWvdFSnB_T8iU8pp8Aq_1736370179');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`profileID`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`categoriaID`) REFERENCES `categoria` (`id`),
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
