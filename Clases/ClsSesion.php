<?php
    class Sesion{
        
        private static $user;
        private static $pass;
        

        public function IniciaSesion($usu, $pass) {
            $sesion=0;
            require_once 'clsConexion.php';
            $objConexion= new Conexion();
            $sql="  select 
                        u.id_usu as id,
                        u.nombre_usu as usuario,
                        u.clave_usu as pass,
                        u.permisos_usu as permisos,
                        u.almacen_id_alm as almacen,
                        u.area_id_are as area
                    from usuario u where u.nombre_usu='".$usu."'";
        
            
            //resultado almacena la tabla obtenida de la consulta
            $resultado=$objConexion->Consultar($sql)->fetch();

            //cadena para insertar en la tabla registro
            $sql2="insert into registro (id_usu_reg,fecha_reg,hora_reg) values(".$resultado["id"].",'". date("Y-m-d")."','". date("h:i:s")."')";
            $objConexion->Consultar($sql2) ;  

            if( ($resultado['pass']==md5($pass)) )
            {
                    session_name("SGI");
                    session_start();
                    $_SESSION['usuario']=$resultado['usuario'];
                    $_SESSION['permisos']=$resultado['permisos'];
                    $_SESSION['id_almacen']=$resultado['almacen'];
                    $_SESSION['id_area']=$resultado['area'];
                    $_SESSION['id']=$resultado['id'];
                    $sesion=1;
               $objConexion->Consultar($sql2) ;  
                    
            }
                return $sesion;
        }
        
        
    }
?>