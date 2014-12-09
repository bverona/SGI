<?php
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:../Presentacion/index.php");
    }

    $nombre=$_POST['txtnombrearea'];

    require_once '../Clases/clsArea.php';
    require_once '../util/funciones.php';
    $objAlmacen = new Area();
    
    if($objAlmacen->AgregarArea($nombre))
      {
        Funciones::mensaje("Operación Realizada Correctamente", "../Presentacion/Gerente/Gerente.php", 's'); 
      }else
          {
            Funciones::mensaje("Operación Fallida Intente Nuevamente", "../Presentacion/Gerente/Gerente.php", 'e'); 
          };
    

?>