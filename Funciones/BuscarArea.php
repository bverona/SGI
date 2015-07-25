<?php

     $id = $_POST['id'];
    
    require_once '../Clases/clsArea.php';
    $objArea = new Area();

    $resultado = $objArea->ListarAreas();
    
    echo json_encode($resultado);
    

?>