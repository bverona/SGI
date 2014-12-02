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
            echo $sql;
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }
            return $correcto;
            
        }
        
        public function ListarPedidos() 
        {
             require_once '../Clases/clsConexion.php';

             $objCon = new Conexion();

             $sql = "select 
                        a.nombre_are as area,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha
                    from
                        area a
                            inner join
                        pedido p ON a.id_are = p.Area_id_are
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu";

                 $resultado = $objCon->consultar($sql);

             while ($registro = $resultado->fetch()) {

                 echo '<tr>';

                 echo '<td>' . $registro["articulo"] . '</td>';
                 echo '<td>' . $registro["cantidad"] . '</td>';
                 echo '<td>' . $registro["usuario"] . '</td>';
                 echo '<td>' . $registro["fecha"] . '</td>';
                 echo '</tr>';
             }
         
         }        
        
        
        }
    
?>