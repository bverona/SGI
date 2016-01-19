
INSERT INTO `almacen` VALUES (0,'','\0','\0',1);
INSERT INTO `almacen` VALUES (1,'Almacén General','\0','',1);
INSERT INTO `almacen` VALUES (2,'Almacen Mediano','\0','\0',0),(3,'Almacen Pequeño','','\0',1),(4,'Almacen Obras','\0','\0',1),(5,'Almacen Oficina','\0','\0',1),(6,'Almacen Extra','','\0',1),(7,'Almacen Temporal','\0','\0',1);

INSERT INTO `area` VALUES (0,'');
INSERT INTO `area` VALUES (3,'Area Alcaldía'),(1,'Area Catastro'),(2,'Area Gerencia'),(4,'Area Tesorería');

INSERT INTO `usuario` VALUES (1,'bruno','0cc175b9c0f1b6a831c399e269772661',8,NULL,NULL);
INSERT INTO `usuario` VALUES (2,'almacen','0cc175b9c0f1b6a831c399e269772661',5,1,NULL);
INSERT INTO `usuario` VALUES (3,'almacen4','0cc175b9c0f1b6a831c399e269772661',4,5,NULL);
INSERT INTO `usuario` VALUES (4,'1','c4ca4238a0b923820dcc509a6f75849b',2,NULL,1);
INSERT INTO `usuario` VALUES (5,'almacen2','0cc175b9c0f1b6a831c399e269772661',4,2,NULL);
INSERT INTO `usuario` VALUES (6,'almacen3','0cc175b9c0f1b6a831c399e269772661',4,4,NULL);
INSERT INTO `usuario` VALUES (7,'area','0cc175b9c0f1b6a831c399e269772661',2,NULL,1);
INSERT INTO `usuario` VALUES (8,'jt','cd4d776e159510e486116827b80d0368',2,NULL,3);
INSERT INTO `usuario` VALUES (9,'almacen6','0cc175b9c0f1b6a831c399e269772661',4,6,null);
INSERT INTO `usuario` VALUES (10,'almacen5','0cc175b9c0f1b6a831c399e269772661',4,3,null);
INSERT INTO `proveedor` VALUES (1,'Proveedor','Chiclayo','1234567890'),(2,'Proveedor2','Lambayeque','0987654321'),(3,'Proveedor3','Ferreñafe','1212121212'),(4,'Proveedor4','Motupe','9898989898'),(5,'Proveedor5','Jaen','0000999911');
INSERT INTO `tipoarticulo` VALUES (1,'Oficina'),(2,'Construccion'),(3,'Vehículos'),(4,'Otros');
INSERT INTO `unidad_de_medida` VALUES (1,'metros'),(2,'centimtros'),(3,'unidad'),(4,'kg'),(5,'tn'),(6,'pulgadas'),(7,'docenas'),(8,'decenas'),(9,'paquete'),(10,'bolsa'),(11,'caja'),(12,'saco'),(13,'baldes'),(14,'volquetadas'),(15,'planchas'),(16,'Litros');
INSERT INTO `articulo` VALUES (19,'Cemento rojo',2,17.5,10),(20,'yeso',2,2,10),(21,'Pintura Roja',2,19.9,11),(22,'Pintura Amarilla',2,18.9,10),(23,'piedra chancada',2,200,14),(38,'madera',2,75,3),(39,'Cemento azul',2,18.5,1),(40,'tecnopor',2,7.5,16),(41,'piedra de 1/2',4,186,2),(42,'alambre grueso',2,2.1,1),(43,'Papel bond',1,13.4,3),(44,'Caja Lapiceros',1,5.6,3),(45,'Engrapador',1,3.6,3),(46,'perforador',1,6.2,3),(47,'bujias',3,25.8,3),(48,'mantenimiento',3,300,3),(49,'Gasolina',3,15.9,16),(50,'Espejo retrovisor',3,78.9,3);
INSERT INTO `articulo_proveedor` VALUES (11,39,1,120,12.5,'0'),(12,23,1,5,78.9,'1'),(13,43,2,10,13.5,'1'),(14,47,3,6,10.35,'1'),(15,44,1,35,5.5,'0'),(16,50,2,10,35.8,'1'),(19,44,1,50,15,'0'),(20,43,1,100,13.5,'1'),(21,45,1,90,4.5,'1');
INSERT INTO `movimiento` VALUES (1,0,'2015-06-08',100,'',100,1,43),(2,0,'2015-06-08',59,'',59,1,44),(3,0,'2015-06-08',10,'',10,1,45),(4,0,'2015-06-08',20,'',20,1,38),(5,0,'2015-06-08',8,'',8,1,47),(6,1,'2015-06-08',90,'Trasferido para satisfacer la demanda requerida ',10,1,43),(7,0,'2015-06-08',10,'Trasferido para satisfacer la demanda requerida ',10,2,43),(8,1,'2015-06-09',7,'Trasferido para satisfacer la demanda requerida ',3,1,45),(9,0,'2015-06-09',3,'Trasferido para satisfacer la demanda requerida ',3,4,45),(10,0,'2015-06-10',150,'',150,1,19),(11,1,'2015-06-10',90,'',60,1,19),(12,0,'2015-06-10',60,'',60,2,19),(13,0,'2015-06-10',110,'',20,1,19),(14,0,'2015-06-11',210,'',100,1,19),(15,0,'2015-06-11',28,'',20,1,47),(16,1,'2015-06-11',16,'Trasferido para satisfacer la demanda requerida ',12,1,47),(17,0,'2015-06-11',12,'Trasferido para satisfacer la demanda requerida ',12,4,47),(18,1,'2015-06-11',105,'',105,1,19),(19,0,'2015-06-11',165,'',105,2,19),(20,1,'2015-06-11',99,'',6,1,19),(21,0,'2015-06-11',5,'',5,1,48),(22,0,'2015-06-11',100,'',1,1,19),(23,1,'2015-06-11',25,'',34,1,44),(24,0,'2015-06-11',34,'',34,3,44),(25,1,'2015-06-12',3,'',2,1,48),(26,0,'2015-06-12',2,'',2,2,48),(27,1,'2015-06-15',2,'Trasferido para satisfacer la demanda requerida ',1,1,48),(28,0,'2015-06-15',3,'Trasferido para satisfacer la demanda requerida ',1,2,48),(29,1,'2015-06-15',7,'Trasferido para satisfacer la demanda requerida ',5,4,47),(30,0,'2015-06-15',5,'Trasferido para satisfacer la demanda requerida ',5,2,47),(31,0,'2015-06-17',10,'',10,1,49),(32,1,'2015-06-26',17,'Trasferido para satisfacer la demanda requerida ',8,1,44),(33,0,'2015-06-26',8,'Trasferido para satisfacer la demanda requerida ',8,4,44),(34,1,'2015-07-10',60,'Trasferido para satisfacer la demanda requerida ',30,1,43),(35,0,'2015-07-10',40,'Trasferido para satisfacer la demanda requerida ',30,2,43),(36,1,'2015-10-29',90,'Trasferido para satisfacer la demanda requerida ',10,1,19),(37,0,'2015-10-29',10,'Trasferido para satisfacer la demanda requerida ',10,3,19),(38,1,'2015-11-05',145,'',20,2,19),(39,0,'2015-11-05',20,'',20,5,19),(40,1,'2015-11-05',125,'',20,2,19),(41,0,'2015-11-05',40,'',20,5,19),(42,1,'2015-11-05',121,'',4,2,19),(43,1,'2015-11-05',120,'',1,2,19),(44,1,'2015-11-05',119,'',1,2,19),(45,1,'2015-11-05',118,'',1,2,19),(46,1,'2015-11-06',117,'',1,2,19),(47,1,'2015-11-06',116,'',1,2,19),(48,0,'2015-11-06',1,'',1,4,19),(49,1,'2015-11-06',115,'',1,2,19),(50,0,'2015-11-06',1,'',1,6,19),(51,1,'2015-11-06',35,'-',5,2,43),(52,0,'2015-11-06',5,'-',5,3,43),(53,1,'2015-11-06',30,'-',5,2,43),(54,0,'2015-11-06',10,'-',5,3,43),(55,1,'2015-11-07',89,'',1,1,19),(56,1,'2015-11-07',18,'',2,1,38),(57,1,'2015-11-07',18,'',2,1,38),(58,1,'2015-11-07',17,'',1,1,38),(59,1,'2015-11-07',15,'',1,1,47),(60,1,'2015-11-07',16,'',1,1,38),(61,0,'2015-11-07',100,'',100,1,39),(62,1,'2015-11-07',99,'',1,1,39),(63,1,'2015-11-07',97,'',2,1,39),(64,1,'2015-11-07',16,'',1,1,44),(65,1,'2015-11-07',59,'',1,1,43),(66,1,'2015-11-07',9,'',1,1,49),(67,1,'2015-11-07',88,'-',1,1,19),(68,1,'2015-11-07',80,'-',8,1,19),(69,1,'2015-11-07',100,'',15,2,19),(70,0,'2015-11-07',150,'',150,1,22),(71,0,'2015-11-07',35,'',20,1,47),(72,0,'2015-11-09',12,'mantenimiento',10,1,48),(73,0,'2015-11-09',4,'perforadores',4,1,46),(74,0,'2015-11-09',15,'bujías',10,2,47),(75,0,'2015-11-09',4,'Lapiceros azules Pilot',4,2,44),(76,0,'2015-11-09',8,'para vehículos',5,2,48),(77,0,'2015-11-09',15,'Para fachada',15,2,22),(78,1,'2015-11-10',23,'Trasferido para satisfacer la demanda requerida ',12,1,47),(79,1,'2015-11-10',3,'Trasferido para satisfacer la demanda requerida ',12,2,47),(80,1,'2015-11-10',11,'Trasferido para satisfacer la demanda requerida ',12,1,47),(81,0,'2015-11-10',200,'',200,1,42),(82,1,'2015-11-10',100,'Trasferido para satisfacer la demanda requerida ',100,1,42),(83,1,'2015-11-10',0,'Trasferido para satisfacer la demanda requerida ',100,1,42),(84,0,'2015-11-10',100,'Trasferido para satisfacer la demanda requerida ',100,4,42),(85,0,'2015-11-10',111,'',100,1,47),(86,1,'2015-11-10',99,'Trasferido para satisfacer la demanda requerida ',12,1,47),(87,0,'2015-11-10',19,'Trasferido para satisfacer la demanda requerida ',12,4,47),(88,1,'2015-11-11',87,'Trasferido para satisfacer la demanda requerida ',12,1,47),(89,0,'2015-11-11',31,'Trasferido para satisfacer la demanda requerida ',12,4,47),(90,0,'2015-11-17',100,'',100,1,50),(91,1,'2015-11-17',80,'',20,1,50),(92,1,'2015-11-17',65,'',15,1,50),(93,0,'2015-11-17',70,'sin descripción',5,1,50),(94,1,'2015-11-17',0,'',100,2,19),(95,0,'2015-11-17',180,'',100,1,19),(96,1,'2015-11-17',0,'',15,2,22),(97,0,'2015-11-17',165,'',15,1,22),(98,1,'2015-11-17',0,'',30,2,43),(99,0,'2015-11-17',89,'',30,1,43),(100,1,'2015-11-17',0,'',4,2,44),(101,0,'2015-11-17',20,'',4,1,44),(102,1,'2015-11-17',0,'',3,2,47),(103,0,'2015-11-17',90,'',3,1,47),(104,1,'2015-11-17',0,'',8,2,48),(105,0,'2015-11-17',20,'',8,1,48),(106,0,'2015-11-22',41,'',25,1,38),(107,1,'2015-11-22',16,'Trasferido para satisfacer la demanda requerida ',25,1,38),(108,0,'2015-11-22',25,'Trasferido para satisfacer la demanda requerida ',25,2,38),(109,0,'2015-11-22',15,'',6,1,49),(110,1,'2015-11-22',5,'Trasferido para satisfacer la demanda requerida ',10,1,49),(111,0,'2015-11-22',10,'Trasferido para satisfacer la demanda requerida ',10,2,49),(112,1,'2015-11-22',0,'',5,1,49),(113,1,'2015-11-30',0,'',1,4,19),(114,1,'2015-11-30',0,'',40,5,19),(115,1,'2015-11-30',0,'',10,3,19),(116,1,'2015-11-30',0,'',1,6,19),(117,1,'2015-11-30',50,'',115,1,22),(118,1,'2015-11-30',50,'',130,1,19);





-- usuarios ok
-- usuarios con privilegios,estos usuarios se crearán una vez y no podrán eliminarse
insert into usuario (nombre_usu, clave_usu, permisos_usu) values('bruno',md5('a'),8 );
insert into usuario (nombre_usu, clave_usu, permisos_usu) values('almacen',md5('a'),5 );


-- almacenes ok
-- almacen generál no podrá ser eliminado o Modificado 
insert into almacen (nombre_alm,general_alm) values('Almacén General',1);
update usuario set almacen_id_alm=1 where nombre_usu='almacen';

-- almacenes normales
insert into almacen (nombre_alm) values('Almacen Mediano');
insert into almacen (nombre_alm) values('Almacen Pequeño');
insert into almacen (nombre_alm) values('Almacen Obras');
insert into almacen (nombre_alm) values('Almacen Oficina');
insert into almacen (nombre_alm) values('Almacen Extra');
insert into almacen (nombre_alm) values('');
UPDATE almacen SET id_alm=0,nombre_alm="" WHERE nombre_alm='';

-- areas ok
insert into area(nombre_are) values('Area Catastro');
insert into area(nombre_are) values('Area Gerencia');
insert into area(nombre_are) values('Area Alcaldía');
insert into area(nombre_are) values('Area Tesorería');
insert into area(nombre_are) values('');
UPDATE area SET id_are=0,nombre_are="" WHERE `nombre_are`='';

-- tipo Artículo

insert into tipoArticulo(nombre_tip)values
("Oficina"),
("Construccion"),
("Vehículos"),
("Otros");


-- unidades de medida
INSERT INTO `sgi`.`unidad_de_medida`
(`nombre_um`)
VALUES
("metros"),-- 1
("centimtros"),
("unidad"),-- 3
("kg"),
("tn"),-- 5
("pulgadas"),
("docenas"),-- 7
("decenas"),
("paquete"),-- 9
("bolsa"),
("caja"),-- 11
("saco"),
("baldes"),-- 13
("volquetadas"),
("planchas"),-- 15
("Litros")
;


insert into articulo(nombre_art,TipoArticulo_id_tip_art,id_um) values 
('Cemento rojo',2,10),
('yeso', 2,10),
('Pintura Roja', 2,11),
('Pintura Amarilla',2,10),
('piedra chancada', 2,14),
('madera', 2,3),
('Cemento azul', 2,1),
('tecnopor', 2,16),
('piedra de 1/2',4, 2),
('alambre grueso',2,1),
('Papel bond', 1,3),
('Caja Lapiceros',1,3),
('Engrapador',1,3),
('perforador', 1,3),
('bujías', 3,3),
('mantenimiento', 3,3),
('Gasolina', 3,16),
('Espejo retrovisor',3,3);


-- Proveedores
insert into proveedor (nombre_proveedor,direccion_proveedor,ruc_proveedor)values ('Proveedor','Chiclayo','1234567890');
insert into proveedor (nombre_proveedor,direccion_proveedor,ruc_proveedor)values ('Proveedor2','Lambayeque','0987654321');
insert into proveedor (nombre_proveedor,direccion_proveedor,ruc_proveedor)values ('Proveedor3','Ferreñafe','1212121212');
insert into proveedor (nombre_proveedor,direccion_proveedor,ruc_proveedor)values ('Proveedor4','Motupe','9898989898');
insert into proveedor (nombre_proveedor,direccion_proveedor,ruc_proveedor)values ('Proveedor5','Jaen','0000999911');


INSERT INTO `usuario` (`nombre_usu`,`clave_usu`,`permisos_usu`,`almacen_id_alm`,`area_id_are`) VALUES ('1','c4ca4238a0b923820dcc509a6f75849b',2,NULL,1);
INSERT INTO `usuario` (`nombre_usu`,`clave_usu`,`permisos_usu`,`almacen_id_alm`,`area_id_are`) VALUES ('almacen2','0cc175b9c0f1b6a831c399e269772661',4,2,NULL);
INSERT INTO `usuario` (`nombre_usu`,`clave_usu`,`permisos_usu`,`almacen_id_alm`,`area_id_are`) VALUES ('almacen3','0cc175b9c0f1b6a831c399e269772661',4,4,NULL);
INSERT INTO `usuario` (`nombre_usu`,`clave_usu`,`permisos_usu`,`almacen_id_alm`,`area_id_are`) VALUES ('area','0cc175b9c0f1b6a831c399e269772661',2,NULL,1);
INSERT INTO `usuario` (`nombre_usu`,`clave_usu`,`permisos_usu`,`almacen_id_alm`,`area_id_are`) VALUES ('jt','cd4d776e159510e486116827b80d0368',2,NULL,3);
INSERT INTO `usuario` (`nombre_usu`,`clave_usu`,`permisos_usu`,`almacen_id_alm`,`area_id_are`) VALUES ('a','0cc175b9c0f1b6a831c399e269772661',2,NULL,4);
INSERT INTO `usuario` (`nombre_usu`,`clave_usu`,`permisos_usu`,`almacen_id_alm`,`area_id_are`) VALUES ('b','92eb5ffee6ae2fec3ad71c777531578f',4,3,NULL);
INSERT INTO `usuario` (`nombre_usu`,`clave_usu`,`permisos_usu`,`almacen_id_alm`,`area_id_are`) VALUES ('almacen4','0cc175b9c0f1b6a831c399e269772661',4,5,NULL);


INSERT INTO orden_de_compra
(
prioridad_orden_de_compra,
atendido_orden_de_compra,
almacen_id_alm,
fecha_orden_de_compra,
cantidad_orden_de_compra,
observacion_orden_de_compra,
articulo_id_art,
detalle_pedido_id_det_ped
)
VALUES
(1,0,3,('2015-06-17'),4,'Ninguna',19,3);








