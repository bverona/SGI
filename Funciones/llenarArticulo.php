<?php
    
    $tipoArticulo = $_POST["tipo_articulo"];
    
    require_once '../Clases/clsArticulo.php';
    $objArticulo = new Articulo();

    $objArticulo->SelectArticulo($tipoArticulo);
    
    
?>

