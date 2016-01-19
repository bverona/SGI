SELECT 
                    
                    a.id,
                    a.articulo,
                    a.cantidad,
                    a.precio,
                    a.costo,
                    COALESCE(b.saldo, 0) as saldo
                FROM
                    (SELECT 
                        art.id_art AS id,
                            art.nombre_art AS articulo,
                            SUM(dp.cantidad_art) AS cantidad,
                            ROUND(art.precio_art, 2) AS precio,
                            ROUND((SUM(dp.cantidad_art) * art.precio_art), 2) AS costo
                    FROM
                        almacen a
                    INNER JOIN pedido p ON a.id_alm = p.almacen_id_alm
                    INNER JOIN detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                    INNER JOIN articulo art ON dp.articulo_id_art = art.id_art
                    INNER JOIN usuario u ON p.id_usu_ped = u.id_usu
                    WHERE
                        dp.atendido_det_ped = 0
                    GROUP BY art.id_art) a
                        LEFT JOIN
                    (SELECT 
                        a.articulo, a.nombre, SUM(a.saldo) AS saldo
                    FROM
                        (SELECT 
                        (art.id_art) AS articulo,
                            (art.nombre_art) AS nombre,
                            a.nombre_alm AS almacen,
                            ((SELECT 
                                    (saldo_movimiento)
                                FROM
                                    movimiento
                                WHERE
                                    id_mov = (SELECT 
                                            MAX(id_mov) AS maximo
                                        FROM
                                            movimiento m
                                        WHERE
                                            m.almacen_id_alm = a.id_alm
                                                AND articulo_id_art = art.id_art))) AS saldo
                    FROM
                        almacen a
                    INNER JOIN movimiento m ON a.id_alm = m.almacen_id_alm
                    INNER JOIN articulo art ON m.articulo_id_art = art.id_art
                    INNER JOIN tipoarticulo t ON art.TipoArticulo_id_tip_art = t.idTipoArticulo
                    WHERE
                        (SELECT 
                                saldo_movimiento
                            FROM
                                movimiento
                            WHERE
                                id_mov = (SELECT 
                                        MAX(id_mov) AS maximo
                                    FROM
                                        movimiento
                                    WHERE
                                        almacen_id_alm = a.id_alm
                                            AND articulo_id_art = art.id_art)) > 0
                    GROUP BY articulo , almacen , saldo
                    ORDER BY 2) a
                    GROUP BY a.articulo) b ON (a.id = b.articulo) 
                UNION SELECT 
                    a.id,
                    a.articulo,
                    a.cantidad,
                    a.precio,
                    a.costo,
                    COALESCE(b.saldo, 0) AS saldo
                FROM
                    (SELECT 
                        art.id_art AS id,
                            art.nombre_art AS articulo,
                            SUM(dp.cantidad_art) AS cantidad,
                            ROUND(art.precio_art, 2) AS precio,
                            ROUND((SUM(dp.cantidad_art) * art.precio_art), 2) AS costo
                    FROM
                        almacen a
                    INNER JOIN pedido p ON a.id_alm = p.almacen_id_alm
                    INNER JOIN detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                    INNER JOIN articulo art ON dp.articulo_id_art = art.id_art
                    INNER JOIN usuario u ON p.id_usu_ped = u.id_usu
                    WHERE
                        dp.atendido_det_ped = 0
                    GROUP BY art.id_art) a
                        RIGHT JOIN
                    (SELECT 
                        a.articulo, a.nombre, SUM(a.saldo) AS saldo
                    FROM
                        (SELECT 
                        (art.id_art) AS articulo,
                            (art.nombre_art) AS nombre,
                            a.nombre_alm AS almacen,
                            ((SELECT 
                                    (saldo_movimiento)
                                FROM
                                    movimiento
                                WHERE
                                    id_mov = (SELECT 
                                            MAX(id_mov) AS maximo
                                        FROM
                                            movimiento m
                                        WHERE
                                            m.almacen_id_alm = a.id_alm
                                                AND articulo_id_art = art.id_art))) AS saldo
                    FROM
                        almacen a
                    INNER JOIN movimiento m ON a.id_alm = m.almacen_id_alm
                    INNER JOIN articulo art ON m.articulo_id_art = art.id_art
                    INNER JOIN tipoarticulo t ON art.TipoArticulo_id_tip_art = t.idTipoArticulo
                    WHERE
                        (SELECT 
                                saldo_movimiento
                            FROM
                                movimiento
                            WHERE
                                id_mov = (SELECT 
                                        MAX(id_mov) AS maximo
                                    FROM
                                        movimiento
                                    WHERE
                                        almacen_id_alm = a.id_alm
                                            AND articulo_id_art = art.id_art)) > 0
                    GROUP BY articulo , almacen , saldo
                    ORDER BY 2) a
                    GROUP BY a.articulo) b ON (a.id = b.articulo)
                WHERE
                    a.id IS NOT NULL;





/*
select 
                        a.nombre_alm as almacen,
                        m.fecha_mov as fecha,
                        art.nombre_art as articulo,
                        m.cantidad_mov as cantidad,
                        m.saldo_movimiento as saldo
                    from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        where
                        m.almacen_id_alm=5
                        and 
                        m.tipo_mov=0 and
                        art.id_art =
                    order by 2;

select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        art.unidad_art as unidad,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
                        round(((select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art))*art.precio_art),2) as costo,
                        round(art.precio_art,2) as precio,
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
                        where    (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art))>0 
                                        and a.id_alm=3
                        group by art.id_art
                        order by 1;

select * from usuario;

SELECT 
    u.nombre_usu,
    DATE_FORMAT(r.acceso_reg, '%d/%m/%y') AS fecha,
    DATE_FORMAT(r.acceso_reg, '%h:%i:%s %p') AS hora
FROM
    registro r
        INNER JOIN
    usuario u ON r.id_usu_reg = u.id_usu
WHERE
    r.id_usu_reg = 5 and
    r.acceso_reg <> '';






SELECT 
                    a.articulo as id, a.nombre as nombre, a.unidad,
                    SUM(a.saldo) AS saldo, a.tipo 
                FROM
                    (SELECT 
                    (art.id_art) AS articulo,
                        (art.nombre_art) AS nombre,
                        a.nombre_alm AS almacen,
                        um.nombre_um as unidad,
                        t.nombre_tip as tipo,
                        ((SELECT 
                                (saldo_movimiento)
                            FROM
                                movimiento
                            WHERE
                                id_mov = (SELECT 
                                        MAX(id_mov) AS maximo
                                    FROM
                                        movimiento m
                                    WHERE
                                        m.almacen_id_alm = a.id_alm
                                            AND articulo_id_art = art.id_art))) as saldo
                FROM
                    almacen a
                INNER JOIN movimiento m ON a.id_alm = m.almacen_id_alm
                INNER JOIN articulo art ON m.articulo_id_art = art.id_art
                INNER JOIN tipoarticulo t ON art.TipoArticulo_id_tip_art = t.idTipoArticulo
                INNER JOIN unidad_de_medida um on um.id_um=art.id_um
                WHERE
                    (SELECT 
                            saldo_movimiento
                        FROM
                            movimiento
                        WHERE
                            id_mov = (SELECT 
                                    MAX(id_mov) AS maximo
                                FROM
                                    movimiento
                                WHERE
                                    almacen_id_alm = a.id_alm
                                        AND articulo_id_art = art.id_art)) > 0
                GROUP BY articulo , almacen , saldo
                ORDER BY 2) a
                GROUP BY id;


SELECT 
        a.articulo, a.nombre, SUM(a.saldo) AS saldo
    FROM
        (SELECT 
        (art.id_art) AS articulo,
            (art.nombre_art) AS nombre,
            a.nombre_alm AS almacen,
            ((SELECT 
                    (saldo_movimiento)
                FROM
                    movimiento
                WHERE
                    id_mov = (SELECT 
                            MAX(id_mov) AS maximo
                        FROM
                            movimiento m
                        WHERE
                            m.almacen_id_alm = a.id_alm
                                AND articulo_id_art = art.id_art))) AS saldo
    FROM
        almacen a
    INNER JOIN movimiento m ON a.id_alm = m.almacen_id_alm
    INNER JOIN articulo art ON m.articulo_id_art = art.id_art
    INNER JOIN tipoarticulo t ON art.TipoArticulo_id_tip_art = t.idTipoArticulo
    WHERE
        (SELECT 
                saldo_movimiento
            FROM
                movimiento
            WHERE
                id_mov = (SELECT 
                        MAX(id_mov) AS maximo
                    FROM
                        movimiento
                    WHERE
                        almacen_id_alm = a.id_alm
                            AND articulo_id_art = art.id_art)) > 0
    GROUP BY articulo , almacen , saldo
    ORDER BY 2) a
    GROUP BY a.articulo;


select a.cantidad,a.cantidad,a.precio,a.costo, b.saldo 
from(
select 
                        art.id_art as id,
                        sum(dp.cantidad_art) as cantidad,
                        round(art.precio_art,2) as precio,
                        round((sum(dp.cantidad_art)*art.precio_art),2) as costo
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
                    where 
                        dp.atendido_det_ped=0 
                    group by art.id_art) a 
full outer join
(select 
                        art.id_art as id,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
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
                        where    (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art))>0
                        group by art.nombre_art
                        order by 1) b 
                        on a.id=b.id;

select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        um.nombre_um as unidad,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,                        
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
                        inner join unidad_de_medida um 
                            on art.id_um=um.id_um                         
                    where 
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art))>0 and 
                        m.almacen_id_alm= 2     
                        group by art.nombre_art
                   order by 1;










select 
                        art.id_art as id_art,
                        a.nombre_alm as almacen,
                        a.id_alm as id_alm,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        dp.id_det_ped as dp,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha,
                        p.almacen_id_alm as destino,
                        coalesce(art.precio_art,2) as precio,
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
                    where 
                        
                        dp.atendido_det_ped=0;

select 
                        art.id_art as id_art,
                        a.nombre_alm as almacen,
                        a.id_alm as id_alm,
                        art.nombre_art as articulo,
                        sum(dp.cantidad_art) as cantidad,
                        dp.id_det_ped as dp,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha,
                        p.almacen_id_alm as destino,
                        coalesce(art.precio_art,2) as precio,
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
                    where 
                        dp.atendido_det_ped=0
                    group by art.id_art;
 

select a.nombre_alm as proveedor, a.id_alm as id_pro, s.detalle_pedido_id_det_ped as dp, 
s.soluciones_det_cant_art as disponible, s.articulo_id_art as articulo, 
s.diferencia_sol_det_ped as diferencia from soluciones_det_ped s inner join 
almacen a ON s.soluciones_det_pro = a.id_alm where s.detalle_pedido_id_det_ped = 22 and 
s.articulo_id_art = 49 and s.tipo_sol_det_ped=0 ;

select a.nombre_alm as proveedor, a.id_alm as id_pro, s.detalle_pedido_id_det_ped as dp,
 s.soluciones_det_cant_art as disponible, s.articulo_id_art as articulo,
 s.diferencia_sol_det_ped as diferencia from soluciones_det_ped s inner join 
almacen a ON s.soluciones_det_pro = a.id_alm where s.detalle_pedido_id_det_ped = 22 and
 s.articulo_id_art = 49 and s.tipo_sol_det_ped=1 and s.soluciones_det_cant_art>0;

select 
                a.nombre_alm as proveedor,
                art.nombre_art as articulo,
                dp.cantidad_art as cantidad
            from
                soluciones_det_ped s
                    inner join
                almacen a ON s.soluciones_det_pro = a.id_alm 
                inner join articulo art
                on art.id_art=s.articulo_id_art 
                inner join detalle_pedido dp
                on s.detalle_pedido_id_det_ped=dp.id_det_ped
            where
                s.detalle_pedido_id_det_ped = 22 and 
                s.articulo_id_art = 49 and 
                s. tipo_sol_det_ped=1 and 
                s.soluciones_det_cant_art>0;



















INSERT INTO orden_de_compra ( prioridad_orden_de_compra, atendido_orden_de_compra, almacen_id_alm, fecha_orden_de_compra, cantidad_orden_de_compra, observacion_orden_de_compra, articulo_id_art, detalle_pedido_id_det_ped ) VALUES ( 2,0,4,'2015-11-13',2,'',41,20);






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

                    values( 1,'2015-11-07',2,18,'',1,38);


select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        um.nombre_um as unidad,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
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
                        inner join unidad_de_medida um 
                            on art.id_um=um.id_um 
                        group by art.nombre_art, almacen
                        order by 5;




select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        art.unidad_art as unidad,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
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
                        where 
                            m.articulo_id_art=19 and
                            m.almacen_id_alm=3
                        group by art.nombre_art
;


select 
                    a.nombre_alm as proveedor,
                    a.id_alm as id_pro,
                    s.detalle_pedido_id_det_ped as dp,
                    s.soluciones_det_cant_art as disponible,
                    s.articulo_id_art as articulo,
                    s.diferencia_sol_det_ped as diferencia
                from
                    soluciones_det_ped s
                        inner join
                    almacen a ON s.soluciones_det_pro = 12 
                where
                    s.detalle_pedido_id_det_ped = 41  
                    and s.tipo_sol_det_ped=0;


                select 
                    a.nombre_alm as proveedor,
                    a.id_alm as id_pro,
                    s.detalle_pedido_id_det_ped as dp,
                    s.soluciones_det_cant_art as disponible,
                    s.articulo_id_art as articulo,
                    s.diferencia_sol_det_ped as diferencia
                from
                    soluciones_det_ped s
                        inner join
                    almacen a ON s.soluciones_det_pro = a.id_alm 
                where
                    s.detalle_pedido_id_det_ped = 15 and 
                s.articulo_id_art =49;



select nombre_alm ,(select  nombre_proveedor from proveedor) as prov from almacen;
union
select  nombre_proveedor from proveedor;

select 
                        art.id_art as articulo,
                        art.nombre_art as nombre,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
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
                        order by 2;


select 
    MAX(id_mov) as maximo 
from movimiento 
                    where almacen_id_alm= $almacen 
                    and 
                    articulo_id_art= $articulo;

select 
    saldo_movimiento as saldo 
                    from movimiento 
                    where id_mov=();

select 
                        dp.id_det_ped as id_dp,
                        art.id_art as articulo,
                        art.nombre_art as nombre,
                        a.id_alm as almacen,
                        a.nombre_alm as nombre_almacen,
                        dp.cantidad_art as cantidad,
                        dp.atendido_det_ped
                    from
                        almacen a
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                        where dp.atendido_det_ped=0;



select 
                    o.id_orden_de_compra as id,
                    art.nombre_art as articulo,
                    o.cantidad_orden_de_compra as cantidad,
                    u.nombre_usu as usuario,
                    case
                        when o.prioridad_orden_de_compra=1 then 'Baja'
                        when o.prioridad_orden_de_compra=2 then 'Media'
                        when o.prioridad_orden_de_compra=3 then 'Alta'
                    end as Prioridad,
                    alm.nombre_alm as nombre_alm,
                    o.fecha_orden_de_compra as fecha
                    from 
                        orden_de_compra o inner join articulo art
                        on o.articulo_id_art=art.id_art 
                        inner join almacen alm
                        on alm.id_alm=o.almacen_id_alm 
                        inner join detalle_pedido dp 
                        on  dp.id_det_ped=o.detalle_pedido_id_det_ped
                        inner join Pedido p 
                        on p.id_ped=dp.Pedido_id_ped 
                        inner join usuario u
                        on u.id_usu= p.id_usu_ped
                    where o.atendido_orden_de_compra=0;




-- ListarPedidosAlmacen
select 
    dp.id_det_ped as id_dp,
    art.id_art as articulo,
    art.nombre_art as nombre,
    a.id_alm as almacen,
    a.nombre_alm as nombre_almacen,
    dp.cantidad_art as cantidad
from
    almacen a
        inner join
    pedido p ON a.id_alm = p.almacen_id_alm
        inner join
    detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
        inner join
    articulo art ON dp.articulo_id_art = art.id_art
    where
    dp.atendido_det_ped=0;

-- Posibles Soluciones
select 
                        dp.id_det_ped as id_dp,
                        art.id_art as articulo,
                        art.nombre_art as nombre,
                        a.id_alm as almacen,
                        a.nombre_alm as nombre_almacen,
                        dp.cantidad_art as cantidad,
                        dp.atendido_det_ped,
                        dp.procesado_det
                    from
                        almacen a
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                        where dp.atendido_det_ped=0;

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
*/