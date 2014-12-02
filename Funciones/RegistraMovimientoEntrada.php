<?php
   
        $id_art=$_POST['id'];
        $cantidad=$_POST['cantidad'];
        $saldo=$_POST['saldo'];
        $almacen=$_POST['almacen'];
        $descripcion=$_POST['descripcion'];
 
        
        require_once '../Clases/clsMovimiento.php'; 
        require_once '../util/funciones.php';
        $objMovimiento = new Movimiento();

        if(($objMovimiento->AgregaMovimiento(0, $almacen,date('Y-m-d'))))
        {

            if($objMovimiento->AgregaDetalleMovimientoEntrada($id_art, $cantidad, $saldo,$descripcion))
            {
                $texto="Operación Realizada";            
            }
            else
                {
                    $texto="Operación No Realizada";
                }
        }
                
         Funciones::mensaje($texto, "../Presentacion/ListarArticulos.php", 's');         
         
?>
