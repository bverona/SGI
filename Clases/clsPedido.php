<?php
    
    class Pedido{
        
        private $id;
        private $idArea;
        private $fecha;
        
        public function __construct($idArea,$fecha){
            $this->fecha=$fecha;
            $this->idArea=$idArea;
        }
        
        public function SetId($id) {
            $this->id=$id;
        }
        public function GetId() {
            return $this->id;
        }
        public function GetIdArea() {
            return $this->idArea;
        }
        
        public function GetFecha() {
            return $this->fecha;
        }
        
        
        
        
        
        
        
        }
    
?>