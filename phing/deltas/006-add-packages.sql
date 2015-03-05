CREATE TABLE IF NOT EXISTS `tribialfeminista`.`Packages` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`))
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8
  COLLATE = utf8_general_ci
  COMMENT = '[entity]';
