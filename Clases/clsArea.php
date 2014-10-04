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
    
    
    public function AgregarArea($nombre)
    {
        require_once './clsConexion.php';
        $obj= new Conexion();
        $sql="insert into area(nombre_are) values('".$nombre."')";        
        
        $resultado=$obj->Consultar($sql);
        
    }
        
        
        
        
        }    
?>