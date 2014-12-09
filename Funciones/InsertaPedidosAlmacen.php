<?php
    session_name("SGI");
    session_start();
    
    $arreglo=  $_POST["arreglo"];
    $descripcion=  $_POST["descripcion"];

    require_once '../Clases/clsPedido.php';
    require_once '../util/funciones.php';

    
    $objPed= new Pedido(0,$_SESSION["id_almacen"], date('Y-m-d'));
    $objPed->SetDescripcion($descripcion);
    
    if(($objPed->AgregarPedido($_SESSION["id"],1)))
     {

        for($i=0;$i<count($arreglo);$i++)
        {
            if(($objPed->AgregarDetallePedido($arreglo[$i][0],$arreglo[$i][1])))
                {
                    echo $arreglo[$i][0]."-".$arreglo[$i][1]."<br>";
                }
        }        

     }
?>