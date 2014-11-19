<?php

     $id = $_POST['id'];
     $nombre = $_POST['nombre'];
    
    require_once '../Clases/clsArea.php';
    require_once '../util/funciones.php';
    $objArea = new Area();

    if($objArea->EditarArea($id, $nombre))
    {
        Funciones::mensaje("Operacion Realizada Correctamente", "../Presentacion/ListarAreas.php", 's');
    } 
    else
    {        
        Funciones::mensaje("Operacion Incorrecta", "../Presentacion/ListarAreas.php", 'e');
    }
    
    

?>