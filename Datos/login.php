<?php

$usuario=$_POST["txtusuario"];
$pass=$_POST["txtpass"];

require_once '../Modelo/ClsSesion.php';

$objSesion = new Sesion($usuario,$pass);

if($objSesion->IniciaSesion())
{
    if($_SESSION["permisos"]==8)
    {
        header("location:/SGI/Vista/Gerente.php");
    }
    else if($_SESSION["permisos"]==4)
    {
        header("location:/SGI/Vista/Almacen.php");
    }
    else 
    {
        header("location:/SGI/Vista/Area.php");
    }
}  else {
    header("location:/SGI/");
}

?>