<?php

class OrdenCompra {
    


    public function NuevaOrdenCompra($prioridad,$almacen,$fecha,$cantidad,$observacion,$id_art,$dp)
    {
        $correcto=false;
        require_once 'clsConexion.php';
        require_once 'clsPedido.php';

        $objCon = new Conexion();
        $objPed = new Pedido(0,0,0);
        
        $sql="
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
                (
                ".$prioridad.",".
                 0 .",".
                 $almacen.",'".
                 $fecha."',".
                 $cantidad.",'".
                 $observacion."',".
                 $id_art.",".
                 $dp.
             ")";
        echo "<br>".$sql."<br>";
        if($objCon->Consultar($sql))
            {
                $objPed->PedidoAtendido($dp);
                $correcto=true;
            }
            return $correcto;
    }
    
    public function ListarOrdenesDeCompra()
    {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = "
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
                    where o.atendido_orden_de_compra=0;";
        
        $resultado = $objCon->consultar($sql);
        
        while ($registro = $resultado->fetch()) {

        echo'<div class="row">';
            echo'<div class="col-xs-12">';
                echo'            
                    <div class="col-xs-1">
                        <p class="text-center">'.$registro["id"].'</p> 
                    </div>';     
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["articulo"].'</p> 
                    </div>';
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["usuario"].'</p> 
                    </div>';     
                echo'            
                    <div class="col-xs-1">
                        <p class="text-center">'.$registro["cantidad"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["Prioridad"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["nombre_alm"].'</p> 
                    </div>                    
                    ';
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["fecha"].'</p> 
                    </div>';                                 
            echo'</div>';
        echo'</div >';
        
        }
    }

    
    
}



?>
