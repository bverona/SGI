<?php

$usuario=$_POST["usuario"];

require_once '../Clases/ClsUsuario.php';
$objUsu= new Usuario();
$objUsu->ListarAccesoUsuarios($usuario);
?>