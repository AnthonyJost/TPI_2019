-- MySQL Script generated by MySQL Workbench
-- 06/06/19 11:32:39
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema bdd_satisfevent
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `bdd_satisfevent` ;

-- -----------------------------------------------------
-- Schema bdd_satisfevent
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bdd_satisfevent` DEFAULT CHARACTER SET utf8 ;
USE `bdd_satisfevent` ;

-- -----------------------------------------------------
-- Table `bdd_satisfevent`.`events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdd_satisfevent`.`events` (
  `idEvents` INT(11) NOT NULL AUTO_INCREMENT,
  `Title` VARCHAR(45) NULL DEFAULT NULL,
  `Date` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`idEvents`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdd_satisfevent`.`schools`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdd_satisfevent`.`schools` (
  `idSchools` INT(11) NOT NULL,
  `Name` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`idSchools`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdd_satisfevent`.`statistics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdd_satisfevent`.`statistics` (
  `idStatistics` INT(11) NOT NULL AUTO_INCREMENT,
  `Material` TINYINT(4) NULL DEFAULT NULL,
  `Activity` TINYINT(4) NULL DEFAULT NULL,
  `Place` TINYINT(4) NULL DEFAULT NULL,
  `Hours` TINYINT(4) NULL DEFAULT NULL,
  `Satisfaction` TINYINT(4) NULL DEFAULT NULL,
  `Suggestion` VARCHAR(250) NULL,
  PRIMARY KEY (`idStatistics`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdd_satisfevent`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdd_satisfevent`.`users` (
  `idUsers` INT(11) NOT NULL AUTO_INCREMENT,
  `FirstName` VARCHAR(45) NULL DEFAULT NULL,
  `LastName` VARCHAR(45) NULL DEFAULT NULL,
  `Email` VARCHAR(45) NULL DEFAULT NULL,
  `Password` VARCHAR(60) NULL DEFAULT NULL,
  `Admin` TINYINT(1) NULL DEFAULT NULL,
  `Schools_idSchools` INT(11) NOT NULL,
  PRIMARY KEY (`idUsers`),
  CONSTRAINT `fk_Users_Schools1`
    FOREIGN KEY (`Schools_idSchools`)
    REFERENCES `bdd_satisfevent`.`schools` (`idSchools`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_Users_Schools1_idx` ON `bdd_satisfevent`.`users` (`Schools_idSchools` ASC);


-- -----------------------------------------------------
-- Table `bdd_satisfevent`.`workinggroups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdd_satisfevent`.`workinggroups` (
  `idWorkingGroups` INT(11) NOT NULL AUTO_INCREMENT,
  `Title` VARCHAR(45) NULL DEFAULT NULL,
  `Cost` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idWorkingGroups`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdd_satisfevent`.`users_has_workinggroups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdd_satisfevent`.`users_has_workinggroups` (
  `Users_idUsers` INT(11) NOT NULL,
  `WorkingGroups_idWorkingGroups` INT(11) NOT NULL,
  PRIMARY KEY (`Users_idUsers`, `WorkingGroups_idWorkingGroups`),
  CONSTRAINT `fk_Users_has_WorkingGroups_Users`
    FOREIGN KEY (`Users_idUsers`)
    REFERENCES `bdd_satisfevent`.`users` (`idUsers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Users_has_WorkingGroups_WorkingGroups1`
    FOREIGN KEY (`WorkingGroups_idWorkingGroups`)
    REFERENCES `bdd_satisfevent`.`workinggroups` (`idWorkingGroups`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_Users_has_WorkingGroups_WorkingGroups1_idx` ON `bdd_satisfevent`.`users_has_workinggroups` (`WorkingGroups_idWorkingGroups` ASC);

CREATE INDEX `fk_Users_has_WorkingGroups_Users_idx` ON `bdd_satisfevent`.`users_has_workinggroups` (`Users_idUsers` ASC);


-- -----------------------------------------------------
-- Table `bdd_satisfevent`.`workinggroups_has_events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdd_satisfevent`.`workinggroups_has_events` (
  `WorkingGroups_idWorkingGroups` INT(11) NOT NULL,
  `Events_idEvents` INT(11) NOT NULL,
  PRIMARY KEY (`WorkingGroups_idWorkingGroups`, `Events_idEvents`),
  CONSTRAINT `fk_WorkingGroups_has_Events_Events1`
    FOREIGN KEY (`Events_idEvents`)
    REFERENCES `bdd_satisfevent`.`events` (`idEvents`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WorkingGroups_has_Events_WorkingGroups1`
    FOREIGN KEY (`WorkingGroups_idWorkingGroups`)
    REFERENCES `bdd_satisfevent`.`workinggroups` (`idWorkingGroups`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_WorkingGroups_has_Events_Events1_idx` ON `bdd_satisfevent`.`workinggroups_has_events` (`Events_idEvents` ASC);

CREATE INDEX `fk_WorkingGroups_has_Events_WorkingGroups1_idx` ON `bdd_satisfevent`.`workinggroups_has_events` (`WorkingGroups_idWorkingGroups` ASC);


-- -----------------------------------------------------
-- Table `bdd_satisfevent`.`workinggroups_has_statistics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdd_satisfevent`.`workinggroups_has_statistics` (
  `WorkingGroups_idWorkingGroups` INT(11) NOT NULL,
  `Statistics_idStatistics` INT(11) NOT NULL,
  PRIMARY KEY (`WorkingGroups_idWorkingGroups`, `Statistics_idStatistics`),
  CONSTRAINT `fk_WorkingGroups_has_Statistics_Statistics1`
    FOREIGN KEY (`Statistics_idStatistics`)
    REFERENCES `bdd_satisfevent`.`statistics` (`idStatistics`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WorkingGroups_has_Statistics_WorkingGroups1`
    FOREIGN KEY (`WorkingGroups_idWorkingGroups`)
    REFERENCES `bdd_satisfevent`.`workinggroups` (`idWorkingGroups`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_WorkingGroups_has_Statistics_Statistics1_idx` ON `bdd_satisfevent`.`workinggroups_has_statistics` (`Statistics_idStatistics` ASC);

CREATE INDEX `fk_WorkingGroups_has_Statistics_WorkingGroups1_idx` ON `bdd_satisfevent`.`workinggroups_has_statistics` (`WorkingGroups_idWorkingGroups` ASC);


-- -----------------------------------------------------
-- Table `bdd_satisfevent`.`statistics_has_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdd_satisfevent`.`statistics_has_users` (
  `statistics_idStatistics` INT(11) NOT NULL,
  `users_idUsers` INT(11) NOT NULL,
  PRIMARY KEY (`statistics_idStatistics`, `users_idUsers`),
  CONSTRAINT `fk_statistics_has_users_statistics1`
    FOREIGN KEY (`statistics_idStatistics`)
    REFERENCES `bdd_satisfevent`.`statistics` (`idStatistics`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_statistics_has_users_users1`
    FOREIGN KEY (`users_idUsers`)
    REFERENCES `bdd_satisfevent`.`users` (`idUsers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_statistics_has_users_users1_idx` ON `bdd_satisfevent`.`statistics_has_users` (`users_idUsers` ASC);

CREATE INDEX `fk_statistics_has_users_statistics1_idx` ON `bdd_satisfevent`.`statistics_has_users` (`statistics_idStatistics` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `Schools` VALUES
('1','CEPM'),
('2','CEPV'),
('3','COFOP'),
('4','CPNV'),
('5','EPCA'),
('6','EPCL'),
('7','EPCN'),
('8','EPM'),
('9','EPSIC'),
('10','ERACOM'),
('11','ESS'),
('12','ETML'),
('13','ETVJ');
