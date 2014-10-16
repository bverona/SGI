<?php
    
    class Movimiento{
        
        private $id;
        private $tipo;
        private $almacen;
        
        
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
        public function SetTipo($tipo) {
            return $this->tipo=$tipo;
        }        
        public function SetAlmacen($almacen) {
            return $this->almacen=$almacen;
        }        

         public function AgregaMovimiento($tipo_mov,$almacen_id){
            
            $correcto=false; 
            require_once '../Clases/clsConexion.php';
            
            $obj= new Conexion();
            $sql="insert into movimiento(tipo_mov, almacen_id_alm)
                     values(".$tipo_mov.",".$almacen_id.")";
            
            if($obj->Consultar($sql)=!0)
            {
                $correcto=true;
            }
            return $correcto;

           }
    
        public function EditaMovimiento($id,$tipo_mov,$almacen_id)
        {
            $correcto=false; 
            require_once '../Clases/clsConexion.php';
            
            $obj= new Conexion();
            $sql="update 
                    movimiento 
                    set 
                    tipo_mov=".$tipo_mov.",
                    almacen_id_alm=".$almacen_id."
                    where id_mov=";
            
            if($obj->Consultar($sql)=!0)
            {
                $correcto=true;
            }
            return $correcto;
           
        }
        
    }

?>
