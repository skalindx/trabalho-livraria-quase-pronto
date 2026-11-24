-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema livraria-main
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema livraria-main
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `livraria-main` DEFAULT CHARACTER SET utf8 ;
USE `livraria-main` ;

-- -----------------------------------------------------
-- Table `livraria-main`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livraria-main`.`categoria` (
  `id_autor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `id_categoria` INT NULL,
  `nome_categoria` VARCHAR(45) NULL,
  `descricao` VARCHAR(45) NULL,
  PRIMARY KEY (`id_autor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livraria-main`.`livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livraria-main`.`livro` (
  `id_livro` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL,
  `editora` VARCHAR(45) NULL,
  `ano_publicado` VARCHAR(45) NULL,
  `quant_disponivel` VARCHAR(45) NULL,
  `categoria_id_autor` INT NOT NULL,
  PRIMARY KEY (`id_livro`),
  INDEX `fk_livro_categoria1_idx` (`categoria_id_autor` ASC) VISIBLE,
  CONSTRAINT `fk_livro_categoria1`
    FOREIGN KEY (`categoria_id_autor`)
    REFERENCES `livraria-main`.`categoria` (`id_autor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livraria-main`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livraria-main`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `cpf` VARCHAR(45) NULL,
  `telefone` VARCHAR(45) NULL,
  `endereco` VARCHAR(45) NULL,
  `senha` VARCHAR(45) NULL,
  `tipo_usuario` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livraria-main`.`autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livraria-main`.`autor` (
  `id_autor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `nacionalidade` VARCHAR(45) NULL,
  `idade` INT NULL,
  PRIMARY KEY (`id_autor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livraria-main`.`reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livraria-main`.`reserva` (
  `id_reserva` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NULL,
  `id_livro` INT NULL,
  `data_reserva` DATE NULL,
  `usuario_id_usuario` INT NOT NULL,
  `livro_id_livro` INT NOT NULL,
  PRIMARY KEY (`id_reserva`),
  INDEX `fk_reserva_usuario_idx` (`usuario_id_usuario` ASC) VISIBLE,
  INDEX `fk_reserva_livro1_idx` (`livro_id_livro` ASC) VISIBLE,
  CONSTRAINT `fk_reserva_usuario`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `livraria-main`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_livro1`
    FOREIGN KEY (`livro_id_livro`)
    REFERENCES `livraria-main`.`livro` (`id_livro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livraria-main`.`autor_has_livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livraria-main`.`autor_has_livro` (
  `autor_id_autor` INT NOT NULL,
  `livro_id_livro` INT NOT NULL,
  PRIMARY KEY (`autor_id_autor`, `livro_id_livro`),
  INDEX `fk_autor_has_livro_livro1_idx` (`livro_id_livro` ASC) VISIBLE,
  INDEX `fk_autor_has_livro_autor1_idx` (`autor_id_autor` ASC) VISIBLE,
  CONSTRAINT `fk_autor_has_livro_autor1`
    FOREIGN KEY (`autor_id_autor`)
    REFERENCES `livraria-main`.`autor` (`id_autor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_autor_has_livro_livro1`
    FOREIGN KEY (`livro_id_livro`)
    REFERENCES `livraria-main`.`livro` (`id_livro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
