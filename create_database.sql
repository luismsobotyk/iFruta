DROP TABLE IF EXISTS `CURSO`;

CREATE TABLE `CURSO` (
                         `id_curso` varchar(5) NOT NULL,
                         `nome_curso` varchar(40) NOT NULL,
                         PRIMARY KEY (`id_curso`)
);

DROP TABLE IF EXISTS `ALUNOS`;

CREATE TABLE `ALUNOS` (
                          `matricula` varchar(10) NOT NULL,
                          `id_curso` varchar(5) NOT NULL,
                          `nome` varchar(50) NOT NULL,
                          `login` varchar(12) NOT NULL,
                          PRIMARY KEY (`matricula`),
                          KEY `fk_id_curso` (`id_curso`),
                          CONSTRAINT `fk_id_curso` FOREIGN KEY (`id_curso`) REFERENCES `CURSO` (`id_curso`) ON DELETE RESTRICT ON UPDATE RESTRICT
);

DROP TABLE IF EXISTS `REGISTROS`;

CREATE TABLE `REGISTROS` (
                             `id_reg` int NOT NULL AUTO_INCREMENT,
                             `registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                             `matricula_aluno` varchar(10) NOT NULL,
                             PRIMARY KEY (`id_reg`),
                             KEY `REGISTROS_FK` (`matricula_aluno`),
                             CONSTRAINT `REGISTROS_FK` FOREIGN KEY (`matricula_aluno`) REFERENCES `ALUNOS` (`matricula`)
);

DROP TABLE IF EXISTS `ADMINISTRADOR`;

CREATE TABLE `ADMINISTRADOR` (
                                 `id_admin` INT NOT NULL AUTO_INCREMENT,
                                 `nome` VARCHAR(50) NOT NULL,
                                 `email` VARCHAR(100) NOT NULL UNIQUE,
                                 `senha` VARCHAR(255) NOT NULL,
                                 `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                 PRIMARY KEY (`id_admin`)
);

