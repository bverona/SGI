<?php

    
    $id = $_POST['id'];
    
    require_once '../Clases/clsAlmacen.php';
    require_once '../util/funciones.php';
    $objAlmacen = new Almacen();

    $resultado = $objAlmacen->EliminarAlmacen($id);
    
//    if()
//    {
//        Funciones::mensaje("Realizado Correctamente", "../Presentacion/Gerente/ListarAlmacenes.php", "s");
//    }  else {
//        Funciones::mensaje("No realizado ", "../Presentacion/Gerente/ListarAlmacenes.php", "e");        
//    }

?>