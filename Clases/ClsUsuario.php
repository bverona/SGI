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
        
        public function RegistraAlmacen($nombre) {
            require_once './clsConexion.php';
            
        }
        
            
    }


?>