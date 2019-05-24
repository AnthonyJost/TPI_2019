-- MySQL Workbench Forward Engineering
DROP DATABASE IF EXISTS BDD_SatisfEvent;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema BDD_SatisfEvent
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema BDD_SatisfEvent
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `BDD_SatisfEvent` DEFAULT CHARACTER SET utf8 ;
USE `BDD_SatisfEvent` ;

-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`Schools`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`Schools` (
  `idSchools` INT NOT NULL,
  `Name` VARCHAR(10) NULL,
  PRIMARY KEY (`idSchools`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`Users` (
  `idUsers` INT NOT NULL AUTO_INCREMENT,
  `FirstName` VARCHAR(45) NULL,
  `LastName` VARCHAR(45) NULL,
  `Email` VARCHAR(45) NULL,
  `Password` VARCHAR(45) NULL,
  `Admin` TINYINT(1) DEFAULT '0',
  `Schools_idSchools` INT NOT NULL,
  PRIMARY KEY (`idUsers`),
  CONSTRAINT `fk_Users_Schools1`
    FOREIGN KEY (`Schools_idSchools`)
    REFERENCES `BDD_SatisfEvent`.`Schools` (`idSchools`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Users_Schools1_idx` ON `BDD_SatisfEvent`.`Users` (`Schools_idSchools` ASC);


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`WorkingGroups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`WorkingGroups` (
  `idWorkingGroups` INT NOT NULL,
  `Title` VARCHAR(45) NULL,
  `Cost` INT NULL,
  PRIMARY KEY (`idWorkingGroups`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`Statistics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`Statistics` (
  `idStatistics` INT NOT NULL,
  `Material` TINYINT NULL,
  `Activity` TINYINT NULL,
  `Place` TINYINT NULL,
  `Hours` TINYINT NULL,
  `Satisfaction` TINYINT NULL,
  PRIMARY KEY (`idStatistics`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`Events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`Events` (
  `idEvents` INT NOT NULL,
  `Title` VARCHAR(45) NULL,
  `Date` DATE NULL,
  PRIMARY KEY (`idEvents`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`Users_has_WorkingGroups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`Users_has_WorkingGroups` (
  `Users_idUsers` INT NOT NULL,
  `WorkingGroups_idWorkingGroups` INT NOT NULL,
  PRIMARY KEY (`Users_idUsers`, `WorkingGroups_idWorkingGroups`),
  CONSTRAINT `fk_Users_has_WorkingGroups_Users`
    FOREIGN KEY (`Users_idUsers`)
    REFERENCES `BDD_SatisfEvent`.`Users` (`idUsers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Users_has_WorkingGroups_WorkingGroups1`
    FOREIGN KEY (`WorkingGroups_idWorkingGroups`)
    REFERENCES `BDD_SatisfEvent`.`WorkingGroups` (`idWorkingGroups`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Users_has_WorkingGroups_WorkingGroups1_idx` ON `BDD_SatisfEvent`.`Users_has_WorkingGroups` (`WorkingGroups_idWorkingGroups` ASC);

CREATE INDEX `fk_Users_has_WorkingGroups_Users_idx` ON `BDD_SatisfEvent`.`Users_has_WorkingGroups` (`Users_idUsers` ASC);


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`WorkingGroups_has_Events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`WorkingGroups_has_Events` (
  `WorkingGroups_idWorkingGroups` INT NOT NULL,
  `Events_idEvents` INT NOT NULL,
  PRIMARY KEY (`WorkingGroups_idWorkingGroups`, `Events_idEvents`),
  CONSTRAINT `fk_WorkingGroups_has_Events_WorkingGroups1`
    FOREIGN KEY (`WorkingGroups_idWorkingGroups`)
    REFERENCES `BDD_SatisfEvent`.`WorkingGroups` (`idWorkingGroups`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WorkingGroups_has_Events_Events1`
    FOREIGN KEY (`Events_idEvents`)
    REFERENCES `BDD_SatisfEvent`.`Events` (`idEvents`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_WorkingGroups_has_Events_Events1_idx` ON `BDD_SatisfEvent`.`WorkingGroups_has_Events` (`Events_idEvents` ASC);

CREATE INDEX `fk_WorkingGroups_has_Events_WorkingGroups1_idx` ON `BDD_SatisfEvent`.`WorkingGroups_has_Events` (`WorkingGroups_idWorkingGroups` ASC);


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`WorkingGroups_has_Statistics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`WorkingGroups_has_Statistics` (
  `WorkingGroups_idWorkingGroups` INT NOT NULL,
  `Statistics_idStatistics` INT NOT NULL,
  PRIMARY KEY (`WorkingGroups_idWorkingGroups`, `Statistics_idStatistics`),
  CONSTRAINT `fk_WorkingGroups_has_Statistics_WorkingGroups1`
    FOREIGN KEY (`WorkingGroups_idWorkingGroups`)
    REFERENCES `BDD_SatisfEvent`.`WorkingGroups` (`idWorkingGroups`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WorkingGroups_has_Statistics_Statistics1`
    FOREIGN KEY (`Statistics_idStatistics`)
    REFERENCES `BDD_SatisfEvent`.`Statistics` (`idStatistics`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_WorkingGroups_has_Statistics_Statistics1_idx` ON `BDD_SatisfEvent`.`WorkingGroups_has_Statistics` (`Statistics_idStatistics` ASC);

CREATE INDEX `fk_WorkingGroups_has_Statistics_WorkingGroups1_idx` ON `BDD_SatisfEvent`.`WorkingGroups_has_Statistics` (`WorkingGroups_idWorkingGroups` ASC);


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

