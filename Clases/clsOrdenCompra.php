<?php

class OrdenCompra {
    


    public function NuevaOrdenCompra($prioridad,$almacen,$cantidad,$observacion,$id_prov,$id_art)
    {
        $correcto=false;
        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql="insert into orden_de_compra 
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
                ".$prioridad.",".
                 0 .",".
                 $almacen.",'".
                 date("Y-m-d")."','".
                 date("h:i:s")."',".
                 $cantidad.",'".
                 $observacion."','".
                 $id_art."',".
                 $id_art.",".
                 $id_prov.
             ")";
        echo "<br>".$sql."<br>";
        if($objCon->Consultar($sql))
            {
                $correcto=true;
            }
            return $correcto;
    }
    
    
}



?>
