<?php
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }

    
    $tipo=$_POST['tipo'];
    $almacen=$_POST['almacen'];
    
    require_once '../Clases/clsArticulo.php';
    
    $objArticulo= new Articulo();
    $objArticulo->ListarArticulos($tipo,$almacen);
    
    
        

?>
