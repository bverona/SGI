<?php
    session_name("SGI");
    session_start();
    
    $nombre=$_POST['editaralmacen'];
    $id=$_POST['idEditado'];

    require_once '../Clases/clsAlmacen.php';
    require_once '../util/funciones.php';
    
    $objAlmacen= new Almacen();
   
        
        if(($objAlmacen->EditarAlmacen($id,$nombre)) )
        {            
            Funciones::mensaje("Operación Realizada con éxito", "../Presentacion/Gerente/Gerente.php", 's');
        }
        else
        {
            Funciones::mensaje("Operación fallida, intente nuevamente", "../Presentacion/Gerente/Gerente.php", 'e');
        }
    

    ?>
