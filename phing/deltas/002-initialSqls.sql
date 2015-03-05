SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema tribialfeminista
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tribialfeminista` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `tribialfeminista` ;

-- -----------------------------------------------------
-- Table `tribialfeminista`.`Questions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tribialfeminista`.`Questions` (
  `id` BINARY(36) NOT NULL,
  `question` VARCHAR(500) NOT NULL COMMENT '[ml]',
  `answer` VARCHAR(200) NOT NULL COMMENT '[ml]',
  `category` ENUM('e', 'h', 'd', 'g', 'a', 'c') NOT NULL COMMENT '[enum:e|h|d|g|a|c]',
  `checked` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '[entity]';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
