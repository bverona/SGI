    <?php
        
        $id_art=$_POST['idsalida'];
        $cantidad=$_POST['cantidadsalida'];
        $saldo=$_POST['saldosalida'];
        $almacenOrigen=$_POST['almacensalida'];
        $radio=$_POST['RadioInline'];
        $almacenDestino=$_POST['cbModulos'];
        $descripcion;
        (!(isset($_POST['descripcion'])))?$descripcion=$_POST['descripcion']:$descripcion="-";
        
        require_once '../Clases/clsMovimiento.php'; 
        require_once '../Clases/clsAlmacen.php'; 
        require_once '../util/funciones.php';
        $objMovimiento = new Movimiento();
        $objAlmacen = new Almacen();
        $texto="Operación Fallida";   
        
       if($radio==2)
        {
            $objMovimiento->AgregaMovimientoTrasferencia($id_art, $cantidad, $descripcion, $almacenOrigen, $almacenDestino);
            $texto="Realizado Correctamente";
        }
         else 
             if($objMovimiento->AgregaMovimientoSalida($cantidad, $descripcion, $almacenOrigen, $id_art))
                {
                $texto="Realizado Correctamente";
                }  
                   
        Funciones::mensaje($texto, "../Presentacion/Almacen/ListarArticulos.php", 's');
?>
