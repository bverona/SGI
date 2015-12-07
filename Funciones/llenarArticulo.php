<?php
    
    if(!isset($_POST["tipo_articulo"]))
    {
        $tipoArticulo = 0;
    }else
    {
        $tipoArticulo = $_POST["tipo_articulo"];
        
    }
    
    require_once '../Clases/clsArticulo.php';
    $objArticulo = new Articulo();

    $objArticulo->SelectArticulo($tipoArticulo);
    
    
?>

