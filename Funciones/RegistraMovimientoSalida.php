    <?php
        
        $id_art=$_POST['idsalida'];
        $cantidad=$_POST['cantidadsalida'];
        $saldo=$_POST['saldosalida'];
        $almacenOrigen=$_POST['almacenOrigen'];
        $radio=$_POST['RadioInline'];
        $almacenDestino=$_POST['almacenDestino'];
        $descripcion=$_POST['descripcion'];
        if($descripcion!=''){
            $descripcion="-";          
        }
        
        require_once '../Clases/clsMovimiento.php'; 
        require_once '../Clases/clsAlmacen.php'; 
        require_once '../util/funciones.php';
        $objMovimiento = new Movimiento();
        $objAlmacen = new Almacen();
        $texto="Operación Fallida";   
        
       if($radio==2)
        {
            $objMovimiento->AgregaMovimientoTrasferencia($id_art, $cantidad, $descripcion, $almacenOrigen, $almacenDestino);
        }
         else 
            {
             $objMovimiento->AgregaMovimientoSalida($cantidad, $descripcion, $almacenOrigen, $id_art);
            }  
                   
        //Funciones::mensaje($texto, "../Presentacion/Almacen/ListarArticulos.php", 's');
?>
