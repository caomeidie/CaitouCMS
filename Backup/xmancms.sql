# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.42)
# Database: xmancms
# Generation Time: 2016-12-16 14:18:16 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table xman_admin
# ------------------------------------------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `xman_admin` WRITE;
/*!40000 ALTER TABLE `xman_admin` DISABLE KEYS */;

INSERT INTO `xman_admin` (`admin_id`, `admin_name`, `password`, `cover`, `mobile`, `status`, `add_time`)
VALUES
	(1,'admin','7c4a8d09ca3762af61e59520943dc26494f8941b',NULL,'13676587657',1,0),
	(4,'编辑','7c4a8d09ca3762af61e59520943dc26494f8941b',NULL,'13767960831',1,1477964502),
	(9,'bbb','7c4a8d09ca3762af61e59520943dc26494f8941b',NULL,'13767960831',1,1477987174),
	(6,'小米','7c4a8d09ca3762af61e59520943dc26494f8941b',NULL,'13579789873',1,1477964965),
	(8,'afds','e10adc3949ba59abbe56e057f20f883e',NULL,'13767960831',1,1477987162),
	(10,'ccc','202cb962ac59075b964b07152d234b70',NULL,'13767960831',1,1477987349),
	(14,'ccc','202cb962ac59075b964b07152d234b70',NULL,'13767960831',1,1477989038),
	(15,'ccc','202cb962ac59075b964b07152d234b70',NULL,'13767960831',1,1477989377),
	(16,'ccc','e10adc3949ba59abbe56e057f20f883e',NULL,'13767960831',1,1477989408),
	(17,'ccc','e10adc3949ba59abbe56e057f20f883e',NULL,'13767960831',1,1477989666),
	(18,'ggg','e10adc3949ba59abbe56e057f20f883e',NULL,'13767960831',1,1477989923);

/*!40000 ALTER TABLE `xman_admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xman_admin_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xman_admin_group`;

CREATE TABLE `xman_admin_group` (
  `group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `rules` text NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `xman_admin_group` WRITE;
/*!40000 ALTER TABLE `xman_admin_group` DISABLE KEYS */;

INSERT INTO `xman_admin_group` (`group_id`, `title`, `status`, `rules`)
VALUES
	(1,'超级管理员',1,'6,7,10,14'),
	(2,'编辑人员',1,'4,6,7,11,9,10,14');

/*!40000 ALTER TABLE `xman_admin_group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xman_admin_group_access
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xman_admin_group_access`;

CREATE TABLE `xman_admin_group_access` (
  `admin_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `xman_admin_group_access` WRITE;
/*!40000 ALTER TABLE `xman_admin_group_access` DISABLE KEYS */;

INSERT INTO `xman_admin_group_access` (`admin_id`, `group_id`)
VALUES
	(1,1),
	(4,2),
	(6,1),
	(10,1),
	(18,1);

/*!40000 ALTER TABLE `xman_admin_group_access` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xman_admin_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xman_admin_menu`;

CREATE TABLE `xman_admin_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(80) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `recom` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `xman_admin_menu` WRITE;
/*!40000 ALTER TABLE `xman_admin_menu` DISABLE KEYS */;

INSERT INTO `xman_admin_menu` (`id`, `pid`, `name`, `title`, `status`, `type`, `recom`)
VALUES
	(1,0,'管理员','User/index',1,1,0),
	(2,1,'管理员管理','User/index',1,1,0),
	(3,1,'添加管理员','User/addUser',1,1,1),
	(4,1,'用户组管理','User/listGroup',1,1,0),
	(5,1,'添加用户组','User/addGroup',1,1,0),
	(6,1,'权限管理','User/listRule',1,1,0),
	(7,1,'添加权限','User/addRule',1,1,0),
	(8,0,'文章','Article/index',1,1,0),
	(9,8,'文章管理','Article/index',1,1,1),
	(10,8,'添加文章','Article/addArticle',1,1,0),
	(14,8,'公告管理','Article/listNotice',1,1,0),
	(16,8,'添加公告','Article/addNotice',1,1,0),
	(17,1,'菜单管理','User/listMenu',1,1,0),
	(18,1,'添加菜单','User/addMenu',1,1,0),
	(20,8,'文章栏目管理','Article/listArticleColumn',1,1,0),
	(21,8,'添加文章栏目','Article/addArticleColumn',1,1,0);

/*!40000 ALTER TABLE `xman_admin_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xman_admin_rule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xman_admin_rule`;

CREATE TABLE `xman_admin_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(80) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `xman_admin_rule` WRITE;
/*!40000 ALTER TABLE `xman_admin_rule` DISABLE KEYS */;

INSERT INTO `xman_admin_rule` (`id`, `pid`, `name`, `title`, `status`, `type`)
VALUES
	(1,0,'管理员管理','User/list',1,1),
	(2,1,'管理员列表','User/index',1,1),
	(3,1,'添加管理员','User/addUser',1,1),
	(4,1,'用户组管理','User/listGroup',1,1),
	(5,1,'添加用户组','User/addGroup',1,1),
	(6,1,'权限管理','User/listRule',1,1),
	(7,1,'添加权限','User/addRule',1,1),
	(8,0,'文章管理','Article/list',1,1),
	(9,8,'文章管理','Article/index',1,1),
	(10,8,'添加文章','Article/addArticle',1,1),
	(14,8,'公告管理','Article/listNotice',1,1),
	(16,8,'添加公告','Article/addNotice',1,1),
	(17,2,'修改管理员','Rule/editUser',1,1),
	(18,2,'删除管理员','User/dropUser',1,1),
	(19,4,'删除用户组','User/dropGroup',1,1),
	(20,4,'修改用户组','User/editGroup',1,1),
	(21,4,'分配权限','User/allocateRule',1,1),
	(22,4,'添加用户','User/allocateUser',1,1),
	(23,6,'修改权限','User/editRule',1,1),
	(24,6,'删除权限','User/dropRule',1,1),
	(25,1,'菜单管理','User/listMenu',1,1),
	(26,1,'添加菜单','addMenu',1,1),
	(27,25,'修改菜单','User/editMenu',1,1),
	(28,25,'删除菜单','Rule/dropMenu',1,1),
	(29,9,'修改文章','Article/editArticle',1,1),
	(30,9,'删除文章','Article/dropArticle',1,1),
	(31,14,'修改公告','Article/editNotice',1,1),
	(32,14,'删除公告','Article/dropNotice',1,1),
	(33,8,'文章栏目管理','Article/listArticleColumn',1,1),
	(34,8,'添加文章栏目','Article/addArticleColumn',1,1),
	(35,33,'修改文章栏目','Article/editArticleColumn',1,1),
	(36,33,'删除文章栏目','Article/dropArticleColumn',1,1);

/*!40000 ALTER TABLE `xman_admin_rule` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xman_article
# ------------------------------------------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `xman_article` WRITE;
/*!40000 ALTER TABLE `xman_article` DISABLE KEYS */;

INSERT INTO `xman_article` (`id`, `article_title`, `article_profile`, `article_content`, `article_status`, `article_type`, `add_time`)
VALUES
	(1,'第一篇文章','第一篇文章概述2432','&lt;p&gt;阿飞萨芬大&lt;img src=&quot;/Upload/images/editor/20160921/1474447531779176.jpg&quot; title=&quot;1474447531779176.jpg&quot; alt=&quot;下载.jpg&quot;/&gt;asfsaafdsafdsa&lt;/p&gt;',1,1,1474447533);

/*!40000 ALTER TABLE `xman_article` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
