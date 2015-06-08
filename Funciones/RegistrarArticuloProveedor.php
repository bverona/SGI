<?php

    $proveedor=$_POST["proveedor"];
    $articulo=$_POST["articulo"];
    $cantidad=$_POST["cantidad"];
    $precio=$_POST["precio"];

    require '../Clases/clsArticulo.php';
    
    $objArt = new Articulo();
    echo $proveedor."\n".$articulo."\n".$cantidad."\n".$precio;
    $objArt->RegistrarArticuloProveedor($proveedor,$articulo,$cantidad,$precio);

    ?>
