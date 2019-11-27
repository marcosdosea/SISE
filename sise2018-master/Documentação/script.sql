-- MySQL Script generated by MySQL Workbench
-- qua 24 jan 2018 16:24:42 -03
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema itatechj_sise_sandbox
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema itatechj_sise_sandbox
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `siselocalhost` DEFAULT CHARACTER SET utf8 ;
USE `siselocalhost` ;

-- -----------------------------------------------------
-- Table `tb_estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_estado` (
  `id_estado` INT(11) NOT NULL,
  `sigla_estado` VARCHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NOT NULL,
  `nome_estado` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NOT NULL,
  PRIMARY KEY (`id_estado`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_lithuanian_ci;


-- -----------------------------------------------------
-- Table `tb_cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_cidade` (
  `id_cidade` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_cidade` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NOT NULL,
  `id_estado` INT(11) NOT NULL,
  `tb_estado_id_estado` INT(11) NOT NULL,
  PRIMARY KEY (`id_cidade`),
  INDEX `fk_tb_cidade_tb_estado1_idx` (`id_estado` ASC),
  INDEX `fk_tb_cidade_tb_estado1_idx1` (`tb_estado_id_estado` ASC),
  CONSTRAINT `fk_tb_cidade_tb_estado1`
    FOREIGN KEY (`tb_estado_id_estado`)
    REFERENCES `tb_estado` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5508
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_lithuanian_ci;


-- -----------------------------------------------------
-- Table `tb_endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_endereco` (
  `id_endereco` INT(11) NOT NULL AUTO_INCREMENT,
  `logradouro_endereco` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  `numero_endereco` INT(11) NULL DEFAULT NULL,
  `bairro_endereco` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  `id_cidade` INT(11) NULL DEFAULT NULL,
  `cep_endereco` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  PRIMARY KEY (`id_endereco`),
  INDEX `fk_tb_endereco_tb_cidade1_idx` (`id_cidade` ASC),
  CONSTRAINT `fk_tb_endereco_tb_cidade1`
    FOREIGN KEY (`id_cidade`)
    REFERENCES `tb_cidade` (`id_cidade`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_lithuanian_ci;


-- -----------------------------------------------------
-- Table `tb_evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_evento` (
  `id_evento` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_evento` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NOT NULL,
  `sigla_evento` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  `descricao_evento` VARCHAR(5000) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  `inicio_inscricoes_evento` DATETIME NULL DEFAULT NULL,
  `fim_inscricoes_evento` DATETIME NULL DEFAULT NULL,
  `data_inicio_evento` DATETIME NULL DEFAULT NULL,
  `data_fim_evento` DATETIME NULL DEFAULT NULL,
  `id_endereco` INT(11) NULL DEFAULT NULL,
  `id_evento_pai` INT(11) NULL DEFAULT NULL,
  `url_imagem_evento` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  `valor_evento` FLOAT NOT NULL,
  `qntd_parcelas_permitida_evento` INT(11) NULL DEFAULT NULL,
  `part_min_evento` INT(11) NULL DEFAULT NULL,
  `ativo_evento` ENUM('s', 'n') CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NOT NULL,
  `vagas` INT(11) NOT NULL,
  `vagas_restantes` INT(11) NOT NULL,
  PRIMARY KEY (`id_evento`),
  INDEX `fk_tb_evento_tb_endereco1_idx` (`id_endereco` ASC),
  INDEX `fk_tb_evento_tb_evento1_idx` (`id_evento_pai` ASC),
  CONSTRAINT `fk_tb_evento_tb_endereco1`
    FOREIGN KEY (`id_endereco`)
    REFERENCES `tb_endereco` (`id_endereco`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 43
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_lithuanian_ci;


-- -----------------------------------------------------
-- Table `tb_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` VARCHAR(60) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NOT NULL,
  `cpf_usuario` VARCHAR(11) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NOT NULL,
  `email_usuario` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NOT NULL,
  `senha_usuario` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NOT NULL,
  `id_asaas_usuario` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  `tipo_usuario` ENUM('OUVINTE', 'ORGANIZADOR', 'ADMIN', 'ROOTER') CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 74
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_lithuanian_ci;


-- -----------------------------------------------------
-- Table `tb_admin_evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_admin_evento` (
  `id_usuario` INT(11) NOT NULL,
  `id_evento` INT(11) NOT NULL,
  PRIMARY KEY (`id_usuario`, `id_evento`),
  INDEX `fk_tb_usuario_has_tb_evento_tb_usuario1_idx` (`id_usuario` ASC),
  INDEX `fk_tb_admin_evento_tb_evento1_idx` (`id_evento` ASC),
  CONSTRAINT `fk_tb_admin_evento_tb_evento1`
    FOREIGN KEY (`id_evento`)
    REFERENCES `tb_evento` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_usuario_has_tb_evento_tb_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_lithuanian_ci;


-- -----------------------------------------------------
-- Table `tb_certificado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_certificado` (
  `id_certificado` INT(11) NOT NULL AUTO_INCREMENT,
  `ch_certificado` INT(11) NOT NULL,
  `status_certificado` TINYINT(1) NOT NULL,
  `url_imagem_certificado` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  `tipo_certificado` ENUM('1', '2', '3') CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NOT NULL,
  `id_evento` INT(11) NOT NULL,
  PRIMARY KEY (`id_certificado`),
  UNIQUE INDEX `id_certificado_UNIQUE` (`id_certificado` ASC),
  INDEX `fk_tb_certificado_tb_evento1_idx` (`id_evento` ASC),
  CONSTRAINT `fk_tb_certificado_tb_evento1`
    FOREIGN KEY (`id_evento`)
    REFERENCES `tb_evento` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_lithuanian_ci;


-- -----------------------------------------------------
-- Table `tb_frequencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_frequencia` (
  `data_hora_frequencia` DATETIME NULL DEFAULT NULL,
  `id_evento_frequencia` INT(11) NOT NULL,
  `id_usuario_frequencia` INT(11) NOT NULL,
  INDEX `fk_tb_frequencia_tb_usuario1_idx` (`id_usuario_frequencia` ASC),
  INDEX `fk_tb_frequencia_tb_evento1_idx` (`id_evento_frequencia` ASC),
  CONSTRAINT `fk_tb_frequencia_tb_usuario1`
    FOREIGN KEY (`id_usuario_frequencia`)
    REFERENCES `tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_frequencia_tb_evento1`
    FOREIGN KEY (`id_evento_frequencia`)
    REFERENCES `tb_evento` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_lithuanian_ci;


-- -----------------------------------------------------
-- Table `tb_info_frequencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_info_frequencia` (
  `id_info_frequencia` INT(11) NOT NULL AUTO_INCREMENT,
  `dia_info_frequencia` DATE NOT NULL,
  `quant_info_frequencia` INT(11) NOT NULL,
  `tb_evento_id_evento` INT(11) NOT NULL,
  PRIMARY KEY (`id_info_frequencia`),
  INDEX `fk_tb_info_frequencia_tb_evento1_idx` (`tb_evento_id_evento` ASC),
  CONSTRAINT `fk_tb_info_frequencia_tb_evento1`
    FOREIGN KEY (`tb_evento_id_evento`)
    REFERENCES `tb_evento` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_lithuanian_ci;


-- -----------------------------------------------------
-- Table `tb_inscricao_evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_inscricao_evento` (
  `tb_usuario_id_usuario` INT(11) NOT NULL,
  `tb_evento_id_evento` INT(11) NOT NULL,
  `data_hora_inscricao_evento` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`tb_usuario_id_usuario`, `tb_evento_id_evento`),
  INDEX `fk_tb_usuario_has_tb_evento_tb_usuario_idx` (`tb_usuario_id_usuario` ASC),
  CONSTRAINT `fk_tb_usuario_has_tb_evento_tb_usuario`
    FOREIGN KEY (`tb_usuario_id_usuario`)
    REFERENCES `tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_lithuanian_ci;


-- -----------------------------------------------------
-- Table `tb_pagamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_pagamento` (
  `id_pagamento` INT(11) NOT NULL AUTO_INCREMENT,
  `valor_pagamento` DOUBLE NULL DEFAULT NULL,
  `quantidade_parcelas_pagamento` INT(11) NULL DEFAULT NULL,
  `status_pagamento` CHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  `id_usuario` INT(11) NOT NULL,
  `id_evento` INT(11) NOT NULL,
  `tipo_pagamento` CHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  PRIMARY KEY (`id_pagamento`),
  INDEX `fk_tb_pagamento_tb_inscricao_evento1_idx` (`id_usuario` ASC, `id_evento` ASC),
  CONSTRAINT `fk_tb_pagamento_tb_inscricao_evento1`
    FOREIGN KEY (`id_usuario` , `id_evento`)
    REFERENCES `tb_inscricao_evento` (`tb_usuario_id_usuario` , `tb_evento_id_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 77
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_lithuanian_ci;


-- -----------------------------------------------------
-- Table `tb_parcela`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_parcela` (
  `id_parcela` INT(11) NOT NULL AUTO_INCREMENT,
  `valor_parcela` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  `vencimento_parcela` DOUBLE NULL DEFAULT NULL,
  `status_parcela` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  `referencia_parcela` VARCHAR(45) CHARACTER SET 'big5' NULL DEFAULT NULL COMMENT 'Valor que referência se é a 1º, 2º, 3º parcerla de um pagamento.',
  `id_pagamento` INT(11) NOT NULL,
  `id_parcela_asaas` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NULL DEFAULT NULL,
  PRIMARY KEY (`id_parcela`),
  INDEX `fk_tb_parcela_tb_pagamento1_idx` (`id_pagamento` ASC),
  CONSTRAINT `fk_tb_parcela_tb_pagamento1`
    FOREIGN KEY (`id_pagamento`)
    REFERENCES `tb_pagamento` (`id_pagamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 74
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_lithuanian_ci;


-- -----------------------------------------------------
-- Table `tb_recuperar_senha`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_recuperar_senha` (
  `id_recuperar_senha` INT(11) NOT NULL AUTO_INCREMENT,
  `token` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NOT NULL,
  `data_requisicao` DATETIME NOT NULL,
  `data_validade` DATETIME NOT NULL,
  `utilizado` ENUM('S', 'N') CHARACTER SET 'utf8' COLLATE 'utf8_lithuanian_ci' NOT NULL,
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_recuperar_senha`),
  INDEX `fk_tb_recuperar_senha_tb_usuario1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_tb_recuperar_senha_tb_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_lithuanian_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
