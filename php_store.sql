-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Jul-2023 às 22:09
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_store`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `ativo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome`, `ativo`) VALUES
(1, 'moda masculina', 1),
(2, 'moda feminina', 1),
(3, 'infantil', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `endereço` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `verificacao` varchar(50) NOT NULL,
  `ativo` tinyint(4) NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delete_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `senha`, `cidade`, `endereço`, `telefone`, `verificacao`, `ativo`, `create_at`, `update_at`, `delete_at`) VALUES
(1, 'nome teste', 'email@email.com', '$2y$10$SWTlZbYaat5GWb79WcKOzOe/bz3gI24myeIl7e6KXHeTTM0k6Uuoq', 'cudadsa', 'rua teste', '9545124211', 'sApG9xZzdk18', 1, '2023-07-06 16:04:25', '2023-07-07 07:14:05', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `categoria` int(11) NOT NULL,
  `url_imagem` varchar(200) NOT NULL,
  `preco` decimal(6,2) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `estoque` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `delete_at` datetime DEFAULT NULL,
  `nome_produto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `descricao`, `categoria`, `url_imagem`, `preco`, `ativo`, `estoque`, `created_at`, `updated_at`, `delete_at`, `nome_produto`) VALUES
(1, 'descrição do produto refente a qualquer coisa', 2, 'tshirt.png', '1056.00', 1, 5, '2023-07-07 16:43:08', '2023-07-07 16:43:08', NULL, 'Camisa preta masculina'),
(2, 'descrição do produto', 2, 'dress_red.png', '120.25', 1, 6, '2023-07-07 16:46:50', '2023-07-07 16:46:50', NULL, 'Vestido vermelho'),
(3, 'descrição do produto', 2, 'tshirt_green.png', '99.00', 1, 6, '2023-07-07 16:47:49', '2023-07-07 16:47:49', NULL, 'Camisa masculina verde'),
(4, 'descrição do produto', 2, 'tshirt_black.png', '55.25', 1, 6, '2023-07-07 17:02:49', '2023-07-07 17:02:49', NULL, 'Camisa preta masculina'),
(5, 'camisa kids', 3, 'camisa_infantil.png', '22.50', 1, 3, '2023-07-10 17:28:31', '2023-07-10 17:28:31', NULL, 'Camisa Kids');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
