<?php
    
    $id=$_POST['id'];
    
    require_once '../Clases/clsArticulo.php';
    
    $objArticulo= new Articulo();
    
    $objArticulo->ListarArticulos($id);
 //   $objTipo->
?>
