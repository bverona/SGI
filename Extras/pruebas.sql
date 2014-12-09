
select    
                        a.nombre_alm as almacen,
                        m.fecha_det_mov as fecha,
                        art.nombre_art as articulo,
                        dm.cantidad_det_mov as cantidad,
                        art.unidad_art as unidad,
                        dm.saldo_det_mov as saldo,
                        m.tipo_mov as movimiento                        
                 from almacen a inner join movimiento m 
                        on a.id_alm=m.almacen_id_alm 
                        inner join detalle_movimiento dm
                        on m.id_mov=dm.movimiento_id_mov 
                        inner join articulo art 
                        on dm.articulo_id_art= art.id_art
                         where a.id_alm=1



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
