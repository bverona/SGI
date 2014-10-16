<?php

    class Usuario{
        
        private $id;
        private $nombre;
        private $clave;
        private $permisos;
        private $area;
        private $almacen;
        

        public function SetId($id) {
             $this->id=$id;
        }
        public function GetId() {
            return $this->id;
        }
        public function SetNombre($nombre) {
            $this->nombre=$nombre;            
        }
        public function GetNombre() {
            return $this->nombre;
        }
        public function SetClave($clave) {
            $this->clave=$clave;            
        }
        public function GetClave() {
            return $this->clave;
        }
        public function SetPermisos($permisos) {
            $this->permisos=$permisos;
        }        
        public function GetPermisos() {
            return $this->permisos;
        }        
        public function SetArea($area) {
            $this->area=$area;
        }        
        public function GetArea() {
            return $this->area;
        }        
        public function SetAlmacen($almacen) {
            $this->almacen=$almacen;
        }
        public function GetAlmacen() {
            return $this->almacen;
        }
        
        public  function AgregarUsuario($nombre,$contrasenha,$permisos)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="insert into usuario (nombre_usu,clave_usu,permisos_usu) 
                  values(
                    '".$nombre."',".
                    "'".md5($contrasenha)."',".
                        $permisos.")";
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
                 
        public  function EditarUsuario($nombreNuevo,$contrasenha)
        {
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="update usuario set ".
                  "nombre_usu='".$nombreNuevo."', ".
                  "clave_usu='".$contrasenha."' ". 
                  "where nombre_usu='".$this->nombre."';";
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }

        public  function ActualizaUsuario($nombreNuevo,$contrasenha, $id)
        {
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="update usuario set ".
                  "nombre_usu='".$nombreNuevo."', ".
                  "clave_usu='".$contrasenha."' ". 
                  "where id_usu=".$id;
          echo $sql."<br>";
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
        
        public  function EliminarUsuario($id)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="delete from usuario where id_usu=".$id;

            if(($obj->Consultar($sql))==!0)
            {
                return 1;
            }
            
            return 0;
        }
 
        public function AsignaArea($area,$nombre) 
        {
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="update usuario set ".
                  "area_id_are=".$area.
                  " where nombre_usu='".$nombre."'";
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }
            return $correcto;           
        }

        public function AsignaAlmacen($almacen,$nombre) 
        {
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="update usuario set ".
                  "almacen_id_alm=".$almacen.
                  " where nombre_usu='".$nombre."'";
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }
            return $correcto;           
        }
        
        public function buscar($id) {
            require_once '../Clases/clsConexion.php';
            $objCon = new Conexion();
            $sql = "select id_usu, nombre_usu, coalesce(almacen_id_alm,'-'),coalesce(area_id_are,'-') from usuario where id_usu=".$id;
            
            $resultdo = $objCon->consultar($sql);
            $registro = $resultdo->fetch();
            
            $retorno = array(
              "id"=>$registro["id_usu"],
              "nombre"=>$registro["nombre_usu"],
              "idAlmacen"=>$registro["almacen_id_alm"],
              "idArea"=>$registro["area_id_are"]
                );
            
                return ($retorno);
            
        }
        
        public function ListarUsuarios() 
        {
            require_once '../Clases/clsConexion.php';
            $objCon = new Conexion();
            
//            $sql = "select count(*) as cantidad from personal";
//            $registro = $objCon->consultar($sql)->fetch();
//            
//            $total_registros = $registro["cantidad"];
//            $registros_por_pagina = 4;
//            $total_paginas = ceil($total_registros / $registros_por_pagina);
//            $pagina_mostrar = ($pagina_actual -1) * $registros_por_pagina;
            
            $sql = "select 
                        u.id_usu as id,
                        u.nombre_usu as usuario,
                        COALESCE(a.nombre_alm,'') as almacen,
                        coalesce(ar.nombre_are,'') as area
                    from usuario u left outer join almacen a on a.id_alm=u.almacen_id_alm 
                        left outer join area ar on ar.id_are=u.area_id_are
                    
                    order by 1";
            
            $resultado = $objCon->consultar($sql);
            
            //echo $sql;
            
            echo '
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Listado de Usuarios</b></div>
                        <div class="panel-body">
                            <div class="table-responsive table-hover">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th colspan="2">&nbsp;</th>
                                      <th>Usuario</th>
                                      <th>Área/Almacén</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                ';
            
            while ($registro = $resultado->fetch())
            {
                echo '<tr>';
                    echo '<td><a href="#" onclick="leerDatosPersonal('.$registro["id"].')" data-toggle="modal" data-target="#myModal"><img src="../imagenes/editar.png"/></a></td>';
                    echo '<td><a href="#" onclick="eliminar(\''.$registro["id"].'\')"><img src="../imagenes/eliminar.png"/></a></td>';
                    echo '<td>'.$registro["usuario"].'</td>';
                    echo '<td>'.$registro["area"]."".$registro["almacen"].'</td>';
                    echo '';
                echo '</tr>';
            }
            echo '              </tbody>
                          </table>
                    </div>
                </div>
            </div>
                ';    
    }
    
    
            }
?>