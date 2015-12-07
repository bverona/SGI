<?php

    session_name("SGI");
    session_start();
    
    require_once '../Clases/clsArticulo.php';
    
    $objArticulo= new Articulo();
    
    $objArticulo->ListarCostoArticulos();

    ?>
