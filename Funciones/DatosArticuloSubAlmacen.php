<?php
  
    $articulo =$_POST["articulo"];
    $almacen =$_POST["almacen"];
    
    require_once '../Clases/clsArticulo.php';
    
    $objArticulo = new Articulo();
  
    $arreglo= $objArticulo->DatosArticuloxSubAlmacen($almacen, $articulo) ;            
    
    echo json_encode($arreglo);
?>