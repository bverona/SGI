-- usuarios
insert into usuario (nombre_usu, clave_usu, permisos_usu) values('bruno',md5('bruno'),8 );
insert into usuario (nombre_usu, clave_usu, permisos_usu) values('almacen',md5('almacen'),4 );
insert into usuario (nombre_usu, clave_usu, permisos_usu) values('area',md5('area'),2 );
-- almacenes
insert into almacen (nombre_alm) values('Almacén Grande');
insert into almacen (nombre_alm) values('Almacén Mediano');
insert into almacen (nombre_alm) values('Almacén Pequeño');
insert into almacen (nombre_alm) values('Almacén Obras');
insert into almacen (nombre_alm) values('Almacén Oficina');

-- áreas
insert into area(nombre_are) values('Area Catastro');
insert into area(nombre_are) values('Area Gerencia');
insert into area(nombre_are) values('Area Alcaldía');
insert into area(nombre_are) values('Area Tesorería');
insert into area(nombre_are) values('Area Tributos');


-- Pedido
insert into pedido (area_id_are,fecha_ped) values(1,'2014/09/17');
insert into pedido (area_id_are,fecha_ped) values(2,'2014/08/24');
insert into pedido (area_id_are,fecha_ped) values(3,'2014/12/18');
insert into pedido (area_id_are,fecha_ped) values(4,'2014/10/30');

-- Detalle Pedido
insert into detalle_pedido(Pedido_id_ped,descripcion_det_ped)values(1,"Caja de lapiceros");
insert into detalle_pedido(Pedido_id_ped,descripcion_det_ped)values(1,"Papel Bond");
insert into detalle_pedido(Pedido_id_ped,descripcion_det_ped)values(1,"Tinta para impresora");
insert into detalle_pedido(Pedido_id_ped,descripcion_det_ped)values(1,"Caja de lápices");

/*
Procedimientos para registrar en el kardex
TABLAS: Movimiento - Detalle Movimiento - Producto
** 1
 lo ideal sería, que por cada almacen, se creen triggers que registren los movimientos
 de entrada y salida respectivamente, esto para que el registro de entradas y salidas se
 lleve a cabo en la tabla detalle movimiento.
 1 entrada, 0 salida
 */

-- almacen Grande
 insert into movimiento (tipo_mov, almacen_id_alm) values(0,1);
 insert into movimiento (tipo_mov, almacen_id_alm) values(1,1);

 -- almacen Mediano
 insert into movimiento (tipo_mov, almacen_id_alm) values(0,2);
 insert into movimiento (tipo_mov, almacen_id_alm) values(1,2);
 
 -- almacen Pequeño
 insert into movimiento (tipo_mov, almacen_id_alm) values(0,3);
 insert into movimiento (tipo_mov, almacen_id_alm) values(1,3);

 -- almacen Obras
 insert into movimiento (tipo_mov, almacen_id_alm) values(0,4);
 insert into movimiento (tipo_mov, almacen_id_alm) values(1,4);

 -- almacen Oficina
 insert into movimiento (tipo_mov, almacen_id_alm) values(0,5);
 insert into movimiento (tipo_mov, almacen_id_alm) values(1,1);

/*
2 si va a insertar uno nuevo artículo registrarlo, si ya existe , 
toma el historial del artículo y trabaja con eso.
*/
insert into articulo(nombre_art,unidad_art,cantidad_art) values 
('Cemento rojo',' bolsas', 100),
('yeso','bolsas', 50),
('Pintura Roja','baldes', 60),
('Pintura Amarilla','bolsas', 50),
('piedra chancada','volquetadas', 9),
('madera','unidades', 35),
('Cemento azul',' bolsas', 120),
('tecnopor',' planchas', 80),
('piedra de 1/2','volquetada', 10),
('alambre grueso','metros', 500);

insert into detalle_movimiento 
(
	movimiento_id_mov,
	descripcion_det_mov,
	articulo_id_art,
	cantidad_det_mov,
	fecha_det_mov
 ) 
values 
(2,'compra reciente',1,20,'2014/10/10'),
(4,'compra reciente',2,30,'2014/09/10'),
(6,'compra reciente',3,50,'2014/03/11'),
(8,'compra reciente',4,30,'2014/09/10'),
(10,'compra antigua',5,200,'2014/12/12');









