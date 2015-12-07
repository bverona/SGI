<?php

    $resto=$_POST["resto"];
    $proveedor=$_POST["proveedor"];
    $articulo=$_POST["articulo"];
    $id_art=$_POST["id_art"];
    $precio=$_POST["precio"];
    $dp=$_POST["dp"];
    
    require_once '../Clases/clsOrdenCompra.php';
    $objOrdenCompra=new OrdenCompra();
    
    $objOrdenCompra->NuevaOrdenCompra
    ($prioridad, $almacen, date('Y-m-d'),  
            $cantidad, $observacion, $id_art,$dp);
    
?>