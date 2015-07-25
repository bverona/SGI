<?php
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }

$nombre=$_POST['nombre'];


require_once '../Clases/clsTipo.php';
require_once '../util/funciones.php';
$objTipo= new TipoArticulo();

$objTipo->AgregarTipo($nombre);

?>