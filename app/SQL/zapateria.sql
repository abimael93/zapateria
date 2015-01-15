SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `zapateria` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `zapateria` ;

-- -----------------------------------------------------
-- Table `zapateria`.`departamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`departamento` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`departamento` (
  `id_departamento` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  PRIMARY KEY (`id_departamento`) ,
  UNIQUE INDEX `id departamento_UNIQUE` (`id_departamento` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`cargo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`cargo` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`cargo` (
  `id_cargo` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(30) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_cargo`) ,
  UNIQUE INDEX `id_cargo_UNIQUE` (`id_cargo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`pais` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`pais` (
  `id_pais` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_pais`) ,
  UNIQUE INDEX `id_pais_UNIQUE` (`id_pais` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`estado` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`estado` (
  `id_estado` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `abrev` VARCHAR(20) NOT NULL ,
  `id_pais` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_estado`) ,
  UNIQUE INDEX `idmunicipio_UNIQUE` (`id_estado` ASC) ,
  INDEX `fk_estado_pais1` (`id_pais` ASC) ,
  CONSTRAINT `fk_estado_pais1`
    FOREIGN KEY (`id_pais` )
    REFERENCES `zapateria`.`pais` (`id_pais` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`municipio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`municipio` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`municipio` (
  `id_municipio` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `id_estado` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_municipio`) ,
  UNIQUE INDEX `idmunicipio_UNIQUE` (`id_municipio` ASC) ,
  INDEX `fk_municipio_estado1` (`id_estado` ASC) ,
  CONSTRAINT `fk_municipio_estado1`
    FOREIGN KEY (`id_estado` )
    REFERENCES `zapateria`.`estado` (`id_estado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`colonia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`colonia` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`colonia` (
  `id_colonia` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `id_municipio` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_colonia`) ,
  UNIQUE INDEX `id_colonia_UNIQUE` (`id_colonia` ASC) ,
  INDEX `fk_colonia_municipio1` (`id_municipio` ASC) ,
  CONSTRAINT `fk_colonia_municipio1`
    FOREIGN KEY (`id_municipio` )
    REFERENCES `zapateria`.`municipio` (`id_municipio` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`empleado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`empleado` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`empleado` (
  `id_empleado` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  `apellidos` VARCHAR(80) NOT NULL ,
  `rfc` VARCHAR(13) NULL ,
  `foto` VARCHAR(255) NULL ,
  `correo` VARCHAR(100) NULL ,
  `usuario` VARCHAR(100) NOT NULL ,
  `contrasena` VARCHAR(100) NOT NULL ,
  `eliminado` ENUM('F','P','T') NOT NULL DEFAULT 'F' ,
  `calle` VARCHAR(60) NOT NULL ,
  `num_int` VARCHAR(20) NOT NULL ,
  `num_ext` VARCHAR(20) NULL ,
  `telefono` VARCHAR(30) NOT NULL ,
  `celular` VARCHAR(30) NULL ,
  `id_cargo` INT UNSIGNED NOT NULL ,
  `id_departamento` INT UNSIGNED NOT NULL ,
  `id_pais` INT UNSIGNED NOT NULL ,
  `id_estado` INT UNSIGNED NOT NULL ,
  `id_municipio` INT UNSIGNED NOT NULL ,
  `id_colonia` INT UNSIGNED NOT NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `estatus` TINYINT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id_empleado`) ,
  UNIQUE INDEX `id_empleado_UNIQUE` (`id_empleado` ASC) ,
  UNIQUE INDEX `RFC_UNIQUE` (`rfc` ASC) ,
  INDEX `fk_empleado_cargo` (`id_cargo` ASC) ,
  INDEX `fk_empleado_departamento1` (`id_departamento` ASC) ,
  INDEX `fk_empleado_municipio1` (`id_municipio` ASC) ,
  INDEX `fk_empleado_pais1` (`id_pais` ASC) ,
  INDEX `fk_empleado_colonia1` (`id_colonia` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`correo` ASC) ,
  UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC) ,
  INDEX `fk_empleado_estado1` (`id_estado` ASC) ,
  CONSTRAINT `fk_empleado_cargo`
    FOREIGN KEY (`id_cargo` )
    REFERENCES `zapateria`.`cargo` (`id_cargo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleado_departamento1`
    FOREIGN KEY (`id_departamento` )
    REFERENCES `zapateria`.`departamento` (`id_departamento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleado_municipio1`
    FOREIGN KEY (`id_municipio` )
    REFERENCES `zapateria`.`municipio` (`id_municipio` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleado_pais1`
    FOREIGN KEY (`id_pais` )
    REFERENCES `zapateria`.`pais` (`id_pais` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleado_colonia1`
    FOREIGN KEY (`id_colonia` )
    REFERENCES `zapateria`.`colonia` (`id_colonia` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleado_estado1`
    FOREIGN KEY (`id_estado` )
    REFERENCES `zapateria`.`estado` (`id_estado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`cliente_categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`cliente_categoria` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`cliente_categoria` (
  `id_cliente_categoria` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_cliente_categoria`) ,
  UNIQUE INDEX `cliente_categoria_UNIQUE` (`id_cliente_categoria` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`cliente_tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`cliente_tipo` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`cliente_tipo` (
  `id_cliente_tipo` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_cliente_tipo`) ,
  UNIQUE INDEX `id_cliente_tipo_UNIQUE` (`id_cliente_tipo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`cliente` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`cliente` (
  `id_cliente` INT UNSIGNED NOT NULL ,
  `razon_social` VARCHAR(80) NOT NULL ,
  `nombre` VARCHAR(60) NOT NULL ,
  `apellidos` VARCHAR(80) NOT NULL ,
  `rfc` VARCHAR(13) NULL ,
  `eliminado` ENUM('F','P','T') NOT NULL DEFAULT 'F' ,
  `id_grupo_empresarial` INT UNSIGNED NOT NULL ,
  `id_cliente_categoria` INT UNSIGNED NULL ,
  `id_cliente_tipo` INT UNSIGNED NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_cliente`) ,
  UNIQUE INDEX `id_cliente_UNIQUE` (`id_cliente` ASC) ,
  UNIQUE INDEX `rfc_UNIQUE` (`rfc` ASC) ,
  INDEX `fk_cliente_cliente1` (`id_grupo_empresarial` ASC) ,
  INDEX `fk_cliente_cliente_categoria1` (`id_cliente_categoria` ASC) ,
  INDEX `fk_cliente_cliente_tipo1` (`id_cliente_tipo` ASC) ,
  CONSTRAINT `fk_cliente_cliente1`
    FOREIGN KEY (`id_grupo_empresarial` )
    REFERENCES `zapateria`.`cliente` (`id_cliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliente_cliente_categoria1`
    FOREIGN KEY (`id_cliente_categoria` )
    REFERENCES `zapateria`.`cliente_categoria` (`id_cliente_categoria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliente_cliente_tipo1`
    FOREIGN KEY (`id_cliente_tipo` )
    REFERENCES `zapateria`.`cliente_tipo` (`id_cliente_tipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`tarifa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`tarifa` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`tarifa` (
  `id_tarifa` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `descuento` DECIMAL(19,2) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  `id_cliente_categoria` INT UNSIGNED NOT NULL ,
  `id_cliente_tipo` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_tarifa`) ,
  UNIQUE INDEX `id_tarifa_UNIQUE` (`id_tarifa` ASC) ,
  INDEX `fk_tarifa_cliente_categoria1` (`id_cliente_categoria` ASC) ,
  INDEX `fk_tarifa_cliente_tipo1` (`id_cliente_tipo` ASC) ,
  CONSTRAINT `fk_tarifa_cliente_categoria1`
    FOREIGN KEY (`id_cliente_categoria` )
    REFERENCES `zapateria`.`cliente_categoria` (`id_cliente_categoria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tarifa_cliente_tipo1`
    FOREIGN KEY (`id_cliente_tipo` )
    REFERENCES `zapateria`.`cliente_tipo` (`id_cliente_tipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`cliente_rel_tarifa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`cliente_rel_tarifa` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`cliente_rel_tarifa` (
  `id_cliente_rel_tarifa` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_cliente` INT UNSIGNED NOT NULL ,
  `id_tarifa` INT UNSIGNED NOT NULL ,
  `observaciones` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_cliente_rel_tarifa`) ,
  UNIQUE INDEX `id_cliente_rel_tarifa_UNIQUE` (`id_cliente_rel_tarifa` ASC) ,
  INDEX `fk_cliente_rel_tarifa_tarifa1` (`id_tarifa` ASC) ,
  INDEX `fk_cliente_rel_tarifa_cliente1` (`id_cliente` ASC) ,
  CONSTRAINT `fk_cliente_rel_tarifa_tarifa1`
    FOREIGN KEY (`id_tarifa` )
    REFERENCES `zapateria`.`tarifa` (`id_tarifa` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliente_rel_tarifa_cliente1`
    FOREIGN KEY (`id_cliente` )
    REFERENCES `zapateria`.`cliente` (`id_cliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`pago_tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`pago_tipo` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`pago_tipo` (
  `id_pago_tipo` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(40) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_pago_tipo`) ,
  UNIQUE INDEX `id_pago_tipo_UNIQUE` (`id_pago_tipo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`cliente_abono`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`cliente_abono` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`cliente_abono` (
  `id_cliente_abono` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `folio` INT NOT NULL ,
  `monto` DECIMAL(19,2) NOT NULL ,
  `id_cliente` INT UNSIGNED NOT NULL ,
  `id_pago_tipo` INT UNSIGNED NOT NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_cliente_abono`) ,
  UNIQUE INDEX `id_cliente_abono_UNIQUE` (`id_cliente_abono` ASC) ,
  UNIQUE INDEX `folio_UNIQUE` (`folio` ASC) ,
  INDEX `fk_cliente_abono_cliente1` (`id_cliente` ASC) ,
  INDEX `fk_cliente_abono_pago_tipo1` (`id_pago_tipo` ASC) ,
  CONSTRAINT `fk_cliente_abono_cliente1`
    FOREIGN KEY (`id_cliente` )
    REFERENCES `zapateria`.`cliente` (`id_cliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliente_abono_pago_tipo1`
    FOREIGN KEY (`id_pago_tipo` )
    REFERENCES `zapateria`.`pago_tipo` (`id_pago_tipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`movimiento_almacen_tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`movimiento_almacen_tipo` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`movimiento_almacen_tipo` (
  `id_movimiento_almacen_tipo` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  `entrada_salida` ENUM('E','S') NOT NULL ,
  `descripcion` VARCHAR(100) NULL ,
  PRIMARY KEY (`id_movimiento_almacen_tipo`) ,
  UNIQUE INDEX `id_movimiento_almacen_tipo_UNIQUE` (`id_movimiento_almacen_tipo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`almacen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`almacen` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`almacen` (
  `id_almacen` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(40) NOT NULL ,
  PRIMARY KEY (`id_almacen`) ,
  UNIQUE INDEX `id_almacen_UNIQUE` (`id_almacen` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`movimiento_almacen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`movimiento_almacen` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`movimiento_almacen` (
  `id_movimiento_almacen` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `referencia` VARCHAR(150) NULL ,
  `id_empleado` INT UNSIGNED NOT NULL ,
  `id_movimiento_almacen_tipo` INT UNSIGNED NOT NULL ,
  `id_almacen` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_movimiento_almacen`) ,
  UNIQUE INDEX `id_movimiento_almacen_UNIQUE` (`id_movimiento_almacen` ASC) ,
  INDEX `fk_movimiento_almacen_empleado1` (`id_empleado` ASC) ,
  INDEX `fk_movimiento_almacen_movimiento_almacen_tipo1` (`id_movimiento_almacen_tipo` ASC) ,
  INDEX `fk_movimiento_almacen_almacen1` (`id_almacen` ASC) ,
  CONSTRAINT `fk_movimiento_almacen_empleado1`
    FOREIGN KEY (`id_empleado` )
    REFERENCES `zapateria`.`empleado` (`id_empleado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimiento_almacen_movimiento_almacen_tipo1`
    FOREIGN KEY (`id_movimiento_almacen_tipo` )
    REFERENCES `zapateria`.`movimiento_almacen_tipo` (`id_movimiento_almacen_tipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimiento_almacen_almacen1`
    FOREIGN KEY (`id_almacen` )
    REFERENCES `zapateria`.`almacen` (`id_almacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`remision`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`remision` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`remision` (
  `id_remision` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `folio` INT NOT NULL ,
  `total` DECIMAL(19,2) NOT NULL DEFAULT 0 ,
  `iva` DECIMAL(19,2) NULL ,
  `estatus` ENUM('P','C') NOT NULL DEFAULT 'P' ,
  `id_movimiento_almacen` INT UNSIGNED NOT NULL ,
  `id_cliente` INT UNSIGNED NOT NULL ,
  `id_empleado` INT UNSIGNED NOT NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_remision`) ,
  UNIQUE INDEX `folio_UNIQUE` (`folio` ASC) ,
  INDEX `fk_remision_movimiento_almacen1` (`id_movimiento_almacen` ASC) ,
  INDEX `fk_remision_cliente1` (`id_cliente` ASC) ,
  INDEX `fk_remision_empleado1` (`id_empleado` ASC) ,
  UNIQUE INDEX `id_remision_UNIQUE` (`id_remision` ASC) ,
  CONSTRAINT `fk_remision_movimiento_almacen1`
    FOREIGN KEY (`id_movimiento_almacen` )
    REFERENCES `zapateria`.`movimiento_almacen` (`id_movimiento_almacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_remision_cliente1`
    FOREIGN KEY (`id_cliente` )
    REFERENCES `zapateria`.`cliente` (`id_cliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_remision_empleado1`
    FOREIGN KEY (`id_empleado` )
    REFERENCES `zapateria`.`empleado` (`id_empleado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`abono_rel_remision`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`abono_rel_remision` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`abono_rel_remision` (
  `id_abono_rel_remision` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `monto` DECIMAL(19,2) NOT NULL ,
  `id_cliente_abono` INT UNSIGNED NOT NULL ,
  `id_remision` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_abono_rel_remision`) ,
  UNIQUE INDEX `id_abono_remision_UNIQUE` (`id_abono_rel_remision` ASC) ,
  INDEX `fk_abono_remision_cliente_abono1` (`id_cliente_abono` ASC) ,
  INDEX `fk_abono_rel_remision_remision1` (`id_remision` ASC) ,
  CONSTRAINT `fk_abono_remision_cliente_abono1`
    FOREIGN KEY (`id_cliente_abono` )
    REFERENCES `zapateria`.`cliente_abono` (`id_cliente_abono` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_abono_rel_remision_remision1`
    FOREIGN KEY (`id_remision` )
    REFERENCES `zapateria`.`remision` (`id_remision` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`proveedor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`proveedor` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`proveedor` (
  `id_proveedor` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `razon_social` VARCHAR(80) NOT NULL ,
  `nombre` VARCHAR(60) NOT NULL ,
  `apellidos` VARCHAR(80) NOT NULL ,
  `rfc` VARCHAR(13) NULL ,
  `eliminado` ENUM('F','P','T') NOT NULL DEFAULT 'F' ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_proveedor`) ,
  UNIQUE INDEX `id_proveedor_UNIQUE` (`id_proveedor` ASC) ,
  UNIQUE INDEX `rfc_UNIQUE` (`rfc` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`proveedor_abono`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`proveedor_abono` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`proveedor_abono` (
  `id_proveedor_abono` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `folio` INT NOT NULL ,
  `monto` DECIMAL(19,2) NOT NULL ,
  `id_pago_tipo` INT UNSIGNED NOT NULL ,
  `id_proveedor` INT UNSIGNED NOT NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_proveedor_abono`) ,
  UNIQUE INDEX `id_cliente_abono_UNIQUE` (`id_proveedor_abono` ASC) ,
  UNIQUE INDEX `folio_UNIQUE` (`folio` ASC) ,
  INDEX `fk_cliente_abono_pago_tipo1` (`id_pago_tipo` ASC) ,
  INDEX `fk_proveedor_abono_proveedor1` (`id_proveedor` ASC) ,
  CONSTRAINT `fk_cliente_abono_pago_tipo10`
    FOREIGN KEY (`id_pago_tipo` )
    REFERENCES `zapateria`.`pago_tipo` (`id_pago_tipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proveedor_abono_proveedor1`
    FOREIGN KEY (`id_proveedor` )
    REFERENCES `zapateria`.`proveedor` (`id_proveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`recepcion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`recepcion` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`recepcion` (
  `id_recepcion` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `folio` INT NOT NULL ,
  `total` DECIMAL(19,2) NOT NULL DEFAULT 0 ,
  `iva` DECIMAL(19,2) NULL ,
  `estatus` ENUM('P','C') NOT NULL DEFAULT 'P' ,
  `id_movimiento_almacen` INT UNSIGNED NOT NULL ,
  `id_proveedor` INT UNSIGNED NOT NULL ,
  `id_empleado` INT UNSIGNED NOT NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_recepcion`) ,
  UNIQUE INDEX `folio_UNIQUE` (`folio` ASC) ,
  INDEX `fk_remision_movimiento_almacen1` (`id_movimiento_almacen` ASC) ,
  INDEX `fk_remision_empleado1` (`id_empleado` ASC) ,
  INDEX `fk_recepcion_proveedor1` (`id_proveedor` ASC) ,
  UNIQUE INDEX `id_recepcion_UNIQUE` (`id_recepcion` ASC) ,
  CONSTRAINT `fk_remision_movimiento_almacen10`
    FOREIGN KEY (`id_movimiento_almacen` )
    REFERENCES `zapateria`.`movimiento_almacen` (`id_movimiento_almacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_remision_empleado10`
    FOREIGN KEY (`id_empleado` )
    REFERENCES `zapateria`.`empleado` (`id_empleado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recepcion_proveedor1`
    FOREIGN KEY (`id_proveedor` )
    REFERENCES `zapateria`.`proveedor` (`id_proveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`abono_rel_recepcion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`abono_rel_recepcion` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`abono_rel_recepcion` (
  `id_abono_rel_recepcion` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `monto` DECIMAL(19,2) NOT NULL ,
  `id_proveedor_abono` INT UNSIGNED NOT NULL ,
  `id_recepcion` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_abono_rel_recepcion`) ,
  UNIQUE INDEX `id_abono_remision_UNIQUE` (`id_abono_rel_recepcion` ASC) ,
  INDEX `fk_abono_rel_recepcion_proveedor_abono1` (`id_proveedor_abono` ASC) ,
  INDEX `fk_abono_rel_recepcion_recepcion1` (`id_recepcion` ASC) ,
  CONSTRAINT `fk_abono_rel_recepcion_proveedor_abono1`
    FOREIGN KEY (`id_proveedor_abono` )
    REFERENCES `zapateria`.`proveedor_abono` (`id_proveedor_abono` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_abono_rel_recepcion_recepcion1`
    FOREIGN KEY (`id_recepcion` )
    REFERENCES `zapateria`.`recepcion` (`id_recepcion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`pago_condicion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`pago_condicion` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`pago_condicion` (
  `id_pago_condicion` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(30) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_pago_condicion`) ,
  UNIQUE INDEX `id_pago_condicion_UNIQUE` (`id_pago_condicion` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`pedido`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`pedido` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`pedido` (
  `id_pedido` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `folio` INT NOT NULL ,
  `iva` DECIMAL(19,2) NULL ,
  `estatus` ENUM('P','C') NOT NULL DEFAULT 'P' ,
  `eliminado` ENUM('F','P','T') NOT NULL DEFAULT 'F' ,
  `id_cliente` INT UNSIGNED NOT NULL ,
  `id_empleado` INT UNSIGNED NOT NULL ,
  `id_pago_condicion` INT UNSIGNED NOT NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_pedido`) ,
  UNIQUE INDEX `id_pedido_UNIQUE` (`id_pedido` ASC) ,
  UNIQUE INDEX `folio_UNIQUE` (`folio` ASC) ,
  INDEX `fk_pedido_cliente1` (`id_cliente` ASC) ,
  INDEX `fk_pedido_empleado1` (`id_empleado` ASC) ,
  INDEX `fk_pedido_pago_condicion1` (`id_pago_condicion` ASC) ,
  CONSTRAINT `fk_pedido_cliente1`
    FOREIGN KEY (`id_cliente` )
    REFERENCES `zapateria`.`cliente` (`id_cliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_empleado1`
    FOREIGN KEY (`id_empleado` )
    REFERENCES `zapateria`.`empleado` (`id_empleado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_pago_condicion1`
    FOREIGN KEY (`id_pago_condicion` )
    REFERENCES `zapateria`.`pago_condicion` (`id_pago_condicion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`orden_compra`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`orden_compra` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`orden_compra` (
  `id_orden_compra` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `folio` INT NOT NULL ,
  `iva` DECIMAL(19,2) NULL ,
  `estatus` ENUM('P','C') NOT NULL DEFAULT 'P' ,
  `eliminado` ENUM('F','P','T') NOT NULL DEFAULT 'F' ,
  `id_proveedor` INT UNSIGNED NOT NULL ,
  `id_empleado` INT UNSIGNED NOT NULL ,
  `id_pago_condicion` INT UNSIGNED NOT NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_orden_compra`) ,
  UNIQUE INDEX `id_pedido_UNIQUE` (`id_orden_compra` ASC) ,
  UNIQUE INDEX `folio_UNIQUE` (`folio` ASC) ,
  INDEX `fk_pedido_empleado1` (`id_empleado` ASC) ,
  INDEX `fk_pedido_pago_condicion1` (`id_pago_condicion` ASC) ,
  INDEX `fk_orden_compra_proveedor1` (`id_proveedor` ASC) ,
  CONSTRAINT `fk_pedido_empleado10`
    FOREIGN KEY (`id_empleado` )
    REFERENCES `zapateria`.`empleado` (`id_empleado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_pago_condicion10`
    FOREIGN KEY (`id_pago_condicion` )
    REFERENCES `zapateria`.`pago_condicion` (`id_pago_condicion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orden_compra_proveedor1`
    FOREIGN KEY (`id_proveedor` )
    REFERENCES `zapateria`.`proveedor` (`id_proveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`familia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`familia` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`familia` (
  `id_familia` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_familia`) ,
  UNIQUE INDEX `id_familia_UNIQUE` (`id_familia` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`color`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`color` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`color` (
  `id_color` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  `descripcion` VARCHAR(100) NULL ,
  PRIMARY KEY (`id_color`) ,
  UNIQUE INDEX `id_color_UNIQUE` (`id_color` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`unidad_medida`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`unidad_medida` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`unidad_medida` (
  `id_unidad_medida` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_unidad_medida`) ,
  UNIQUE INDEX `id_unidad_medida_UNIQUE` (`id_unidad_medida` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`producto_tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`producto_tipo` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`producto_tipo` (
  `id_producto_tipo` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  PRIMARY KEY (`id_producto_tipo`) ,
  UNIQUE INDEX `id_producto_tipo_UNIQUE` (`id_producto_tipo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`producto_grupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`producto_grupo` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`producto_grupo` (
  `id_producto_grupo` INT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(60) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_producto_grupo`) ,
  UNIQUE INDEX `id_producto_grupo_UNIQUE` (`id_producto_grupo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`talla`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`talla` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`talla` (
  `id_talla` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  `descripcion` VARCHAR(100) NULL ,
  `id_producto_tipo` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_talla`) ,
  UNIQUE INDEX `id_talla_UNIQUE` (`id_talla` ASC) ,
  INDEX `fk_talla_producto_tipo1` (`id_producto_tipo` ASC) ,
  CONSTRAINT `fk_talla_producto_tipo1`
    FOREIGN KEY (`id_producto_tipo` )
    REFERENCES `zapateria`.`producto_tipo` (`id_producto_tipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`modelo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`modelo` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`modelo` (
  `id_modelo` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(40) NOT NULL ,
  `precio_unitario` DECIMAL(19,2) NULL ,
  `estatus` ENUM('P','C') NOT NULL DEFAULT 'P' ,
  `eliminado` ENUM('F','P','T') NOT NULL DEFAULT 'F' ,
  `id_color` INT UNSIGNED NULL ,
  `id_unidad_medida` INT UNSIGNED NOT NULL ,
  `id_producto_tipo` INT UNSIGNED NOT NULL ,
  `id_producto_grupo` INT UNSIGNED NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_modelo`) ,
  UNIQUE INDEX `id_modelo_UNIQUE` (`id_modelo` ASC) ,
  INDEX `fk_modelo_color1` (`id_color` ASC) ,
  INDEX `fk_modelo_unidad_medida1` (`id_unidad_medida` ASC) ,
  INDEX `fk_modelo_producto_tipo1` (`id_producto_tipo` ASC) ,
  INDEX `fk_modelo_producto_grupo1` (`id_producto_grupo` ASC) ,
  CONSTRAINT `fk_modelo_color1`
    FOREIGN KEY (`id_color` )
    REFERENCES `zapateria`.`color` (`id_color` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_modelo_unidad_medida1`
    FOREIGN KEY (`id_unidad_medida` )
    REFERENCES `zapateria`.`unidad_medida` (`id_unidad_medida` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_modelo_producto_tipo1`
    FOREIGN KEY (`id_producto_tipo` )
    REFERENCES `zapateria`.`producto_tipo` (`id_producto_tipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_modelo_producto_grupo1`
    FOREIGN KEY (`id_producto_grupo` )
    REFERENCES `zapateria`.`producto_grupo` (`id_producto_grupo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`producto` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`producto` (
  `id_producto` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_producto_padre` INT UNSIGNED NULL ,
  `nombre` VARCHAR(40) NOT NULL ,
  `precio_unitario` DECIMAL(19,2) NOT NULL ,
  `eliminado` ENUM('F','T','P') NOT NULL DEFAULT 'F' ,
  `id_familia` INT UNSIGNED NULL ,
  `id_color` INT UNSIGNED NULL ,
  `id_producto_grupo` INT UNSIGNED NULL ,
  `id_unidad_medida` INT UNSIGNED NOT NULL ,
  `id_producto_tipo` INT UNSIGNED NOT NULL ,
  `id_talla` INT UNSIGNED NULL ,
  `id_modelo` INT UNSIGNED NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_producto`) ,
  UNIQUE INDEX `id_producto_UNIQUE` (`id_producto` ASC) ,
  INDEX `fk_producto_producto1` (`id_producto_padre` ASC) ,
  INDEX `fk_producto_familia1` (`id_familia` ASC) ,
  INDEX `fk_producto_color1` (`id_color` ASC) ,
  INDEX `fk_producto_unidad_medida1` (`id_unidad_medida` ASC) ,
  INDEX `fk_producto_producto_tipo1` (`id_producto_tipo` ASC) ,
  INDEX `fk_producto_producto_grupo1` (`id_producto_grupo` ASC) ,
  INDEX `fk_producto_talla1` (`id_talla` ASC) ,
  INDEX `fk_producto_modelo1` (`id_modelo` ASC) ,
  CONSTRAINT `fk_producto_producto1`
    FOREIGN KEY (`id_producto_padre` )
    REFERENCES `zapateria`.`producto` (`id_producto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_familia1`
    FOREIGN KEY (`id_familia` )
    REFERENCES `zapateria`.`familia` (`id_familia` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_color1`
    FOREIGN KEY (`id_color` )
    REFERENCES `zapateria`.`color` (`id_color` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_unidad_medida1`
    FOREIGN KEY (`id_unidad_medida` )
    REFERENCES `zapateria`.`unidad_medida` (`id_unidad_medida` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_producto_tipo1`
    FOREIGN KEY (`id_producto_tipo` )
    REFERENCES `zapateria`.`producto_tipo` (`id_producto_tipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_producto_grupo1`
    FOREIGN KEY (`id_producto_grupo` )
    REFERENCES `zapateria`.`producto_grupo` (`id_producto_grupo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_talla1`
    FOREIGN KEY (`id_talla` )
    REFERENCES `zapateria`.`talla` (`id_talla` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_modelo1`
    FOREIGN KEY (`id_modelo` )
    REFERENCES `zapateria`.`modelo` (`id_modelo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`remision_detalle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`remision_detalle` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`remision_detalle` (
  `id_remision_detalle` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `cantidad` DECIMAL(19,3) NOT NULL ,
  `precio_unitario` DECIMAL(19,2) NOT NULL ,
  `descuento` DECIMAL(19,2) NOT NULL ,
  `id_remision` INT UNSIGNED NOT NULL ,
  `id_producto` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_remision_detalle`) ,
  UNIQUE INDEX `id_remision_detalle_UNIQUE` (`id_remision_detalle` ASC) ,
  INDEX `fk_remision_detalle_remision1` (`id_remision` ASC) ,
  INDEX `fk_remision_detalle_producto1` (`id_producto` ASC) ,
  CONSTRAINT `fk_remision_detalle_remision1`
    FOREIGN KEY (`id_remision` )
    REFERENCES `zapateria`.`remision` (`id_remision` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_remision_detalle_producto1`
    FOREIGN KEY (`id_producto` )
    REFERENCES `zapateria`.`producto` (`id_producto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`recepcion_detalle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`recepcion_detalle` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`recepcion_detalle` (
  `id_recepcion_detalle` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `cantidad` DECIMAL(19,3) NOT NULL ,
  `precio_unitario` DECIMAL(19,2) NOT NULL ,
  `descuento` DECIMAL(19,2) NOT NULL ,
  `id_recepcion` INT UNSIGNED NOT NULL ,
  `id_producto` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_recepcion_detalle`) ,
  UNIQUE INDEX `id_remision_detalle_UNIQUE` (`id_recepcion_detalle` ASC) ,
  INDEX `fk_recepcion_detalle_recepcion1` (`id_recepcion` ASC) ,
  INDEX `fk_recepcion_detalle_producto1` (`id_producto` ASC) ,
  CONSTRAINT `fk_recepcion_detalle_recepcion1`
    FOREIGN KEY (`id_recepcion` )
    REFERENCES `zapateria`.`recepcion` (`id_recepcion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recepcion_detalle_producto1`
    FOREIGN KEY (`id_producto` )
    REFERENCES `zapateria`.`producto` (`id_producto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`ajuste_entrada_tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`ajuste_entrada_tipo` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`ajuste_entrada_tipo` (
  `id_ajuste_entrada_tipo` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  `exclusivo_sistema` ENUM('S','N') NOT NULL DEFAULT 'S' ,
  `descripcion` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_ajuste_entrada_tipo`) ,
  UNIQUE INDEX `id_ajuste_entrada_tipo_UNIQUE` (`id_ajuste_entrada_tipo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`ajuste_entrada`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`ajuste_entrada` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`ajuste_entrada` (
  `id_ajuste_entrada` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `folio` INT NOT NULL ,
  `id_movimiento_almacen` INT UNSIGNED NOT NULL ,
  `id_ajuste_entrada_tipo` INT UNSIGNED NOT NULL ,
  `id_cliente` INT UNSIGNED NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_ajuste_entrada`) ,
  UNIQUE INDEX `id_ajuste_entrada_UNIQUE` (`id_ajuste_entrada` ASC) ,
  UNIQUE INDEX `folio_UNIQUE` (`folio` ASC) ,
  INDEX `fk_ajuste_entrada_movimiento_almacen1` (`id_movimiento_almacen` ASC) ,
  INDEX `fk_ajuste_entrada_ajuste_entrada_tipo1` (`id_ajuste_entrada_tipo` ASC) ,
  INDEX `fk_ajuste_entrada_cliente1` (`id_cliente` ASC) ,
  CONSTRAINT `fk_ajuste_entrada_movimiento_almacen1`
    FOREIGN KEY (`id_movimiento_almacen` )
    REFERENCES `zapateria`.`movimiento_almacen` (`id_movimiento_almacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ajuste_entrada_ajuste_entrada_tipo1`
    FOREIGN KEY (`id_ajuste_entrada_tipo` )
    REFERENCES `zapateria`.`ajuste_entrada_tipo` (`id_ajuste_entrada_tipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ajuste_entrada_cliente1`
    FOREIGN KEY (`id_cliente` )
    REFERENCES `zapateria`.`cliente` (`id_cliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`ajuste_salida_tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`ajuste_salida_tipo` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`ajuste_salida_tipo` (
  `id_ajuste_salida_tipo` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  `exclusivo_sistema` ENUM('S','N') NOT NULL DEFAULT 'S' ,
  `descripcion` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_ajuste_salida_tipo`) ,
  UNIQUE INDEX `id_ajuste_entrada_tipo_UNIQUE` (`id_ajuste_salida_tipo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`ajuste_salida`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`ajuste_salida` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`ajuste_salida` (
  `id_ajuste_salida` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `folio` INT NOT NULL ,
  `id_movimiento_almacen` INT UNSIGNED NOT NULL ,
  `id_ajuste_salida_tipo` INT UNSIGNED NOT NULL ,
  `id_proveedor` INT UNSIGNED NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_ajuste_salida`) ,
  UNIQUE INDEX `id_ajuste_entrada_UNIQUE` (`id_ajuste_salida` ASC) ,
  UNIQUE INDEX `folio_UNIQUE` (`folio` ASC) ,
  INDEX `fk_ajuste_entrada_movimiento_almacen1` (`id_movimiento_almacen` ASC) ,
  INDEX `fk_ajuste_salida_ajuste_salida_tipo1` (`id_ajuste_salida_tipo` ASC) ,
  INDEX `fk_ajuste_salida_proveedor1` (`id_proveedor` ASC) ,
  CONSTRAINT `fk_ajuste_entrada_movimiento_almacen10`
    FOREIGN KEY (`id_movimiento_almacen` )
    REFERENCES `zapateria`.`movimiento_almacen` (`id_movimiento_almacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ajuste_salida_ajuste_salida_tipo1`
    FOREIGN KEY (`id_ajuste_salida_tipo` )
    REFERENCES `zapateria`.`ajuste_salida_tipo` (`id_ajuste_salida_tipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ajuste_salida_proveedor1`
    FOREIGN KEY (`id_proveedor` )
    REFERENCES `zapateria`.`proveedor` (`id_proveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`ajuste_entrada_detalle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`ajuste_entrada_detalle` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`ajuste_entrada_detalle` (
  `id_ajuste_entrada_detalle` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `cantidad` DECIMAL(19,3) NOT NULL ,
  `precio_unitario` DECIMAL(19,2) NOT NULL ,
  `descuento` DECIMAL(19,2) NOT NULL ,
  `id_ajuste_entrada` INT UNSIGNED NOT NULL ,
  `id_producto` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_ajuste_entrada_detalle`) ,
  UNIQUE INDEX `id_remision_detalle_UNIQUE` (`id_ajuste_entrada_detalle` ASC) ,
  INDEX `fk_ajuste_entrada_detalle_ajuste_entrada1` (`id_ajuste_entrada` ASC) ,
  INDEX `fk_ajuste_entrada_detalle_producto1` (`id_producto` ASC) ,
  CONSTRAINT `fk_ajuste_entrada_detalle_ajuste_entrada1`
    FOREIGN KEY (`id_ajuste_entrada` )
    REFERENCES `zapateria`.`ajuste_entrada` (`id_ajuste_entrada` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ajuste_entrada_detalle_producto1`
    FOREIGN KEY (`id_producto` )
    REFERENCES `zapateria`.`producto` (`id_producto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`ajuste_salida_detalle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`ajuste_salida_detalle` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`ajuste_salida_detalle` (
  `id_ajuste_salida_detalle` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `cantidad` DECIMAL(19,3) NOT NULL ,
  `precio_unitario` DECIMAL(19,2) NOT NULL ,
  `descuento` DECIMAL(19,2) NOT NULL ,
  `id_ajuste_salida` INT UNSIGNED NOT NULL ,
  `id_producto` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_ajuste_salida_detalle`) ,
  UNIQUE INDEX `id_remision_detalle_UNIQUE` (`id_ajuste_salida_detalle` ASC) ,
  INDEX `fk_ajuste_salida_detalle_ajuste_salida1` (`id_ajuste_salida` ASC) ,
  INDEX `fk_ajuste_salida_detalle_producto1` (`id_producto` ASC) ,
  CONSTRAINT `fk_ajuste_salida_detalle_ajuste_salida1`
    FOREIGN KEY (`id_ajuste_salida` )
    REFERENCES `zapateria`.`ajuste_salida` (`id_ajuste_salida` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ajuste_salida_detalle_producto1`
    FOREIGN KEY (`id_producto` )
    REFERENCES `zapateria`.`producto` (`id_producto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`pedido_detalle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`pedido_detalle` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`pedido_detalle` (
  `id_pedido_detalle` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `cantidad` DECIMAL(19,3) NOT NULL ,
  `precio_unitario` DECIMAL(19,2) NOT NULL ,
  `descuento` DECIMAL(19,2) NOT NULL ,
  `id_pedido` INT UNSIGNED NOT NULL ,
  `id_producto` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_pedido_detalle`) ,
  UNIQUE INDEX `id_pedido_detalle_UNIQUE` (`id_pedido_detalle` ASC) ,
  INDEX `fk_pedido_detalle_pedido1` (`id_pedido` ASC) ,
  INDEX `fk_pedido_detalle_producto1` (`id_producto` ASC) ,
  CONSTRAINT `fk_pedido_detalle_pedido1`
    FOREIGN KEY (`id_pedido` )
    REFERENCES `zapateria`.`pedido` (`id_pedido` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_detalle_producto1`
    FOREIGN KEY (`id_producto` )
    REFERENCES `zapateria`.`producto` (`id_producto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`orden_compra_detalle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`orden_compra_detalle` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`orden_compra_detalle` (
  `id_orden_compra_detalle` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `cantidad` DECIMAL(19,3) NOT NULL ,
  `precio_unitario` DECIMAL(19,2) NOT NULL ,
  `descuento` DECIMAL(19,2) NOT NULL ,
  `id_orden_compra` INT UNSIGNED NOT NULL ,
  `id_producto` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_orden_compra_detalle`) ,
  UNIQUE INDEX `id_pedido_detalle_UNIQUE` (`id_orden_compra_detalle` ASC) ,
  INDEX `fk_orden_compra_detalle_orden_compra1` (`id_orden_compra` ASC) ,
  INDEX `fk_orden_compra_detalle_producto1` (`id_producto` ASC) ,
  CONSTRAINT `fk_orden_compra_detalle_orden_compra1`
    FOREIGN KEY (`id_orden_compra` )
    REFERENCES `zapateria`.`orden_compra` (`id_orden_compra` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orden_compra_detalle_producto1`
    FOREIGN KEY (`id_producto` )
    REFERENCES `zapateria`.`producto` (`id_producto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`proceso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`proceso` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`proceso` (
  `id_proceso` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(80) NOT NULL ,
  `precio_unitario` DECIMAL(19,2) NOT NULL ,
  `id_proceso_padre` INT UNSIGNED NULL ,
  PRIMARY KEY (`id_proceso`) ,
  UNIQUE INDEX `id_proceso_UNIQUE` (`id_proceso` ASC) ,
  INDEX `fk_proceso_proceso1` (`id_proceso_padre` ASC) ,
  CONSTRAINT `fk_proceso_proceso1`
    FOREIGN KEY (`id_proceso_padre` )
    REFERENCES `zapateria`.`proceso` (`id_proceso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`proceso_rel_modelo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`proceso_rel_modelo` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`proceso_rel_modelo` (
  `id_proceso_rel_modelo` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_proceso` INT UNSIGNED NOT NULL ,
  `id_modelo` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_proceso_rel_modelo`) ,
  UNIQUE INDEX `id_proceso_rel_mode_UNIQUE` (`id_proceso_rel_modelo` ASC) ,
  INDEX `fk_proceso_rel_modelo_proceso1` (`id_proceso` ASC) ,
  INDEX `fk_proceso_rel_modelo_modelo1` (`id_modelo` ASC) ,
  CONSTRAINT `fk_proceso_rel_modelo_proceso1`
    FOREIGN KEY (`id_proceso` )
    REFERENCES `zapateria`.`proceso` (`id_proceso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proceso_rel_modelo_modelo1`
    FOREIGN KEY (`id_modelo` )
    REFERENCES `zapateria`.`modelo` (`id_modelo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`metadato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`metadato` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`metadato` (
  `id_metadato` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `singular` VARCHAR(45) NOT NULL DEFAULT '' ,
  `plural` VARCHAR(45) NOT NULL DEFAULT '' ,
  `tipo_dato` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id_metadato`) ,
  UNIQUE INDEX `id_metadato_UNIQUE` (`id_metadato` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`info_cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`info_cliente` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`info_cliente` (
  `id_info_cliente` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_metadato` INT UNSIGNED NOT NULL ,
  `id_cliente` INT UNSIGNED NOT NULL ,
  `valor` VARCHAR(255) NOT NULL ,
  `principal` TINYINT UNSIGNED NOT NULL DEFAULT 0 ,
  `conjunto` TINYINT NULL DEFAULT NULL ,
  PRIMARY KEY (`id_info_cliente`) ,
  UNIQUE INDEX `id_info_cliente_UNIQUE` (`id_info_cliente` ASC) ,
  INDEX `fk_info_cliente_metadato1` (`id_metadato` ASC) ,
  INDEX `fk_info_cliente_cliente1` (`id_cliente` ASC) ,
  CONSTRAINT `fk_info_cliente_metadato1`
    FOREIGN KEY (`id_metadato` )
    REFERENCES `zapateria`.`metadato` (`id_metadato` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_info_cliente_cliente1`
    FOREIGN KEY (`id_cliente` )
    REFERENCES `zapateria`.`cliente` (`id_cliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`info_proveedor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`info_proveedor` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`info_proveedor` (
  `id_info_proveedor` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_metadato` INT UNSIGNED NOT NULL ,
  `id_proveedor` INT UNSIGNED NOT NULL ,
  `valor` VARCHAR(255) NOT NULL ,
  `principal` TINYINT UNSIGNED NOT NULL DEFAULT 0 ,
  `conjunto` TINYINT NULL DEFAULT NULL ,
  INDEX `fk_metadato_has_proveedor_proveedor1` (`id_proveedor` ASC) ,
  INDEX `fk_metadato_has_proveedor_metadato1` (`id_metadato` ASC) ,
  PRIMARY KEY (`id_info_proveedor`) ,
  UNIQUE INDEX `info_proveedor_UNIQUE` (`id_info_proveedor` ASC) ,
  CONSTRAINT `fk_metadato_has_proveedor_metadato1`
    FOREIGN KEY (`id_metadato` )
    REFERENCES `zapateria`.`metadato` (`id_metadato` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_metadato_has_proveedor_proveedor1`
    FOREIGN KEY (`id_proveedor` )
    REFERENCES `zapateria`.`proveedor` (`id_proveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`adjunto_tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`adjunto_tipo` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`adjunto_tipo` (
  `id_adjunto_tipo` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_adjunto_tipo`) ,
  UNIQUE INDEX `id_adjunto_tipo_UNIQUE` (`id_adjunto_tipo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`adjunto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`adjunto` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`adjunto` (
  `id_adjunto` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(255) NOT NULL ,
  `ruta` VARCHAR(255) NOT NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `id_adjunto_tipo` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_adjunto`) ,
  UNIQUE INDEX `id_adjunto_UNIQUE` (`id_adjunto` ASC) ,
  INDEX `fk_adjunto_adjunto_tipo1` (`id_adjunto_tipo` ASC) ,
  CONSTRAINT `fk_adjunto_adjunto_tipo1`
    FOREIGN KEY (`id_adjunto_tipo` )
    REFERENCES `zapateria`.`adjunto_tipo` (`id_adjunto_tipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`producto_rel_adjunto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`producto_rel_adjunto` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`producto_rel_adjunto` (
  `id_producto_rel_adjunto` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_producto` INT UNSIGNED NOT NULL ,
  `id_adjunto` INT UNSIGNED NOT NULL ,
  `principal` TINYINT NOT NULL DEFAULT 0 ,
  INDEX `fk_producto_has_adjunto_adjunto1` (`id_adjunto` ASC) ,
  INDEX `fk_producto_has_adjunto_producto1` (`id_producto` ASC) ,
  UNIQUE INDEX `id_producto_rel_adjunto_UNIQUE` (`id_producto_rel_adjunto` ASC) ,
  PRIMARY KEY (`id_producto_rel_adjunto`) ,
  CONSTRAINT `fk_producto_has_adjunto_producto1`
    FOREIGN KEY (`id_producto` )
    REFERENCES `zapateria`.`producto` (`id_producto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_has_adjunto_adjunto1`
    FOREIGN KEY (`id_adjunto` )
    REFERENCES `zapateria`.`adjunto` (`id_adjunto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`adjunto_rel_modelo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`adjunto_rel_modelo` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`adjunto_rel_modelo` (
  `id_adjunto_rel_modelo` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_adjunto` INT UNSIGNED NOT NULL ,
  `id_modelo` INT UNSIGNED NOT NULL ,
  `principal` TINYINT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id_adjunto_rel_modelo`) ,
  INDEX `fk_adjunto_has_modelo_modelo1` (`id_modelo` ASC) ,
  INDEX `fk_adjunto_has_modelo_adjunto1` (`id_adjunto` ASC) ,
  UNIQUE INDEX `id_adjunto_rel_modelo_UNIQUE` (`id_adjunto_rel_modelo` ASC) ,
  CONSTRAINT `fk_adjunto_has_modelo_adjunto1`
    FOREIGN KEY (`id_adjunto` )
    REFERENCES `zapateria`.`adjunto` (`id_adjunto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_adjunto_has_modelo_modelo1`
    FOREIGN KEY (`id_modelo` )
    REFERENCES `zapateria`.`modelo` (`id_modelo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`agenda`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`agenda` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`agenda` (
  `id_agenda` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_objeto` INT UNSIGNED NOT NULL ,
  `tipo_objeto` ENUM('REM','REC','PED','OC','PROD','ABOC','ABOP','PROC','TAR') NOT NULL ,
  `objeto` TEXT NULL ,
  `estatus` ENUM('P','C') NOT NULL DEFAULT 'P' ,
  `fecha_calendario` TIMESTAMP NULL DEFAULT NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_agenda`) ,
  UNIQUE INDEX `id_agenda_UNIQUE` (`id_agenda` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`log` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`log` (
  `id_log` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_objeto` INT UNSIGNED NOT NULL ,
  `id_autor` INT UNSIGNED NOT NULL ,
  `tag` VARCHAR(30) NOT NULL ,
  `tipo_objeto` ENUM('REC','REM','AE','AS','PED','OC','PRO','MOD','PROD','PROC','ABOC','ABOP','EMP','PROV','CLI','ALM','DEP','PROT','NOTA','AGN','TAR') NOT NULL ,
  `comentario` VARCHAR(255) NOT NULL ,
  `datos_antes` TEXT NOT NULL ,
  `datos_despues` TEXT NOT NULL ,
  `agrupado` TINYINT NOT NULL DEFAULT 0 ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `version` INT NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`id_log`) ,
  UNIQUE INDEX `id_logs_UNIQUE` (`id_log` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`modelo_rel_producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`modelo_rel_producto` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`modelo_rel_producto` (
  `id_modelo_rel_producto` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_modelo` INT UNSIGNED NOT NULL ,
  `id_producto` INT UNSIGNED NOT NULL ,
  `cantidad` DECIMAL(19,3) NOT NULL ,
  INDEX `fk_modelo_has_producto_producto1` (`id_producto` ASC) ,
  INDEX `fk_modelo_has_producto_modelo1` (`id_modelo` ASC) ,
  PRIMARY KEY (`id_modelo_rel_producto`) ,
  UNIQUE INDEX `id_modelo_rel_producto_UNIQUE` (`id_modelo_rel_producto` ASC) ,
  CONSTRAINT `fk_modelo_has_producto_modelo1`
    FOREIGN KEY (`id_modelo` )
    REFERENCES `zapateria`.`modelo` (`id_modelo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_modelo_has_producto_producto1`
    FOREIGN KEY (`id_producto` )
    REFERENCES `zapateria`.`producto` (`id_producto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`nota`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`nota` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`nota` (
  `id_nota` INT NOT NULL ,
  `id_objeto` INT NOT NULL ,
  `tipo_objeto` ENUM('REC','REM','AE','AS','PED','OC','PRO','MOD','PROD','PROC','ABOC','ABOP','EMP','PROV','CLI','ALM','DEP','PROT','AGN','TAR') NOT NULL ,
  `id_autor` INT NOT NULL ,
  `comentario` TEXT NOT NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_nota`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`produccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`produccion` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`produccion` (
  `id_produccion` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_pedido` INT UNSIGNED NOT NULL ,
  `id_supervisor` INT UNSIGNED NOT NULL ,
  `folio` INT NOT NULL ,
  `id_producto` INT UNSIGNED NOT NULL ,
  `cantidad` DECIMAL(19,3) NOT NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `estatus` ENUM('P','C') NOT NULL ,
  `eliminado` ENUM('F','P','T') NOT NULL ,
  PRIMARY KEY (`id_produccion`) ,
  UNIQUE INDEX `id_produccion_UNIQUE` (`id_produccion` ASC) ,
  INDEX `fk_produccion_empleado1` (`id_supervisor` ASC) ,
  UNIQUE INDEX `folio_UNIQUE` (`folio` ASC) ,
  INDEX `fk_produccion_pedido1` (`id_pedido` ASC) ,
  INDEX `fk_produccion_producto1` (`id_producto` ASC) ,
  CONSTRAINT `fk_produccion_empleado1`
    FOREIGN KEY (`id_supervisor` )
    REFERENCES `zapateria`.`empleado` (`id_empleado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produccion_pedido1`
    FOREIGN KEY (`id_pedido` )
    REFERENCES `zapateria`.`pedido` (`id_pedido` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produccion_producto1`
    FOREIGN KEY (`id_producto` )
    REFERENCES `zapateria`.`producto` (`id_producto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`tarea`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`tarea` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`tarea` (
  `id_tarea` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_tarea_padre` INT UNSIGNED NULL ,
  `id_empleado` INT UNSIGNED NOT NULL ,
  `id_proceso` INT UNSIGNED NOT NULL ,
  `id_produccion` INT UNSIGNED NOT NULL ,
  `estatus` ENUM('P','A','C') NOT NULL ,
  `eliminado` ENUM('F','P','T') NOT NULL ,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_tarea`) ,
  UNIQUE INDEX `id_tarea_UNIQUE` (`id_tarea` ASC) ,
  INDEX `fk_tarea_tarea1` (`id_tarea_padre` ASC) ,
  INDEX `fk_tarea_proceso1` (`id_proceso` ASC) ,
  INDEX `fk_tarea_empleado1` (`id_empleado` ASC) ,
  INDEX `fk_tarea_produccion1` (`id_produccion` ASC) ,
  CONSTRAINT `fk_tarea_tarea1`
    FOREIGN KEY (`id_tarea_padre` )
    REFERENCES `zapateria`.`tarea` (`id_tarea` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tarea_proceso1`
    FOREIGN KEY (`id_proceso` )
    REFERENCES `zapateria`.`proceso` (`id_proceso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tarea_empleado1`
    FOREIGN KEY (`id_empleado` )
    REFERENCES `zapateria`.`empleado` (`id_empleado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tarea_produccion1`
    FOREIGN KEY (`id_produccion` )
    REFERENCES `zapateria`.`produccion` (`id_produccion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`existencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`existencia` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`existencia` (
  `id_existencia` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `precio_unitario` DECIMAL(19,2) NOT NULL ,
  `cantidad` DECIMAL(19,2) NOT NULL ,
  `id_producto` INT UNSIGNED NOT NULL ,
  `id_almacen` INT UNSIGNED NOT NULL ,
  `fecha_registro` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id_existencia`) ,
  UNIQUE INDEX `id_existencia_UNIQUE` (`id_existencia` ASC) ,
  INDEX `fk_existencia_producto1` (`id_producto` ASC) ,
  INDEX `fk_existencia_almacen1` (`id_almacen` ASC) ,
  CONSTRAINT `fk_existencia_producto1`
    FOREIGN KEY (`id_producto` )
    REFERENCES `zapateria`.`producto` (`id_producto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_existencia_almacen1`
    FOREIGN KEY (`id_almacen` )
    REFERENCES `zapateria`.`almacen` (`id_almacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `zapateria`.`referencia_origen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zapateria`.`referencia_origen` ;

CREATE  TABLE IF NOT EXISTS `zapateria`.`referencia_origen` (
  `id_referencia_origen` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_objeto_emisor` INT NOT NULL ,
  `tipo_objeto_emisor` ENUM('REC','REM','AE','AS','PED','OC') NOT NULL ,
  `id_objeto_receptor` INT NOT NULL ,
  `tipo_objeto_receptor` ENUM('REC','REM','AE','AS','PED','OC') NOT NULL ,
  PRIMARY KEY (`id_referencia_origen`) ,
  UNIQUE INDEX `id_referencia_origen_UNIQUE` (`id_referencia_origen` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
