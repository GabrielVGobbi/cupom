-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14-Mar-2020 às 13:37
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cupom`
--
CREATE DATABASE IF NOT EXISTS `cupom` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cupom`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `id_endereco` int(11) DEFAULT NULL,
  `id_company` varchar(45) DEFAULT NULL,
  `cli_nome` varchar(255) DEFAULT NULL COMMENT 'nome do restaurante \\\\nexemplo: cabana ',
  `cli_telefone` varchar(13) DEFAULT NULL COMMENT 'data em que a loja foi criada ',
  `cli_email` varchar(95) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `hash_id` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `id_endereco`, `id_company`, `cli_nome`, `cli_telefone`, `cli_email`, `create_date`, `hash_id`) VALUES
(6, NULL, '1', 'Cabana', '11971501923', 'cabana@cabana', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `companies`
--

INSERT INTO `companies` (`id`, `name`) VALUES
(1, 'Agencia 1123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom`
--

CREATE TABLE `cupom` (
  `id_cupom` int(11) NOT NULL,
  `cup_titulo` varchar(95) DEFAULT NULL COMMENT 'titulo do cupom: HAMBURGUER EM DOBRO',
  `cup_descricao` varchar(255) DEFAULT NULL COMMENT 'descricao do cupom',
  `cup_valor` decimal(10,2) DEFAULT NULL COMMENT 'valor',
  `cup_expiracao` date DEFAULT NULL,
  `cup_codigo` varchar(255) DEFAULT NULL COMMENT 'codigo do cupom gerado pelas duas inicias do titulo \ne numeros aleatorios \nsem repetir um ou outro ',
  `cup_condicoes` mediumtext COMMENT 'condições para usar o cupom',
  `create_date` date DEFAULT NULL COMMENT 'data em que a loja foi criada '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom_cliente`
--

CREATE TABLE `cupom_cliente` (
  `id_cupom_cliente` int(11) NOT NULL,
  `id_cupom` int(11) DEFAULT NULL COMMENT 'id do cupom ',
  `id_cliente` int(11) DEFAULT NULL COMMENT 'id da loja',
  `status` varchar(1) DEFAULT '0' COMMENT 'STATUS DO CUPOM\n\n0 para ativo \n1 para inativo \n2 para já usado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `params` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `id_company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `name`, `params`, `id_company`) VALUES
(1, 'admin', '1,2,3,4', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_params`
--

CREATE TABLE `permission_params` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `permission_params`
--

INSERT INTO `permission_params` (`id`, `name`, `id_company`) VALUES
(1, 'cupom_view', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `login` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `usr_info` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `user_photo_url` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `id_group` int(11) NOT NULL,
  `id_company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `password`, `usr_info`, `user_photo_url`, `id_group`, `id_company`) VALUES
(1, 'suporte@suporte', '1', '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cupom`
--
ALTER TABLE `cupom`
  ADD PRIMARY KEY (`id_cupom`);

--
-- Indexes for table `cupom_cliente`
--
ALTER TABLE `cupom_cliente`
  ADD PRIMARY KEY (`id_cupom_cliente`);

--
-- Indexes for table `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `params_idx` (`params`);

--
-- Indexes for table `permission_params`
--
ALTER TABLE `permission_params`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_idx` (`id_company`),
  ADD KEY `fk_permissions_groups_idx` (`id_group`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cupom`
--
ALTER TABLE `cupom`
  MODIFY `id_cupom` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cupom_cliente`
--
ALTER TABLE `cupom_cliente`
  MODIFY `id_cupom_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permission_params`
--
ALTER TABLE `permission_params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `company` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permissions_groups` FOREIGN KEY (`id_group`) REFERENCES `permission_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
