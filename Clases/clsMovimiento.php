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
            
            if($obj->Consultar($sql)!=0)
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
            
            if($obj->Consultar($sql)!=0)
            {
                $correcto=true;
            }
            return $correcto;
           
        }
        
        public function AgregaDetalleMovimientoEntrada($id_art,$cantidad,$saldo,$id_alm) 
        {

            $correcto=false; 
            require_once '../Clases/clsConexion.php';
            
            $obj= new Conexion();
            
            $sqlEntrada="select id_mov from movimiento where almacen_id_alm=".$id_alm." and tipo_mov=0";
            echo $sqlEntrada;
            $resultado=$obj->Consultar($sqlEntrada);
            $registrado=$resultado->fetch();

            $sql="insert into detalle_movimiento (
                        movimiento_id_mov,
                        articulo_id_art,
                        cantidad_det_mov,
                        saldo_det_mov)
                  values(".$registrado["id_mov"].",".$id_art .",".$cantidad.",".$saldo.")";
            $sqlSuma="update articulo set cantidad_art=cantidad_art+".$cantidad." where id_art=".$id_art;
            
            if($obj->Consultar($sql)!=0)
            {
                if($obj->Consultar($sqlSuma)!=0)
                {
                    $correcto=true;
                }

            }
            return $correcto;

        }
        
        
        
    }

?>
