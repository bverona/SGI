<?php
    
    class Area{
        
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
        
        
        public  function AgregarArea($nombre)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="insert into area(nombre_are) values('".$nombre."')";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }        
        
        public  function EditarArea($nombre,$nombreNuevo)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="update area set nombre_are='".$nombreNuevo."' where nombre_are='".$nombre."'";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
        
        public  function EliminarArea($nombre)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="delete from area where nombre_are='".$nombre."'";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }
            
            return $correcto;
        }

        public function ObtenerArea($id){
            
            require_once '../datos/accesodatos.php';
            $objCon = new Conexion();
            $sql = "select  nombre_are from area where id_are=".$id."order by 1;";
            
            $resultado = $objCon->consultar($sql);
            $registro = $resulatdo->fetch();
            
            $retorno = $registro["nombre_are"];
            
            return $retorno;
        }        
        
        public function ListarArea(){
            
            require_once '../Clases/clsConexion.php';
            $objCon = new Conexion();
            $sql = "select id_are, nombre_are from area order by 1;";
            $resultado = $objCon->consultar($sql);
            
            while($registro = $resultado->fetch()){  

                $areas .= '<option value="'.$registro["id_are"].'">'.$registro["nombre_are"].'</option>';
            }
                        
            echo $areas;
        }
        public function ListarAreas(){
            
            require_once '../Clases/clsConexion.php';
            $objCon = new Conexion();
            $sql = "select id_are, nombre_are from area where id_are <> 0 order by 1;";
            $resultado = $objCon->consultar($sql);
            
            while($registro = $resultado->fetch()){  

                $areas .= '<tr><td>'.$registro["id_are"].'</td><td>'.$registro["nombre_are"].'</td></tr>';                
            }
                        
            echo $areas;
        }
        
    
        }    
?>