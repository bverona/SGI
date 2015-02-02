<?php
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }
    
    
    require_once '../Clases/clsPedido.php';
    
            $almacen= $_SESSION["id_almacen"];
    
    $objPedido= new Pedido(0,0, date());
    $objPedido->ListarPedidosSubAlmacen($almacen);
    
    
        

?>
