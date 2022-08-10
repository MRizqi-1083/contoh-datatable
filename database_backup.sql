/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.24 : Database - contoh_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`contoh_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `contoh_db`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur` int(5) NOT NULL,
  `alamat` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','non-aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `nama_idx` (`name`),
  KEY `status_idx` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=21917 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/* Procedure structure for procedure `sp_getdata` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_getdata` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getdata`(IN p_start INT,IN p_length INT,IN p_cari VARCHAR(100),IN p_col INT, IN p_dir VARCHAR(5),OUT p_total INT)
BEGIN
		SELECT 
			SQL_CALC_FOUND_ROWS
			users.id,
			users.name,
			users.email,
			users.instansi,
			users.divisi,
			users.jabatan,
			users.status 
		from users
		where
		       users.name LIKE COALESCE(p_cari,users.name)
		       OR users.email LIKE COALESCE(p_cari,users.email)
		       OR users.instansi LIKE COALESCE(p_cari,users.instansi)
		       OR users.divisi LIKE COALESCE(p_cari,users.divisi)
		       OR users.jabatan LIKE COALESCE(p_cari,users.jabatan)
		       OR users.status LIKE COALESCE(p_cari,users.status)
		 ORDER BY                    
		    CASE WHEN p_col = 1 AND p_dir = 'desc' THEN users.name END DESC,    
		    CASE WHEN p_col = 1 AND p_dir = 'asc' THEN users.name END ASC,                   
                    CASE WHEN p_col = 2 AND p_dir = 'desc' THEN users.email END DESC,    
                    CASE WHEN p_col = 2 AND p_dir = 'asc' THEN users.email END ASC,    
                    CASE WHEN p_col = 3 AND p_dir = 'desc' THEN users.instansi END DESC,
                    CASE WHEN p_col = 3 AND p_dir = 'asc' THEN users.instansi END ASC,
                    CASE WHEN p_col = 4 AND p_dir = 'desc' THEN users.divisi END DESC,
                    CASE WHEN p_col = 4 AND p_dir = 'asc' THEN users.divisi END ASC,
                    CASE WHEN p_col = 5 AND p_dir = 'desc' THEN users.jabatan END DESC,
                    CASE WHEN p_col = 5 AND p_dir = 'asc' THEN users.jabatan END ASC,
                    CASE WHEN p_col = 5 AND p_dir = 'desc' THEN users.status END DESC,
                    CASE WHEN p_col = 5 AND p_dir = 'asc' THEN users.status END ASC
		LIMIT p_start,p_length;
		SET p_total = FOUND_ROWS();
	END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
