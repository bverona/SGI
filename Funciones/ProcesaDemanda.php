<?php

$id_art=$_POST["id_art"];
$demanda=$_POST["demanda"];
$costoAlmacenamiento=$_POST["costoAlmacenamiento"];
$costoPreparacion=$_POST["costoPreparacion"];

require '../Clases/clsDemanda.php';

$objDemanda = new Demanda();


    if($objDemanda->NuevaDemanda($demanda,$costoPreparacion, $costoAlmacenamiento, $id_art))
        {       
            echo 'Realizado Correctamente';
        }           


?>
