<?php

    class Usuario{
        
        private $id;
        private $nombre;
        private $clave;
        private $permisos;
        private $area;
        private $almacen;
        
        public function __construct($nombre,$clave,$permisos,$area,$almacen) {

            $this->nombre=$nombre;
            $this->clave=$clave;
            $this->permisos=$permisos;
            $this->area=$area;
            $this->almacen=$almacen;
            
        }

        public function SetId($id) {
             $this->id=$id;
        }
        public function GetId() {
            return $this->id;
        }
        public function GetNombre() {
            return $this->nombre;
        }
        public function GetClave() {
            return $this->clave;
        }
        public function GetPermisos() {
            return $this->permisos;
        }        
        public function GetArea() {
            return $this->area;
        }        
        public function GetAlmacen() {
            return $this->almacen;
        }
        
        public  function AgregarUsuario($nombre,$contrasenha,$permisos)
        {
            $correcto=false;
            require_once '../Datos/clsConexion.php';
            $obj= new Conexion();
            $sql="insert into usuario values(nombre_usu,clave_usu,permisos_usu)
                    ('".$nombre."','".$contrasenha."',".$permisos.");";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
        
        
        public  function EditarUsuario($nombre,$contrasenha,$permisos)
        {
            $correcto=false;
            require_once '../Datos/clsConexion.php';
            $obj= new Conexion();
            $sql="update articulo set nombre_art='".$nombreNuevo."' where nombre_art='".$nombre."';";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
        


        public  function EliminarUsuario($nombre)
        {
            $correcto=false;
            require_once '../Datos/clsConexion.php';
            $obj= new Conexion();
            $sql="delete from usuario where nombre_usu='".$nombre."';";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }
            
            return $correcto;
        }
 
    }
?>