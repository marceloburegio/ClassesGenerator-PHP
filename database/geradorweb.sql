/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;

CREATE TABLE `atributos` (

  `classeId` int(10) unsigned NOT NULL,

  `atributoId` int(10) unsigned NOT NULL AUTO_INCREMENT,

  `nome` varchar(50) NOT NULL DEFAULT '',

  `acesso` varchar(20) NOT NULL DEFAULT 'private',

  `tipo` varchar(50) NOT NULL DEFAULT '',

  `resumo` varchar(200) DEFAULT NULL,

  `descricao` text,

  `colunaBd` varchar(100) DEFAULT NULL,

  `chavePk` tinyint(1) DEFAULT NULL,

  `ordem` smallint(5) unsigned NOT NULL,

  PRIMARY KEY (`atributoId`),

  UNIQUE KEY `UniqueIndex` (`classeId`,`nome`)

) ENGINE=InnoDB AUTO_INCREMENT=13006 DEFAULT CHARSET=latin1;


CREATE TABLE `classes` (

  `sistemaId` int(10) unsigned NOT NULL,

  `classeId` int(10) unsigned NOT NULL AUTO_INCREMENT,

  `nome` varchar(50) NOT NULL DEFAULT '',

  `tipo` char(2) NOT NULL DEFAULT '',

  `tipoCamada` char(2) DEFAULT NULL,

  `resumo` varchar(200) DEFAULT NULL,

  `descricao` text,

  `autor` varchar(200) DEFAULT NULL,

  `pacote` varchar(100) DEFAULT NULL,

  `subpacote` varchar(100) DEFAULT NULL,

  `versao` varchar(10) DEFAULT NULL,

  `dataCriacao` datetime NOT NULL,

  `tabelaBd` varchar(100) DEFAULT NULL,

  PRIMARY KEY (`classeId`),

  UNIQUE KEY `UniqueIndex` (`nome`,`sistemaId`)

) ENGINE=InnoDB AUTO_INCREMENT=5406 DEFAULT CHARSET=latin1;


CREATE TABLE `intfaces` (

  `classeId` int(10) unsigned NOT NULL,

  `intfaceId` int(10) unsigned NOT NULL,

  PRIMARY KEY (`classeId`,`intfaceId`)

) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `metodos` (

  `classeId` int(10) unsigned NOT NULL,

  `metodoId` int(10) unsigned NOT NULL AUTO_INCREMENT,

  `nome` varchar(50) NOT NULL DEFAULT '',

  `acesso` varchar(20) DEFAULT NULL,

  `retorno` varchar(50) DEFAULT NULL,

  `conteudo` text NOT NULL,

  `resumo` varchar(200) DEFAULT NULL,

  `descricao` text,

  `ordem` smallint(5) unsigned NOT NULL,

  PRIMARY KEY (`metodoId`),

  UNIQUE KEY `UniqueIndex` (`classeId`,`nome`)

) ENGINE=InnoDB AUTO_INCREMENT=37833 DEFAULT CHARSET=latin1;


CREATE TABLE `parametros` (

  `metodoId` int(10) unsigned NOT NULL,

  `parametroId` int(10) unsigned NOT NULL AUTO_INCREMENT,

  `nome` varchar(50) NOT NULL DEFAULT '',

  `tipo` varchar(50) NOT NULL DEFAULT '',

  `valorPadrao` varchar(200) NOT NULL DEFAULT '',

  `ordem` smallint(5) unsigned NOT NULL,

  PRIMARY KEY (`parametroId`),

  UNIQUE KEY `UniqueIndex` (`nome`,`metodoId`)

) ENGINE=InnoDB AUTO_INCREMENT=34962 DEFAULT CHARSET=latin1;


CREATE TABLE `sistemas` (

  `sistemaId` int(10) unsigned NOT NULL AUTO_INCREMENT,

  `nome` varchar(50) NOT NULL DEFAULT '',

  `descricao` text,

  `criadoPor` varchar(255) NOT NULL DEFAULT '',

  PRIMARY KEY (`sistemaId`),

  UNIQUE KEY `UniqueIndex` (`nome`)

) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;


CREATE TABLE `throws` (

  `metodoId` int(10) unsigned DEFAULT NULL,

  `throwsId` int(10) unsigned NOT NULL AUTO_INCREMENT,

  `nome` varchar(50) NOT NULL DEFAULT '',

  `ordem` smallint(5) unsigned DEFAULT NULL,

  PRIMARY KEY (`throwsId`),

  UNIQUE KEY `UniqueIndex` (`metodoId`,`nome`)

) ENGINE=InnoDB AUTO_INCREMENT=21400 DEFAULT CHARSET=latin1;


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
