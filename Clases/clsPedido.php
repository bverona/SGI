<?php
    
    class Pedido{
        
        private $id;
        private $idArea;
        private $fecha;
        
        function __construct($idArea,$fecha){
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
        
        public  function AgregarPedido($usuario)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="insert into pedido (area_id_are,fecha_ped,id_usu_ped)
                    values(".$this->GetIdArea().",'".$this->GetFecha()."',".$usuario.");";
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }
//            echo $sql;
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
        
        public function AgregarDetallePedido($id_art,$cant)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            //para obtener el indice del último pedido agregado
            $sql="select MAX(id_ped)as maximo from pedido;";
            
            $resultado = $obj->Consultar($sql);
            $registro = $resultado->fetch();
            
            $sql="insert into detalle_pedido(Pedido_id_ped,articulo_id_art,cantidad_art)"
                    . "values(".$registro["maximo"].",".$id_art.",".$cant.")";
            
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }
            return $correcto;
            
        }
        
        }
    
?>