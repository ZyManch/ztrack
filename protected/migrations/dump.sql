-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2015 at 09:24 PM
-- Server version: 5.1.40
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `ztrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(32) NOT NULL,
  `access` set('read','create','update','exception') NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `company_id`, `title`, `access`, `status`, `changed`) VALUES
(1, NULL, 'admin', 'read,create,update,exception', 'Active', '2014-08-30 08:41:29'),
(2, 1, 'Full access', 'read,create,update,exception', 'Active', '2014-08-30 09:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `company_id` int(10) unsigned DEFAULT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `title`, `company_id`, `status`, `changed`) VALUES
(1, 'master', NULL, 'Active', '2014-08-29 22:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `browser`
--

CREATE TABLE IF NOT EXISTS `browser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `browser` varchar(255) NOT NULL,
  `name` varchar(32) NOT NULL DEFAULT 'unknown',
  `version` varchar(32) NOT NULL DEFAULT 'unknown',
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `browser`
--


-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `editor_id` int(10) unsigned NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `editor_id` (`editor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `title`, `editor_id`, `status`, `changed`) VALUES
(1, 'MyCompany', 2, 'Active', '2015-03-10 12:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `editor`
--

CREATE TABLE IF NOT EXISTS `editor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `editor`
--

INSERT INTO `editor` (`id`, `name`, `title`, `description`, `status`, `changed`) VALUES
(1, 'html', 'HTML', 'WYSIWYG editor', 'Active', '2015-03-09 16:32:01'),
(2, 'wiki', 'Wiki', 'Wiki editor', 'Active', '2015-03-09 16:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `exception`
--

CREATE TABLE IF NOT EXISTS `exception` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` int(11) NOT NULL,
  `level_id` int(10) unsigned NOT NULL,
  `total_count` int(10) unsigned NOT NULL DEFAULT '0',
  `trace_file` varchar(200) DEFAULT NULL,
  `trace_line` mediumint(8) unsigned DEFAULT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `level_id` (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `exception`
--


-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `title` varchar(32) NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `company_id`, `title`, `status`, `changed`) VALUES
(1, 1, 'Test group', 'Active', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `group_access`
--

CREATE TABLE IF NOT EXISTS `group_access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL,
  `access_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`group_id`),
  KEY `access_id` (`access_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `group_access`
--

INSERT INTO `group_access` (`id`, `group_id`, `access_id`, `project_id`, `status`, `changed`) VALUES
(1, 1, 2, 3, 'Active', '2014-08-30 10:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `guest_system_module`
--

CREATE TABLE IF NOT EXISTS `guest_system_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system_module_id` int(10) unsigned NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `system_module_id` (`system_module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `guest_system_module`
--


-- --------------------------------------------------------

--
-- Table structure for table `label`
--

CREATE TABLE IF NOT EXISTS `label` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `title` varchar(32) NOT NULL,
  `color` char(6) NOT NULL DEFAULT '1ab394',
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `label`
--

INSERT INTO `label` (`id`, `company_id`, `title`, `color`, `status`, `changed`) VALUES
(1, 1, 'label', '1ab394', 'Active', '2015-03-11 17:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('Page','Exception') NOT NULL DEFAULT 'Exception',
  `title` varchar(32) NOT NULL,
  `css_class` varchar(32) NOT NULL DEFAULT '',
  `company_id` int(10) unsigned DEFAULT NULL,
  `weight` mediumint(8) unsigned NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `type`, `title`, `css_class`, `company_id`, `weight`, `status`, `changed`) VALUES
(1, 'Exception', 'info', '', NULL, 1, 'Active', '2014-08-29 21:55:06'),
(2, 'Exception', 'warning', '', NULL, 10, 'Active', '2014-08-29 21:55:12'),
(3, 'Exception', 'error', '', NULL, 20, 'Active', '2014-08-29 21:55:17'),
(4, 'Exception', 'critical', '', NULL, 30, 'Active', '2014-08-29 21:55:20'),
(5, 'Page', 'Low', '', NULL, 1, 'Active', '2015-03-14 06:27:04'),
(6, 'Page', 'Normal', '', NULL, 10, 'Active', '2015-03-14 06:27:04'),
(7, 'Page', 'High', '', NULL, 20, 'Active', '2015-03-14 06:27:30'),
(8, 'Page', 'Urgent', '', NULL, 30, 'Active', '2015-03-14 06:27:30'),
(9, 'Page', 'Immediately', '', NULL, 100, 'Active', '2015-03-14 22:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `method`
--

CREATE TABLE IF NOT EXISTS `method` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `method`
--


-- --------------------------------------------------------

--
-- Table structure for table `os`
--

CREATE TABLE IF NOT EXISTS `os` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `os` varchar(255) NOT NULL,
  `name` varchar(32) NOT NULL DEFAULT 'unknown',
  `version` varchar(32) NOT NULL DEFAULT 'unknown',
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `os`
--


-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_page_id` int(10) unsigned DEFAULT NULL,
  `author_user_id` int(10) unsigned NOT NULL,
  `assign_user_id` int(10) unsigned DEFAULT NULL,
  `page_type_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned DEFAULT NULL,
  `url` varchar(64) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `body` text NOT NULL,
  `progress` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `level_id` int(10) unsigned DEFAULT NULL,
  `status` enum('Active','Blocked','Deleted','Closed') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author_user_id` (`author_user_id`),
  KEY `assign_user_id` (`assign_user_id`),
  KEY `page_type_id` (`page_type_id`),
  KEY `project_id` (`project_id`),
  KEY `parent_page_id` (`parent_page_id`),
  KEY `level` (`level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `parent_page_id`, `author_user_id`, `assign_user_id`, `page_type_id`, `project_id`, `url`, `title`, `body`, `progress`, `level_id`, `status`, `changed`) VALUES
(2, 9, 1, 1, 1, 2, NULL, 'Тикет 1', 'Описание тикета', 0, 8, 'Active', '2015-03-14 21:59:04'),
(3, NULL, 1, NULL, 2, 2, NULL, 'Wiki page', 'Info', 0, NULL, 'Active', '2015-03-09 12:48:34'),
(4, NULL, 1, NULL, 2, NULL, NULL, NULL, '<p>asdasdsad</p>', 0, NULL, 'Active', '0000-00-00 00:00:00'),
(5, NULL, 1, NULL, 2, 2, '', '123', '== Heading ==\r\n\r\n=== Subheading ===\r\n\r\n==== Subsubheading ====\r\n\r\n'''''''''' Bold-italic ''''''''''\r\n\r\n'''''' Bold ''''''\r\n\r\n'''' Italic ''''\r\n\r\n---- \r\n\r\n<a href="asdas">asdad</a>\r\n: Indentation\r\n\r\n:: Subindentation\r\n\r\n* Unordered list \r\n** Unordered list \r\n** Unordered list \r\n# Ordered list \r\n## Ordered list \r\n## Ordered list \r\n\r\n[[file:http://example.com/image.jpg title]]\r\n\r\n\r\nтекст http://example.com текст\r\n\r\n\r\nфыв\r\n\r\n"Example Link":http://example.com\r\n\r\n\r\nфыв\r\n[mylink]', 0, NULL, 'Active', '0000-00-00 00:00:00'),
(6, NULL, 1, NULL, 2, 2, 'mylink', 'My link', 'info', 0, NULL, 'Active', '0000-00-00 00:00:00'),
(7, NULL, 1, NULL, 3, NULL, NULL, 'note 1', 'asdasdasd', 0, NULL, 'Active', '2015-03-11 17:13:12'),
(8, 7, 1, NULL, 3, NULL, NULL, 'note 2', 'asdsadasd\r\n\r\n\r\nasdasd *asdsada* asdsadsa', 0, NULL, 'Active', '2015-03-11 17:13:26'),
(9, NULL, 1, NULL, 4, 2, NULL, '1.0', '', 0, NULL, 'Active', '2015-03-13 22:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `page_label`
--

CREATE TABLE IF NOT EXISTS `page_label` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `label_id` int(10) unsigned NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  KEY `label_id` (`label_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `page_label`
--

INSERT INTO `page_label` (`id`, `page_id`, `label_id`, `status`, `changed`) VALUES
(1, 7, 1, 'Active', '2015-03-11 17:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `page_type`
--

CREATE TABLE IF NOT EXISTS `page_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `constant` varchar(64) NOT NULL,
  `title` varchar(64) NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `page_type`
--

INSERT INTO `page_type` (`id`, `constant`, `title`, `status`, `changed`) VALUES
(1, 'PAGE_TYPE_TICKETS', 'Тикеты', 'Active', '2015-03-09 12:54:08'),
(2, 'PAGE_TYPE_WIKI', 'Wiki', 'Active', '2015-03-09 12:54:13'),
(3, 'PAGE_TYPE_NOTES', 'Пометки', 'Active', '2015-03-09 12:54:20'),
(4, 'PAGE_TYPE_RELEASE', 'Релиз', 'Active', '2015-03-13 22:43:53');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `title`, `parent_id`, `status`, `changed`) VALUES
(1, 'GTFlix', NULL, 'Active', '2014-08-29 21:56:34'),
(2, 'Gfpass', 1, 'Active', '2014-08-29 21:57:22'),
(3, 'LegalVideo', 1, 'Active', '2014-08-29 21:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `project_system_module`
--

CREATE TABLE IF NOT EXISTS `project_system_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `system_module_id` int(10) unsigned NOT NULL,
  `params` text,
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `system_module_id` (`system_module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `project_system_module`
--

INSERT INTO `project_system_module` (`id`, `project_id`, `system_module_id`, `params`, `changed`) VALUES
(1, 2, 7, NULL, '2015-03-09 11:17:59'),
(3, 2, 8, NULL, '2015-03-09 12:42:07'),
(4, 2, 10, NULL, '2015-03-12 17:13:07'),
(5, 3, 10, NULL, '2015-03-12 17:13:07'),
(6, 3, 7, NULL, '2015-03-13 18:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `browser_id` int(10) unsigned NOT NULL,
  `os_id` int(10) unsigned NOT NULL,
  `user_ip` int(10) unsigned NOT NULL,
  `code` varchar(32) NOT NULL,
  `method_id` int(10) unsigned NOT NULL,
  `url_id` int(10) unsigned NOT NULL,
  `referer_url_id` int(11) unsigned DEFAULT NULL,
  `server_id` int(10) unsigned DEFAULT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  KEY `server_id` (`server_id`),
  KEY `url_id` (`url_id`),
  KEY `method_id` (`method_id`),
  KEY `referer_url_id` (`referer_url_id`),
  KEY `os_id` (`os_id`),
  KEY `browser_id` (`browser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `request`
--


-- --------------------------------------------------------

--
-- Table structure for table `request_data`
--

CREATE TABLE IF NOT EXISTS `request_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `request_id` int(10) unsigned NOT NULL,
  `data` text NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `request_data`
--


-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE IF NOT EXISTS `server` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `server`
--


-- --------------------------------------------------------

--
-- Table structure for table `system_module`
--

CREATE TABLE IF NOT EXISTS `system_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `type` enum('user','project','widget') NOT NULL DEFAULT 'user',
  `installation` enum('force','install','not_install','manual') NOT NULL DEFAULT 'not_install',
  `position` int(11) NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `system_module`
--

INSERT INTO `system_module` (`id`, `name`, `title`, `description`, `type`, `installation`, `position`, `status`, `changed`) VALUES
(1, 'dashboard', 'Dashboard', 'Add dashboard', 'user', 'force', 3, 'Active', '2015-03-13 17:09:21'),
(2, 'projects', 'Projects', 'Add project list', 'user', 'install', 5, 'Active', '2015-03-13 17:09:16'),
(3, 'notification', 'Notifications', 'Add notifications in top menu', 'user', 'install', 9, 'Active', '2015-03-13 17:09:08'),
(4, 'messages', 'Messages', 'Add messages in top menu', 'user', 'install', 11, 'Active', '2015-03-13 17:09:12'),
(5, 'search', 'Search panel', 'Add search panel in topmenu', 'user', 'install', 4, 'Active', '2015-03-13 17:08:59'),
(6, 'profile', 'Profile', 'Add profile in top menu', 'user', 'force', 1, 'Active', '2015-03-13 17:08:55'),
(7, 'tickets', 'Tickets', 'Add list of all tickets', 'project', 'install', 0, 'Active', '2015-03-13 18:01:14'),
(8, 'wiki', 'Wiki', 'Add wiki to project', 'project', 'not_install', 1, 'Active', '2015-03-13 17:08:38'),
(9, 'notes', 'Notes', '', 'user', 'not_install', 15, 'Active', '2015-03-13 17:08:35'),
(10, 'settings', 'Settings', 'Project setting', 'project', 'force', 1000, 'Active', '2015-03-13 17:08:31'),
(11, 'tickets', 'Ticket list', '', 'widget', 'manual', 0, 'Active', '2015-03-15 18:11:33'),
(13, 'lastRelease', 'Current Release', '', 'widget', 'manual', 0, 'Active', '2015-03-14 22:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `trace`
--

CREATE TABLE IF NOT EXISTS `trace` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(10) unsigned DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `line` int(11) DEFAULT NULL,
  `method` int(11) DEFAULT NULL,
  `position` int(10) unsigned NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `trace`
--


-- --------------------------------------------------------

--
-- Table structure for table `trace_argument`
--

CREATE TABLE IF NOT EXISTS `trace_argument` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trace_id` int(10) unsigned NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `position` mediumint(8) unsigned NOT NULL,
  `value` text NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `trace_id` (`trace_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `trace_argument`
--


-- --------------------------------------------------------

--
-- Table structure for table `trace_code`
--

CREATE TABLE IF NOT EXISTS `trace_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trace_id` int(10) unsigned NOT NULL,
  `line` mediumint(9) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `trace_id` (`trace_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `trace_code`
--


-- --------------------------------------------------------

--
-- Table structure for table `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `protocol` enum('https','http') NOT NULL DEFAULT 'http',
  `domain` varchar(200) NOT NULL,
  `url` text NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `url`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `login` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `company_id`, `login`, `email`, `password`, `status`, `changed`) VALUES
(1, 1, 'zymanch', 'zymanch@gmail.com', '3268d93b93f909370e16a3f414787013', 'Active', '2014-08-30 08:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE IF NOT EXISTS `user_access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `access_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `access_id` (`access_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id`, `user_id`, `access_id`, `project_id`, `status`, `changed`) VALUES
(1, 1, 1, 1, 'Active', '2014-08-30 09:01:44'),
(2, 1, 1, 2, 'Active', '2014-08-30 09:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `status` enum('Active','Blocked','Deleted') NOT NULL DEFAULT 'Active',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`, `status`, `changed`) VALUES
(1, 1, 1, 'Active', '2014-08-30 09:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_system_module`
--

CREATE TABLE IF NOT EXISTS `user_system_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `system_module_id` int(10) unsigned NOT NULL,
  `params` text,
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `module_id` (`system_module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_system_module`
--

INSERT INTO `user_system_module` (`id`, `user_id`, `system_module_id`, `params`, `changed`) VALUES
(1, 1, 1, NULL, '2015-03-09 09:35:33'),
(2, 1, 2, NULL, '2015-03-09 09:35:37'),
(3, 1, 3, NULL, '2015-03-09 10:22:28'),
(4, 1, 4, NULL, '2015-03-09 10:22:28'),
(5, 1, 5, NULL, '2015-03-09 10:22:35'),
(6, 1, 6, NULL, '2015-03-09 10:22:35'),
(7, 1, 9, NULL, '2015-03-11 17:01:20');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access`
--
ALTER TABLE `access`
  ADD CONSTRAINT `access_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`editor_id`) REFERENCES `editor` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `exception`
--
ALTER TABLE `exception`
  ADD CONSTRAINT `exception_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_access`
--
ALTER TABLE `group_access`
  ADD CONSTRAINT `group_access_ibfk_2` FOREIGN KEY (`access_id`) REFERENCES `access` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_access_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_access_ibfk_4` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guest_system_module`
--
ALTER TABLE `guest_system_module`
  ADD CONSTRAINT `guest_system_module_ibfk_1` FOREIGN KEY (`system_module_id`) REFERENCES `system_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `label`
--
ALTER TABLE `label`
  ADD CONSTRAINT `label_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `level`
--
ALTER TABLE `level`
  ADD CONSTRAINT `level_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `page_ibfk_6` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `page_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_ibfk_2` FOREIGN KEY (`assign_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_ibfk_3` FOREIGN KEY (`page_type_id`) REFERENCES `page_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_ibfk_4` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_ibfk_5` FOREIGN KEY (`parent_page_id`) REFERENCES `page` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `page_label`
--
ALTER TABLE `page_label`
  ADD CONSTRAINT `page_label_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_label_ibfk_2` FOREIGN KEY (`label_id`) REFERENCES `label` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_system_module`
--
ALTER TABLE `project_system_module`
  ADD CONSTRAINT `project_system_module_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_system_module_ibfk_2` FOREIGN KEY (`system_module_id`) REFERENCES `system_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`url_id`) REFERENCES `url` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`method_id`) REFERENCES `method` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_4` FOREIGN KEY (`server_id`) REFERENCES `server` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_5` FOREIGN KEY (`referer_url_id`) REFERENCES `url` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_6` FOREIGN KEY (`browser_id`) REFERENCES `browser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_7` FOREIGN KEY (`os_id`) REFERENCES `os` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_data`
--
ALTER TABLE `request_data`
  ADD CONSTRAINT `request_data_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `server`
--
ALTER TABLE `server`
  ADD CONSTRAINT `server_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trace`
--
ALTER TABLE `trace`
  ADD CONSTRAINT `trace_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trace_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `trace` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trace_argument`
--
ALTER TABLE `trace_argument`
  ADD CONSTRAINT `trace_argument_ibfk_1` FOREIGN KEY (`trace_id`) REFERENCES `trace` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trace_code`
--
ALTER TABLE `trace_code`
  ADD CONSTRAINT `trace_code_ibfk_1` FOREIGN KEY (`trace_id`) REFERENCES `trace` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_access`
--
ALTER TABLE `user_access`
  ADD CONSTRAINT `user_access_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_access_ibfk_2` FOREIGN KEY (`access_id`) REFERENCES `access` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_access_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_group`
--
ALTER TABLE `user_group`
  ADD CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_system_module`
--
ALTER TABLE `user_system_module`
  ADD CONSTRAINT `user_system_module_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_system_module_ibfk_2` FOREIGN KEY (`system_module_id`) REFERENCES `system_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
