    <?php
        
        $id_art=$_POST['idsalida'];
        $cantidad=$_POST['cantidadsalida'];
        $saldo=$_POST['saldosalida'];
        $almacen=$_POST['almacensalida'];
        $radio=$_POST['RadioInline'];
        $destino=$_POST['cbModulos'];
        $descripcion;
        $arreglo=null;
        (!(isset($_POST['descripcion'])))?$descripcion=$_POST['descripcion']:$descripcion="-";
        
        require_once '../Clases/clsMovimiento.php'; 
        require_once '../Clases/clsAlmacen.php'; 
        require_once '../util/funciones.php';
        $objMovimiento = new Movimiento();
        $objAlmacen = new Almacen();
$texto="Operación Realizada";   
        
       if($radio==2)
        {
           if($objMovimiento->AgregaMovimiento(1, $almacen,date('Y-m-d')))//primero registra la salida del almacén  general
                {
                    if($objMovimiento->AgregaDetalleMovimientoSalida($id_art, $cantidad, $saldo, $descripcion))//registra el detalle de esa salida
                    {         
                        if(($objMovimiento->AgregaMovimiento(0, $destino,date('Y-m-d'))))//registra la entrada del almacén de destino
                        {
                            $saldo2=$objMovimiento->definecant($destino, $id_art);//obtiene el saldo del producto en ese almacen 
                            if($saldo2==null) // si es nulo, se hace 0 el saldo en ese almacén
                                {$saldo2=0;}
                            
                            if($objMovimiento->AgregaDetalleMovimientoEntradaxAlmacen($id_art, $cantidad, $saldo2,$descripcion))
                            {
                                         
                                $texto="Operación Realizada";            
                            }
                            else
                                {
                                    $texto="Operación No Realizada";
                                }
                        }                        

                        
                        
                        
                    }
                }
        }// de aquí para abajo todo ok
         else 
             if($objMovimiento->AgregaMovimiento(1, $almacen,date('Y-m-d')))
                {
                    if($objMovimiento->AgregaDetalleMovimientoSalida($id_art, $cantidad, $saldo, $almacen,$descripcion))
                    {
                        $texto="Realizado Correctamente";
                    }
                }  
                   
         Funciones::mensaje($texto, "../Presentacion/Almacen/ListarArticulos.php", 's');
?>
