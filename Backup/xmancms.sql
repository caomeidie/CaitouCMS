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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `xman_admin` */

insert  into `xman_admin`(`id`,`admin_name`,`password`,`add_time`) values (1,'admin','7c4a8d09ca3762af61e59520943dc26494f8941b',0);

/*Table structure for table `xman_admin_group` */

DROP TABLE IF EXISTS `xman_admin_group`;

CREATE TABLE `xman_admin_group` (
  `group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `rules` text NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `xman_admin_group` */

/*Table structure for table `xman_admin_group_access` */

DROP TABLE IF EXISTS `xman_admin_group_access`;

CREATE TABLE `xman_admin_group_access` (
  `admin_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `xman_admin_group_access` */

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `xman_admin_rule` */

insert  into `xman_admin_rule`(`id`,`pid`,`name`,`title`,`status`,`type`) values (1,0,'管理员列表','User/index',1,1);

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
