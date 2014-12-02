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
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
//        if(($objMovimiento->AgregaMovimiento(1, $almacen,date('Y-m-d'))))
//        {
//
//            //verifica casilla de transferencia, 2 = activa
//            if($radio==2)
//            {                
//
//                
//                if($objMovimiento->AgregaDetalleMovimientoSalida($id_art, $cantidad, $saldo, $almacen,$descripcion))
//                {
//
//                   //arreglo que recibe los movimientos de un producto en un almacén
//                  $arreglo=$objMovimiento->BuscaArticuloDetalle($destino, $id_art);
//                   
//                   echo "destino :".$destino."<br>";
//                   echo "id_art  :".$id_art."<br>";
//                   $nombreAlmacen=$objAlmacen->ObtenerAlmacen($almacen);
//                   $descripcion="Recibido de ". $nombreAlmacen;
//                   
//                   //si existen movimientos entonces va a tomar el saldo y la cantidad
//                   //del último movimiento y los usará para añadirlos al registro
//
//                   echo "<br> arreglo: ". ($arreglo)."<br>";
////                   if($arreglo!=0)
////                        {
////                            echo "No primera entrada <br>";
////                            echo "4<br>";
////                            //para especificar desde qué almacen se recibe el artículo
////                            echo $descripcion."<br>";
////                            //obtiene los últimos elementos para usarlos como parámetros
////                            for($i=0;$i<count($arreglo);$i++)
////                            {
////                                $canti=$arreglo[$i]["cantidad"];
////                                $sald=$arreglo[$i]["saldo"];
////                                            echo "5->>".$canti."--".$sald."<br>";
////                            }
////                                echo "6<br>";
////                            $objMovimiento->AgregaMovimiento(0, $destino, date('Y-m-d'));
////                            $objMovimiento->AgregaDetalleMovimientoEntradaxAlmacen($id_art, $canti, $sald,$descripcion);
////                        }
////                    else
////                        {
//                            echo "7 primera entrada <br> ";
//                            echo "destino :".$destino."<br>";
//                            echo "id_art  :".$id_art."<br>";
//                            $objMovimiento->AgregaMovimiento(0, $destino, date('Y-m-d'));
//                            $objMovimiento->AgregaDetalleMovimientoEntradaxAlmacen($id_art,$cantidad,0,$descripcion);                        
//                        }
//                
//                    $texto="Operación Realizada";            
//                }
//                else
//                    {
//                        $texto="Operación No Realizada";
//                    }
//            }
//            else
//                {
//                    if($objMovimiento->AgregaDetalleMovimientoSalida($id_art, $cantidad, $saldo, $almacen,$descripcion))
//                    {
//
//                        $texto="Operación Realizada";            
//                    }
//                    else
//                        {
//                            $texto="Operación No Realizada";
//                        }                
//                }
//            
//      //  }
                
         Funciones::mensaje($texto, "../Presentacion/ListarArticulos.php", 's');
?>
