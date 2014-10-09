<?php
    
    class Area{
        
        private $id;
        private $nombre;
        
        
        public function SetId($id){
            $this->id=$id;
        }
        public function GetId(){
            return $this->id;
        }
        public function GetNombre(){
            return $this->nombre;
        }
        public function SetNombre($nombre) {
            $this->nombre=$nombre;
        }
        
        
        public  function AgregarArea($nombre)
        {
            $correcto=false;
            require_once '../Datos/clsConexion.php';
            $obj= new Conexion();
            $sql="insert into area(nombre_are) values('".$nombre."')";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
        
        
        public  function EditarArea($nombre,$nombreNuevo)
        {
            $correcto=false;
            require_once '../Datos/clsConexion.php';
            $obj= new Conexion();
            $sql="update area set nombre_are='".$nombreNuevo."' where nombre_are='".$nombre."'";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
        
        public  function EliminarArea($nombre)
        {
            $correcto=false;
            require_once '../Datos/clsConexion.php';
            $obj= new Conexion();
            $sql="delete from area where nombre_are='".$nombre."'";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }
            
            return $correcto;
        }
        
        
  
    
        }    
?>