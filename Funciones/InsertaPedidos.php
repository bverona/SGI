<?php
    session_name("SGI");
    session_start();
    
    $arreglo=  $_POST["arreglo"];

    require_once '../Clases/clsPedido.php';
    require_once '../util/funciones.php';

    
    $objPed= new Pedido($_SESSION["id_area"],0, date('Y-m-d'));
//    Funciones::mensaje("naa", "#", "s");
//    $qas=$_SESSION["id_area"];
//    echo $qas."************".$_SESSION["id"];
    
    if(($objPed->AgregarPedido($_SESSION["id"],0)))
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