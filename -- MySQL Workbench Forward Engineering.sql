-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema kp_mona
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema kp_mona
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `kp_mona` DEFAULT CHARACTER SET utf8 ;
USE `kp_mona` ;

-- -----------------------------------------------------
-- Table `kp_mona`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kp_mona`.`role` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name_role` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_role_UNIQUE` (`name_role` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kp_mona`.`rt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kp_mona`.`rt` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama_rt` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nama_rt_UNIQUE` (`nama_rt` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kp_mona`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kp_mona`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama_warga` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `role_id` INT NOT NULL,
  `no_tlp` VARCHAR(16) NOT NULL,
  `email` VARCHAR(60) NOT NULL,
  `alamat` VARCHAR(100) NOT NULL,
  `rt_id` INT NOT NULL,
  `nik` VARCHAR(16) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `fk_users_role_idx` (`role_id` ASC),
  INDEX `fk_users_rt1_idx` (`rt_id` ASC),
  CONSTRAINT `fk_users_role`
    FOREIGN KEY (`role_id`)
    REFERENCES `kp_mona`.`role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_rt1`
    FOREIGN KEY (`rt_id`)
    REFERENCES `kp_mona`.`rt` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kp_mona`.`pengaduan_kategori`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kp_mona`.`pengaduan_kategori` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `kategori` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nama_rt_UNIQUE` (`kategori` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kp_mona`.`pengaduan_header`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kp_mona`.`pengaduan_header` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `subject` VARCHAR(45) NOT NULL,
  `nomor_pengaduan` VARCHAR(45) NOT NULL,
  `pengaduan_kategori_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nomor_pengaduan_UNIQUE` (`nomor_pengaduan` ASC),
  INDEX `fk_pengaduan_header_pengaduan_kategori1_idx` (`pengaduan_kategori_id` ASC),
  CONSTRAINT `fk_pengaduan_header_pengaduan_kategori1`
    FOREIGN KEY (`pengaduan_kategori_id`)
    REFERENCES `kp_mona`.`pengaduan_kategori` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kp_mona`.`pengaduan_status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kp_mona`.`pengaduan_status` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `status_UNIQUE` (`status` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kp_mona`.`pengaduan_detail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kp_mona`.`pengaduan_detail` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `detail_pengaduan` TEXT NOT NULL,
  `tgl` DATETIME NOT NULL,
  `pengaduan_header_id` INT NOT NULL,
  `pengaduan_status_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pengaduan_detail_pengaduan_header1_idx` (`pengaduan_header_id` ASC),
  INDEX `fk_pengaduan_detail_pengaduan_status1_idx` (`pengaduan_status_id` ASC),
  INDEX `fk_pengaduan_detail_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_pengaduan_detail_pengaduan_header1`
    FOREIGN KEY (`pengaduan_header_id`)
    REFERENCES `kp_mona`.`pengaduan_header` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pengaduan_detail_pengaduan_status1`
    FOREIGN KEY (`pengaduan_status_id`)
    REFERENCES `kp_mona`.`pengaduan_status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pengaduan_detail_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `kp_mona`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kp_mona`.`pengaduan_foto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kp_mona`.`pengaduan_foto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama_file` VARCHAR(45) NOT NULL,
  `pengaduan_detail_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pengaduan_foto_pengaduan_detail1_idx` (`pengaduan_detail_id` ASC),
  CONSTRAINT `fk_pengaduan_foto_pengaduan_detail1`
    FOREIGN KEY (`pengaduan_detail_id`)
    REFERENCES `kp_mona`.`pengaduan_detail` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kp_mona`.`komentar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kp_mona`.`komentar` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `isi_komentar` TEXT NOT NULL,
  `users_id` INT NOT NULL,
  `pengaduan_detail_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_komentar_users1_idx` (`users_id` ASC),
  INDEX `fk_komentar_pengaduan_detail1_idx` (`pengaduan_detail_id` ASC),
  CONSTRAINT `fk_komentar_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `kp_mona`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_komentar_pengaduan_detail1`
    FOREIGN KEY (`pengaduan_detail_id`)
    REFERENCES `kp_mona`.`pengaduan_detail` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `kp_mona`.`role`
-- -----------------------------------------------------
START TRANSACTION;
USE `kp_mona`;
INSERT INTO `kp_mona`.`role` (`id`, `name_role`) VALUES (1, 'Warga');
INSERT INTO `kp_mona`.`role` (`id`, `name_role`) VALUES (2, 'Ketua RT');
INSERT INTO `kp_mona`.`role` (`id`, `name_role`) VALUES (3, 'Ketua RW');
INSERT INTO `kp_mona`.`role` (`id`, `name_role`) VALUES (4, 'Petugas');

COMMIT;


-- -----------------------------------------------------
-- Data for table `kp_mona`.`rt`
-- -----------------------------------------------------
START TRANSACTION;
USE `kp_mona`;
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (001, 'H. Nahrawi');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (002, 'Tri Agus Setiawan');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (003, 'Sarudin Akmal');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (004, 'Mohammad Arifin');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (005, 'Mustika Indah Cahyani');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (006, 'Sri Wahyuningsih');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (007, 'Abdul Rohim');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (008, 'Ahmad Zainudin');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (009, 'Lukmanul Hakim');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (010, 'Madina Idris');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (011, 'Yasin Gunawan');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (012, 'Muhasan Muhammad Nur');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (013, 'Bilal Jibriliant Aljabbar');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (014, 'Nisun Masan');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (015, 'Hamdani M. Nawi');
INSERT INTO `kp_mona`.`rt` (`id`, `nama_rt`) VALUES (016, 'Dede Arohman');

COMMIT;


-- -----------------------------------------------------
-- Data for table `kp_mona`.`pengaduan_kategori`
-- -----------------------------------------------------
START TRANSACTION;
USE `kp_mona`;
INSERT INTO `kp_mona`.`pengaduan_kategori` (`id`, `kategori`) VALUES (1, 'Kebersihan');
INSERT INTO `kp_mona`.`pengaduan_kategori` (`id`, `kategori`) VALUES (2, 'Keamanan');
INSERT INTO `kp_mona`.`pengaduan_kategori` (`id`, `kategori`) VALUES (3, 'Lingkungan');

COMMIT;


-- -----------------------------------------------------
-- Data for table `kp_mona`.`pengaduan_status`
-- -----------------------------------------------------
START TRANSACTION;
USE `kp_mona`;
INSERT INTO `kp_mona`.`pengaduan_status` (`id`, `status`) VALUES (10, 'New');
INSERT INTO `kp_mona`.`pengaduan_status` (`id`, `status`) VALUES (20, 'On Progress');
INSERT INTO `kp_mona`.`pengaduan_status` (`id`, `status`) VALUES (30, 'Done');
INSERT INTO `kp_mona`.`pengaduan_status` (`id`, `status`) VALUES (40, 'Cancel');

COMMIT;

