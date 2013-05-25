-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.66-0ubuntu0.11.10.2 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-05-20 16:14:47
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for petdog
CREATE DATABASE IF NOT EXISTS `petdog` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `petdog`;


-- Dumping structure for table petdog.animal
CREATE TABLE IF NOT EXISTS `animal` (
  `idanimal` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` int(10) DEFAULT NULL,
  `idade` int(10) DEFAULT NULL,
  `raca` varchar(25) DEFAULT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `descricao` text,
  `foto` varchar(250) DEFAULT NULL,
  `adicionado` datetime DEFAULT NULL,
  `doador` int(11) DEFAULT NULL,
  `adotado_por` int(11) DEFAULT NULL,
  `adotado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`idanimal`),
  KEY `doador` (`doador`),
  KEY `adotado_por` (`adotado_por`),
  CONSTRAINT `FK_animal_usuario` FOREIGN KEY (`doador`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_animal_usuario_2` FOREIGN KEY (`adotado_por`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table petdog.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `telefone` varchar(12) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `usuario` varchar(25) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `adm` tinyint(4) DEFAULT '0',
  `cadastro` datetime DEFAULT NULL,
  `ultimo_acesso` datetime DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
