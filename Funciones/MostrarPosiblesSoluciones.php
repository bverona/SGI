<?php

    $detalle_ped=$_POST["dp"];
    $id_art=$_POST["id_art"];
    $nombre_articulo=$_POST["nombre_articulo"];
    $precio=$_POST["precio"];
    $destino=$_POST["destino"];
    $cant=$_POST["cantidad"];
    $origen=$_POST["origen"];

    require '../Clases/clsPedido.php';
    
    $objPro = new Pedido(0,0,0);
    
    $objPro ->PosiblesSoluciones($detalle_ped, $id_art, $nombre_articulo, $precio, $destino, $cant, $origen);

?>