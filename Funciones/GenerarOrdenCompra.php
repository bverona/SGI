
<?php

    $id_art=$_POST["id_art"];
    $precio=$_POST["precio"];
    $cantidad=$_POST["cantidad"];
    $id_prov=$_POST["id_prov"];
    $prioridad=$_POST["prioridad"];
    $almacen=$_POST["id_alm"];
    
    require_once '../Clases/clsOrdenCompra.php';
    $objOrdenCompra=new OrdenCompra();
    
    $objOrdenCompra->NuevaOrdenCompra
            ($prioridad, $almacen, $cantidad, 
            $observacion,  $id_prov, $id_art);
    
?>