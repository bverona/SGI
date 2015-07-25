<?php
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }
    
    
    require_once '../Clases/clsArticulo.php';
    
    if ( isset($_POST["almacen"]))
    {
       $almacen= $_POST["almacen"];
    }else
        {
            $almacen= $_SESSION["id_almacen"];
        }
    
    $objArticulo= new Articulo();
    $objArticulo->ListarArticulosPorAlmacen($almacen);
    
    
        

?>
