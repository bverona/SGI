<?php

    $prioridad=$_POST["prioridad"];
    $cantidad=$_POST["cantidadoc"];
    $observación=$_POST["observacion"];
    $id_art=$_POST["id_art"];
    $almacen=$_POST["id_alm"];
    $dp=$_POST["dp"];
    
    require_once '../Clases/clsOrdenCompra.php';
    $objOrdenCompra=new OrdenCompra();
    
    $objOrdenCompra->NuevaOrdenCompra
    ($prioridad, $almacen, date('Y-m-d'),  
            $cantidad, $observacion, $id_art,$dp);
    
?>