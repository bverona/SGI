<?php

    class Articulo {
        
        private $id;
        private $nombre;
        private $unidad;
        private $cantidad;

    
        public function __construct($nombre, $unidad,$cantidad)
        {
            $this->nombre=$nombre;
            $this->unidad=$unidad;
            $this->cantidad=$cantidad;
        }
    
        public function SetId($id) {
            return $this->id=$id;            
        }
        public function GetId() {
            return $this->id;            
        }
        public function GetNombre() {
            return $this->nombre;            
        }
        public function GetUnidad() {
            return $this->unidad;            
        }
        public function GetCantidad() {
            return $this->cantidad;            
        }
        
        
        public  function AgregarArticulo($nombre,$unidad,$cantidad)
        {
            $correcto=false;
            require_once '../Datos/clsConexion.php';
            $obj= new Conexion();
            $sql="insert into articulo(nombre_art,unidad_art,cantidad_art) 
                    values('".$nombre."','".$unidad."',".$cantidad.")";
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
        
        
        public  function EditarArticulo($nombre,$unidad,$cantidad)
        {
            $correcto=false;
            require_once '../Datos/clsConexion.php';
            $obj= new Conexion();
            $sql="update articulo 
                  set 
                    nombre_art='".$nombreNuevo."',
                    unidad_art='".$unidad."',
                    cantidad=".$cantidad.
                 "where
                    nombre_art='".$nombre."'";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
        
        public  function EliminarArticulo($nombre)
        {
            $correcto=false;
            require_once '../Datos/clsConexion.php';
            $obj= new Conexion();
            $sql="delete from articulo where nombre_art='".$nombre."'";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }
            
            return $correcto;
        }
        
    }               
?>