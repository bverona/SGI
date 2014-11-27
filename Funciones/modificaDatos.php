<?php
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }


    $usuario=$_POST['nombre'];
    $pass=$_POST['pass'];
    $pass2=$_POST['pass2'];

    if($pass==$pass2)
    {
        require_once '../Clases/ClsUsuario.php'; 
        require_once '../util/funciones.php';
        
        $objusuario = new Usuario();
        $direccion;

        $objusuario->EditarUsuario($_SESSION['id'],$usuario,md5($pass));
        $texto="Cambio Realizado, satisfactoriamente";

        //Esto por el momento
    if($_SESSION["permisos"]==8)
            {
                $direccion="../Presentacion/Gerente.php";
            }
            else if($_SESSION["permisos"]==4)
            {
                $direccion="../Presentacion/Almacen.php";            }
            else 
            {
                $direccion="../Presentacion/Area.php";
            }

        Funciones::mensaje($texto, $direccion, 's');
        
    }
    else {
     //esto tambien por el momento
        
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
}
?>
