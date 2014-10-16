<?php
    
    class Almacen{
        
        private $id;
        private $nombre;
        
        
        public function SetId($id){
            $this->id=$id;
        }
        public function GetId(){
            return $this->id;
        }
        public function GetNombre(){
            return $this->nombre;
        }
        public function SetNombre($nombre) {
            $this->nombre=$nombre;
        }
        
        
        public  function AgregarAlmacen($nombre)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="insert into almacen(nombre_alm) values('".$nombre."')";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }        
        
        public  function EditarAlmacen($nombre,$nombreNuevo)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="update almacen set nombre_alm='".$nombreNuevo."' where nombre_alm='".$nombre."'";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
        
        public  function EliminarAlmacen($nombre)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="delete from almacen where nombre_alm='".$nombre."'";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }
            
            return $correcto;
        }  

        
        public function ObtenerAlmacen($id){
            
            require_once '../datos/accesodatos.php';
            $objCon = new Conexion();
            $sql = "select  nombre_alm from almacen where id_alm=".$id."order by 1;";
            
            $resultado = $objCon->consultar($sql);
            $registro = $resulatdo->fetch();
            
            $retorno = $registro["nombre_alm"];
            
            return $retorno;
        }        

        public function ListarAlmacen(){
            
            require_once '../Clases/clsConexion.php';
            $objCon = new Conexion();
            $sql = "select id_alm, nombre_alm from almacen order by 1;";
            $resultado = $objCon->consultar($sql);
            
            while($registro = $resultado->fetch()){            

                $almacenes .= '<option value="'.$registro["id_alm"].'">'.$registro["nombre_alm"].'</option>';
                
            }
                        
            echo $almacenes;
        }        
        public function ListarAlmacenes(){
            
            require_once '../Clases/clsConexion.php';
            $objCon = new Conexion();
            $sql = "select id_alm, nombre_alm from almacen where id_alm <> 0 order by 1;";
            $resultado = $objCon->consultar($sql);
            
            while($registro = $resultado->fetch()){            

                $almacenes .= '<tr><td>  '.$registro["id_alm"].'</td><td>'.$registro["nombre_alm"].'</td></tr>';                
            }
                        
            echo $almacenes;
        }        
        
        
        
        
            }    
?>