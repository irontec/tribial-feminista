ALTER TABLE `Users`
  ADD COLUMN 
    `fbUsername` VARCHAR(40) DEFAULT NULL;

ALTER TABLE `Users` ADD COLUMN `twUsername` VARCHAR(40) DEFAULT NULL;

