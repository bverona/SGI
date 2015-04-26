<?php

    
    $id = $_POST['id'];
    
    require_once '../Clases/clsArea.php';
    require_once '../util/funciones.php';
    $objArea = new Area();

    $resultado = $objArea->EliminarArea($id);
    
//    if()
//    {
//        Funciones::mensaje("Realizado Correctamente", "../Presentacion/Gerente/ListarAlmacenes.php", "s");
//    }  else {
//        Funciones::mensaje("No realizado ", "../Presentacion/Gerente/ListarAlmacenes.php", "e");        
//    }

?>