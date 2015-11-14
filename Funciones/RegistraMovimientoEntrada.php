<?php
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }
   
        $articulo=$_POST['id'];
        $cantidad=$_POST['cantidad'];
        $almacen=$_POST['almacen'];
        $descripcion="";
        
        if(isset($_POST['descripcion']))
        {
            $descripcion=$_POST['descripcion'];
        }
        
        require_once '../Clases/clsMovimiento.php'; 
        $objMovimiento = new Movimiento();
      
        ($objMovimiento->AgregaMovimientoEntrada($cantidad,$descripcion, $almacen, $articulo));
         
?>
