-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 20-Jun-2018 às 20:15
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `campeonatos_`
--
CREATE DATABASE IF NOT EXISTS `campeonatos_` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `campeonatos_`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `campeonato`
--

CREATE TABLE IF NOT EXISTS `campeonato` (
  `id` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `num_times` int(11) NOT NULL,
  `tipo` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `campeonato`
--

INSERT INTO `campeonato` (`id`, `nome`, `num_times`, `tipo`) VALUES
('1036790213', 'BrasileirÃ£o 2018', 20, 'pc'),
('1189879260', 'Copa do Brasil', 10, 'mm'),
('16519292', 'novinho', 2, 'pc'),
('76517659', 'camP', 2, 'pc');

-- --------------------------------------------------------

--
-- Estrutura da tabela `classificacao`
--

CREATE TABLE IF NOT EXISTS `classificacao` (
  `id_campeonato` varchar(100) NOT NULL,
  `nome_time` varchar(100) NOT NULL,
  `gols_pro` int(11) NOT NULL,
  `gols_contra` int(11) NOT NULL,
  `saldo_gols` int(11) NOT NULL,
  `pontuacao` int(11) NOT NULL,
  PRIMARY KEY (`id_campeonato`,`nome_time`),
  KEY `nome_time` (`nome_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `classificacao`
--

INSERT INTO `classificacao` (`id_campeonato`, `nome_time`, `gols_pro`, `gols_contra`, `saldo_gols`, `pontuacao`) VALUES
('1036790213', 'SÃ£o Paulo FC', 0, 0, 0, 0),
('16519292', 'black FC', 0, 0, 0, 0),
('16519292', 'SÃ£o Paulo FC', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogo`
--

CREATE TABLE IF NOT EXISTS `jogo` (
  `id` varchar(100) NOT NULL,
  `id_campeonato` varchar(100) NOT NULL,
  `nome_time_casa` varchar(100) NOT NULL,
  `gols_casa` int(11) NOT NULL,
  `gols_visitante` int(11) NOT NULL,
  `nome_time_visitante` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jogo` (`id_campeonato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jogo`
--

INSERT INTO `jogo` (`id`, `id_campeonato`, `nome_time_casa`, `gols_casa`, `gols_visitante`, `nome_time_visitante`) VALUES
('862074201', '16519292', 'black FC', 0, 0, 'SÃ£o Paulo FC');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogo_classificacao`
--

CREATE TABLE IF NOT EXISTS `jogo_classificacao` (
  `id_campeonato` varchar(100) NOT NULL,
  `id_jogo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jogo_classificacao`
--

INSERT INTO `jogo_classificacao` (`id_campeonato`, `id_jogo`) VALUES
('16519292', 1688739124),
('16519292', 913665692),
('16519292', 1014657256),
('16519292', 274559461),
('16519292', 2010872618),
('16519292', 1205566257),
('16519292', 1324070915),
('16519292', 862074201);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogo_mata`
--

CREATE TABLE IF NOT EXISTS `jogo_mata` (
  `id_mata` varchar(100) NOT NULL,
  `id_campeonato_mata` varchar(100) NOT NULL,
  `nome_time_casa_mata` varchar(100) NOT NULL,
  `gols_casa_mata` int(11) NOT NULL,
  `gols_visitante_mata` int(11) NOT NULL,
  `nome_time_visitante_mata` varchar(100) NOT NULL,
  PRIMARY KEY (`id_mata`),
  KEY `id_campeonato_mata` (`id_campeonato_mata`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mata_mata`
--

CREATE TABLE IF NOT EXISTS `mata_mata` (
  `id_campeonato` varchar(100) NOT NULL,
  `nome_time` varchar(100) NOT NULL,
  `gols_pro` int(11) NOT NULL,
  `gols_contra` int(11) NOT NULL,
  `classificado` varchar(100) NOT NULL,
  PRIMARY KEY (`id_campeonato`,`nome_time`),
  KEY `nome_time` (`nome_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `mata_mata`
--

INSERT INTO `mata_mata` (`id_campeonato`, `nome_time`, `gols_pro`, `gols_contra`, `classificado`) VALUES
('1189879260', 'SÃ£o Paulo FC', 0, 0, '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `time`
--

CREATE TABLE IF NOT EXISTS `time` (
  `nome` varchar(100) NOT NULL,
  `dono` varchar(100) NOT NULL,
  PRIMARY KEY (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `time`
--

INSERT INTO `time` (`nome`, `dono`) VALUES
('black FC', 'kleberfauzer'),
('Corinthians', 'guilherme'),
('SÃ£o Paulo FC', 'gabriel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `time_campeonato`
--

CREATE TABLE IF NOT EXISTS `time_campeonato` (
  `nome_time` varchar(100) NOT NULL,
  `id_campeonato` varchar(100) NOT NULL,
  `tipo` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `time_campeonato`
--

INSERT INTO `time_campeonato` (`nome_time`, `id_campeonato`, `tipo`) VALUES
('SÃ£o Paulo FC', '1036790213', 'pc'),
('SÃ£o Paulo FC', '16519292', 'pc'),
('', '16519292', 'pc'),
('', '16519292', 'pc'),
('', '16519292', 'pc'),
('', '16519292', 'pc'),
('', '16519292', 'pc'),
('', '16519292', 'pc'),
('', '16519292', 'pc'),
('', '16519292', 'pc'),
('black FC', '16519292', 'pc');

-- --------------------------------------------------------

--
-- Estrutura da tabela `time_jogo`
--

CREATE TABLE IF NOT EXISTS `time_jogo` (
  `nome_time` varchar(100) NOT NULL,
  `id_jogo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `time_jogo`
--

INSERT INTO `time_jogo` (`nome_time`, `id_jogo`) VALUES
('black FC', '1688739124'),
('SÃ£o Paulo FC', '1688739124'),
('black FC', '913665692'),
('1688739124', '913665692'),
('black FC', '1014657256'),
('913665692', '1014657256'),
('black FC', '274559461'),
('1014657256', '274559461'),
('black FC', '2010872618'),
('274559461', '2010872618'),
('black FC', '1205566257'),
('2010872618', '1205566257'),
('', '1324070915'),
('SÃ£o Paulo FC', '1324070915'),
('black FC', '862074201'),
('SÃ£o Paulo FC', '862074201');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `data_nasc` varchar(10) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario`, `nome`, `senha`, `data_nasc`) VALUES
('eu', 'eu', '1234', '2001-05-19'),
('gabriel', 'Gabriel', '1234', '2001-03-13'),
('guilherme', 'Guilherme', '1234', '0001-01-01'),
('kleberfauzer', 'kleber', 'kleber', '2001-07-17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_campeonato`
--

CREATE TABLE IF NOT EXISTS `usuario_campeonato` (
  `usuario` varchar(100) NOT NULL,
  `id_campeonato` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario_campeonato`
--

INSERT INTO `usuario_campeonato` (`usuario`, `id_campeonato`) VALUES
('gabriel', '1036790213'),
('gabriel', '1189879260'),
('gabriel', '16519292'),
('gabriel', '76517659');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `classificacao`
--
ALTER TABLE `classificacao`
  ADD CONSTRAINT `classificacao_ibfk_1` FOREIGN KEY (`id_campeonato`) REFERENCES `campeonato` (`id`),
  ADD CONSTRAINT `classificacao_ibfk_2` FOREIGN KEY (`nome_time`) REFERENCES `time` (`nome`);

--
-- Limitadores para a tabela `jogo`
--
ALTER TABLE `jogo`
  ADD CONSTRAINT `jogo_ibfk_1` FOREIGN KEY (`id_campeonato`) REFERENCES `campeonato` (`id`);

--
-- Limitadores para a tabela `jogo_mata`
--
ALTER TABLE `jogo_mata`
  ADD CONSTRAINT `jogo_mata_ibfk_1` FOREIGN KEY (`id_campeonato_mata`) REFERENCES `campeonato` (`id`);

--
-- Limitadores para a tabela `mata_mata`
--
ALTER TABLE `mata_mata`
  ADD CONSTRAINT `mata_mata_ibfk_1` FOREIGN KEY (`id_campeonato`) REFERENCES `campeonato` (`id`),
  ADD CONSTRAINT `mata_mata_ibfk_2` FOREIGN KEY (`nome_time`) REFERENCES `time` (`nome`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
