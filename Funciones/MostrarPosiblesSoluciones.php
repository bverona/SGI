<?php

    $detalle_ped=$_POST["dp"];
    $id_art=$_POST["id_art"];
    $nombre_articulo=$_POST["nombre_articulo"];
    $precio=$_POST["precio"];
    $destino=$_POST["destino"];
    $cant=$_POST["cantidad"];
    //$origen=$_POST["origen"];

    require_once  '../Clases/clsPedido.php';
    
    $objPed = new Pedido(0,0,0);
    
    $objPed ->PosiblesSoluciones($detalle_ped, $id_art, $nombre_articulo, $precio, $destino, $cant);
    

?>