ALTER TABLE `Questions` ADD `falseAnswer1` varchar(500) NOT NULL COMMENT '[ml]' AFTER `answer_eu`;
ALTER TABLE `Questions` ADD `falseAnswer2` varchar(500) NOT NULL COMMENT '[ml]' AFTER `falseAnswer1`;
ALTER TABLE `Questions` ADD `falseAnswer3` varchar(500) NOT NULL COMMENT '[ml]' AFTER `falseAnswer2`;
