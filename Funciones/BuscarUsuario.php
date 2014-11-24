<?php
     $id = $_POST['id'];
    
    require_once '../Clases/clsArticulo.php';
    $objArticulo = new Usuario();

    $resultado = $objArticulo->buscar($id);
    
    echo json_encode($resultado);
    


?>
