<?php
    session_name("SGI");
    session_start();

    $id=$_POST['id'];
    
    require_once '../Clases/clsArticulo.php';
    
    $objArticulo= new Articulo();
    
    $objArticulo->ListarArticulosxSubAlmacen($id,$_SESSION["id_almacen"]);
 //   $objTipo->
?>
