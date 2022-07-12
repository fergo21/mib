-- MySQL Workbench Synchronization
-- Generated: 2021-11-09 18:33
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Fer

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `mib_db` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `mib_db`.`schools` (
  `idschools` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idschools`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`courses` (
  `idcourses` INT(11) NOT NULL AUTO_INCREMENT,
  `division` VARCHAR(45) NULL DEFAULT NULL,
  `shift` VARCHAR(45) NULL DEFAULT NULL,
  `year` VARCHAR(4) NULL DEFAULT NULL,
  `number_students` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idcourses`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`students` (
  `idstudents` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NULL DEFAULT NULL,
  `school_courses_idschool_courses` INT(11) NOT NULL,
  PRIMARY KEY (`idstudents`),
  INDEX `fk_students_school_courses1_idx` (`school_courses_idschool_courses` ASC) VISIBLE,
  CONSTRAINT `fk_students_school_courses1`
    FOREIGN KEY (`school_courses_idschool_courses`)
    REFERENCES `mib_db`.`school_courses` (`idschool_courses`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`products` (
  `idproducts` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idproducts`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`tickets` (
  `idtickets` INT(11) NOT NULL AUTO_INCREMENT,
  `code` INT(11) NOT NULL,
  `date` DATETIME NOT NULL,
  `orders_idorders` INT(11) NOT NULL,
  `ticket_details_iddetails` INT(11) NOT NULL,
  PRIMARY KEY (`idtickets`),
  INDEX `fk_tickets_orders1_idx` (`orders_idorders` ASC) VISIBLE,
  INDEX `fk_tickets_ticket_details1_idx` (`ticket_details_iddetails` ASC) VISIBLE,
  CONSTRAINT `fk_tickets_orders1`
    FOREIGN KEY (`orders_idorders`)
    REFERENCES `mib_db`.`orders` (`idorders`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tickets_ticket_details1`
    FOREIGN KEY (`ticket_details_iddetails`)
    REFERENCES `mib_db`.`ticket_details` (`iddetails`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`ticket_details` (
  `iddetails` INT(11) NOT NULL AUTO_INCREMENT,
  `quantity` INT(11) NOT NULL,
  `price` DECIMAL NOT NULL,
  `advance_payment` DECIMAL NULL DEFAULT NULL,
  PRIMARY KEY (`iddetails`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`orders` (
  `idorders` INT(11) NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `form_payment` VARCHAR(45) NOT NULL,
  `description` LONGTEXT NULL DEFAULT NULL,
  `date_delivery` DATETIME NOT NULL,
  `total_amount` DECIMAL NULL DEFAULT NULL,
  `dues` INT(11) NULL DEFAULT NULL,
  `status` VARCHAR(45) NULL DEFAULT NULL,
  `students_idstudents` INT(11) NOT NULL,
  `users_idusers` INT(11) NOT NULL,
  `combo_products_idcombo_products` INT(11) NOT NULL,
  PRIMARY KEY (`idorders`),
  INDEX `fk_orders_students1_idx` (`students_idstudents` ASC) VISIBLE,
  INDEX `fk_orders_users1_idx` (`users_idusers` ASC) VISIBLE,
  INDEX `fk_orders_combo_products1_idx` (`combo_products_idcombo_products` ASC) VISIBLE,
  CONSTRAINT `fk_orders_students1`
    FOREIGN KEY (`students_idstudents`)
    REFERENCES `mib_db`.`students` (`idstudents`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_users1`
    FOREIGN KEY (`users_idusers`)
    REFERENCES `mib_db`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_combo_products1`
    FOREIGN KEY (`combo_products_idcombo_products`)
    REFERENCES `mib_db`.`combo_products` (`idcombo_products`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`expenses` (
  `idexpenses` INT(11) NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `amount` DECIMAL NOT NULL,
  `type_expenses_idtype_expenses` INT(11) NOT NULL,
  PRIMARY KEY (`idexpenses`),
  INDEX `fk_expenses_type_expenses1_idx` (`type_expenses_idtype_expenses` ASC) VISIBLE,
  CONSTRAINT `fk_expenses_type_expenses1`
    FOREIGN KEY (`type_expenses_idtype_expenses`)
    REFERENCES `mib_db`.`type_expenses` (`idtype_expenses`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`type_expenses` (
  `idtype_expenses` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`idtype_expenses`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`users` (
  `idusers` INT(11) NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  `roles_idroles` INT(11) NOT NULL,
  PRIMARY KEY (`idusers`),
  INDEX `fk_users_roles_idx` (`roles_idroles` ASC) VISIBLE,
  CONSTRAINT `fk_users_roles`
    FOREIGN KEY (`roles_idroles`)
    REFERENCES `mib_db`.`roles` (`idroles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`roles` (
  `idroles` INT(11) NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idroles`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`combo` (
  `idcombo` INT(11) NOT NULL AUTO_INCREMENT,
  `number_combo` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idcombo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`providers` (
  `idproviders` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NULL DEFAULT NULL,
  `address` VARCHAR(100) NULL DEFAULT NULL,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idproviders`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`combo_products` (
  `idcombo_products` INT(11) NOT NULL AUTO_INCREMENT,
  `combo_idcombo` INT(11) NOT NULL,
  `products_idproducts` INT(11) NOT NULL,
  PRIMARY KEY (`idcombo_products`),
  INDEX `fk_combo_products_combo1_idx` (`combo_idcombo` ASC) VISIBLE,
  INDEX `fk_combo_products_products1_idx` (`products_idproducts` ASC) VISIBLE,
  CONSTRAINT `fk_combo_products_combo1`
    FOREIGN KEY (`combo_idcombo`)
    REFERENCES `mib_db`.`combo` (`idcombo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_combo_products_products1`
    FOREIGN KEY (`products_idproducts`)
    REFERENCES `mib_db`.`products` (`idproducts`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mib_db`.`school_courses` (
  `idschool_courses` INT(11) NOT NULL AUTO_INCREMENT,
  `schools_idschools` INT(11) NOT NULL,
  `courses_idcourses` INT(11) NOT NULL,
  PRIMARY KEY (`idschool_courses`),
  INDEX `fk_school_courses_schools1_idx` (`schools_idschools` ASC) VISIBLE,
  INDEX `fk_school_courses_courses1_idx` (`courses_idcourses` ASC) VISIBLE,
  CONSTRAINT `fk_school_courses_schools1`
    FOREIGN KEY (`schools_idschools`)
    REFERENCES `mib_db`.`schools` (`idschools`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_school_courses_courses1`
    FOREIGN KEY (`courses_idcourses`)
    REFERENCES `mib_db`.`courses` (`idcourses`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
