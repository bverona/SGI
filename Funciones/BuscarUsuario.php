<?php
     $id = $_POST['id_usu'];
    
    require_once '../Clases/ClsUsuario.php';
    $objUsuario = new Usuario();

    $resultado = $objUsuario->buscar($id);
    
    echo json_encode($resultado);
    


?>
