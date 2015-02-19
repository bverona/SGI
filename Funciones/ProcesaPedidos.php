<?php

$prov=$_POST["prov"];
$dest=$_POST["dest"];
$articulo=$_POST["articulo"];
$cantidad=$_POST["cantidad"];
$dp=$_POST["dp"];

require '../util/funciones.php';
require '../Clases/clsPedido.php';
require '../Clases/clsMovimiento.php';

$objMovimiento = new Movimiento();
$objPed = new Pedido("", "", "");

$descripcion="Trasferido para satisfacer la demanda requerida ";
    if($objMovimiento->AgregaMovimientoTrasferencia($articulo, $cantidad, $descripcion, $prov, $dest))
        {       
            $objPed->PedidoAtendido($dp);
        }           
    else
        {
            Funciones::mensaje("Operación Fallida", "../Presentacion/Almacen/PedidosAlmacen.php", $tipo);        
        }


?>
