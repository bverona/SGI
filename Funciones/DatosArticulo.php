<?php
  
    $id =$_POST["id"];
    
    require_once '../Clases/clsArticulo.php';
    
    $objArticulo = new Articulo();
  
    echo json_encode($objArticulo->BuscaArticulo($id));            

?>