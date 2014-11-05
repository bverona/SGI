<?php
   
        $usuario=$_POST['nombre'];
        $rb=$_POST['RadioInline'];
        $pass=$_POST['pass'];
        $modulos=$_POST['select'];
        $id=$_POST['id'];
 
        require_once '../Clases/ClsUsuario.php'; 
        require_once '../Clases/ClsSesion.php'; 
        require_once '../util/funciones.php';
        $objusuario = new Usuario();
        $direccion;
        
        
        $texto="Cambio No Realizado";            
        if($rb==4)
        {
        if($objusuario->ActualizaUsuario($usuario,md5($pass),$modulos,0,$id))
            {
            $texto="Cambio Realizado, satisfactoriamente";            
            }            
        }else{
        $objusuario->ActualizaUsuario($usuario,md5($pass),"0",$modulos,$id);            
        $texto="Cambio Realizado, satisfactoriamente";
        }
        
        $direccion="../Presentacion/Gerente.php";
 
         Funciones::mensaje($texto, $direccion, 's');
        
?>
