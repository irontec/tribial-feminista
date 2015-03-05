CREATE TABLE `Users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `loginType` ENUM('twitter', 'facebook') NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
)
ENGINE=InnoDB
DEFAULT
CHARSET=utf8
COMMENT='[entity]';
