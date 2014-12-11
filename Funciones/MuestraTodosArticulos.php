<?php
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }

    

    require_once '../Clases/clsArticulo.php';
    
    $objArticulo= new Articulo();
    $objArticulo->ListarTodosArticulos();
    
    
        

?>
