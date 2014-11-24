<?php
    session_name("SGI");
    session_start();
    
    $arreglo=$_POST["arreglo"];

    require_once '../Clases/clsPedido.php';
    require_once '../util/funciones.php';

    
    $objPed= new Pedido($_SESSION["id_area"], date('Y-m-d'));
//    Funciones::mensaje("naa", "#", "s");
//    $qas=$_SESSION["id_area"];
//    echo $qas."************".$_SESSION["id"];
    
    if(($objPed->AgregarPedido($_SESSION["id"])))
     {

        for($i=0;$i<count($arreglo);$i++)
        {
            if(($objPed->AgregarDetallePedido($arreglo[$i][0],$arreglo[$i][1])))
                {
                    
                }
        }        
                Funciones::mensaje("Hecho", "../Presentacion/Area.php", "s");
     }
?>