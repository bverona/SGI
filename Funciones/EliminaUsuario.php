<?php

    
    $id = $_POST['id_usu'];
    
    require_once '../Clases/ClsUsuario.php';
    $objUsuario = new Usuario();
    $resultado = $objUsuario->EliminarUsuario($id);
    
    echo $resultado;
    

?>