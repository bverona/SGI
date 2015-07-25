<?php

    $proveedor=$_POST["proveedor"];

    require '../Clases/clsProveedor.php';
    
    $objPro = new Proveedor();
    
    $objPro ->ListarArticulosPorProveedor($proveedor);

?>