ALTER TABLE `Questions` ADD `packageId` MEDIUMINT(8) UNSIGNED NULL;

ALTER TABLE `Questions`
  ADD
    CONSTRAINT `fk_package_id`
    FOREIGN KEY (`packageId`)
    REFERENCES `Packages`(`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE;
