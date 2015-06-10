<?php

    $proveedor=$_POST["proveedor"];
    $articulo=$_POST["articulo"];

    require '../Clases/clsProveedor.php';

    $objArtPro = new Proveedor();

    $objArtPro->CambiarEstadoArticuloProveedor($proveedor,$articulo);
    
    
    
    ?>