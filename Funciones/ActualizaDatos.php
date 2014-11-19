<?php
   
        $usuario=$_POST['nombre'];
        $rb=$_POST['RadioInline'];
        $pass=$_POST['pass'];
        $modulos=$_POST['cbModulos'];
        $id=$_POST['id'];
 
        require_once '../Clases/ClsUsuario.php'; 
        require_once '../Clases/ClsSesion.php'; 
        require_once '../util/funciones.php';
        $objusuario = new Usuario();
        $direccion;
        echo $modulos."<br>";
        
        $permisos=4;//permiso para almacén
        if($rb==4)
        {
        if($objusuario->ActualizaUsuario($usuario,md5($pass),$modulos,0,$permisos,$id))
            {
            $texto="Cambio Reailzado, satisfactoriamente";            
            }            
        }else
        {
            $permisos=2;
            $objusuario->ActualizaUsuario($usuario,md5($pass),0,$modulos,$permisos,$id);
            $texto="Cambio Realizado, satisfactoriamente";
        }
        
        $direccion="../Presentacion/Gerente.php";
 
         Funciones::mensaje($texto, $direccion, 's');
        
?>
