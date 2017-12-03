-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.13-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela sysseller.log_dia
CREATE TABLE IF NOT EXISTS `log_dia` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `data` varchar(50) NOT NULL,
  `acesso` int(11) NOT NULL DEFAULT '0',
  `unico` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela sysseller.log_link
CREATE TABLE IF NOT EXISTS `log_link` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `data` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `link` varchar(50) DEFAULT NULL,
  `req` varchar(50) DEFAULT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela sysseller.log_mes
CREATE TABLE IF NOT EXISTS `log_mes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` varchar(50) NOT NULL,
  `acesso` int(11) NOT NULL DEFAULT '0',
  `unico` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela sysseller.log_unico_dia
CREATE TABLE IF NOT EXISTS `log_unico_dia` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `data` varchar(50) NOT NULL,
  `contador` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela sysseller.log_unico_mes
CREATE TABLE IF NOT EXISTS `log_unico_mes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `data` varchar(50) NOT NULL,
  `contador` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
