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


insert into orden_de_compra 
            ( 
                prioridad_orden_de_compra,
                atendido_orden_de_compra,
                almacen_id_alm,
                fecha_orden_de_compra,
                hora_orden_de_compra,
                cantidad_orden_de_compra,
                observacion_orden_de_compra,
                articulo_id_art,
                articulo_proveedor_id_art,
                articulo_proveedor_id_prov
            )
            values
            (0,false,3,);







