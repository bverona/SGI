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
        
        public  function AgregarPedido($area_id,$fecha)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="insert into pedido (area_id_are,fecha_ped)
                    values(".$area_id.",'".$fecha."');";
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }
            return $correcto;
        }
        
        public  function EditarPedido($id,$area,$fecha)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="update pedido 
                    set 
                    fecha_ped='".$fecha."'
                    area_id_are".$area."
                    where 
                        id_ped='".$id."';";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
        
        public  function EliminarPedido($id)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="delete from pedido where id_ped=".$id;
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }
            
        return $correcto;
        
        }        
        
        }
    
?>