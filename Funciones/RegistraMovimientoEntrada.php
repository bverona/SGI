<?php
   
        $id_art=$_POST['id'];
        $cantidad=$_POST['cantidad'];
        $saldo=$_POST['saldo'];
        $almacen=$_POST['almacen'];
 
        
        require_once '../Clases/clsMovimiento.php'; 
        require_once '../util/funciones.php';
        $objMovimiento = new Movimiento();
        $direccion;
        
        if($objMovimiento->AgregaDetalleMovimientoEntrada($id_art, $cantidad, $saldo,$almacen))
        {
        $texto="Cambio Reailzado,  satisfactoriamente";            
        }
        else
            {
                $texto="Cambio No Realizado";
            }
        
         Funciones::mensaje($texto, "../Presentacion/ListarArticulos.php", 's');
        
?>
