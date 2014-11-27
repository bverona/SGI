<?php

$nombre=$_POST['nombre'];
$unidad=$_POST['unidad'];
$cantidad=$_POST['cantidad'];
$tipo=$_POST['cbtipo'];
$codigo=$_POST['codigo'];
$precio=$_POST['precio'];


require_once '../Clases/clsArticulo.php';
require_once '../util/funciones.php';
$objArticulo= new Articulo();

    if(($objArticulo->AgregarArticulo($nombre, $unidad, $cantidad, $tipo, $codigo, $precio)!=0))
    {
        Funciones::mensaje("Operación Realizada Correctamente", "../Presentacion/ListarArticulos.php", "s");
    }else
    {
        Funciones::mensaje("Operación No Realizada", "../Presentacion/ListarArticulos.php", "e");
    }

?>