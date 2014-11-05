<?php
    
$usuario=$_POST["txtusuario"];
$pass=$_POST["txtpass"];

require_once '../Clases/ClsSesion.php';

$objSesion = new Sesion();

/*método que da acceso a los diferentes módulos a través de los permisos 
de cada usuario */
if($objSesion->IniciaSesion($usuario,$pass))
{
    if($_SESSION["permisos"]==8)
    {
        header("location:../Presentacion/Gerente.php");
    }
    else if($_SESSION["permisos"]==4)
    {
        header("location:../Presentacion/Almacen.php");
    }
    else 
    {
        header("location:../Presentacion/Area.php");
    }
}  else {
        
    header("location:../index.php");
}

?>