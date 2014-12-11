<?php
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }
   
        $articulo=$_POST['id'];
        $cantidad=$_POST['cantidad'];
        $descripcion="";
        
        if(isset($_POST['descripcion']))
        {
            $descripcion=$_POST['descripcion'];
        }
        
        require_once '../util/funciones.php';
        require_once '../Clases/clsMovimiento.php'; 
        $objMovimiento = new Movimiento();
      
        if(($objMovimiento->AgregaMovimientoEntrada($cantidad,"", $_SESSION["id_almacen"], $articulo)))
        {
            Funciones::mensaje("Operación exitosa", "../Presentacion/Almacen/ListarArticulos.php", 's');
        }
        else
            {
            Funciones::mensaje("Error al realizar operación", "../Presentacion/Almacen/ListarArticulos.php", 'e');
            }
         
?>
