-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jun-2020 às 19:30
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ist`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_disc`
--

CREATE TABLE `lista_disc` (
  `nome` varchar(25) NOT NULL,
  `id_lista` int(11) NOT NULL,
  `categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `lista_disc`
--

INSERT INTO `lista_disc` (`nome`, `id_lista`, `categoria`) VALUES
('Lingua Portuguesa', 1, 2),
('Ed. Física', 4, 1),
('Ed. Física', 5, 2),
('Ed. Física', 6, 3),
('Ed. Física', 7, 4),
('Inglês', 8, 1),
('Inglês', 9, 2),
('Inglês', 10, 3),
('Inglês', 11, 4),
('Lingua Portuguesa', 12, 1),
('Lingua Portuguesa', 13, 3),
('Lingua Portuguesa', 14, 4),
('Matemática', 15, 1),
('Matemática', 16, 2),
('Matemática', 17, 3),
('Matemática', 18, 4),
('Ciências', 20, 1),
('Ciências', 21, 4),
('Geografia', 22, 2),
('Geografia', 23, 3),
('Geografia', 24, 4),
('História', 25, 2),
('História', 26, 3),
('História', 27, 4),
('Ciências Sociais', 28, 2),
('Arte', 29, 2),
('Arte', 31, 3),
('Literatura', 32, 3),
('Filosofia', 33, 3),
('Sociologia', 34, 3),
('Redação', 35, 3),
('Física', 36, 3),
('Química', 37, 3),
('Biologia', 38, 3),
('Filosofia', 39, 4),
('Química', 40, 4),
('Sociologia', 41, 4),
('Redação', 42, 4),
('Física', 43, 4),
('Arte', 44, 4),
('Biologia', 45, 4),
('Ciências', 46, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `lista_disc`
--
ALTER TABLE `lista_disc`
  ADD PRIMARY KEY (`id_lista`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lista_disc`
--
ALTER TABLE `lista_disc`
  MODIFY `id_lista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
