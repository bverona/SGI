<?php
    
    $id=$_POST['id'];
    
    require_once '../Clases/clsMovimiento.php';
    
    $objMovimiento= new Movimiento();
    
    $objMovimiento->ListarMovimientos($id);
 //   $objTipo->
?>
