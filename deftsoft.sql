/*
SQLyog Ultimate v8.5 
MySQL - 5.6.16 : Database - deftsoft
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`deftsoft` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `deftsoft`;

/*Table structure for table `blog_categories` */

DROP TABLE IF EXISTS `blog_categories`;

CREATE TABLE `blog_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_categories` */

insert  into `blog_categories`(`id`,`name`,`status`,`created_at`,`updated_at`) values (1,'Technology','Active','2017-01-01 11:11:11',NULL),(2,'News','Active','2017-01-01 11:11:11',NULL),(3,'Business','Active','2017-01-01 11:11:11',NULL);

/*Table structure for table `client_testmonial` */

DROP TABLE IF EXISTS `client_testmonial`;

CREATE TABLE `client_testmonial` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_profilImg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `projectImg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `feedbacks` longtext COLLATE utf8_unicode_ci NOT NULL,
  `projectUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive','deleted') COLLATE utf8_unicode_ci DEFAULT 'active',
  `testimonial_type` enum('text','video') COLLATE utf8_unicode_ci DEFAULT 'text',
  `videoUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `client_testmonial` */

insert  into `client_testmonial`(`id`,`client_name`,`client_address`,`client_profilImg`,`projectImg`,`feedbacks`,`projectUrl`,`status`,`testimonial_type`,`videoUrl`,`created_at`,`updated_at`) values (1,'SACHA ALAGICH','Owner of lifestyle brand ESCAPE TO PARADISE','1483509973111x111_client-img1.jpg','1483454844redirect_wordpress_under_maintenance_page.jpg','<p>Thanks for your good work.</p>\r\n','http://oncallmanagementsystems.com','active','text','','2017-01-01 23:00:00','2017-01-04 06:06:14'),(4,'Thaka','Owner of lifestyle brand ESCAPE TO PARADISE','1483637309client-img-small.jpg','1483637309testi-img.png','<p>Thanks for your good work.</p>\r\n','https://www.youtube.com/embed/PCzFer2mQ80','active','video','https://www.youtube.com/embed/PCzFer2mQ80','2017-01-05 17:27:28','2017-01-05 17:31:59'),(5,'Robert and Iphie','Robert and Iphie','1483637415client-img3.jpg','1483637415client-img3.jpg','<p>Thanks for your good work.</p>\r\n','https://www.youtube.com/embed/ZqCh_gNnhyU','active','video','https://www.youtube.com/embed/ZqCh_gNnhyU','2017-01-05 17:30:15','2017-01-05 17:32:20'),(6,'KC KUHNS','KC KUHNS','1483637462client-img2.jpg','1483637462client-img2.jpg','<p>Thanks for your good work.</p>\r\n','https://www.youtube.com/embed/JsfNAEYO6qc','active','video','https://www.youtube.com/embed/JsfNAEYO6qc','2017-01-05 17:31:02','2017-01-05 17:32:39'),(7,'Frank Connor',' F3 Technologies - cConnects Web Services ','default-img.png','1483945588Screenshot.png','<p>&nbsp;Sukhdev is a tremendous talent and hard working individual. His problem solving skills are some of the best I&#39;ve seen in my 20 years as an IT professional. If you have the availability to hire him on your team I would certainly recommend it.&nbsp;</p>\r\n','http://www.cconnects.com','active','text','','2017-01-09 07:06:30','2017-01-09 07:06:30'),(8,'Mohammad F.','Shopify checkout modification - Shopify Expert needed','default-img.png','1483953709Screenshot.png','<p>Very understandable and proffesional</p>\r\n','http://floward.com/','active','text','','2017-01-09 09:21:52','2017-01-09 09:21:52');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values ('2017_01_04_184841_create_blog_categories_table',1),('2017_01_04_185114_create_blog_table',1),('2017_01_07_070324_create_contact_us_table',2),('2017_01_09_111605_create_business_partner_app_table',3),('2017_01_11_093907_create_job_category_table',4),('2017_01_11_094143_create_job_opening_table',4);

/*Table structure for table `tbl_access_control` */

DROP TABLE IF EXISTS `tbl_access_control`;

CREATE TABLE `tbl_access_control` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_access_control` */

insert  into `tbl_access_control`(`id`,`user_type`,`permissions`,`created_at`,`updated_at`) values (1,'admin','[\"blog\",\"pages\",\"users\"]','2017-01-03 06:41:43','2017-01-03 06:41:43'),(2,'others','[\"blog\",\"pages\",\"users\"]','2017-01-03 06:41:43','2017-01-03 06:41:43');

/*Table structure for table `tbl_blog` */

DROP TABLE IF EXISTS `tbl_blog`;

CREATE TABLE `tbl_blog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `blogImg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blog_slug` mediumtext COLLATE utf8_unicode_ci,
  `postedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `custom_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_blog` */

insert  into `tbl_blog`(`id`,`title`,`category_id`,`description`,`blogImg`,`blog_slug`,`postedBy`,`custom_url`,`status`,`created_at`,`updated_at`) values (2,'test','1','<p>test</p>\r\n','1483951967service-img.jpg','test','1','9999','Active','2017-01-07 05:24:44','2017-01-09 08:52:48'),(3,'test','1','<p>The obsession of living in dreams has led the technology to go beyond the imagination. The clear and seen example of this is what called Augmented Reality! People in the world of IT are very well aware of this fact and most of them have worked in order to bring such creative innovation. It provides the developers endless opportunities to showcase and play with their ability..</p>\r\n','1483951997service-img.jpg','test-1','1','','Active','2017-01-08 05:41:12','2017-01-09 08:53:18'),(4,'testtest','1','<p>The obsession of living in dreams has led the technology to go beyond the imagination. The clear and seen example of this is what called Augmented Reality! People in the world of IT are very well aware of this fact and most of them have worked in order to bring such creative innovation. It provides the developers endless opportunities to showcase and play with their ability..</p>\r\n','1483952015service-img.jpg','testtest','1','','Active','2017-01-08 05:41:55','2017-01-09 08:53:36');

/*Table structure for table `tbl_business_partners_applications` */

DROP TABLE IF EXISTS `tbl_business_partners_applications`;

CREATE TABLE `tbl_business_partners_applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `business_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Classification` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_business_partners_applications` */

insert  into `tbl_business_partners_applications`(`id`,`name`,`user_ip`,`email`,`business_type`,`Classification`,`created_at`,`updated_at`) values (1,'test','127.0.0.1','test@test.com','Real Estate','[\"I am a Business Owner\\/Entrepreneur\",\"I am an Individual looking for a Partnership Opportunity\"]','2017-01-09 13:29:49',NULL),(2,'sadasd','127.0.0.1','sdfdfdsfdf@hjd.dfd','Independent Software Vendors','[\"I am a Business Owner\\/Entrepreneur\"]','2017-01-09 13:32:35',NULL);

/*Table structure for table `tbl_contactus_queries` */

DROP TABLE IF EXISTS `tbl_contactus_queries`;

CREATE TABLE `tbl_contactus_queries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message_content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_contactus_queries` */

insert  into `tbl_contactus_queries`(`id`,`user_ip`,`name`,`email`,`phone_number`,`message_content`,`created_at`,`updated_at`) values (3,'127.0.0.1','test','test@test.com','21312312321','test','2017-01-07 08:30:44','2017-01-07 08:30:44'),(4,'127.0.0.1','asdasd','test@test.com','23324234324','asdsad','2017-01-07 08:31:04','2017-01-07 08:31:04'),(5,'127.0.0.1','Test Test','test@test.com','2313212545','test','2017-01-09 09:10:48','2017-01-09 09:10:48'),(6,'127.0.0.1','asd','test@test.com','8788788787','ates','2017-01-09 09:11:27','2017-01-09 09:11:27'),(7,'127.0.0.1','asd','test@test.com','8788788787','asd','2017-01-09 09:11:52','2017-01-09 09:11:52');

/*Table structure for table `tbl_footer_menu` */

DROP TABLE IF EXISTS `tbl_footer_menu`;

CREATE TABLE `tbl_footer_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `sort_index` int(11) DEFAULT NULL,
  `section_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_section` enum('section1','section2','section3','section4') COLLATE utf8_unicode_ci DEFAULT 'section1',
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_footer_menu` */

insert  into `tbl_footer_menu`(`id`,`parent_id`,`post_id`,`sort_index`,`section_title`,`name`,`footer_section`,`status`,`created_at`,`updated_at`) values (1,0,10,1,'WEB/APPLICATION DEVELOPMENT','Web/Application Development','section1','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(2,0,11,2,'WEB/APPLICATION DEVELOPMENT','Web Designing','section1','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(3,0,12,3,'WEB/APPLICATION DEVELOPMENT','E-Business Solution','section1','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(4,0,13,4,'WEB/APPLICATION DEVELOPMENT','Enterprise Solution','section1','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(5,0,14,5,'WEB/APPLICATION DEVELOPMENT','Content Management System','section1','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(6,0,1,1,'MOBILE DEVELOPMENT','iPhone & iPad Applications','section2','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(7,0,1,2,'MOBILE DEVELOPMENT','Android & Tab Apps','section2','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(8,0,1,3,'MOBILE DEVELOPMENT','Hybrid Applications','section2','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(9,0,1,4,'MOBILE DEVELOPMENT','Windows Applications','section2','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(10,0,1,5,'MOBILE DEVELOPMENT','Web Applications','section2','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(11,0,1,6,'MOBILE DEVELOPMENT','PhoneGap','section2','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(12,0,1,1,'DIGITAL MARKETING','Content Creation','section3','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(13,0,1,2,'DIGITAL MARKETING','Social Media Marketing','section3','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(14,0,1,3,'DIGITAL MARKETING','Pay per Click','section3','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(15,0,1,4,'DIGITAL MARKETING','Search Engine Optimization','section3','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(16,0,1,5,'DIGITAL MARKETING','Online Reputation Management','section3','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(17,0,1,6,'DIGITAL MARKETING','App Marketing','section3','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(18,0,56,1,'Others','Business Partner','section4','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(19,0,57,2,'Others','Career','section4','Active','2016-12-12 12:12:12','2016-12-12 12:12:12'),(20,0,55,3,'Others','Blog','section4','Active','2016-12-12 12:12:12','2016-12-12 12:12:12');

/*Table structure for table `tbl_job_categories` */

DROP TABLE IF EXISTS `tbl_job_categories`;

CREATE TABLE `tbl_job_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_job_categories` */

insert  into `tbl_job_categories`(`id`,`name`,`status`,`created_at`,`updated_at`) values (1,'PHP','Active','2017-01-01 12:12:12',NULL);

/*Table structure for table `tbl_job_opening` */

DROP TABLE IF EXISTS `tbl_job_opening`;

CREATE TABLE `tbl_job_opening` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `job_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exp_required` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profession_exp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_of_vacancy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_summary` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `skills` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_job_opening` */

insert  into `tbl_job_opening`(`id`,`category_id`,`job_title`,`exp_required`,`job_location`,`profession_exp`,`no_of_vacancy`,`job_summary`,`skills`,`status`,`created_at`,`updated_at`) values (1,1,'1','6 years','Mohali','5 years','4','<p>test</p>\r\n','<p>test</p>\r\n','Active','2017-01-11 12:52:01','2017-01-11 14:09:33'),(2,1,'abc','1 year','Mohali','5 years','312','<p>test</p>\r\n','<p>test</p>\r\n','Active','2017-01-11 13:01:09','2017-01-11 14:09:56');

/*Table structure for table `tbl_menus` */

DROP TABLE IF EXISTS `tbl_menus`;

CREATE TABLE `tbl_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_sort_index` int(11) DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_menus` */

insert  into `tbl_menus`(`id`,`parent_id`,`post_id`,`name`,`header_sort_index`,`status`,`created_at`,`updated_at`) values (1,0,2,'Services',1,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00'),(2,0,3,'Clients',2,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00'),(3,0,4,'Portfolio',3,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00'),(4,0,53,'About Us',4,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00'),(5,0,6,'Contact Us',5,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00');

/*Table structure for table `tbl_portfolio` */

DROP TABLE IF EXISTS `tbl_portfolio`;

CREATE TABLE `tbl_portfolio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `portfolioImg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `projectUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_portfolio` */

insert  into `tbl_portfolio`(`id`,`title`,`category_id`,`portfolioImg`,`projectUrl`,`status`,`created_at`,`updated_at`) values (1,'test','24','1483692757portfolio-img3.jpg','http://dev.deftsoft/','Active','2017-01-05 16:01:24','2017-01-06 08:52:38'),(2,'London Skyline','22','1483703507london-skyline.png','http://london-skyline.com','Active','2017-01-06 08:09:39','2017-01-06 11:51:53'),(3,'test','23','1483704705service-img.jpg','http://dev.deftsoft/','Active','2017-01-06 08:55:53','2017-01-06 12:11:46'),(4,'test','25','1483693083portfolio-img4.jpg','http://dev.deftsoft/','Active','2017-01-06 08:58:04','2017-01-06 08:58:04'),(5,'test','26','1483693121portfolio-img5.jpg','http://dev.deftsoft/','Active','2017-01-06 08:58:41','2017-01-06 08:58:41'),(6,'livingmystyle.co.uk','22','1483703182livingmystyle.png','http://livingmystyle.co.uk','Active','2017-01-06 11:03:58','2017-01-06 11:46:25'),(7,'modeste','22','1483703252modeste.png','http://www.modeste.paris/','Active','2017-01-06 11:10:07','2017-01-06 11:47:36');

/*Table structure for table `tbl_postmeta` */

DROP TABLE IF EXISTS `tbl_postmeta`;

CREATE TABLE `tbl_postmeta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `post_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postmeta_type` enum('image','text','video') COLLATE utf8_unicode_ci DEFAULT 'text',
  `post_value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=283 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_postmeta` */

insert  into `tbl_postmeta`(`id`,`post_id`,`post_key`,`postmeta_type`,`post_value`,`created_at`,`updated_at`) values (12,23,'slider_images','image','portfolio-img2.jpg','2016-12-12 12:00:00',NULL),(13,24,'slider_images','image','portfolio-img3.jpg','2016-12-12 12:00:00',NULL),(14,25,'slider_images','image','portfolio-img4.jpg','2016-12-12 12:00:00',NULL),(15,26,'slider_images','image','portfolio-img4.jpg','2016-12-12 12:00:00',NULL),(16,27,'slider_images','image','portfolio-img4.jpg','2016-12-12 12:00:00',NULL),(17,36,'video_url','video','https://www.youtube.com/embed/PCzFer2mQ80','2016-12-12 12:00:00',NULL),(33,44,'testkey','text','123','2016-12-23 10:00:14','2016-12-23 10:11:22'),(34,44,'testkey2','text','4774','2016-12-23 10:00:14','2016-12-23 10:11:22'),(35,44,'file_data','video','14824872148.png','2016-12-23 10:00:14','2016-12-23 10:11:22'),(36,44,'file_data_2','video','148248721422.png','2016-12-23 10:00:16','2016-12-23 10:11:22'),(207,48,'Asd','text','asdasdasd','2016-12-26 13:54:51',NULL),(208,48,'Sss','text','sss','2016-12-26 13:54:51',NULL),(209,48,'Afa','text','af','2016-12-26 13:54:51',NULL),(210,48,'ds','image','148276039016 (1).png','2016-12-26 13:54:51',NULL),(211,48,'ddddd','image','148276048222.png','2016-12-26 13:54:51',NULL),(231,49,'Test','text','test','2016-12-27 09:04:49',NULL),(232,49,'test23','text','sasas','2016-12-27 09:04:50',NULL),(233,49,'asd','image','14828292628.png','2016-12-27 09:04:50',NULL),(234,49,'ssssss','image','1482829480imgres.jpg','2016-12-27 09:04:50',NULL),(241,51,'ssss','text','ssss','2017-01-02 11:05:11',NULL),(243,22,'Slider Images','text','profile-single-slider.png','2017-01-05 11:23:00',NULL),(281,7,'development_edit_icon','image','1482333367tab-web-app-development-icon.png','2017-01-10 08:40:56',NULL),(282,7,'development_icon','image','1482333367tab-web-app-development.jpg','2017-01-10 08:40:56',NULL);

/*Table structure for table `tbl_posts` */

DROP TABLE IF EXISTS `tbl_posts`;

CREATE TABLE `tbl_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title1` mediumtext COLLATE utf8_unicode_ci,
  `title2` mediumtext COLLATE utf8_unicode_ci,
  `title3` mediumtext COLLATE utf8_unicode_ci,
  `tagline` mediumtext COLLATE utf8_unicode_ci,
  `short_description` mediumtext COLLATE utf8_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` mediumtext COLLATE utf8_unicode_ci,
  `meta_description` mediumtext COLLATE utf8_unicode_ci,
  `custom_slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `long_description` longtext COLLATE utf8_unicode_ci,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_posts` */

insert  into `tbl_posts`(`id`,`user_id`,`parent_id`,`content`,`title`,`post_slug`,`post_type`,`banner`,`title1`,`title2`,`title3`,`tagline`,`short_description`,`meta_title`,`meta_keywords`,`meta_description`,`custom_slug`,`long_description`,`status`,`created_at`,`updated_at`) values (1,1,0,'','Home','home','page','1483634294banner-bg.jpg','Solutions to','Grow Your Business','','','','Homepage','Deftsoft Homepage','Deftsoft Homepage','','','Active','2016-12-06 23:12:00','2017-01-05 17:04:54'),(2,1,0,'<p>service</p>','Services','services','page','1483637733blog-banner.jpg','Business solutions optimized to give your','E-Business the power it needs to succeed','<p><span style=\"color:#1a80cc\"><strong>Deftsoft is committed</strong></span>&nbsp;to help you in making sure that your venture achieves its goals.</p>\r\n','<h5>Tested and Certified&nbsp;<span style=\"color:#1a80cc\"><strong>App Development!</strong></span></h5>\r\n\r\n<p>An Unparalleled Design &amp; Utility Experience</p>\r\n','','Services','Services','Services','','','Active','2016-12-06 23:12:00','2017-01-05 17:35:34'),(3,1,0,'<p>Clients</p>','Clients','client','page','1483637733blog-banner.jpg','A vast clientele across the Globe ','is our driving force','<p><span style=\"color:#1a80cc\"><strong>We at Deftsoft adapt</strong></span>&nbsp;to a client centric approach and that is what makes us the best!</p>\r\n','<h5><span style=\"color:#1a80cc\"><strong>client</strong>&nbsp;</span>centric approach and that is what<br />\r\nmakes us the best!</h5>\r\n','','Client','Client','Client','','','Active','2016-12-06 23:12:00','2017-01-05 17:34:43'),(4,1,0,'<p>Portfolio</p>','Portfolio','portfolio','page','1483637733blog-banner.jpg','Delivering Quality Software','to Clients Worldwide','<p><span style=\"color:#1a80cc\"><strong>Get in Touch</strong></span>&nbsp;with Our Exceptional Team</p>\r\n','<h5>Go through&nbsp;<span style=\"color:#1a80cc\"><strong>our portfolio</strong></span></h5>\r\n\r\n<p>With over a decade&#39;s worth of experience, we have provided countless different industries with the best web &amp; digital marketing solutions</p>\r\n','<p>With over a decade&#39;s worth of experience, we have provided countless different industries with the best web &amp; digital marketing solutions</p>','','','','','','Active','2016-12-06 23:12:00','2017-01-05 08:18:33'),(6,1,0,'<section class=\"contact-steps\" id=\"ds-contact-steps\">\r\n        <div class=\"container\">\r\n            <div class=\"row\">\r\n                <div class=\"address-fields\">\r\n                    <div class=\"address-box address-box1\">\r\n                        <div class=\"icon-img\"><span><img src=\"images/email-icon.png\"  alt=\"\"/></span></div>\r\n                        <div class=\"address-text\">\r\n                            <h3>For Business Enquiry</h3>\r\n                            <p>business@deftsoft.com</p>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"address-box address-box2\">\r\n                        <div class=\"icon-img\"><span><img src=\"images/office-icon.png\"  alt=\"\"/></span></div>\r\n                        <div class=\"address-text\"><h3>Flagship office(US)</h3>\r\n                            <p>Deftsoft Inc.122 Saratoga Avenue, \r\n                                Suite 100,Santa Clara,CA 95051<br>\r\n                                Tel (US). (408) 622-0236<br>\r\n                                US (Office).(408) 650 8543</p>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"address-box address-box3\">\r\n                        <div class=\"icon-img\"><span><img src=\"images/office-icon2.png\"  alt=\"\"/></span></div>\r\n                        <div class=\"address-text\"><h3>Corporate Office (IND)</h3>\r\n                            <p>Live Deftsoft Informatics (P) Ltd.<br>\r\n                                C-139, ELTOP, Ind. Area, Phase 8<br>\r\n                                Mohali, India 0172-5095594</p>\r\n                        </div>\r\n                    </div>\r\n                </div>                           \r\n            </div>\r\n        </div>\r\n    </section>','Contact Us','contact-us','page','1483637733blog-banner.jpg','Let us collaborate!','Connect with Deftsoft!','<p>We are available 24*7 to provide you with the assistance you need</p>\r\n','<p>Have a Question For us</p>\r\n','<p>Enter your details below and we will get back to you.</p>','Client','','','','','Active','2016-12-06 23:12:00','2017-01-09 10:37:35'),(7,1,2,'<p>WEB/APPLICATION DEVELOPMENT</p>','WEB DEVELOPMENT','web-development','service','1482314934happy-new-year-images.jpg','Best In the Industry','','<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n','','<h3>WEB DEVELOPMENT</h3>\r\n\r\n<p>Deftsoft brings together creative and dynamic web development tools to help you enter the world of web technologies. &nbsp;We have everything covered from the responsive websites, CMS&rsquo;s, E-Commerce, ASP.NET, PHP, ROR, Phython, E-Business, Content Management, Java/J2EE, &nbsp;Enterprise Applications. We are a full-service web solutions experts, focused to help your business grow. We are proud to be specialized in developing powerful tools and web applications for the B2B and B2C markets by leveraging insights from the user experience research.</p>','','','','','','Active','2016-12-06 23:12:00','2017-01-10 08:40:56'),(8,1,2,'<p>MOBILE DEVELOPMENT</p>','UX & UI DESIGN','ux-ui-design','service','banner-bg.jpg','','','<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n','','<h3>UX &amp; UI DESIGN</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident</p>','','','','','','Active','2016-12-06 23:12:00','2017-01-10 08:40:32'),(9,1,2,'<p>DIGITAL MARKETING</p>','DIGITAL MARKETING','digital-marketing','service','banner-bg.jpg','','','<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n','','<h3>DIGITAL MARKETING</h3>\r\n\r\n<p>Deftsoft fortify your digital marketing needs and assist you to reach your potential customers<span style=\"color:red\"> </span>and business objectives. We produce innovative digital solutions that are at the forefront of&nbsp; the technology. To help our every client hit the nail perfectly on the head of the digital era, Search Engine Optimization, Social Media Marketing, Pay Per Click, App Marketing, Content Creation, Local Search Optimization and Brand Optimization are the areas of our prime focus. We are a dedicated and experienced team of professionals that are ambitious and endeavor to provide the best digital strategies to help your business grow beyond the limits<span style=\"color:red\">.</span></p>','','','','','','Active','2016-12-06 23:12:00','2017-01-10 08:39:34'),(10,1,7,'Web/Application Development','Web/Application Development','web-app-developments','subservice','1483637733blog-banner.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00'),(11,1,7,'Web Designing','Web Designing','web-designing','subservice','1483637733blog-banner.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00'),(12,1,7,'E-Business Solution','E-Business Solution','e-buiness-solutions','subservice','1483637733blog-banner.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00'),(13,1,7,'Enterprise Solution','Enterprise Solution','enterprise-solutions','subservice','1483637733blog-banner.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00'),(14,1,7,'Content Management System','Content Management System','content-management-system','subservice','banner-bg.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00'),(15,1,0,NULL,'IOS Developers','ios-partner','partner','partner-logo-1.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00'),(16,1,0,'','Android Developers','android-partner','partner','partner-logo-5.png','','','','','','','','',NULL,'','Active','2016-12-06 23:12:00','2017-01-02 11:20:41'),(17,1,0,NULL,'Google Partner','google-partner','partner','partner-logo-2.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00'),(18,1,0,NULL,'Bing Parnter','bing-partner','partner','partner-logo-3.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00'),(19,1,0,NULL,'STPI Partner','stpi-partner','partner','partner-logo-4.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-06 23:12:00','2016-12-06 23:12:00'),(20,1,2,'<p>Product DEVELOPMENT</p>','MOBILE APP DEVELOPMENT','app-development','service','banner-bg.jpg','','','<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n\r\n<p>value=&quot;</p>\r\n','','<h3>MOBILE APP DEVELOPMENT</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident</p>','','','','','','Active','2016-12-06 23:12:00','2017-01-10 08:40:08'),(21,1,0,'','Our Work','our-work','ourwork','banner-bg.jpg','Interactive Web & Mobile Solutions','That Are Ingeniously Crafted!','<p>value=&quot;</p>\r\n','A team of professionals&nbsp; provides utmost integrity and customer satisfaction by improving your business value.&nbsp; We have hands-on-experience in managing IT challenges to ease the business processes for all clients.\r\n','','Our Work','Our Work','Our Work','','','Active','2016-12-06 23:12:00','2017-01-05 17:09:09'),(22,1,4,'<p>Website Design</p>','Website Design','website-design','portfolio-category','1483637733blog-banner.jpg','Delivering Quality Software','to Clients Worldwide','<p><span style=\"color:#1a80cc\">Get in Touch</span> with Our Exceptional Team</p>\r\n','<h5>Sophisticase<strong>&nbsp;<span style=\"color:#1a80cc\">Website Design</span></strong></h5>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum dictum, elit ut posuere scelerisque, massa lectus viverra ante, eu rhoncus arcu diam at turpis. Duis eu ex egestas, tesque nunc id, ultricies lectus.</p>\r\n','<p>Deftsoft clearly comprehends that business environment is succeeding to expose more energetic facade, wherein solutions are also sprouting as brisk as business decisions, timelines and market drivers!</p>','','','','','','Active','2016-12-06 23:12:00','2017-01-05 11:23:00'),(23,1,4,'Mobile app Service','Mobile app Service','mobile-app-service','portfolio-category','1483637733blog-banner.jpg',NULL,NULL,NULL,NULL,'Deftsoft clearly comprehends that business environment is succeeding to expose more energetic facade, wherein solutions are also sprouting as brisk as business decisions, timelines and market drivers!',NULL,NULL,NULL,NULL,NULL,'Active','2016-12-12 12:00:00','2016-12-12 12:00:00'),(24,1,4,'Website Development','Website Development','website-development','portfolio-category','1483637733blog-banner.jpg',NULL,NULL,NULL,NULL,'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',NULL,NULL,NULL,NULL,NULL,'Active','2016-12-12 12:00:00','2016-12-12 12:00:00'),(25,1,4,'Logo Design','Logo Design','logo-design','portfolio-category','1483637733blog-banner.jpg',NULL,NULL,NULL,NULL,'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',NULL,NULL,NULL,NULL,NULL,'Active','2016-12-12 12:00:00','2016-12-12 12:00:00'),(26,1,4,'Professional Services','Professional \r\nServices','professional-services','portfolio-category','1483637733blog-banner.jpg',NULL,NULL,NULL,NULL,'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',NULL,NULL,NULL,'',NULL,'Active','2016-12-12 12:00:00','2016-12-12 12:00:00'),(28,1,0,'IMG','IMG','img-client-logo','client-logo','client-logo-3.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-12 12:00:00','2016-12-12 12:00:00'),(29,1,0,'FUJI','FUJI','fuji-client-logo','client-logo','client-logo-5.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-12 12:00:00','2016-12-12 12:00:00'),(30,1,0,'SKINS','SKINS','skins-client-logo','client-logo','client-logo-6.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-12 12:00:00','2016-12-12 12:00:00'),(31,1,0,'MICROSOFT','MICROSOFT','microsoft-client-logo','client-logo','client-logo-1.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-12 12:00:00','2016-12-12 12:00:00'),(32,1,0,'SERVCORP','SERVCORP','servcorp-client-logo','client-logo','client-logo-3.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-12 12:00:00','2016-12-12 12:00:00'),(33,1,0,'YAHOO','YAHOO','yahoo-client-logo','client-logo','client-logo-2.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-12 12:00:00','2016-12-12 12:00:00'),(34,1,0,'Come Let’s Commemorate The Festival Of Eid With Pomp And Show!','Title of the blog1','title-of-the-blog1','blog','blog-1.jpg','Come Let’s Commemorate The Festival Of Eid With Pomp And Show!',NULL,NULL,NULL,'Come Let’s Commemorate The Festival Of Eid With Pomp And Show!',NULL,NULL,NULL,NULL,NULL,'Active','2016-12-05 12:00:00','2016-12-12 12:00:00'),(35,1,0,'Come Let’s Commemorate The Festival Of Eid With Pomp And Show!','Title of the blog2','title-of-the-blog1','blog','blog-1.jpg','Come Let’s Commemorate The Festival Of Eid With Pomp And Show!',NULL,NULL,NULL,'Come Let’s Commemorate The Festival Of Eid With Pomp And Show!',NULL,NULL,NULL,NULL,NULL,'Active','2016-12-12 12:00:00','2016-12-12 12:00:00'),(36,1,0,NULL,'TOM CORMIER','tom-cormier','video-testimonial',NULL,'Co-Founder- Living Legacy Project',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2016-12-12 12:00:00','2016-12-12 12:00:00'),(52,1,8,'<p>sadsdsasdasas</p>','service 2','service-2','subservice','1483363429logo.png','test','test','test','test','<p>test</p>','test','test','test','server2','<p>test</p>','Active','2017-01-02 13:23:49','2017-01-02 13:59:39'),(53,1,0,'<section class=\"ds-mission-outer\" id=\"ds-mission\">\r\n            <div class=\"container\">\r\n                <div class=\"row\"> \r\n                    <div class=\"col-xs-12 col-sm-12 col-md-12\">\r\n                        <div class=\"ds-mission-inner\">\r\n                            <div class=\"mission-content-sec\">\r\n                                <div class=\"mission-left-sec\">\r\n                                    <div class=\"mission-img\">\r\n                                        <div class=\"mission-content\">\r\n                                            <div class=\"mission-content-inner\"> \r\n                                                <img src=\"images/mission-icon.png\" alt=\"\" />\r\n                                                <h3>Our <strong>Mission</strong></h3>\r\n                                                <p>Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit.  </p>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n\r\n                                <div class=\"mission-right-sec\">\r\n                                    <ul> \r\n                                        <li><a href=\"javascript:;\"><figure><img src=\"images/mission-icon1.png\" alt=\"\" /> </figure>Sustainability </a> </li>\r\n                                        <li><a href=\"javascript:;\"><figure><img src=\"images/mission-icon2.png\" alt=\"\" /> </figure>Quality </a> </li>\r\n                                        <li><a href=\"javascript:;\"> <figure><img src=\"images/mission-icon3.png\" alt=\"\" /> </figure>Excellence  </a> </li>\r\n                                        <li><a href=\"javascript:;\"><figure><img src=\"images/mission-icon4.png\" alt=\"\" /> </figure> Teamwork</a> </li>\r\n                                    </ul>\r\n                                </div>\r\n                            </div>\r\n\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        <!-- Mission closed -->\r\n\r\n        <section class=\"ds-management\" id=\"management\">\r\n            <div class=\"container\">\r\n                <div class=\"row\">\r\n                    <div class=\"col-xs-12 col-sm-12 col-md-12\">\r\n                        <div class=\"heading-two\">\r\n                            <h2>Management <strong>Team</strong></h2> \r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div class=\"management-team\">\r\n                    <ul class=\"mg-team-bg\">\r\n                        <li class=\"col-md-4 col-sm-4 col-xs-4 mg-li\">\r\n                            <div class=\"mangement-img\"><img src=\"images/mg-img-1.png\"  alt=\"\"/>\r\n                                <div class=\"mg-title\">\r\n                                    <h2>Amaneet Brar</h2>\r\n                                    <h6>CEO/Managing Director</h6>\r\n                                </div>\r\n                            </div>\r\n                            <div class=\"mg-footer\">\r\n                                <p>As I glance at the progression over the years since our inception in 2005 achieved, and even more.</p>\r\n                            </div>\r\n                        </li>\r\n                        <li class=\"col-md-4 col-sm-4 col-xs-4 mg-li\">\r\n                            <div class=\"mangement-img\"><img src=\"images/mg-img-2.png\"  alt=\"\"/>\r\n                                <div class=\"mg-title\">\r\n                                    <h2>Amaninder Brar</h2>\r\n                                    <h6>Director</h6>\r\n                                </div>\r\n                            </div>\r\n                            <div class=\"mg-footer\">\r\n                                <p>As I glance at the progression over the years since our inception in 2005 achieved, and even more.</p>\r\n                            </div>\r\n                        </li>\r\n                        <li class=\"col-md-4 col-sm-4 col-xs-4 mg-li\">\r\n                            <div class=\"mangement-img\"><img src=\"images/mg-img-3.png\"  alt=\"\"/>\r\n                                <div class=\"mg-title\">\r\n                                    <h2>Matt Lowe</h2>\r\n                                    <h6>Managing Partner</h6>\r\n                                </div>\r\n                            </div>\r\n                            <div class=\"mg-footer\">\r\n                                <p>As I glance at the progression over the years since our inception in 2005 achieved, and even more.</p>\r\n                            </div>\r\n                        </li>\r\n                    </ul>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        <!-- Mangement team closed -->\r\n\r\n        <section class=\"ds-mo-app-service ds-about-tabs\" id=\"app-services\">\r\n            <div class=\"container\">\r\n                <div class=\"row\">\r\n                    <div class=\"col-xs-12 col-sm-12 col-md-12\">\r\n                        <div class=\"heading-two\">\r\n                            <h2>More <strong>About Deftsoft</strong></h2> \r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div id=\"parentHorizontalTab\" class=\"ds-tabs-main-outer\">\r\n                    <ul class=\"resp-tabs-list main-tab-list hor_1\">\r\n                        <li><div class=\"tab-wrap\"><div class=\"tab-li story-tab\"><span><i class=\"fa fa-image\"></i></span>Our Story</div><div class=\"overlay\"><img src=\"images/iphone-tab-img.jpg\" alt=\"img\"/></div></div></li>\r\n                        <li><div class=\"tab-wrap\"><div class=\"tab-li partner-tab\"><span><i class=\"fa fa-image\"></i></span>Partners</div><div class=\"overlay\"><img src=\"images/iphone-tab-img.jpg\" alt=\"img\"/></div></div></li>\r\n                        <li><div class=\"tab-wrap\"><div class=\"tab-li why-tab\"><span><i class=\"fa fa-image\"></i></span>Why Deftsoft</div><div class=\"overlay\"><img src=\"images/iphone-tab-img.jpg\" alt=\"img\"/></div></div></li>\r\n                        <li><div class=\"tab-wrap\"><div class=\"tab-li event-tab\"><span><i class=\"fa fa-image\"></i></span>Events</div><div class=\"overlay\"><img src=\"images/iphone-tab-img.jpg\" alt=\"img\"/></div></div></li>\r\n                    </ul>\r\n                    <div class=\"resp-tabs-container tabs-custom-body-outer hor_1\">\r\n                        <div class=\"ds-tabs-inner ds-web-app-tab-outer\">\r\n                            <div class=\"row\">\r\n                                <div class=\"col-xs-12 col-sm-12 col-md-12 tab-web-app-first-left\">\r\n                                    <ul class=\"timeline timeline-horizontal\">\r\n                                        <li class=\"timeline-item first-year active\">\r\n                                            <div class=\"timeline-head\"><span>2005</span></div>\r\n                                            <div class=\"timeline-badge\"><div class=\"inner-badge\"><i class=\"fa fa-circle\"></i></div></div>\r\n                                            <div class=\"timeline-panel\">\r\n                                                <div class=\"timeline-icon\">\r\n                                                    <span class=\"circle\"><i class=\"fa fa-hand\"></i></span>\r\n                                                </div>\r\n                                                <div class=\"timeline-body\">\r\n                                                    <p>As I glance at the progression over the years since our lorem ipsum even more.</p>\r\n                                                </div>\r\n                                            </div>\r\n                                        </li>\r\n                                        <li class=\"timeline-item second-year\">\r\n                                            <div class=\"timeline-head\"><span>2009</span></div>\r\n                                            <div class=\"timeline-badge\"><div class=\"inner-badge\"><i class=\"fa fa-circle\"></i></div></div>\r\n                                            <div class=\"timeline-panel\">\r\n                                                <div class=\"timeline-icon\">\r\n                                                    <span class=\"circle\"><i class=\"fa fa-hand\"></i></span>\r\n                                                </div>\r\n                                                <div class=\"timeline-body\">\r\n                                                    <p>As I glance at the progression over the years since our lorem ipsum even more.</p>\r\n                                                </div>\r\n                                            </div>\r\n                                        </li>\r\n                                        <li class=\"timeline-item third-year\">\r\n                                            <div class=\"timeline-head\"><span>2011</span></div>\r\n                                            <div class=\"timeline-badge\"><div class=\"inner-badge\"><i class=\"fa fa-circle\"></i></div></div>\r\n                                            <div class=\"timeline-panel\">\r\n                                                <div class=\"timeline-icon\">\r\n                                                    <span class=\"circle\"><i class=\"fa fa-hand\"></i></span>\r\n                                                </div>\r\n                                                <div class=\"timeline-body\">\r\n                                                    <p>As I glance at the progression over the years since our lorem ipsum even more.</p>\r\n                                                </div>\r\n                                            </div>\r\n                                        </li>\r\n                                        <li class=\"timeline-item fourth-year\">\r\n                                            <div class=\"timeline-head\"><span>2016</span></div>\r\n                                            <div class=\"timeline-badge\"><div class=\"inner-badge\"><i class=\"fa fa-circle\"></i></div></div>\r\n                                            <div class=\"timeline-panel\">\r\n                                                <div class=\"timeline-icon\">\r\n                                                    <span class=\"circle\"><i class=\"fa fa-hand\"></i></span>\r\n                                                </div>\r\n                                                <div class=\"timeline-body\">\r\n                                                    <p>As I glance at the progression over the years since our lorem ipsum even more.</p>\r\n                                                </div>\r\n                                            </div>\r\n                                        </li>\r\n                                    </ul>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"ds-tabs-inner\">\r\n                            <h3>Android &amp; tab apps</h3>\r\n                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident</p>\r\n                        </div>\r\n                        <div class=\"ds-tabs-inner\">\r\n                            <h3>Hybrid Applications</h3>\r\n                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident</p>\r\n                        </div>\r\n                        <div class=\"ds-tabs-inner\">\r\n                            <h3>Windows Applications</h3>\r\n                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident</p>\r\n                        </div>\r\n\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        <!-- About deftsoft closed -->\r\n\r\n        <section class=\"ds-vision\" id=\"vision\">\r\n            <div class=\"vision-full-width\">\r\n                <div class=\"container\">\r\n                    <div class=\"row\">\r\n                        <div class=\"col-xs-12 col-sm-12 col-md-12\">\r\n                            <div class=\"heading-two\">\r\n                                <h2>Our <strong>Vision</strong></h2>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"vision-container\">\r\n                        <div class=\"container\">\r\n                            <div class=\"row\">\r\n                                <div class=\"bhoechie-tab-menu\">\r\n                                    <div class=\"list-group\">\r\n                                        <div class=\"ds-tab groth active\">\r\n                                            <h4>Growth</h4>\r\n                                            <div class=\"icon-box\"><i class=\"glyphicon glyphicon-groth\"></i></div>\r\n                                        </div>\r\n                                        <div class=\"ds-tab strength\">\r\n                                            <h4>Employee Strength</h4>\r\n                                            <div class=\"icon-box\"><i class=\"glyphicon glyphicon-strength\"></i></div>\r\n                                        </div>\r\n                                        <div class=\"ds-tab services\">\r\n                                            <h4>11+ years of Services</h4>\r\n                                            <div class=\"icon-box\"><i class=\"glyphicon glyphicon-service\"></i></div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>          \r\n                        <div class=\"bhoechie-tab\">\r\n                            <!-- flight section -->\r\n                            <div class=\"bhoechie-tab-content active\">\r\n                                <div class=\"tab-content-box\">\r\n                                    <div class=\"vision-img\"><img src=\"images/about-img.png\"  alt=\"\"/></div>\r\n                                    <div class=\"vision-content\">\r\n                                        <h3>Growth</h3>\r\n                                        <p>My experience as an entrepreneur with over 17 years of experience has taught me that dedication, perseverance and compassion can help any business succeed. I have been associated and have worked closely with other members of the management team since the idea of forming Deftsoft Inc. came to mind.</p>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                            <!-- train section -->\r\n                            <div class=\"bhoechie-tab-content\">\r\n                                <div class=\"tab-content-box\">\r\n                                    <div class=\"vision-img\"><img src=\"images/about-img.png\"  alt=\"\"/></div>\r\n                                    <div class=\"vision-content\">\r\n                                        <h3>Employee Strength</h3>\r\n                                        <p>My experience as an entrepreneur with over 17 years of experience has taught me that dedication, perseverance and compassion can help any business succeed. I have been associated and have worked closely with other members of the management team since the idea of forming Deftsoft Inc. came to mind.</p>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n\r\n                            <!-- hotel search -->\r\n                            <div class=\"bhoechie-tab-content\">\r\n                                <div class=\"tab-content-box\">\r\n                                    <div class=\"vision-img\"><img src=\"images/about-img.png\"  alt=\"\"/></div>\r\n                                    <div class=\"vision-content\">\r\n                                        <h3>11+ years of Services</h3>\r\n                                        <p>My experience as an entrepreneur with over 17 years of experience has taught me that dedication, perseverance and compassion can help any business succeed. I have been associated and have worked closely with other members of the management team since the idea of forming Deftsoft Inc. came to mind.</p>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n\r\n                        </div>\r\n                    </div>\r\n\r\n                </div>\r\n            </div> \r\n        </section>\r\n        <!-- Our vision closed -->\r\n\r\n        <section class=\"ds-our-achievement-section\">\r\n            <div class=\"ds-our-achievement-hdd\">\r\n                <div class=\"container\">\r\n                    <div class=\"row\">\r\n                        <div class=\"col-xs-12 col-sm-12 col-md-12 \">\r\n                            <div class=\"heading-two\">\r\n                                <h2>Our<strong> Achievement</strong></h2>\r\n                            </div>\r\n                            <div class=\"achive-inner-sec\"> \r\n                                <div class=\"achive-left-sec\"> \r\n                                    <span><img src=\"images/achiv-icon.png\" alt=\"\" /> </span>\r\n                                    </figure>\r\n                                </div>\r\n\r\n                                <div class=\"achive-right-sec\"> \r\n                                    <div class=\"hover-content\"> \r\n                                        <div id=\"tab1show\" class=\"tab-content\">\r\n                                            <h5>B2B Portal </h5>\r\n                                            <p>We are known among the Top Five IT Solution providers at one of the World\'s Best B2B Portal. </p>\r\n                                        </div>\r\n\r\n                                        <div id=\"tab2show\" class=\"tab-content\">\r\n                                            <h5>Best Career</h5>\r\n                                            <p>We are known among the Top Five IT Solution providers at one of the World\'s  </p>\r\n                                        </div>\r\n\r\n                                        <div id=\"tab3show\" class=\"tab-content\">\r\n                                            <h5>Recognized</h5>\r\n                                            <p>We are known among the Top Five IT Solution providers  </p>\r\n                                        </div>\r\n\r\n                                        <div id=\"tab4show\" class=\"tab-content\">\r\n                                            <h5>HR Practices</h5>\r\n                                            <p>We are known among the Top Five IT Solution providers at one of the World\'s Best B2B Portal. </p>\r\n                                        </div>\r\n                                    </div>\r\n                                    <div class=\"achiver-point-sec\">\r\n                                        <ul> \r\n                                            <li id=\"tab1\" class=\"tab active\"><a href=\"javascript:void(0)\" ><figure><i class=\"fa fa-image\"></i></figure> B2B Portal </a> </li>\r\n                                            <li id=\"tab2\" class=\"tab\"><a href=\"javascript:void(0)\"  ><figure><i class=\"fa fa-image\"></i></figure>Best Career </a> </li>\r\n                                            <li id=\"tab3\" class=\"tab\"><a href=\"javascript:void(0)\" ><figure><i class=\"fa fa-image\"></i></figure>Recognized </a> </li>\r\n                                            <li id=\"tab4\" class=\"tab\"><a href=\"javascript:void(0)\" ><figure><i class=\"fa fa-image\"></i></figure>HR Practices </a> </li> \r\n                                        </ul>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </section>','About us','about-us','page','1483637733blog-banner.jpg','We offers you','Immaculate Solutions','<p><strong><span style=\"color:#1a80cc\">At Deftsoft</span>,</strong>&nbsp;we know how to make your Business Grow!</p>\r\n','','','About us','About us','About us','','','Active','2017-01-06 06:40:01','2017-01-11 06:49:40'),(55,1,0,'<p>test</p>','Blog','blog','page','1483637733blog-banner.jpg','We offers you ','Immaculate Solutions','<p><strong><span style=\"color:#1981fc\">At Deftsoft</span>,</strong>&nbsp;we know how to make your Business Grow!</p>\r\n','<span style=\"color:#1981fc\"><strong>Blogs</strong></span>&nbsp;from the end of&nbsp;<span style=\"color:#1981fc\"><strong>Deftsoft</strong></span>&nbsp;to Enrich your\r\n\r\nreading experience\r\n','<p>test</p>','test','test','test','','<p>test</p>','Active','2017-01-07 18:51:48','2017-01-08 08:15:53'),(56,1,0,'','Business Partner','business-partner','page','1483637733blog-banner.jpg','We offers you ','Immaculate Solutions','<p><strong><span style=\"color:#1981fc\">At Deftsoft</span>,</strong>&nbsp;we know how to make your Business Grow!</p>\r\n','<h5><span style=\"color:#1981fc\"><strong>Deftsoft help</strong></span>&nbsp;your brand to reach out for more and assist it to&nbsp;<span style=\"color:#1981fc\"><strong>grow</strong>&nbsp;</span>in the right direction.</h5>\r\n','','','','','','','Active','2017-01-08 19:07:17','2017-01-08 19:10:45'),(57,1,0,'','Career','career','page','1483637733blog-banner.jpg','We offers you ','Immaculate Solutions','<p><strong><span style=\"color:#1981fc\">At Deftsoft</span>,</strong>&nbsp;we know how to make your Business Grow!</p>\r\n','<h5><strong><span style=\"color:#1981fc\">Career</span>&nbsp;</strong>Opportunities</h5>\r\n\r\n<p>With Deftsoft Informatics we can make you realize your dream. We CARE&hellip;. It is our responsibility to take care about the career and Aim of our team with the alignment of Deftsoft Informatics Goals, Aim and Dreams!!!!</p>\r\n','','','','','','','Active','2017-01-08 19:38:05','2017-01-08 19:40:28');

/*Table structure for table `tbl_system_setting` */

DROP TABLE IF EXISTS `tbl_system_setting`;

CREATE TABLE `tbl_system_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci DEFAULT 'Inactive',
  `setting_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_system_setting` */

insert  into `tbl_system_setting`(`id`,`key`,`value`,`extra_info`,`status`,`setting_type`,`created_at`,`updated_at`) values (1,'main_logo','main logo','logo.png','Active','image','2016-12-12 12:12:00','2016-12-27 14:20:14'),(2,'right_logo_value','11+','years','Active','text','2016-12-12 12:12:00','2016-12-27 14:21:52'),(3,'right_logo_slot','Years','years','Active','text','2016-12-12 12:12:00','2016-12-12 12:12:00'),(4,'fb_link','www.facebook.com','facebook','Active','link','2016-12-12 12:12:00','2016-12-12 12:12:00'),(5,'twitter_link','www.twitter.com','twitter','Active','link','2016-12-12 12:12:00','2016-12-12 12:12:00'),(6,'gplus_link','www.gplus.com','gplus','Active','link','2016-12-12 12:12:00','2016-12-12 12:12:00'),(7,'linked_link','www.linkedin.com','linkedin','Active','link','2016-12-12 12:12:00','2016-12-12 12:12:00'),(8,'copyright_year','2005-2015','copyright year','Active','text','2016-12-12 12:12:00','2016-12-12 12:12:00'),(9,'copyright_by','Live Deftsoft Informatics','Live Deftsoft Informatics (P) Ltd','Active','text','2016-12-12 12:12:00','2016-12-12 12:12:00'),(10,'copyright_by_link','http://deftsoft.com','deftsoft.co','Active','link','2016-12-12 12:12:00','2016-12-12 12:12:00'),(11,'maintaince_mode','0',NULL,'Active','text','2016-12-12 12:12:00','2017-01-10 09:56:05');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profie_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'male',
  `status` enum('active','inactive','deleted') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `usertype` enum('superadmin','admin','others') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'others',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`firstname`,`lastname`,`email`,`password`,`country`,`state`,`city`,`user_slug`,`zipcode`,`address1`,`address2`,`profie_image`,`timezone`,`gender`,`status`,`usertype`,`remember_token`,`created_at`,`updated_at`) values (1,'Test','test','test','patrickphp4@gmail.com','$2y$10$7445ZCJ6JQR38HCAxuU7keAMXmiDzV.aZII2y.c6yWEsTAXKJVMRS','india','chandigarh','chnadigarh','test-test','12121','test','test','1482142424happy-new-year-images.jpg','Asia/Kolkata','male','active','superadmin','Mz8KqbGmOAfNMeHUpKlFZdx54GmXbOGvzn7tnE6VkcU4jKevbF4PzNRuhMZY','2016-12-12 12:12:12','2017-01-03 06:45:15'),(3,'rrrrrrrrrrr ddddddddddd','rrrrrrrrrrr','ddddddddddd','test@test.com','$2y$10$39CuIWd2ucaZbEQZ1TgZYuaFZ9.QrkgeaQF6BLOWqROdN6qOHpeYK','test','test','test','rrrrrrrrrrr-ddddddddddd-1483348284','123213','test','test','default-img.png','America/Anchorage','female','active','admin',NULL,'2017-01-02 09:11:24','2017-01-02 09:14:56');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
