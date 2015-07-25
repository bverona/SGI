<?php

    $nombre=$_POST["txtnombreproveedor"];
    $direccion=$_POST["txtdireccionproveedor"];
    $ruc=$_POST["txtrucproveedor"];

    require_once '../Clases/clsProveedor.php';
    require_once '../util/funciones.php';
    
    $objPro= new Proveedor();
    
    if($objPro->NuevoProveedor($nombre, $direccion, $ruc))
    {
        Funciones::mensaje("Operación Realizada Correctamente", "../Presentacion/Gerente/Gerente.php", 's');
    }else
    {
        Funciones::mensaje("Operación no Realizada ", "../Presentacion/Gerente/Gerente.php", 'e');     
    }
    
?>

