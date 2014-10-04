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
        
        
    }

?>