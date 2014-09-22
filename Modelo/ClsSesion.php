<?php
    class Sesion{
        
        private static $user;
        private static $pass;
        
        
        public function __construct($usu, $pass)
        {
            $this->user=$usu;
            $this->pass=$pass;
        }
        
        public function IniciaSesion() {
            $sesion=FALSE;
            require_once 'clsConexion.php';
            $objConexion= new Conexion();
            $sql="select".
                    " nombre_usu as usuario,".
                    "clave_usu as pass,".
                    "permisos_usu as permisos".
                    " from usuario where".
                    " nombre_usu='".  $this->user."'";
                    //." and clave_usu='".$pass."';";
            
            //resultado almacena la tabla obtenida de la consulta
            $resultado=$objConexion->Consultar($sql)->fetch();
            
            if($resultado['pass']==  md5($this->pass))
                {
                session_name("SGI_session");
                session_start();
                $_SESSION['usuario']=$resultado['usuario'];
                $_SESSION['permisos']=$resultado['permisos'];
                $sesion=TRUE;
               
                }
            return $sesion;
        }        
    }
?>