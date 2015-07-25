<?php

    $almacen=$_POST["id"];
    require_once '../Clases/clsMovimiento.php';    
    
    $objMovimiento= new Movimiento();
    
    $objMovimiento->ListarEntradas($almacen);

?>
