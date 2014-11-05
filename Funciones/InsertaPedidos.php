<?php
    session_name("SGI");
    session_start();
   
    $arreglo=$_POST["arreglo"];

    require_once '../Clases/clsPedido.php';
    require_once '../util/funciones.php';
    
//    Funciones::mensaje("naa", "#", "s");

   $objPed= new Pedido($_SESSION["id_area"],date('y-m-d'));
    $j=0;

    if($objPed->AgregarPedido($_SESSION["id_area"],$id,date('y-m-d')))
     {

        for($i=0;$i<count($arreglo);$i++)
        {
            if(($objPed->AgregarDetallePedido($arreglo[$i])))
                {
                    $j++;
                }
        }        
                Funciones::mensaje("HEcho", "../Presentacion/gerente.php", "s");
     }
    echo "operación Realizada";
?>