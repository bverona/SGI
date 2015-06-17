<?php

$dp=$_POST["dp"];

require '../Clases/clsPedido.php';

$objPed=new Pedido(0, 0, 0);

$objPed->CancelarPedido($dp);
?>