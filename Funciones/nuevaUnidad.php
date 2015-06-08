<?php
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }

$nombre=$_POST['nombre'];


require_once '../Clases/clsUnidad.php';

$objUni= new Unidad();

$objUni->NuevaUnidad($nombre);

?>