CREATE DATABASE  IF NOT EXISTS `deliver_it` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `deliver_it`;

--
-- Table structure for table `corredores`
--

DROP TABLE IF EXISTS `corredores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `corredores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(300) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `corredores`
--

LOCK TABLES `corredores` WRITE;
/*!40000 ALTER TABLE `corredores` DISABLE KEYS */;
INSERT INTO `corredores` VALUES (1,'Mateus','06704671631','1996-11-22'),(2,'Ana','06704671633','1986-11-06'),(3,'Brena','06704671635','1986-11-06'),(4,'Paulo','06704671669','2002-11-05'),(5,'GIl','06704671668','2000-10-05'),(6,'Afonso','06704671666','1976-10-05');
/*!40000 ALTER TABLE `corredores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provas`
--

DROP TABLE IF EXISTS `provas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `provas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_prova` int(2) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provas`
--

LOCK TABLES `provas` WRITE;
/*!40000 ALTER TABLE `provas` DISABLE KEYS */;
INSERT INTO `provas` VALUES (1,3,'2025-04-20'),(2,5,'2025-04-20'),(3,21,'2021-04-21');
/*!40000 ALTER TABLE `provas` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `corredor_provas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `corredor_provas` (
  `id_corredor` int(11) NOT NULL,
  `id_prova` int(11) NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  PRIMARY KEY (`id_corredor`,`id_prova`),
  KEY `fk_corredor_provas_2_idx` (`id_prova`),
  CONSTRAINT `fk_corredor_provas_1` FOREIGN KEY (`id_corredor`) REFERENCES `corredores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_corredor_provas_2` FOREIGN KEY (`id_prova`) REFERENCES `provas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `corredor_provas`
--

LOCK TABLES `corredor_provas` WRITE;
/*!40000 ALTER TABLE `corredor_provas` DISABLE KEYS */;
INSERT INTO `corredor_provas` VALUES (1,1,'20:30:25','21:00:01'),(1,3,'08:30:00','09:07:09'),(2,1,'20:30:25','21:10:01'),(3,1,'20:30:25','21:10:03'),(3,3,'08:30:00','09:10:03'),(4,3,'08:30:00','09:11:03'),(5,3,'08:30:00','09:11:09'),(6,3,'08:30:00','09:05:09');
/*!40000 ALTER TABLE `corredor_provas` ENABLE KEYS */;
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-18 22:12:29
