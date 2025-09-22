-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 11/09/2025 às 18:16
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
  `id` varchar(255) NOT NULL,
  `usuario_id` int NOT NULL,
  `aluno_nome` varchar(100) NOT NULL,
  `tema` varchar(255) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `texto` text NOT NULL,
  `data_envio` datetime NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pendente',
  `c1` int DEFAULT '0',
  `c2` int DEFAULT '0',
  `c3` int DEFAULT '0',
  `c4` int DEFAULT '0',
  `c5` int DEFAULT '0',
  `nota_final` int DEFAULT '0',
  `comentarios` text,
  `pontos_fortes` text,
  `pontos_melhoria` text,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `redacoes`
--

INSERT INTO `redacoes` (`id`, `usuario_id`, `aluno_nome`, `tema`, `titulo`, `texto`, `data_envio`, `status`, `c1`, `c2`, `c3`, `c4`, `c5`, `nota_final`, `comentarios`, `pontos_fortes`, `pontos_melhoria`) VALUES
('redacao_68c30c0c570b08.08202593', 4, 'Lorena', 'Desafios para a valorização de comunidades e povos tradicionais no Brasil', '', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2025-09-11 17:51:08', 'corrigida', 200, 200, 20, 200, 80, 700, 'meia boca', 'nenhum', 'todos'),
('redacao_68c30daa509d32.46166696', 4, 'Lorena', 'Publicidade infantil em questão no Brasil', '', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2025-09-11 17:58:02', 'pendente', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `temas`
--

DROP TABLE IF EXISTS `temas`;
CREATE TABLE IF NOT EXISTS `temas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `textos_motivadores` text NOT NULL,
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
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_cadastro`, `is_admin`) VALUES
(3, 'Paola', 'paoladgasparii.pdg@gmail.com', '$2y$10$42sGyrSGBakkkp5th9YfWuIVVaMNuUDqfggfYmcERz07JH7qPHUSq', '2025-08-14 17:39:06', 1),
(4, 'Lorena', 'lorena123@gmail.com', '$2y$10$IQbK/2CcDLzX01zb4xs3X.1pB5p4qscRu6ePGJ3pPcEF6qVmlp3JW', '2025-09-11 17:51:01', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
