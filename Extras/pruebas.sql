


select 
    id_proveedor as id,
    nombre_proveedor as nombre,
    ruc_proveedor as ruc
from proveedor;



update 

select  
                        ap.proveedor_id_proveedor as id, 
                        a.nombre_art as articulo, 
                        ap.articulo_proveedor_pre as precio, 
                        p.nombre_proveedor as proveedor, 
                        ap.articulo_proveedor_cant as cantidad
                from    
                        articulo_proveedor ap  inner join
                        proveedor p on ap.proveedor_id_proveedor=p.id_proveedor
                        inner join articulo a on a.id_art=ap.articulo_id_art;


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
            (
                
            )

select * from orden_de_compra;

select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        art.unidad_art as unidad,
                        t.nombre_tip as tipo,
                        a.nombre_alm as almacen,
                        a.id_alm as idAlm
                    from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        where m.almacen_id_alm=5 
                        group by art.nombre_art
                   order by 1;

select 
                    id_alm,
                    nombre_alm,
                    asignado_alm as asignado,
                    case
                    when estado_alm = 1 then  'Activo' 
                    when estado_alm = 0 then 'Inactivo'
                    end as estado
                from
                    almacen
                where
                    id_alm <> 0 and general_alm = 0
                order by 1;

update almacen set estado_alm=0 where id_alm= ;

select * from almacen;


insert into 
    articulo_proveedor 
        (
            articulo_id_art,
            proveedor_id_proveedor,
            articulo_proveedor_cant,
            articulo_proveedor_pre
        )
values 
        (16,3,20,4.5);

select  
                        ap.proveedor_id_proveedor as id, 
                        a.nombre_art as articulo, 
                        ap.articulo_proveedor_pre as precio, 
                        p.nombre_proveedor as proveedor, 
                        ap.articulo_proveedor_cant 
                from    
                        articulo_proveedor ap  inner join
                        proveedor p on ap.proveedor_id_proveedor=p.id_proveedor
                        inner join articulo a on a.id_art=ap.articulo_id_art
                where a.id_art=1;

select * from soluciones_det_ped;


insert INTO soluciones_det_ped 
            (
                detalle_pedido_id_det_ped,
                soluciones_alm_pro
            )    
            VALUES (10, 5);
select 
                        art.id_art as articulo,
                        art.nombre_art as nombre,
                        art.unidad_art as unidad,
                        a.nombre_alm as nombre_almacen,
                        a.id_alm as almacen
                   from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        group by art.nombre_art, almacen
                        order by 5;


select 
                        dp.id_det_ped as id_dp,
                        art.id_art as articulo,
                        art.nombre_art as nombre,
                        a.id_alm as almacen,
                        dp.cantidad_art as cantidad
                    from
                        almacen a
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                        where dp.atendido_det_ped=0;


 select 
                        art.id_art as articulo,
                        a.id_alm as almacen
                   from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        group by  almacen;

select 
                        art.id_art as id_articulo,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        p.fecha_ped as fecha,
                        case
                        when dp.atendido_det_ped = 0 then 'No atendido'
                        when dp.atendido_det_ped = 1 then 'Atendido' 
                        end
                        as atendido
                    from
                        almacen a
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                        where p.almacen_id_alm<>0 
                        and
                        dp.atendido_det_ped=0;

select 
                        a.nombre_alm as almacen,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha,
                        dp.atendido_det_ped as atendido
                    from
                        almacen a
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                        where p.almacen_id_alm<>0



select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        art.unidad_art as unidad,
                        t.nombre_tip as tipo,
                        a.nombre_alm as almacen,
                        a.id_alm as idAlm
                   from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        group by art.nombre_art, almacen
                        order by 5

select 
                        a.id_art,
                        a.nombre_art as nombre,
                        a.unidad_art as unidad,
                        a.codigo_art as codigo,
                        t.nombre_tip as tipo
                   from 
                        articulo a inner join tipoarticulo t
                        on a.TipoArticulo_id_tip_art=t.idTipoArticulo
                        order by 1


select art.nombre_art, art.unidad_art, t.nombre_tip 
from almacen a inner join movimiento m on a.id_alm=m.almacen_id_alm 
inner join articulo art on m.articulo_id_art=art.id_art 
inner join tipoarticulo t on art.TipoArticulo_id_tip_art=t.idTipoArticulo 
where m.almacen_id_alm=1 and art.TipoArticulo_id_tip_art=3 
group by art.nombre_art order by 1;

select 

                        art.id_art,

                        art.nombre_art as nombre,

                        art.unidad_art as unidad,

                        t.nombre_tip as tipo                   

                    from 

                        almacen a 

                        inner join 

                        movimiento m 

                        on a.id_alm=m.almacen_id_alm

                        inner join articulo art 

                        on m.articulo_id_art=art.id_art

                        inner join tipoarticulo t

                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo

                        where m.almacen_id_alm=1

                        group by art.nombre_art

                   order by 1

select 
                        art.nombre_art,
                        art.unidad_art,
                        t.nombre_tip
                   from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        where m.almacen_id_alm=1
                        and art.TipoArticulo_id_tip_art=1
                        group by art.nombre_art
                   order by 1

select MAX(id_mov)as maximo from movimiento
                    where articulo_id_art=1 and almacen_id_alm=3;

select (saldo_movimiento)as saldo from movimiento
                    where id_mov=7

insert into movimiento 
(
    tipo_mov,
    fecha_mov,
    cantidad_mov,
    saldo_movimiento,
    descripcion_mov,
    almacen_id_alm,
    articulo_id_art
)
values(1,'2014-05-12',5,9,'Primera entrada',1,1);


select 
                        art.id_art,
                        art.nombre_art as nombre,
                        art.unidad_art as unidad,
                        t.nombre_tip as tipo                   
                    from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo

                        group by art.nombre_art
                   order by 1;


select 
                        art.id_art,
                        art.nombre_art as nombre,
                        art.unidad_art as unidad,
                        m.cantidad_mov as cantidad,
                        m.saldo_movimiento as saldo,
                        t.nombre_tip as tipo
                   from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        where m.almacen_id_alm=8
                        and m.articulo_id_art=2
                   order by 1

select MAX(id_mov) as maximo from movimiento where almacen_id_alm=1 and articulo_id_art=1

select saldo_movimiento as saldo from movimiento where id_mov=50

insert into movimiento ( tipo_mov, fecha_mov, cantidad_mov, saldo_movimiento, descripcion_mov, almacen_id_alm, articulo_id_art )
 values( 1,'2014-12-10',10,65,'',1,1)

select MAX(id_mov) as maximo from movimiento where almacen_id_alm= and articulo_id_art=1

select saldo_movimiento as saldo from movimiento where id_mov=51

insert into movimiento ( tipo_mov, fecha_mov, cantidad_mov, saldo_movimiento, descripcion_mov, almacen_id_alm, articulo_id_art ) 
values( 0,'2014-12-10',10,35,'',4,1)




select    
            a.nombre_alm as almacen,
 --           art.nombre_art as articulo,
            case 
            when m.tipo_mov=0 then 'Entrada'
            when m.tipo_mov=1 then 'Salida'
            end as 'Movimiento',
            art.unidad_art as unidad,
            dm.cantidad_det_mov as cantidad,
            dm.saldo_det_mov as saldo,
            m.fecha_det_mov as fecha,
     from almacen a inner join movimiento m 
            on a.id_alm=m.almacen_id_alm 
            inner join detalle_movimiento dm
            on m.id_mov=dm.movimiento_id_mov 
            inner join articulo art 
            on dm.articulo_id_art= art.id_art
            where a.id_alm=1;





select 
                        distinct(art.nombre_art),
                         art.unidad_art,
                         dm.cantidad_det_mov,
                         dm.saldo_det_mov
                        
                    from
                        almacen a
                            inner join
                        movimiento m ON a.id_alm = m.almacen_id_alm
                            inner join
                        detalle_movimiento dm ON m.id_mov = dm.movimiento_id_mov
                            inner join
                        articulo art ON dm.articulo_id_art= art.id_art;
                        --where m.tipo_mov=1;

select 
                        distinct(art.nombre_art),
                         art.unidad_art,
                         dm.cantidad_det_mov,
                         m.tipo_mov,
                         sum(dm.saldo_det_mov) as saldoresta
                        
                    from
                        almacen a
                            inner join
                        movimiento m ON a.id_alm = m.almacen_id_alm
                            inner join
                        detalle_movimiento dm ON m.id_mov = dm.movimiento_id_mov
                            inner join
                        articulo art ON dm.articulo_id_art= art.id_art
                        where 
                        m.tipo_mov=0                                
                        group by art.nombre_art;
--                        having art.nombre_art like '%Cemento Rojo%'
--union                                
select 
                        (art.nombre_art),
                         art.unidad_art,
                         dm.cantidad_det_mov,
                         m.tipo_mov,
                        sum(dm.saldo_det_mov)*-1 as saldosuma
                        
                    from
                        almacen a
                            inner join
                        movimiento m ON a.id_alm = m.almacen_id_alm
                            inner join
                        detalle_movimiento dm ON m.id_mov = dm.movimiento_id_mov
                            inner join
                        articulo art ON dm.articulo_id_art= art.id_art
                        where 
                        m.tipo_mov=1                                
                        group by art.nombre_art;
                               
                                
                                
);


select 
                        a.nombre_alm as area,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha
                    from
                        almacen a
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dm. = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu;

select * from pedido p inner join detalle_pedido d on p.id_ped=d.id_det_ped;

select id_alm, nombre_alm,asignado_alm  from almacen ;
where id_alm<>0 order by 1;




select 
                        a.nombre_are as area,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha
                    from
                        area a
                            inner join
                        pedido p ON a.id_are = p.Area_id_are
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                    where p.Area_id_are<>0

 


select * from detalle_pedido









;
select                       *
     from almacen a inner join movimiento m 
            on a.id_alm=m.almacen_id_alm 
             inner join detalle_movimiento dm
             on m.id_mov=dm.movimiento_id_mov
                        where m.almacen_id_alm =2 and dm.articulo_id_art= 1;

SELECT 						
                        *
                    from 
                        movimiento mov inner join detalle_movimiento det
                        on mov.id_mov=det.id_det_mov
                        where mov.almacen_id_alm =2 and det.articulo_id_art= 1 
                        order by  det.saldo_det_mov desc limit 5,1;

SELECT *
from movimiento mov inner join detalle_movimiento det on mov.id_mov=det.id_det_mov 
where mov.almacen_id_alm=2 and det.articulo_id_art=1 and mov.tipo_mov=0;

select * from movimiento;
select * from detalle_movimiento;






insert into detalle_movimiento ( movimiento_id_mov, articulo_id_art, cantidad_det_mov, saldo_det_mov, descripcion_det_mov) 
values(396,1,2,0,'Recibido de Almacén General') ;



select                         coalesce(dm.cantidad_det_mov,'0') as cantidad
     from almacen a inner join movimiento m 
            on a.id_alm=m.almacen_id_alm 
             inner join detalle_movimiento dm
             on m.id_mov=dm.movimiento_id_mov
                        where m.almacen_id_alm =2 and dm.articulo_id_art= 2 
                        order by  cantidad desc limit 5,1 ;
