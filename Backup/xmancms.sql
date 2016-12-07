/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.6.17 : Database - xmancms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`xmancms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `xmancms`;

/*Table structure for table `xman_admin` */

DROP TABLE IF EXISTS `xman_admin`;

CREATE TABLE `xman_admin` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `cover` varchar(10) DEFAULT NULL,
  `mobile` varchar(11) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `add_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `xman_admin` */

insert  into `xman_admin`(`admin_id`,`admin_name`,`password`,`cover`,`mobile`,`status`,`add_time`) values (1,'admin','7c4a8d09ca3762af61e59520943dc26494f8941b',NULL,'13676587657',1,0),(4,'编辑','7c4a8d09ca3762af61e59520943dc26494f8941b',NULL,'13767960831',1,1477964502),(9,'bbb','7c4a8d09ca3762af61e59520943dc26494f8941b',NULL,'13767960831',1,1477987174),(6,'小米','7c4a8d09ca3762af61e59520943dc26494f8941b',NULL,'13579789873',1,1477964965),(8,'afds','e10adc3949ba59abbe56e057f20f883e',NULL,'13767960831',1,1477987162),(10,'ccc','202cb962ac59075b964b07152d234b70',NULL,'13767960831',1,1477987349),(14,'ccc','202cb962ac59075b964b07152d234b70',NULL,'13767960831',1,1477989038),(15,'ccc','202cb962ac59075b964b07152d234b70',NULL,'13767960831',1,1477989377),(16,'ccc','e10adc3949ba59abbe56e057f20f883e',NULL,'13767960831',1,1477989408),(17,'ccc','e10adc3949ba59abbe56e057f20f883e',NULL,'13767960831',1,1477989666),(18,'ggg','e10adc3949ba59abbe56e057f20f883e',NULL,'13767960831',1,1477989923);

/*Table structure for table `xman_admin_group` */

DROP TABLE IF EXISTS `xman_admin_group`;

CREATE TABLE `xman_admin_group` (
  `group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `rules` text NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `xman_admin_group` */

insert  into `xman_admin_group`(`group_id`,`title`,`status`,`rules`) values (1,'超级管理员',1,'6,7,10,14'),(2,'编辑人员',1,'4,6,7,11,9,10,14');

/*Table structure for table `xman_admin_group_access` */

DROP TABLE IF EXISTS `xman_admin_group_access`;

CREATE TABLE `xman_admin_group_access` (
  `admin_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `xman_admin_group_access` */

insert  into `xman_admin_group_access`(`admin_id`,`group_id`) values (1,1),(4,2),(6,1),(10,1),(18,1);

/*Table structure for table `xman_admin_rule` */

DROP TABLE IF EXISTS `xman_admin_rule`;

CREATE TABLE `xman_admin_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(80) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `xman_admin_rule` */

insert  into `xman_admin_rule`(`id`,`pid`,`name`,`title`,`status`,`type`) values (1,0,'管理员管理','User/list',1,1),(2,1,'管理员列表','User/index',1,1),(3,1,'添加管理员','User/addUser',1,1),(4,1,'用户组管理','User/listGroup',1,1),(5,1,'添加用户组','User/addGroup',1,1),(6,1,'权限管理','User/listRule',1,1),(7,1,'添加权限','User/addRule',1,1),(8,0,'文章管理','Article/list',1,1),(9,8,'文章管理','Article/index',1,1),(10,8,'添加文章','Article/addArticle',1,1),(11,1,'修改权限','User/editRule',1,1),(12,1,'删除权限','User/dropRule',1,1),(14,8,'公告管理','Article/listNotice',1,1);

/*Table structure for table `xman_article` */

DROP TABLE IF EXISTS `xman_article`;

CREATE TABLE `xman_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_title` varchar(100) NOT NULL,
  `article_profile` varchar(255) NOT NULL,
  `article_content` text NOT NULL,
  `article_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1:正常，0：关闭',
  `article_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1:文章，2：公告',
  `add_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `xman_article` */

insert  into `xman_article`(`id`,`article_title`,`article_profile`,`article_content`,`article_status`,`article_type`,`add_time`) values (1,'第一篇文章','第一篇文章概述2432','&lt;p&gt;阿飞萨芬大&lt;img src=&quot;/Upload/images/editor/20160921/1474447531779176.jpg&quot; title=&quot;1474447531779176.jpg&quot; alt=&quot;下载.jpg&quot;/&gt;asfsaafdsafdsa&lt;/p&gt;',1,1,1474447533);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
