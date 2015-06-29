<?php
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }

    $foco=$_POST["foco"];


    if(!isset($foco))
    {
        $foco=1;
    }
    
    require_once '../Clases/clsArticulo.php';
    
    $objArticulo= new Articulo();
    $objArticulo->ListarTodosArticulos($foco);
    
    
        

?>
