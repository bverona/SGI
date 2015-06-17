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
                    articulo_id_art
                )
                VALUES
                (
                ".$prioridad.",".
                 0 .",".
                 $almacen.",'".
                 $fecha."',".
                 $cantidad.",'".
                 $observacion."',".
                 $id_art.
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
                    case
                        when o.prioridad_orden_de_compra=1 then 'Baja'
                        when o.prioridad_orden_de_compra=2 then 'Media'
                        when o.prioridad_orden_de_compra=3 then 'Alta'
                    end as Prioridad,
                    alm.nombre_alm as nombre_alm,
                    o.fecha_orden_de_compra as fecha,
                    from 
                        orden_de_compra o inner join articulo art
                        on o.articulo_id_art=art.id_art 
                        inner join almacen alm
                        on alm.id_alm=o.almacen_id_alm 
                    where o.atendido_orden_de_compra=0";
        
        $resultado = $objCon->consultar($sql);
        
        while ($registro = $resultado->fetch()) {

        echo'<div class="row">';
            echo'<div class="col-xs-12">';
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["articulo"].'</p> 
                    </div>';     
                echo'            
                    <div class="col-xs-1">
                        <p class="text-center">'.$registro["cantidad"].'</p> 
                    </div>';
                echo'            
                    <div class="col-xs-1">
                        <p class="text-center">'.$registro["usuario"].'</p> 
                    </div>';     
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["almacen"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-1">
                        <p class="text-center">'.$registro["fecha"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["atendido"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-2">
                        <div '.$this->VerificarPedido($registro["id_alm"], $registro["id_art"], $registro["cantidad"]).'><a class="btn btn-success" data-toggle="collapse" href="#pedido'.$registro["dp"].'" 
                            onclick="MostrarPosiblesSoluciones('
                            .$registro["dp"].','.$registro["id_art"].','
                            ."'".$registro["articulo"]."'".','.$registro["precio"].','
                            .$registro["destino"].','.$registro["cantidad"].
                            ')" aria-expanded="false" aria-controls="#pedido'.$registro["dp"].'"> 
                        Posibles Soluciones</a>
                        </div>
                     </div>';  
                echo    
                    '<div class="col-xs-1"><p class="text-center">
                                <a  href="#" id="CancelarPedido'.$registro["dp"].'" onclick="AsignaDP('.$registro["dp"].');CancelaPedido('.$registro["dp"].');">                               
                                <img src="../../Imagenes/Cancelar Pedido.png" > </a>
                                </p>'
                            .'</div>';
                
            echo'</div>';
        echo'</div >';
        
        echo' <br><div class="row collapse" aria-expanded="false" id="pedido'.$registro["dp"].'">
                        
        </div>';
        }
    }

    
    
}



?>
