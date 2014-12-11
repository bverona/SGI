<?php
    
    $id=$_POST['id'];
    
    require_once '../Clases/clsMovimiento.php';
    
    $objMovimiento= new Movimiento();
    
    if(($_POST["articulo"])==0)
    {
        $objMovimiento->ListarMovimientos($id);
    }else
        {
            $objMovimiento->ListarMovimientosPorAlmacen($id,$_POST["articulo"]);
        }
 //   $objTipo->
?>
