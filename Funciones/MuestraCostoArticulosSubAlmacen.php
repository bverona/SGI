<?php

    session_name("SGI");
    session_start();
    
    $almacen=$_POST["almacen"];
    
    require_once '../Clases/clsArticulo.php';
    
    $objArticulo= new Articulo();
    
    $objArticulo->ListarCostoArticulosSubAlmacen($almacen);

    ?>
