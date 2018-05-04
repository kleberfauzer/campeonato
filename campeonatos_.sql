create schema campeonatos_;

use campeonatos_;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: campeonatos_'

CREATE TABLE `usuario` (
  `usuario` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `data_nasc` varchar(10) NOT NULL,
  `data_criacao` varchar(10) NOT NULL,
   PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `campeonato` (
  `id` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `num_times` int(11) NOT NULL,
  `data_criacao` varchar(10) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `time` (
  `nome` varchar(100) NOT NULL,
  `dono` varchar(100) NOT NULL,
  `data_criacao` varchar(100) NOT NULL,
  PRIMARY KEY (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `classificacao` (
  `id_campeonato` varchar(100) NOT NULL,
  `nome_time` varchar(100) NOT NULL,
  `gols_pro` int(11) NOT NULL,
  `gols_contra` int(11) NOT NULL,
  `saldo_gols` int(11) NOT NULL,
  `pontuacao` int(11) NOT NULL,
  primary key (id_campeonato, nome_time),
  foreign key (id_campeonato) references campeonato(id), 
  foreign key (nome_time) references time(nome) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `mata_mata` (
  `id_campeonato` varchar(100) NOT NULL,
  `nome_time` varchar(100) NOT NULL,
  `gols_pro` int(11) NOT NULL,
  `gols_contra` int(11) NOT NULL,
   `classificado` varchar(100) NOT NULL,
   primary key (id_campeonato, nome_time),
   foreign key (id_campeonato) references campeonato(id), 
   foreign key (nome_time) references time(nome) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `jogo` (
  `id` varchar(100) NOT NULL,
  `id_campeonato` varchar(100) NOT NULL,
  `nome_time_casa` varchar(100) NOT NULL,
  `gols_casa` int(11) NOT NULL,
  `gols_visitante` int(11) NOT NULL,
  `nome_time_visitante` varchar(100) NOT NULL,
   PRIMARY KEY (`id`),
   foreign key jogo(id_campeonato) references campeonato(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `jogo_classificacao` (
  `id_campeonato` varchar(100) NOT NULL,
  `id_jogo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `time_campeonato` (
  `nome_time` varchar(100) NOT NULL,
  `id_campeonato` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `time_jogo` (
  `nome_time` varchar(100) NOT NULL,
  `id_jogo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `jogo_mata` (
  `id_mata` varchar(100) NOT NULL,
  `id_campeonato_mata` varchar(100) NOT NULL,
  `nome_time_casa_mata` varchar(100) NOT NULL,
  `gols_casa_mata` int(11) NOT NULL,
  `gols_visitante_mata` int(11) NOT NULL,
  `nome_time_visitante_mata` varchar(100) NOT NULL,
   PRIMARY KEY (`id_mata`),
   foreign key (id_campeonato_mata) references campeonato(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `usuario_campeonato` (
  `usuario` varchar(100) NOT NULL,
  `id_campeonato` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
