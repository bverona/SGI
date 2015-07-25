<?php

    $proveedor=$_POST["proveedor"];
    $articulo=$_POST["articulo"];
    $cantidad=$_POST["cantidad"];
    $precio=$_POST["precio"];

    require '../Clases/clsProveedor.php';
    
    $objPro = new Proveedor();

    $objPro->AñadirArticuloProveedor($articulo,$proveedor,$cantidad,$precio);

    ?>
