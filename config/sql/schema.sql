-- phpMyAdmin SQL Dump
-- version 2.11.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2009 at 11:35 PM
-- Server version: 5.0.41
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `cakefestworking`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
CREATE TABLE `acos` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `model` varchar(255) default NULL,
  `foreign_key` int(11) default NULL,
  `alias` varchar(255) default NULL,
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` VALUES(1, NULL, NULL, NULL, 'Users', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
CREATE TABLE `aros` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `model` varchar(255) default NULL,
  `foreign_key` int(11) default NULL,
  `alias` varchar(255) default NULL,
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` VALUES(1, NULL, NULL, NULL, 'Roles', 1, 4);
INSERT INTO `aros` VALUES(2, NULL, NULL, NULL, 'admin', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE `aros_acos` (
  `id` int(11) NOT NULL auto_increment,
  `aro_id` int(11) NOT NULL,
  `aco_id` int(11) NOT NULL,
  `_create` varchar(2) NOT NULL default '0',
  `_read` varchar(2) NOT NULL default '0',
  `_update` varchar(2) NOT NULL default '0',
  `_delete` varchar(2) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `aro_id` (`aro_id`),
  KEY `aco_id` (`aco_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `aros_acos`
--

INSERT INTO `aros_acos` VALUES(1, 2, 1, '0', '1', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--


-- --------------------------------------------------------

--
-- Table structure for table `i18n`
--

DROP TABLE IF EXISTS `i18n`;
CREATE TABLE `i18n` (
  `id` int(11) NOT NULL auto_increment,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(11) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `i18n`
--


-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `source_id` char(36) default NULL,
  `text` varchar(140) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `profile_id` (`user_id`),
  KEY `source_id` (`source_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` VALUES('4a55baa3-0c9c-4ef0-b274-1457a77796a8', '', NULL, '', '2009-07-09 19:38:43', '2009-07-09 19:38:43');
INSERT INTO `posts` VALUES('4a55baa6-2e28-4fff-b52c-1457a77796a8', '', NULL, 'test', '2009-07-09 19:38:46', '2009-07-09 19:38:46');
INSERT INTO `posts` VALUES('4a55bb2f-0150-4cb2-b24a-0fc7a77796a8', '', NULL, 'test', '2009-07-09 19:41:03', '2009-07-09 19:41:03');
INSERT INTO `posts` VALUES('4a55cf98-09e8-4d73-9ecf-1457a77796a8', '', NULL, 'test', '2009-07-09 21:08:08', '2009-07-09 21:08:08');
INSERT INTO `posts` VALUES('4a560120-8554-459a-a1db-1457a77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Testie', '2009-07-10 00:39:28', '2009-07-10 00:39:28');
INSERT INTO `posts` VALUES('4a5601fc-211c-4b1f-8f6b-0fc4a77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Test with callbacks', '2009-07-10 00:43:08', '2009-07-10 00:43:08');
INSERT INTO `posts` VALUES('4a560230-f828-4767-81e3-0fc6a77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Test with callbacks', '2009-07-10 00:44:00', '2009-07-10 00:44:00');
INSERT INTO `posts` VALUES('4a5602ff-a710-455d-8d98-1457a77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, '12345. Once I caught a fish alive.', '2009-07-10 00:47:27', '2009-07-10 00:47:27');
INSERT INTO `posts` VALUES('4a567476-ec64-42c3-910f-00dba77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Testing', '2009-07-10 08:51:34', '2009-07-10 08:51:34');
INSERT INTO `posts` VALUES('4a567572-6ecc-4a64-b81e-00dca77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Testing', '2009-07-10 08:55:46', '2009-07-10 08:55:46');
INSERT INTO `posts` VALUES('4a5675cd-b404-4a1a-9391-00dda77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Testing', '2009-07-10 08:57:17', '2009-07-10 08:57:17');
INSERT INTO `posts` VALUES('4a5675d3-ed78-4a2a-a22e-00dda77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Testing', '2009-07-10 08:57:23', '2009-07-10 08:57:23');
INSERT INTO `posts` VALUES('4a56761a-55f0-4f5e-98a9-00d9a77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Testing', '2009-07-10 08:58:34', '2009-07-10 08:58:34');
INSERT INTO `posts` VALUES('4a567637-a9d0-4bde-b947-00dba77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Testing', '2009-07-10 08:59:03', '2009-07-10 08:59:03');
INSERT INTO `posts` VALUES('4a567659-9754-4d09-998a-00dca77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Testing', '2009-07-10 08:59:37', '2009-07-10 08:59:37');
INSERT INTO `posts` VALUES('4a5677a2-46ac-418d-8372-00eba77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Testing', '2009-07-10 09:05:06', '2009-07-10 09:05:06');
INSERT INTO `posts` VALUES('4a5677ba-6b34-49a9-952b-00dea77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Testing', '2009-07-10 09:05:30', '2009-07-10 09:05:30');
INSERT INTO `posts` VALUES('4a5677d2-9080-4975-9e6b-00d9a77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Testing', '2009-07-10 09:05:54', '2009-07-10 09:05:54');
INSERT INTO `posts` VALUES('4a5677df-05ec-4979-9b10-00d9a77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Testing', '2009-07-10 09:06:07', '2009-07-10 09:06:07');
INSERT INTO `posts` VALUES('4a5677fc-c26c-43c0-aa62-00dda77796a8', '4a55e6f7-8b84-4974-8479-100fa77796a8', NULL, 'Secret stuff here.', '2009-07-10 09:06:36', '2009-07-10 09:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `robot_tasks`
--

DROP TABLE IF EXISTS `robot_tasks`;
CREATE TABLE `robot_tasks` (
  `id` char(36) NOT NULL,
  `robot_task_action_id` char(36) NOT NULL,
  `status` enum('pending','processing','running','completed','failed') NOT NULL default 'pending',
  `parameters` text,
  `scheduled` datetime NOT NULL,
  `started` datetime default NULL,
  `finished` datetime default NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `robot_task_action_id` (`robot_task_action_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `robot_tasks`
--


-- --------------------------------------------------------

--
-- Table structure for table `robot_task_actions`
--

DROP TABLE IF EXISTS `robot_task_actions`;
CREATE TABLE `robot_task_actions` (
  `id` char(36) NOT NULL,
  `action` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `action` (`action`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `robot_task_actions`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `group_id` char(36) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `posts_count` int(11) NOT NULL,
  `open_id_url` varchar(255) default NULL,
  `role` varchar(255) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES('4a571386-2254-4c97-8a74-a9d6a77796a8', '', 'graham@grahamweldon.com', 'graham', 'bc8d6ec58885461ca93961dbff9fe74d2bc95b6b', 0, '', NULL, '2009-07-10 20:10:14', '2009-07-10 20:10:14');
INSERT INTO `users` VALUES('4a55ef52-a6a4-4f25-88aa-4bc8a77796a8', '', '', 'users', '', 0, '', NULL, '2009-07-09 23:23:30', '2009-07-09 23:23:30');
INSERT INTO `users` VALUES('4a5711a8-4bbc-4ebb-b646-8507a77796a8', '', '', 'bob', '3edab4973bcdbb82b137866308ac5872e1a1740e', 0, '', NULL, '2009-07-10 20:02:16', '2009-07-10 20:02:16');
INSERT INTO `users` VALUES('4a57132c-31c4-4e23-ad93-00dda77796a8', '', 'abc@abc.abc', 'a', '06bac96cc833777a85e0a1847673b20720c21391', 0, '', NULL, '2009-07-10 20:08:44', '2009-07-10 20:08:44');
