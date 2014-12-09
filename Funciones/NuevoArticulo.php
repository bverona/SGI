<?php
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }

$nombre=$_POST['nombre'];
$unidad=$_POST['unidad'];

$tipo=$_POST['cbtipo'];
$codigo=$_POST['codigo'];
$precio=$_POST['precio'];


require_once '../Clases/clsArticulo.php';
require_once '../util/funciones.php';
$objArticulo= new Articulo();

    if(($objArticulo->AgregarArticulo($nombre, $unidad,  $tipo, $codigo, $precio,$_SESSION["id_almacen"])!=0))
    {
        Funciones::mensaje("Operación Realizada Correctamente", "../Presentacion/Almacen/ListarArticulos.php", "s");
    }else
    {
        Funciones::mensaje("Operación No Realizada", "../Presentacion/Almacen/ListarArticulos.php", "e");
    }

?>