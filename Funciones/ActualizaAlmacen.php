<?php

    $nombre=$_POST["nombre"];
    $id=$_POST["id"];
    require_once '../Clases/clsAlmacen.php';
    require_once '../util/funciones.php';
    
    $objAlmacen=new Almacen();
    $objAlmacen->EditarAlmacen($id, $nombre);
            
    Funciones::mensaje("Operación Realizada con éxito","../Presentacion/ListarAlmacenes.php", "s");

    ?>
