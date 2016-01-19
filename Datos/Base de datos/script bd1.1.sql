-- MySQL Script generated by MySQL Workbench
-- 01/04/16 15:18:29
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema SGI
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema SGI
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `SGI` DEFAULT CHARACTER SET utf8 ;
USE `SGI` ;

-- -----------------------------------------------------
-- Table `SGI`.`almacen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`almacen` (
  `id_alm` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre_alm` VARCHAR(50) NOT NULL COMMENT '',
  `asignado_alm` BIT NULL DEFAULT 0 COMMENT '',
  `general_alm` BIT NULL DEFAULT 0 COMMENT '',
  `estado_alm` TINYINT(1) NULL DEFAULT 1 COMMENT '',
  PRIMARY KEY (`id_alm`)  COMMENT '',
  UNIQUE INDEX `nombre_alm_UNIQUE` (`nombre_alm` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SGI`.`TipoArticulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`TipoArticulo` (
  `idTipoArticulo` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre_tip` VARCHAR(50) NOT NULL COMMENT '',
  PRIMARY KEY (`idTipoArticulo`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SGI`.`unidad_de_Medida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`unidad_de_Medida` (
  `id_um` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre_um` VARCHAR(50) NULL COMMENT '',
  PRIMARY KEY (`id_um`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SGI`.`articulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`articulo` (
  `id_art` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre_art` VARCHAR(200) NOT NULL COMMENT '',
  `TipoArticulo_id_tip_art` INT NOT NULL COMMENT '',
  `precio_art` FLOAT NULL COMMENT '',
  `id_um` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id_art`)  COMMENT '',
  INDEX `fk_articulo_TipoArticulo1_idx` (`TipoArticulo_id_tip_art` ASC)  COMMENT '',
  INDEX `fk_articulo_unidad_de_Medida1_idx` (`id_um` ASC)  COMMENT '',
  CONSTRAINT `fk_articulo_TipoArticulo1`
    FOREIGN KEY (`TipoArticulo_id_tip_art`)
    REFERENCES `SGI`.`TipoArticulo` (`idTipoArticulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articulo_unidad_de_Medida1`
    FOREIGN KEY (`id_um`)
    REFERENCES `SGI`.`unidad_de_Medida` (`id_um`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SGI`.`movimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`movimiento` (
  `id_mov` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `tipo_mov` INT NOT NULL COMMENT '',
  `fecha_mov` DATE NOT NULL COMMENT '',
  `saldo_movimiento` FLOAT NOT NULL DEFAULT 0 COMMENT '',
  `descripcion_mov` VARCHAR(100) NULL COMMENT '',
  `cantidad_mov` FLOAT NOT NULL DEFAULT 0 COMMENT '',
  `almacen_id_alm` INT NOT NULL COMMENT '',
  `articulo_id_art` INT NOT NULL COMMENT '',
  INDEX `fk_movimiento_almacen1_idx` (`almacen_id_alm` ASC)  COMMENT '',
  INDEX `fk_movimiento_articulo1_idx` (`articulo_id_art` ASC)  COMMENT '',
  PRIMARY KEY (`id_mov`)  COMMENT '',
  CONSTRAINT `fk_movimiento_almacen1`
    FOREIGN KEY (`almacen_id_alm`)
    REFERENCES `SGI`.`almacen` (`id_alm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimiento_articulo1`
    FOREIGN KEY (`articulo_id_art`)
    REFERENCES `SGI`.`articulo` (`id_art`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SGI`.`area`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`area` (
  `id_are` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre_are` VARCHAR(100) NULL COMMENT '',
  PRIMARY KEY (`id_are`)  COMMENT '',
  UNIQUE INDEX `nombre_are_UNIQUE` (`nombre_are` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SGI`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`usuario` (
  `id_usu` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre_usu` VARCHAR(32) NULL COMMENT '',
  `clave_usu` VARCHAR(32) NULL COMMENT '',
  `permisos_usu` INT NULL COMMENT '',
  `almacen_id_alm` INT NULL COMMENT '',
  `area_id_are` INT NULL COMMENT '',
  PRIMARY KEY (`id_usu`)  COMMENT '',
  UNIQUE INDEX `usuario_usu_UNIQUE` (`nombre_usu` ASC)  COMMENT '',
  INDEX `fk_usuario_almacen1_idx` (`almacen_id_alm` ASC)  COMMENT '',
  INDEX `fk_usuario_Area1_idx` (`area_id_are` ASC)  COMMENT '',
  CONSTRAINT `fk_usuario_almacen1`
    FOREIGN KEY (`almacen_id_alm`)
    REFERENCES `SGI`.`almacen` (`id_alm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_Area1`
    FOREIGN KEY (`area_id_are`)
    REFERENCES `SGI`.`area` (`id_are`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SGI`.`pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`pedido` (
  `id_ped` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Area_id_are` INT NULL COMMENT '',
  `fecha_ped` DATE NOT NULL COMMENT '',
  `id_usu_ped` INT NOT NULL COMMENT '',
  `almacen_id_alm` INT NULL COMMENT '',
  `descripcion_ped` VARCHAR(150) NULL COMMENT '',
  PRIMARY KEY (`id_ped`)  COMMENT '',
  INDEX `fk_Pedido_Area1_idx` (`Area_id_are` ASC)  COMMENT '',
  INDEX `fk_pedido_usuario1_idx` (`id_usu_ped` ASC)  COMMENT '',
  INDEX `fk_pedido_almacen1_idx` (`almacen_id_alm` ASC)  COMMENT '',
  CONSTRAINT `fk_Pedido_Area1`
    FOREIGN KEY (`Area_id_are`)
    REFERENCES `SGI`.`area` (`id_are`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_usuario1`
    FOREIGN KEY (`id_usu_ped`)
    REFERENCES `SGI`.`usuario` (`id_usu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_almacen1`
    FOREIGN KEY (`almacen_id_alm`)
    REFERENCES `SGI`.`almacen` (`id_alm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SGI`.`detalle_pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`detalle_pedido` (
  `id_det_ped` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Pedido_id_ped` INT NOT NULL COMMENT '',
  `cantidad_art` INT NULL COMMENT '',
  `atendido_det_ped` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `procesado_det` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `articulo_id_art` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id_det_ped`, `Pedido_id_ped`)  COMMENT '',
  INDEX `fk_detalle_pedido_Pedido1_idx` (`Pedido_id_ped` ASC)  COMMENT '',
  INDEX `fk_detalle_pedido_articulo1_idx` (`articulo_id_art` ASC)  COMMENT '',
  CONSTRAINT `fk_detalle_pedido_Pedido1`
    FOREIGN KEY (`Pedido_id_ped`)
    REFERENCES `SGI`.`pedido` (`id_ped`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_pedido_articulo1`
    FOREIGN KEY (`articulo_id_art`)
    REFERENCES `SGI`.`articulo` (`id_art`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SGI`.`demanda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`demanda` (
  `id_dem` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `demanda_dem` FLOAT NULL COMMENT '',
  `costo_preparacion_dem` FLOAT NULL COMMENT '',
  `costo_almacenamiento_dem` FLOAT NULL COMMENT '',
  `articulo_id_art` INT NOT NULL COMMENT '',
  `estado_dem` BIT NULL DEFAULT 0 COMMENT '',
  `total_dem` FLOAT NULL COMMENT '',
  PRIMARY KEY (`id_dem`)  COMMENT '',
  INDEX `fk_demanda_articulo1_idx` (`articulo_id_art` ASC)  COMMENT '',
  CONSTRAINT `fk_demanda_articulo1`
    FOREIGN KEY (`articulo_id_art`)
    REFERENCES `SGI`.`articulo` (`id_art`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `SGI`.`orden_de_compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`orden_de_compra` (
  `id_orden_de_compra` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `prioridad_orden_de_compra` INT NULL COMMENT '',
  `atendido_orden_de_compra` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `almacen_id_alm` INT NULL COMMENT '',
  `fecha_orden_de_compra` DATE NOT NULL COMMENT '',
  `cantidad_orden_de_compra` FLOAT NULL COMMENT '',
  `observacion_orden_de_compra` VARCHAR(200) NULL COMMENT '',
  `articulo_id_art` INT NOT NULL COMMENT '',
  `detalle_pedido_id_det_ped` INT NOT NULL COMMENT '',
  `demanda_id_dem` INT NULL COMMENT '',
  PRIMARY KEY (`id_orden_de_compra`)  COMMENT '',
  INDEX `fk_orden_de_compra_almacen1_idx` (`almacen_id_alm` ASC)  COMMENT '',
  INDEX `fk_orden_de_compra_articulo1_idx` (`articulo_id_art` ASC)  COMMENT '',
  INDEX `fk_orden_de_compra_detalle_pedido1_idx` (`detalle_pedido_id_det_ped` ASC)  COMMENT '',
  INDEX `fk_orden_de_compra_demanda1_idx` (`demanda_id_dem` ASC)  COMMENT '',
  CONSTRAINT `fk_orden_de_compra_almacen1`
    FOREIGN KEY (`almacen_id_alm`)
    REFERENCES `SGI`.`almacen` (`id_alm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orden_de_compra_articulo1`
    FOREIGN KEY (`articulo_id_art`)
    REFERENCES `SGI`.`articulo` (`id_art`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orden_de_compra_detalle_pedido1`
    FOREIGN KEY (`detalle_pedido_id_det_ped`)
    REFERENCES `SGI`.`detalle_pedido` (`id_det_ped`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orden_de_compra_demanda1`
    FOREIGN KEY (`demanda_id_dem`)
    REFERENCES `SGI`.`demanda` (`id_dem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SGI`.`proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`proveedor` (
  `id_proveedor` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre_proveedor` VARCHAR(100) NOT NULL COMMENT '',
  `direccion_proveedor` VARCHAR(250) NULL COMMENT '',
  `ruc_proveedor` VARCHAR(10) NULL COMMENT '',
  PRIMARY KEY (`id_proveedor`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SGI`.`soluciones_det_ped`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`soluciones_det_ped` (
  `detalle_pedido_id_det_ped` INT NULL COMMENT '',
  `soluciones_det_pro` INT NULL COMMENT '',
  `soluciones_det_cant_art` FLOAT NULL COMMENT '',
  `articulo_id_art` INT NOT NULL COMMENT '',
  `diferencia_sol_det_ped` FLOAT NULL COMMENT '',
  `tipo_sol_det_ped` TINYINT(1) NULL COMMENT '',
  INDEX `fk_soluciones_det_ped_detalle_pedido1_idx` (`detalle_pedido_id_det_ped` ASC)  COMMENT '',
  INDEX `fk_soluciones_det_ped_articulo1_idx` (`articulo_id_art` ASC)  COMMENT '',
  CONSTRAINT `fk_soluciones_det_ped_detalle_pedido1`
    FOREIGN KEY (`detalle_pedido_id_det_ped`)
    REFERENCES `SGI`.`detalle_pedido` (`id_det_ped`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_soluciones_det_ped_almacen1`
    FOREIGN KEY (`soluciones_det_pro`)
    REFERENCES `SGI`.`almacen` (`id_alm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_soluciones_det_ped_articulo1`
    FOREIGN KEY (`articulo_id_art`)
    REFERENCES `SGI`.`articulo` (`id_art`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SGI`.`articulo_proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`articulo_proveedor` (
  `id_art_prov` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `articulo_id_art` INT NOT NULL COMMENT '',
  `proveedor_id_proveedor` INT NOT NULL COMMENT '',
  `articulo_proveedor_cant` INT NOT NULL COMMENT '',
  `articulo_proveedor_pre` FLOAT NOT NULL COMMENT '',
  `vigencia_art_prov` BIT NULL DEFAULT 1 COMMENT '',
  INDEX `fk_articulo_has_proveedor_proveedor1_idx` (`proveedor_id_proveedor` ASC)  COMMENT '',
  INDEX `fk_articulo_has_proveedor_articulo1_idx` (`articulo_id_art` ASC)  COMMENT '',
  PRIMARY KEY (`id_art_prov`, `proveedor_id_proveedor`, `articulo_id_art`)  COMMENT '',
  CONSTRAINT `fk_articulo_has_proveedor_articulo1`
    FOREIGN KEY (`articulo_id_art`)
    REFERENCES `SGI`.`articulo` (`id_art`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articulo_has_proveedor_proveedor1`
    FOREIGN KEY (`proveedor_id_proveedor`)
    REFERENCES `SGI`.`proveedor` (`id_proveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SGI`.`registro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SGI`.`registro` (
  `id_reg` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `id_usu_reg` INT NOT NULL COMMENT '',
  `acceso_reg` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id_reg`)  COMMENT '',
  INDEX `fk_registro2_usuario1_idx` (`id_usu_reg` ASC)  COMMENT '',
  CONSTRAINT `fk_registro2_usuario1`
    FOREIGN KEY (`id_usu_reg`)
    REFERENCES `SGI`.`usuario` (`id_usu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
