<?php
     $id = $_POST['id'];
    
    require_once '../Clases/clsUsuario.php';
    $objUsuario = new Usuario();

    $resultado = $objUsuario->buscar($id);
    
    echo json_encode($resultado);
    


?>
