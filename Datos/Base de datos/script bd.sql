-- -----------------------------------------------------
-- Table almacen
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS almacen (
  id_alm INT NOT NULL AUTO_INCREMENT,
  nombre_alm VARCHAR(100) NOT NULL,
  asignado_alm BIT NULL DEFAULT 0,
  general_alm BIT NULL DEFAULT 0,
  PRIMARY KEY (id_alm),
  UNIQUE INDEX nombre_alm_UNIQUE (nombre_alm ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table TipoArticulo
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS TipoArticulo (
  idTipoArticulo INT NOT NULL AUTO_INCREMENT,
  nombre_tip VARCHAR(50) NOT NULL,
  PRIMARY KEY (idTipoArticulo))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table articulo
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS articulo (
  id_art INT NOT NULL AUTO_INCREMENT,
  nombre_art VARCHAR(200) NOT NULL,
  unidad_art VARCHAR(45) NULL,
  cantidad_art INT NULL,
  TipoArticulo_id_tip_art INT NOT NULL,
  codigo_art VARCHAR(30) NULL,
  precio_art FLOAT NULL,
  PRIMARY KEY (id_art),
  INDEX fk_articulo_TipoArticulo1_idx (TipoArticulo_id_tip_art ASC),
  CONSTRAINT fk_articulo_TipoArticulo1
    FOREIGN KEY (TipoArticulo_id_tip_art)
    REFERENCES TipoArticulo (idTipoArticulo)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table movimiento
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS movimiento (
  id_mov INT NOT NULL AUTO_INCREMENT,
  tipo_mov INT NOT NULL,
  fecha_mov DATE NOT NULL,
  saldo_movimiento FLOAT NOT NULL DEFAULT 0,
  descripcion_mov VARCHAR(100) NULL,
  cantidad_mov FLOAT NOT NULL DEFAULT 0,
  almacen_id_alm INT NOT NULL,
  articulo_id_art INT NOT NULL,
  INDEX fk_movimiento_almacen1_idx (almacen_id_alm ASC),
  INDEX fk_movimiento_articulo1_idx (articulo_id_art ASC),
  PRIMARY KEY (id_mov),
  CONSTRAINT fk_movimiento_almacen1
    FOREIGN KEY (almacen_id_alm)
    REFERENCES almacen (id_alm)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_movimiento_articulo1
    FOREIGN KEY (articulo_id_art)
    REFERENCES articulo (id_art)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table area
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS area (
  id_are INT NOT NULL AUTO_INCREMENT,
  nombre_are VARCHAR(100) NULL,
  PRIMARY KEY (id_are),
  UNIQUE INDEX nombre_are_UNIQUE (nombre_are ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table usuario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS usuario (
  id_usu INT NOT NULL AUTO_INCREMENT,
  nombre_usu VARCHAR(32) NULL,
  clave_usu VARCHAR(32) NULL,
  permisos_usu INT NULL,
  almacen_id_alm INT NULL,
  area_id_are INT NULL,
  PRIMARY KEY (id_usu),
  UNIQUE INDEX usuario_usu_UNIQUE (nombre_usu ASC),
  INDEX fk_usuario_almacen1_idx (almacen_id_alm ASC),
  INDEX fk_usuario_Area1_idx (area_id_are ASC),
  CONSTRAINT fk_usuario_almacen1
    FOREIGN KEY (almacen_id_alm)
    REFERENCES almacen (id_alm)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_usuario_Area1
    FOREIGN KEY (area_id_are)
    REFERENCES area (id_are)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table pedido
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS pedido (
  id_ped INT NOT NULL AUTO_INCREMENT,
  Area_id_are INT NULL,
  fecha_ped DATE NOT NULL,
  id_usu_ped INT NOT NULL,
  almacen_id_alm INT NULL,
  descripcion_ped VARCHAR(150) NULL,
  PRIMARY KEY (id_ped),
  INDEX fk_Pedido_Area1_idx (Area_id_are ASC),
  INDEX fk_pedido_usuario1_idx (id_usu_ped ASC),
  INDEX fk_pedido_almacen1_idx (almacen_id_alm ASC),
  CONSTRAINT fk_Pedido_Area1
    FOREIGN KEY (Area_id_are)
    REFERENCES area (id_are)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_pedido_usuario1
    FOREIGN KEY (id_usu_ped)
    REFERENCES usuario (id_usu)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_pedido_almacen1
    FOREIGN KEY (almacen_id_alm)
    REFERENCES almacen (id_alm)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table detalle_pedido
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS detalle_pedido (
  id_det_ped INT NOT NULL AUTO_INCREMENT,
  Pedido_id_ped INT NOT NULL,
  articulo_id_art INT NOT NULL,
  cantidad_art INT NULL,
  atendido_det_ped TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (id_det_ped, Pedido_id_ped),
  INDEX fk_detalle_pedido_Pedido1_idx (Pedido_id_ped ASC),
  INDEX fk_detalle_pedido_articulo1_idx (articulo_id_art ASC),
  CONSTRAINT fk_detalle_pedido_Pedido1
    FOREIGN KEY (Pedido_id_ped)
    REFERENCES pedido (id_ped)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_detalle_pedido_articulo1
    FOREIGN KEY (articulo_id_art)
    REFERENCES articulo (id_art)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table registro
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS registro (
  id_reg INT NOT NULL AUTO_INCREMENT,
  id_usu_reg INT NOT NULL,
  fecha_reg DATE NOT NULL,
  hora_reg TIME NULL,
  PRIMARY KEY (id_reg),
  INDEX fk_Registro_usuario1_idx (id_usu_reg ASC),
  CONSTRAINT fk_Registro_usuario1
    FOREIGN KEY (id_usu_reg)
    REFERENCES usuario (id_usu)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table orden_de_compra
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS orden_de_compra (
  id_orden_de_compra INT NOT NULL AUTO_INCREMENT,
  prioridad_orden_de_compra INT NULL,
  atendido_orden_de_compra TINYINT(1) NULL DEFAULT 0,
  almacen_id_alm INT NULL,
  fecha_orden_de_compra DATE NOT NULL,
  hora_orden_de_compra TIME NOT NULL,
  cantidad_orden_de_compra FLOAT NULL,
  observacion_orden_de_compra VARCHAR(200) NULL,
  articulo_id_art INT NOT NULL,
  PRIMARY KEY (id_orden_de_compra),
  INDEX fk_orden_de_compra_almacen1_idx (almacen_id_alm ASC),
  INDEX fk_orden_de_compra_articulo1_idx (articulo_id_art ASC),
  CONSTRAINT fk_orden_de_compra_almacen1
    FOREIGN KEY (almacen_id_alm)
    REFERENCES almacen (id_alm)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_orden_de_compra_articulo1
    FOREIGN KEY (articulo_id_art)
    REFERENCES articulo (id_art)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table proveedor
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS proveedor (
  id_proveedor INT NOT NULL,
  nombre_proveedor VARCHAR(100) NOT NULL,
  direccion_proveedor VARCHAR(250) NULL,
  ruc_proveedor VARCHAR(10) NULL,
  detalle_orden_compra_id_detalle_orden_compra INT NOT NULL,
  orden_de_compra_id_orden_de_compra INT NOT NULL,
  PRIMARY KEY (id_proveedor),
  INDEX fk_proveedor_orden_de_compra1_idx (orden_de_compra_id_orden_de_compra ASC),
  CONSTRAINT fk_proveedor_orden_de_compra1
    FOREIGN KEY (orden_de_compra_id_orden_de_compra)
    REFERENCES orden_de_compra (id_orden_de_compra)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table unidad_de_medida
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS unidad_de_medida (
  id_unidad_de_medida INT NOT NULL,
  nombre_unidad_de_medida VARCHAR(100) NOT NULL,
  PRIMARY KEY (id_unidad_de_medida))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table articulo_has_unidad_de_medida
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS articulo_has_unidad_de_medida (
  articulo_id_art INT NOT NULL,
  unidad_de_medida_id_unidad_de_medida INT NOT NULL,
  PRIMARY KEY (articulo_id_art, unidad_de_medida_id_unidad_de_medida),
  INDEX fk_articulo_has_unidad_de_medida_unidad_de_medida1_idx (unidad_de_medida_id_unidad_de_medida ASC),
  INDEX fk_articulo_has_unidad_de_medida_articulo1_idx (articulo_id_art ASC),
  CONSTRAINT fk_articulo_has_unidad_de_medida_articulo1
    FOREIGN KEY (articulo_id_art)
    REFERENCES articulo (id_art)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_articulo_has_unidad_de_medida_unidad_de_medida1
    FOREIGN KEY (unidad_de_medida_id_unidad_de_medida)
    REFERENCES unidad_de_medida (id_unidad_de_medida)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


