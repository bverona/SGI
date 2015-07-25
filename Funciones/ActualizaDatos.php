<?php
   
        $usuario=$_POST['nombre'];
        $rb=$_POST['RadioInline'];
        $pass=$_POST['pass'];
        $modulos=$_POST['cbModulos'];
        $id=$_POST['id'];
 
        if(isset($_POST['antiguo']))
        {
           $antiguo=$_POST['antiguo'];            
        }else
            {
            $antiguo=1;
            }
        
        require_once '../Clases/ClsUsuario.php'; 
        require_once '../Clases/ClsSesion.php'; 
        require_once '../util/funciones.php';
        $objusuario = new Usuario();
        $direccion;
        
        $permisos=4;//permiso para almacén
        if($rb==4)
        {
        if($objusuario->ActualizaUsuario($usuario,md5($pass),$modulos,0,$permisos,$id,$antiguo))
            {
            $texto="Cambio Reailzado, satisfactoriamente";            
            }            
        }else
        {
            $permisos=2;
            $objusuario->ActualizaUsuario($usuario,md5($pass),0,$modulos,$permisos,$id,$antiguo);
            $texto="Cambio Realizado, satisfactoriamente";
        }
        
        $direccion="../Presentacion/Gerente/Gerente.php";
 
         Funciones::mensaje($texto, $direccion, 's');
        
?>
