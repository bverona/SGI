<?php
    
    $id=$_POST['id'];
    $articulo=$_POST["articulo"];
    require_once '../Clases/clsMovimiento.php';
    
    $objMovimiento= new Movimiento();

    $objMovimiento->ListarMovimientosPorAlmacen($id,$articulo);

    ?>
