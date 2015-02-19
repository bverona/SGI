<?php

    $id=$_POST["id"];
    $nombre=$_POST["txtnombreproveedor"];
    $direccion=$_POST["txtdireccionproveedor"];
    $ruc=$_POST["txtrucproveedor"];
    
    require_once '../Clases/clsProveedor.php';
    require_once '../util/funciones.php';
    $objPro = new Proveedor();

            
    if($objPro->EditarProveedor($id,$nombre,$direccion,$ruc))
    {
        Funciones::mensaje("Operacion Realizada Correctamente", "../Presentacion/Gerente/ListarProveedores.php", 's');
    } 
    else
    {        
        Funciones::mensaje("Operacion Incorrecta", "../Presentacion/Gerente/ListarProveedores.php", 'e');
    }
    
    

?>