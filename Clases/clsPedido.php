<?php
    
    class Pedido{
        
        private $id;
        private $idArea;
        private $idAlmacen;
        private $fecha;
        private $descripcion;
        

        function __construct($idArea,$idAlmacen,$fecha){
            $this->fecha=$fecha;
            $this->idArea=$idArea;
            $this->idAlmacen=$idAlmacen;
            $this->descripcion="";
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
        public function SetDescripcion($descripcion) {
            $this->descripcion=$descripcion;
        }
        public function GetDescripcion() {
            return $this->descripcion;
        }        
        public function GetIdAlmacen() {
            return $this->idAlmacen;
        }        
        public function GetFecha() {
            return $this->fecha;
        }
        
        public  function AgregarPedido($usuario,$foco)
        {
            
            $correcto=false;
            require_once 'clsConexion.php';
            $obj= new Conexion();
            
            ($foco==0)?
            $sql="insert into pedido (area_id_are,fecha_ped,id_usu_ped,descripcion_ped)
                    values(".$this->GetIdArea().",'".$this->GetFecha()."',".$usuario.",'".$this->GetDescripcion()."');":
            $sql="insert into pedido (almacen_id_alm,fecha_ped,id_usu_ped,descripcion_ped)
                    values(".$this->GetIdAlmacen().",'".$this->GetFecha()."',".$usuario.",'".$this->GetDescripcion()."');";

            echo $sql;
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
        
        public  function EditarPedido($id,$area,$fecha)
        {
            $correcto=false;
            require_once 'clsConexion.php';
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
            require_once 'clsConexion.php';
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
            require_once 'clsConexion.php';
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
        
        public function ListarPedidosArea() 
        {
             require_once 'clsConexion.php';

             $objCon = new Conexion();

             $sql = "select 
                        a.nombre_are as area,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha,
                        dp.atendido_det_ped as atendido
                    from
                        area a
                            inner join
                        pedido p ON a.id_are = p.Area_id_are
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                        where p.Area_id_are<>0 ";

                 $resultado = $objCon->consultar($sql);

             while ($registro = $resultado->fetch()) {

                 ($registro["atendido"]==1)?$aux="Atendido":$aux="No Atendido";
                     
                 echo '<tr>';

                 echo '<td>' . $registro["articulo"] . '</td>';
                 echo '<td>' . $registro["cantidad"] . '</td>';
                 echo '<td>' . $registro["usuario"] . '</td>';
                 echo '<td>' . $registro["area"] . '</td>';
                 echo '<td>' . $registro["fecha"] . '</td>';
                 echo '<td>' . $aux . '</td>';
                 echo '</tr>';
             }
         
         }        
        
        public function ListarPedidosAlmacen() 
        {
             require_once 'clsConexion.php';

             $objCon = new Conexion();

             $sql = "select 
                        a.nombre_alm as almacen,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha,
                        dp.atendido_det_ped as atendido                        
                    from
                        almacen a
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                        where p.almacen_id_alm<>0 ";

                 $resultado = $objCon->consultar($sql);

             while ($registro = $resultado->fetch()) {
                 ($registro["atendido"]==1)?$aux="Atendido":$aux="No Atendido";
                 echo '<tr>';

                 echo '<td>' . $registro["articulo"] . '</td>';
                 echo '<td>' . $registro["cantidad"] . '</td>';
                 echo '<td>' . $registro["usuario"] . '</td>';
                 echo '<td>' . $registro["almacen"] . '</td>';
                 echo '<td>' . $registro["fecha"] . '</td>';
                 echo '<td>' . $aux. '</td>';
                 echo '</tr>';
             }
         
         }        
        
        }
    
?>