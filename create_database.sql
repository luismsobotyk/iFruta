USE ifruta;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ALUNOS`
--

DROP TABLE IF EXISTS `ALUNOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ALUNOS` (
  `matricula` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_curso` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`matricula`),
  KEY `fk_id_curso` (`id_curso`),
  CONSTRAINT `fk_id_curso` FOREIGN KEY (`id_curso`) REFERENCES `CURSO` (`id_curso`) ON DELETE RESTRICT ON UPDATE RESTRICT
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CURSO`
--

DROP TABLE IF EXISTS `CURSO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CURSO` (
  `id_curso` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_curso` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_curso`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `REGISTROS`
--

DROP TABLE IF EXISTS `REGISTROS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `REGISTROS` (
  `id_reg` int NOT NULL AUTO_INCREMENT,
  `registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `matricula_aluno` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_reg`),
  KEY `REGISTROS_FK` (`matricula_aluno`),
  CONSTRAINT `REGISTROS_FK` FOREIGN KEY (`matricula_aluno`) REFERENCES `ALUNOS` (`matricula`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

-- Table structure for table `ADMINISTRADOR`

DROP TABLE IF EXISTS `ADMINISTRADOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ADMINISTRADOR` (
  `id_admin` INT NOT NULL AUTO_INCREMENT, -- ID único para cada administrador
  `nome` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL, -- Nome do administrador
  `email` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE, -- Email do administrador
  `senha` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL, -- Senha do administrador (hash)
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, -- Data de criação do registro
  PRIMARY KEY (`id_admin`) -- Chave primária
);
/*!40101 SET character_set_client = @saved_cs_client */;
