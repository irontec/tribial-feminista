ALTER TABLE `Questions` ADD `question_es` varchar(500) NOT NULL  COMMENT '' AFTER `question`;
ALTER TABLE `Questions` ADD `question_eu` varchar(500) NOT NULL  COMMENT '' AFTER `question`;
ALTER TABLE `Questions` ADD `answer_es` varchar(200) NOT NULL  COMMENT '' AFTER `answer`;
ALTER TABLE `Questions` ADD `answer_eu` varchar(200) NOT NULL  COMMENT '' AFTER `answer`;
