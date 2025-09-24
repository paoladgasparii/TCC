-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 24/09/2025 às 15:16
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `corrija_ai`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `redacoes`
--

DROP TABLE IF EXISTS `redacoes`;
CREATE TABLE IF NOT EXISTS `redacoes` (
  `id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `usuario_id` int NOT NULL,
  `aluno_nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tema` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `texto` text COLLATE utf8mb4_general_ci NOT NULL,
  `data_envio` datetime NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pendente',
  `c1` int DEFAULT '0',
  `c2` int DEFAULT '0',
  `c3` int DEFAULT '0',
  `c4` int DEFAULT '0',
  `c5` int DEFAULT '0',
  `nota_final` int DEFAULT '0',
  `comentarios` text COLLATE utf8mb4_general_ci,
  `pontos_fortes` text COLLATE utf8mb4_general_ci,
  `pontos_melhoria` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `temas`
--

DROP TABLE IF EXISTS `temas`;
CREATE TABLE IF NOT EXISTS `temas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_general_ci NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `textos_motivadores` text COLLATE utf8mb4_general_ci NOT NULL,
  `ano` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_cadastro`, `is_admin`) VALUES
(3, 'Paola', 'paoladgasparii.pdg@gmail.com', '$2y$10$42sGyrSGBakkkp5th9YfWuIVVaMNuUDqfggfYmcERz07JH7qPHUSq', '2025-08-14 17:39:06', 1),
(4, 'Lorena', 'lorena123@gmail.com', '$2y$10$IQbK/2CcDLzX01zb4xs3X.1pB5p4qscRu6ePGJ3pPcEF6qVmlp3JW', '2025-09-11 17:51:01', 0),
(5, 'João Francisco', 'joao12345@gmail.com', '$2y$10$3NHHG//Ju3ocCTvVySQY/ehKVKLoczq88DKAL1BMTHQY.EI0q4UoW', '2025-09-24 14:28:28', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
