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

-- ok
-- tipo Artículo
insert into tipoArticulo(nombre_tip)values
("Oficina"),
("Construccion"),
("Vehículos");
/*
CREATE TRIGGER Inserta_moviento_almacen before INSERT on almacen
for each row
insert into movimiento(tipo_mov, almacen_id_alm,fecha_det_mov)
values(1,NEW.id_alm,Date('d-m-Y'));
insert into movimiento(tipo_mov, almacen_id_alm,fecha_det_mov)
values(2,NEW.id_alm,Date('d-m-Y'));
2 si va a insertar uno nuevo artículo registrarlo, si ya existe ,
toma el historial del artículo y trabaja con eso.
*/
insert into articulo(nombre_art,unidad_art,cantidad_art,TipoArticulo_id_tip_art) values
('Cemento rojo',' bolsas', 100,2),
('yeso','bolsas', 50,2),
('Pintura Roja','baldes', 60,2),
('Pintura Amarilla','bolsas', 50,2),
('piedra chancada','volquetadas', 9,2),
('madera','unidades', 35,2),
('Cemento azul',' bolsas', 120,2),
('tecnopor',' planchas', 80,2),
('piedra de 1/2','volquetada', 10,2),
('alambre grueso','metros', 500,2),
('Papel bond','medio millar', 20,1),
('Caja Lapiceros','Unidad', 8,1),
('Engrapador','unidad', 10,1),
('perforador','unidad', 9,1),
('bujías','unidad', 6,3),
('mantenimiento','unidad', 3,3),
('Gasolina','litros', 50,3),
('Espejo retrovisor','unidad', 1,3);

/* FALTA
Procedimientos para registrar en el kardex
TABLAS: Movimiento - Detalle Movimiento - Producto
** 1
lo ideal ser?a, que por cada almacen, se creen triggers que registren los movimientos
de entrada y salida respectivamente, esto para que el registro de entradas y salidas se
lleve a cabo en la tabla detalle movimiento.
1 entrada, 0 salida
*/
-- almacen Grandemovimiento
insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(0,1,'12/12/14');
insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(1,1,'12/2/13');
-- almacen Mediano
insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(0,2,'01/2/11');
insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(1,2,'10/11/14');
-- almacen Peque?o
insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(0,3,'12/5/14');
insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(1,3,'15/6/14');
-- almacen Obras
insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(0,4,'10/8/14');
insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(1,4,'08/11/14');
-- almacen Oficina
insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(0,5,'30/4/14');
insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(1,1,'26/5/14');

insert into detalle_movimiento
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

-- Pedido
insert into pedido (area_id_are,fecha_ped) values(1,'2014/09/17');
insert into pedido (area_id_are,fecha_ped) values(2,'2014/08/24');
insert into pedido (area_id_are,fecha_ped) values(3,'2014/12/18');
insert into pedido (area_id_are,fecha_ped) values(4,'2014/10/30');

-- Detalle Pedido
insert into detalle_pedido(Pedido_id_ped,articulo_id_art,cantidad_art)values(1,1,1);
insert into detalle_pedido(Pedido_id_ped,articulo_id_art,cantidad_art)values(2,2,1);
insert into detalle_pedido(Pedido_id_ped,articulo_id_art,cantidad_art)values(1,4,1);
insert into detalle_pedido(Pedido_id_ped,articulo_id_art,cantidad_art)values(1,1,1);






