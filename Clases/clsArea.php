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
            require_once 'clsConexion.php';
            $obj= new Conexion();
            $sql="insert into area(nombre_are) values('".$nombre."')";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }        
        
        public  function EditarArea($id,$nombreNuevo)
        {
            $correcto=false;
            require_once 'clsConexion.php';
            $obj= new Conexion();
            $sql="update area set nombre_are='".$nombreNuevo."' where id_are=".$id;

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
        
        public  function EliminarArea($id)
        {
            $correcto=false;
            require_once 'clsConexion.php';
            $obj= new Conexion();
            
            $sql="update usuario 
                    set 
                        area_id_are = null,
                            permisos_usu=0
                    where
                        area_id_are =".$id;
            $sql2="delete from area where id_are=".$id;

            
            if(($obj->Consultar($sql))==!0 && ($obj->Consultar($sql2))==!0)
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
            $registro = $resultado->fetch();
            
            $retorno = $registro["nombre_are"];
            
            return $retorno;
        }        
        
        public function ListarArea(){
            
            require_once 'clsConexion.php';
            $objCon = new Conexion();
            $sql = "select id_are, nombre_are from area order by 1;";
            $resultado = $objCon->consultar($sql);
            
            while($registro = $resultado->fetch()){  
                  
                $areas .= '<option value="'.$registro["id_are"].'">'.$registro["nombre_are"].'</option>';
            }
                        
            echo $areas;
        }

        public function ListarAreas(){
            
            require_once 'clsConexion.php';
            $objCon = new Conexion();
            $sql = "select id_are as id, nombre_are as nombre from area where id_are <> 0 order by 1;";
            $resultado = $objCon->consultar($sql);
            
        echo '
        <div class="panel panel-success">
            <div class="panel-heading"><b>Listado de Almacenes</b></div>
                <div class="panel-body">
                    <div class="table-responsive table-hover">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Editar</th>
                              <th>Eliminar</th>
                              <th>Areas</th>
                            </tr>
                          </thead>
                          <tbody>
        ';

            while ($registro = $resultado->fetch()) {

                echo '<tr>';
                echo '<td><a href="#" onclick="leerDatos(' . $registro["id"] . ' )" data-toggle="modal" data-target="#myModal"><img src="../../imagenes/editar.png"/></a></td>';
                echo '<td><a href="#" onclick="eliminar(\'' . $registro["id"] . '\')"><img src="../../imagenes/eliminar.png"/></a></td>';
                echo '<td>' . $registro["nombre"] . '</td>';
                echo '</tr>';
            }
                echo '</tbody>
                  </table>
            </div>
        </div>
    </div>
                ';

        }
        
    
        }    
?>