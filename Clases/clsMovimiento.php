<?php
    
    class Movimiento{
        
        private $id;
        private $tipo;
        private $almacen;
        
        public function __construct($tipo,$almacen) {
            $this->almacen=$almacen;
            $this->tipo=$tipo;
        }
        
        public function SetId($id) {
            $this->id=$id;
        }        
        public function GetId() {
            return $this->id;
        }        
        public function GetTipo() {
            return $this->tipo;
        }        
        public function GetAlmacen() {
            return $this->almacen;
        }        

        
    }

?>
