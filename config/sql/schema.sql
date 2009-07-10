#CakeFestWorking sql generated on: 2009-07-10 17:07:21 : 1247211921

DROP TABLE IF EXISTS `posts`;
DROP TABLE IF EXISTS `users`;


CREATE TABLE `posts` (
	`id` varchar(36) NOT NULL,
	`user_id` varchar(36) NOT NULL,
	`source_id` varchar(36) DEFAULT NULL,
	`text` varchar(140) NOT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY profile_id (`user_id`),
	KEY source_id (`source_id`));

CREATE TABLE `users` (
	`id` varchar(36) NOT NULL,
	`group_id` varchar(36) NOT NULL,
	`email` varchar(255) NOT NULL,
	`username` varchar(255) NOT NULL,
	`password` text NOT NULL,
	`posts_count` int(11) NOT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY username (`username`),
	KEY group_id (`group_id`));

