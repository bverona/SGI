<?php

    require_once '../Clases/clsPedido.php';
    
    $objPedido= new Pedido(0, 0, 0);
    
    $objPedido->ProcesaPedidos();
    
?>