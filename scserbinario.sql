-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: sc_serbinario
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aplicacoes`
--

DROP TABLE IF EXISTS `aplicacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aplicacoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `projetos_id` int(10) unsigned NOT NULL,
  `nome_aplicacao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `table_name_aplicacao` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `aplicacoes_projetos_id_foreign` (`projetos_id`),
  CONSTRAINT `aplicacoes_projetos_id_foreign` FOREIGN KEY (`projetos_id`) REFERENCES `projetos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aplicacoes`
--

LOCK TABLES `aplicacoes` WRITE;
/*!40000 ALTER TABLE `aplicacoes` DISABLE KEYS */;
INSERT INTO `aplicacoes` VALUES (1,1,'Categoria','categories','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,2,'Produto','products','0000-00-00 00:00:00','2015-10-18 01:27:41'),(3,3,'Cadastro de Clientes e Fornecedores','clientes_fornecedores','2015-10-18 01:34:58','2015-10-18 01:35:06');
/*!40000 ALTER TABLE `aplicacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campos`
--

DROP TABLE IF EXISTS `campos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `campos_tipo_id_foreign` (`tipo_id`),
  CONSTRAINT `campos_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campos`
--

LOCK TABLES `campos` WRITE;
/*!40000 ALTER TABLE `campos` DISABLE KEYS */;
/*!40000 ALTER TABLE `campos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2015_10_28_141157_create_tipos_table',1),('2015_10_28_141209_create_campos_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operacoes`
--

DROP TABLE IF EXISTS `operacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operacoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rota_operacoes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aplicacao_id` int(10) unsigned NOT NULL,
  `tipo_crud_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `operacoes_aplicacoes_id_foreign` (`aplicacao_id`),
  KEY `operacoes_tipo_crud_id_foreign` (`tipo_crud_id`),
  CONSTRAINT `operacoes_aplicacoes_id_foreign` FOREIGN KEY (`aplicacao_id`) REFERENCES `aplicacoes` (`id`),
  CONSTRAINT `operacoes_tipo_crud_id_foreign` FOREIGN KEY (`tipo_crud_id`) REFERENCES `tipo_crud` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operacoes`
--

LOCK TABLES `operacoes` WRITE;
/*!40000 ALTER TABLE `operacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `operacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projetos`
--

DROP TABLE IF EXISTS `projetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projetos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome_projeto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao_projeto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_space_projeto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome_db_projeto` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `path_projeto_projeto` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projetos`
--

LOCK TABLES `projetos` WRITE;
/*!40000 ALTER TABLE `projetos` DISABLE KEYS */;
INSERT INTO `projetos` VALUES (1,'Protocolo','Sistema de gerenciamento de protocolo eletronico','SCSerbinario','protocolo','','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'Agendamento','Sistema de agendamento eletronico para a saúde','SCSerbinario','agendamento','','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'Serbinario Gestor','Sistema que gerenciará:\r\n- Cadastro de usuário\r\n- Contas a Pagar e Receber\r\n- Agenda\r\n- Cadastro de Propostas','Serbinario','sergestor','SerGestor','2015-10-17 21:12:51','2015-10-17 21:12:51');
/*!40000 ALTER TABLE `projetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_crud`
--

DROP TABLE IF EXISTS `tipo_crud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_crud` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_crud` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_crud`
--

LOCK TABLES `tipo_crud` WRITE;
/*!40000 ALTER TABLE `tipo_crud` DISABLE KEYS */;
INSERT INTO `tipo_crud` VALUES (1,'edit','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'create','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'new','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'delete','0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'grid','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tipo_crud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos`
--

DROP TABLE IF EXISTS `tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome_tipos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos`
--

LOCK TABLES `tipos` WRITE;
/*!40000 ALTER TABLE `tipos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-28 13:14:01
