<?php
    session_name("SGI");
    session_start();
    
    $nombre=$_POST['nombre'];
    $pass=$_POST['pass'];
    $permisos=$_POST['RadioInline'];
    $modulo=$_POST['cbModulos'];

    require_once '../Clases/ClsUsuario.php';
    require_once '../util/funciones.php';
    $objusuario= new Usuario();
   
        
        if(($objusuario->AgregarUsuario($nombre, $pass, $permisos)) )
        {
            //asigna área o Almacen según sea
            $permisos==2?$objusuario->AsignaArea($modulo,$nombre):$objusuario->AsignaAlmacen($modulo, $nombre);
            
            Funciones::mensaje("Operación Realizada con éxito", "../Presentacion/Gerente/Gerente.php", 's');
        }
        else
        {
            Funciones::mensaje("Operación fallida, intente nuevamente", "../Presentacion/Gerente/Gerente.php", 'e');
        }
    

    ?>