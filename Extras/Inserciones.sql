-- usuarios ok
-- usuarios con privilegios,estos usuarios se crearán una vez y no podrán eliminarse
insert into usuario (nombre_usu, clave_usu, permisos_usu) values('bruno',md5('bruno'),8 );
insert into usuario (nombre_usu, clave_usu, permisos_usu) values('almacen',md5('almacen'),5 );


-- almacenes ok
-- almacen generál no podrá ser eliminado o Modificado 
insert into almacen (nombre_alm,general_alm) values('Almacén General',1);
update usuario set almacen_id_alm=1 where nombre_usu='almacen';

-- almacenes normales
insert into almacen (nombre_alm) values('Almacen Mediano');
insert into almacen (nombre_alm) values('Almacen Pequeño');
insert into almacen (nombre_alm) values('Almacen Obras');
insert into almacen (nombre_alm) values('Almacen Oficina');
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
("Construccion"),
("Vehículos");

insert into articulo(nombre_art,unidad_art,TipoArticulo_id_tip_art) values 
('Cemento rojo',' bolsas',2),
('yeso','bolsas', 2),
('Pintura Roja','baldes', 2),
('Pintura Amarilla','bolsas', 2),
('piedra chancada','volquetadas', 2),
('madera','unidades', 2),
('Cemento azul',' bolsas', 2),
('tecnopor',' planchas', 2),
('piedra de 1/2','volquetada', 2),
('alambre grueso','metros', 2),
('Papel bond','medio millar', 1),
('Caja Lapiceros','Unidad', 1),
('Engrapador','unidad', 1),
('perforador','unidad', 1),
('bujías','unidad', 3),
('mantenimiento','unidad', 3),
('Gasolina','litros', 3),
('Espejo retrovisor','unidad', 3);

-- insert into articulo(nombre_art,unidad_art,cantidad_art,TipoArticulo_id_tip_art) values 
-- ('Cemento rojo',' bolsas', 100,2),
-- ('yeso','bolsas', 50,2),
-- ('Pintura Roja','baldes', 60,2),
-- ('Pintura Amarilla','bolsas', 50,2),
-- ('piedra chancada','volquetadas', 9,2),
-- ('madera','unidades', 35,2),
-- ('Cemento azul',' bolsas', 120,2),
-- ('tecnopor',' planchas', 80,2),
-- ('piedra de 1/2','volquetada', 10,2),
-- ('alambre grueso','metros', 500,2),
-- ('Papel bond','medio millar', 20,1),
-- ('Caja Lapiceros','Unidad', 8,1),
-- ('Engrapador','unidad', 10,1),
-- ('perforador','unidad', 9,1),
-- ('bujías','unidad', 6,3),
-- ('mantenimiento','unidad', 3,3),
-- ('Gasolina','litros', 50,3),
-- ('Espejo retrovisor','unidad', 1,3);




-- Pedido ok
-- insert into pedido (area_id_are,fecha_ped,id_usu_ped) values(1,'2014/09/17',2);
-- insert into pedido (area_id_are,fecha_ped,id_usu_ped) values(2,'2014/08/24',3);
-- insert into pedido (area_id_are,fecha_ped,id_usu_ped) values(3,'2014/12/18',3);
-- insert into pedido (area_id_are,fecha_ped,id_usu_ped) values(4,'2014/10/30',2);
-- 
-- 
-- insert into detalle_pedido(Pedido_id_ped,articulo_id_art,cantidad_art)
--                     values(1,2,2);


-- insert into detalle_pedido(Pedido_id_ped,articulo_id_art,cantidad_art)values(1,1,2);
-- insert into detalle_pedido(Pedido_id_ped,articulo_id_art,cantidad_art)values(1,2,4);
-- insert into detalle_pedido(Pedido_id_ped,articulo_id_art,cantidad_art)values(1,3,5);
-- insert into detalle_pedido(Pedido_id_ped,articulo_id_art,cantidad_art)values(1,4,3);

/*
 0 entrada, 1 salida
 */

-- -- almacen Grandemovimiento
--  insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(0,1,'12/12/14');
--  insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(1,1,'12/2/13');
-- 
--  -- almacen Mediano
--  insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(0,2,'01/2/11');
--  insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(1,2,'10/11/14');
--  
--  -- almacen Peque?o
--  insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(0,3,'12/5/14');
--  insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(1,3,'15/6/14');
-- 
--  -- almacen Obras
--  insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(0,4,'10/8/14');
--  insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(1,4,'08/11/14');
-- 
--  -- almacen Oficina
--  insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(0,5,'30/4/14');
--  insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(1,1,'26/5/14');
-- -- ok 



-- insert into detalle_movimiento (
--                 movimiento_id_mov,
--                 articulo_id_art,
--                 cantidad_det_mov)
--             values(1,1,50);


/*insert into detalle_movimiento 
(
	movimiento_id_mov,
	descripcion_det_mov,
	articulo_id_art,
	cantidad_det_mov
 ) 
values 
(2,'compra reciente',1,20),
(4,'compra reciente',2,30),
(6,'compra reciente',3,50),
(8,'compra reciente',4,30),
(10,'compra antigua',5,200);
*/
                                           