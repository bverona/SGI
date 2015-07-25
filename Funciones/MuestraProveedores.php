<?php

    $articulo=$_POST["articulo"];
    require_once '../Clases/clsProveedor.php';    
    
    $objPro= new Proveedor();

    $objPro->ListarProveedoresModal($articulo);
    //echo 'sas';

?>
