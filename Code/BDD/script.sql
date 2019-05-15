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
-- Table `BDD_SatisfEvent`.`Ecoles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`Ecoles` (
  `idEcoles` INT NOT NULL,
  `Nom` VARCHAR(10) NULL,
  PRIMARY KEY (`idEcoles`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`Utilisateurs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`Utilisateurs` (
  `idUtilisateurs` INT NOT NULL AUTO_INCREMENT,
  `Prenom` VARCHAR(45) NULL,
  `Nom` VARCHAR(45) NULL,
  `Email` VARCHAR(45) NULL,
  `MotDePasse` VARCHAR(45) NULL,
  `Admin` TINYINT(1) NULL,
  `Ecoles_idEcoles` INT NOT NULL,
  PRIMARY KEY (`idUtilisateurs`),
  CONSTRAINT `fk_Utilisateurs_Ecoles1`
    FOREIGN KEY (`Ecoles_idEcoles`)
    REFERENCES `BDD_SatisfEvent`.`Ecoles` (`idEcoles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Utilisateurs_Ecoles1_idx` ON `BDD_SatisfEvent`.`Utilisateurs` (`Ecoles_idEcoles` ASC);


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`Ateliers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`Ateliers` (
  `idAteliers` INT NOT NULL,
  `Nom` VARCHAR(45) NULL,
  `Coût` INT NULL,
  PRIMARY KEY (`idAteliers`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`Statistiques`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`Statistiques` (
  `idStatistiques` INT NOT NULL,
  `Supports` TINYINT NULL,
  `Animation` TINYINT NULL,
  `Lieu` TINYINT NULL,
  `Horaires` TINYINT NULL,
  `Satisfaction` TINYINT NULL,
  PRIMARY KEY (`idStatistiques`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`Evenements`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`Evenements` (
  `idEvenements` INT NOT NULL,
  `Nom` VARCHAR(45) NULL,
  `Date` DATE NULL,
  PRIMARY KEY (`idEvenements`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`Utilisateurs_has_Ateliers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`Utilisateurs_has_Ateliers` (
  `Utilisateurs_idUtilisateurs` INT NOT NULL,
  `Ateliers_idAteliers` INT NOT NULL,
  PRIMARY KEY (`Utilisateurs_idUtilisateurs`, `Ateliers_idAteliers`),
  CONSTRAINT `fk_Utilisateurs_has_Ateliers_Utilisateurs`
    FOREIGN KEY (`Utilisateurs_idUtilisateurs`)
    REFERENCES `BDD_SatisfEvent`.`Utilisateurs` (`idUtilisateurs`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Utilisateurs_has_Ateliers_Ateliers1`
    FOREIGN KEY (`Ateliers_idAteliers`)
    REFERENCES `BDD_SatisfEvent`.`Ateliers` (`idAteliers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Utilisateurs_has_Ateliers_Ateliers1_idx` ON `BDD_SatisfEvent`.`Utilisateurs_has_Ateliers` (`Ateliers_idAteliers` ASC);

CREATE INDEX `fk_Utilisateurs_has_Ateliers_Utilisateurs_idx` ON `BDD_SatisfEvent`.`Utilisateurs_has_Ateliers` (`Utilisateurs_idUtilisateurs` ASC);


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`Ateliers_has_Evenements`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`Ateliers_has_Evenements` (
  `Ateliers_idAteliers` INT NOT NULL,
  `Evenements_idEvenements` INT NOT NULL,
  PRIMARY KEY (`Ateliers_idAteliers`, `Evenements_idEvenements`),
  CONSTRAINT `fk_Ateliers_has_Evenements_Ateliers1`
    FOREIGN KEY (`Ateliers_idAteliers`)
    REFERENCES `BDD_SatisfEvent`.`Ateliers` (`idAteliers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ateliers_has_Evenements_Evenements1`
    FOREIGN KEY (`Evenements_idEvenements`)
    REFERENCES `BDD_SatisfEvent`.`Evenements` (`idEvenements`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Ateliers_has_Evenements_Evenements1_idx` ON `BDD_SatisfEvent`.`Ateliers_has_Evenements` (`Evenements_idEvenements` ASC);

CREATE INDEX `fk_Ateliers_has_Evenements_Ateliers1_idx` ON `BDD_SatisfEvent`.`Ateliers_has_Evenements` (`Ateliers_idAteliers` ASC);


-- -----------------------------------------------------
-- Table `BDD_SatisfEvent`.`Ateliers_has_Statistiques`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDD_SatisfEvent`.`Ateliers_has_Statistiques` (
  `Ateliers_idAteliers` INT NOT NULL,
  `Statistiques_idStatistiques` INT NOT NULL,
  PRIMARY KEY (`Ateliers_idAteliers`, `Statistiques_idStatistiques`),
  CONSTRAINT `fk_Ateliers_has_Statistiques_Ateliers1`
    FOREIGN KEY (`Ateliers_idAteliers`)
    REFERENCES `BDD_SatisfEvent`.`Ateliers` (`idAteliers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ateliers_has_Statistiques_Statistiques1`
    FOREIGN KEY (`Statistiques_idStatistiques`)
    REFERENCES `BDD_SatisfEvent`.`Statistiques` (`idStatistiques`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Ateliers_has_Statistiques_Statistiques1_idx` ON `BDD_SatisfEvent`.`Ateliers_has_Statistiques` (`Statistiques_idStatistiques` ASC);

CREATE INDEX `fk_Ateliers_has_Statistiques_Ateliers1_idx` ON `BDD_SatisfEvent`.`Ateliers_has_Statistiques` (`Ateliers_idAteliers` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `Ecoles` VALUES
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
