-- usuarios
insert into usuario (nombre_usu, clave_usu, permisos_usu) values('bruno',md5('bruno'),8 );
insert into usuario (nombre_usu, clave_usu, permisos_usu) values('almacen',md5('almacen'),4 );
insert into usuario (nombre_usu, clave_usu, permisos_usu) values('area',md5('area'),2 );
-- almacenes
insert into almacen (nombre_alm) values('Almac�n Grande');
insert into almacen (nombre_alm) values('Almac�n Mediano');
insert into almacen (nombre_alm) values('Almac�n Peque�o');
insert into almacen (nombre_alm) values('Almac�n Obras');
insert into almacen (nombre_alm) values('Almac�n Oficina');

-- �reas
insert into area(nombre_are) values('Area Catastro');
insert into area(nombre_are) values('Area Gerencia');
insert into area(nombre_are) values('Area Alcald�a');
insert into area(nombre_are) values('Area Tesorer�a');
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
insert into detalle_pedido(Pedido_id_ped,descripcion_det_ped)values(1,"Caja de l�pices");










