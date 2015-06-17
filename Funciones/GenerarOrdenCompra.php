<?php

    $prioridad=$_POST["prioridad"];
    $almacen=$_POST["id_alm"];
    $cantidad=$_POST["cantidad"];
    $observación=$_POST["observacion"];
    $id_art=$_POST["id_art"];
    $dp=$_POST["dp"];
    
    require_once '../Clases/clsOrdenCompra.php';
    $objOrdenCompra=new OrdenCompra();
    
    $objOrdenCompra->NuevaOrdenCompra
    ($prioridad, $almacen, date('Y-m-d'),  
            $cantidad, $observacion, $id_art,$dp);
    
?>