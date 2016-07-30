CREATE SCHEMA `supsearch` ;

CREATE TABLE `supsearch`.`website` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`_id`),
  UNIQUE INDEX `_id_UNIQUE` (`_id` ASC),
  UNIQUE INDEX `url_UNIQUE` (`url` ASC));
