-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema tb_pwl18
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `tb_pwl18` ;

-- -----------------------------------------------------
-- Schema tb_pwl18
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tb_pwl18` DEFAULT CHARACTER SET utf8 ;
USE `tb_pwl18` ;

-- -----------------------------------------------------
-- Table `tb_pwl18`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_pwl18`.`role` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_pwl18`.`driver`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_pwl18`.`driver` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `approved` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_pwl18`.`seller`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_pwl18`.`seller` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NULL,
  `approved` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_pwl18`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_pwl18`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `roles_id` INT NOT NULL,
  `banned` TINYINT(1) NOT NULL,
  `driver_id` INT NULL,
  `seller_id` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `fk_user_roles_idx` (`roles_id` ASC),
  INDEX `fk_user_driver1_idx` (`driver_id` ASC),
  INDEX `fk_user_seller1_idx` (`seller_id` ASC),
  CONSTRAINT `fk_user_roles`
    FOREIGN KEY (`roles_id`)
    REFERENCES `tb_pwl18`.`role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_driver1`
    FOREIGN KEY (`driver_id`)
    REFERENCES `tb_pwl18`.`driver` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_seller1`
    FOREIGN KEY (`seller_id`)
    REFERENCES `tb_pwl18`.`seller` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_pwl18`.`item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_pwl18`.`item` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `price` DOUBLE NOT NULL,
  `seller_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_item_seller1_idx` (`seller_id` ASC),
  CONSTRAINT `fk_item_seller1`
    FOREIGN KEY (`seller_id`)
    REFERENCES `tb_pwl18`.`seller` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_pwl18`.`transactions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_pwl18`.`transactions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `distance_fee` DOUBLE NULL,
  `order_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pickup_date` DATETIME NULL,
  `finish_date` DATETIME NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_transaction_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_transaction_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `tb_pwl18`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_pwl18`.`transaction_detail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_pwl18`.`transaction_detail` (
  `transaction_id` INT NOT NULL,
  `item_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`transaction_id`, `item_id`),
  INDEX `fk_transaction_has_item_item1_idx` (`item_id` ASC),
  INDEX `fk_transaction_has_item_transaction1_idx` (`transaction_id` ASC),
  CONSTRAINT `fk_transaction_has_item_transaction1`
    FOREIGN KEY (`transaction_id`)
    REFERENCES `tb_pwl18`.`transactions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaction_has_item_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `tb_pwl18`.`item` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tb_pwl18`.`deliveries`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_pwl18`.`deliveries` (
  `driver_id` INT NOT NULL,
  `transaction_id` INT NOT NULL,
  PRIMARY KEY (`driver_id`, `transaction_id`),
  INDEX `fk_driver_has_transaction_transaction1_idx` (`transaction_id` ASC),
  INDEX `fk_driver_has_transaction_driver1_idx` (`driver_id` ASC),
  CONSTRAINT `fk_driver_has_transaction_driver1`
    FOREIGN KEY (`driver_id`)
    REFERENCES `tb_pwl18`.`driver` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_driver_has_transaction_transaction1`
    FOREIGN KEY (`transaction_id`)
    REFERENCES `tb_pwl18`.`transactions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `tb_pwl18`.`role`
-- -----------------------------------------------------
START TRANSACTION;
USE `tb_pwl18`;
INSERT INTO `tb_pwl18`.`role` (`id`, `name`) VALUES (1, 'Admin');
INSERT INTO `tb_pwl18`.`role` (`id`, `name`) VALUES (2, 'Seller');
INSERT INTO `tb_pwl18`.`role` (`id`, `name`) VALUES (3, 'Driver');
INSERT INTO `tb_pwl18`.`role` (`id`, `name`) VALUES (4, 'Buyer');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tb_pwl18`.`driver`
-- -----------------------------------------------------
START TRANSACTION;
USE `tb_pwl18`;
INSERT INTO `tb_pwl18`.`driver` (`id`, `approved`) VALUES (1, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `tb_pwl18`.`seller`
-- -----------------------------------------------------
START TRANSACTION;
USE `tb_pwl18`;
INSERT INTO `tb_pwl18`.`seller` (`id`, `name`, `address`, `approved`) VALUES (1, 'Lampar Cafe', 'Jalan Ciateul No. 81', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `tb_pwl18`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `tb_pwl18`;
INSERT INTO `tb_pwl18`.`users` (`id`, `username`, `password`, `email`, `name`, `roles_id`, `banned`, `driver_id`, `seller_id`) VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@catering.com', 'Admin Tjakep', 1, 0, NULL, NULL);
INSERT INTO `tb_pwl18`.`users` (`id`, `username`, `password`, `email`, `name`, `roles_id`, `banned`, `driver_id`, `seller_id`) VALUES (2, 'buyer', '21232f297a57a5a743894a0e4a801fc3', 'buyer@catering.com', 'Buyer Tjakep', 4, 0, NULL, NULL);
INSERT INTO `tb_pwl18`.`users` (`id`, `username`, `password`, `email`, `name`, `roles_id`, `banned`, `driver_id`, `seller_id`) VALUES (3, 'seler', '21232f297a57a5a743894a0e4a801fc3', 'seler@catering.com', 'Seler Tjakep', 2, 0, NULL, 1);
INSERT INTO `tb_pwl18`.`users` (`id`, `username`, `password`, `email`, `name`, `roles_id`, `banned`, `driver_id`, `seller_id`) VALUES (4, 'driver', '21232f297a57a5a743894a0e4a801fc3', 'driver@catering.com', 'Driver Tjakep', 3, 0, 1, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `tb_pwl18`.`item`
-- -----------------------------------------------------
START TRANSACTION;
USE `tb_pwl18`;
INSERT INTO `tb_pwl18`.`item` (`id`, `name`, `price`, `seller_id`) VALUES (111, 'Nasi Goreng Special', 24000, 1);
INSERT INTO `tb_pwl18`.`item` (`id`, `name`, `price`, `seller_id`) VALUES (112, 'Sapo Tahu', 18000, 1);
INSERT INTO `tb_pwl18`.`item` (`id`, `name`, `price`, `seller_id`) VALUES (113, 'Ayam Goreng Taliwang', 20000, 1);
INSERT INTO `tb_pwl18`.`item` (`id`, `name`, `price`, `seller_id`) VALUES (114, 'Sate Kambing', 45000, 1);
INSERT INTO `tb_pwl18`.`item` (`id`, `name`, `price`, `seller_id`) VALUES (221, 'Chicken Cordon Blue', 35000, 1);
INSERT INTO `tb_pwl18`.`item` (`id`, `name`, `price`, `seller_id`) VALUES (222, 'Chicken Snitzle', 29000, 1);
INSERT INTO `tb_pwl18`.`item` (`id`, `name`, `price`, `seller_id`) VALUES (223, 'Fish And Chips', 32000, 1);
INSERT INTO `tb_pwl18`.`item` (`id`, `name`, `price`, `seller_id`) VALUES (224, 'Burger Spicy', 35000, 1);
INSERT INTO `tb_pwl18`.`item` (`id`, `name`, `price`, `seller_id`) VALUES (331, 'Pizza American Suprime', 50000, 1);
INSERT INTO `tb_pwl18`.`item` (`id`, `name`, `price`, `seller_id`) VALUES (332, 'Beef Lada Hitam', 50000, 1);
INSERT INTO `tb_pwl18`.`item` (`id`, `name`, `price`, `seller_id`) VALUES (333, 'Es Campur Special', 20000, 1);
INSERT INTO `tb_pwl18`.`item` (`id`, `name`, `price`, `seller_id`) VALUES (334, 'Dorayaki ', 17000, 1);

COMMIT;

