<?php

    class Articulo {
        
        private $id;
        private $nombre;
        private $unidad;
        private $cantidad;

    
    
        public function SetId($id) {
            return $this->id=$id;            
        }
        public function GetId() {
            return $this->id;            
        }
        public function GetNombre() {
            return $this->nombre;            
        }
        public function GetUnidad() {
            return $this->unidad;            
        }
        public function GetCantidad() {
            return $this->cantidad;            
        }
        
        
        public  function AgregarArticulo($nombre,$unidad,$cantidad,$tipo,$codigo,$precio)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="
            insert into articulo(
                nombre_art,
                unidad_art,
                cantidad_art,
                TipoArticulo_id_tip_art,
                codigo_art,
                precio_art) 
            values(
                    '".$nombre."',".
                    "'".$unidad."',".
                    $cantidad.","
                    .$tipo.","
                    ."'".$codigo."',"
                    .$precio.")";
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }      
        
        public  function EditarArticulo($nombre,$unidad,$cantidad)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="update articulo 
                  set 
                    nombre_art='".$nombreNuevo."',
                    unidad_art='".$unidad."',
                    cantidad=".$cantidad.
                 "where
                    nombre_art='".$nombre."'";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }
        
        public  function EliminarArticulo($nombre)
        {
            $correcto=false;
            require_once '../Clases/clsConexion.php';
            $obj= new Conexion();
            $sql="delete from articulo where nombre_art='".$nombre."'";

            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }
            
            return $correcto;
        }
 
        public function SelectTipoArticulo() 
        {

        require_once '../Clases/clsConexion.php';
        $objCon = new Conexion();
        $sql = "select idTipoArticulo,  nombre_tip from tipoarticulo order by 1";
        $resultado = $objCon->consultar($sql);
        while ($registro = $resultado->fetch()) {

            $almacenes .= '<option value="' . $registro["idTipoArticulo"] . '">' . $registro["nombre_tip"] . '</option>';
        }

        echo $almacenes;
        }

        public function SelectArticulo($id) 
        {

        require_once '../Clases/clsConexion.php';
        $objCon = new Conexion();
        $sql = "select id_art as id, nombre_art as nombre from articulo where TipoArticulo_id_tip_art ='".$id."' order by 1";
        $resultado = $objCon->consultar($sql);
        while ($registro = $resultado->fetch()) 
        {
            echo'<option value="' . $registro["id"] .'">' . $registro["nombre"] . '</option>';
        }

    }
        
        public function BuscaArticulo($id) 
        {

        require_once '../Clases/clsConexion.php';
        $objCon = new Conexion();
        $sql = "select id_art as id, nombre_art as nombre, cantidad_art as cantidad, unidad_art as unidad from articulo where id_art ='".$id."'";
        $resultado = $objCon->consultar($sql);
        $retorno;
        while ($registro = $resultado->fetch()) 
        {
            $retorno = array(
                "id"=>$registro["id"],
                "nombre"=>$registro["nombre"],
                "cantidad"=>$registro["cantidad"],
                "unidad"=>$registro["unidad"]
            );
        }
        return $retorno;
        }
        
        public function ListarArticulos($id) {
        require_once '../Clases/clsConexion.php';
        require_once '../Clases/clsTipo.php';

        $objCon = new Conexion();
        $objTipoArticulo = new TipoArticulo();
        
        $sql = "select 
                     a.id_art as id, 
                     a.nombre_art as nombre, 
                     a.unidad_art as unidad, 
                     a.cantidad_art as cantidad,
                     t.nombre_tip as tipo
                from articulo a inner join tipoarticulo t 
                     on a.TipoArticulo_id_tip_art=t.idTipoArticulo
                order by 1";

        $sql2=  "select
                     a.id_art as id,
                     a.nombre_art as nombre,
                     a.unidad_art as unidad,
                     a.cantidad_art as cantidad, 
                     t.nombre_tip as tipo
                from articulo a inner join tipoarticulo t 
                     on a.TipoArticulo_id_tip_art=t.idTipoArticulo
                where TipoArticulo_id_tip_art='".$id."'
                order by 1";
        
            ($id=='0')?
            $resultado = $objCon->consultar($sql):
            $resultado = $objCon->consultar($sql2);
//                print_r($resultado);

        while ($registro = $resultado->fetch()) {

            echo '<tr>';
            echo '<td><a href="#" onclick="leerDatosEntrada(' . $registro["id"] . ')" data-toggle="modal" data-target="#ModalEntrada"><span class="glyphicon glyphicon-arrow-down"></span><img src="../imagenes/entrada.png"/></a></td>';
            echo '<td><a href="#" onclick="leerDatosSalida(' . $registro["id"] . ')" data-toggle="modal" data-target="#ModalSalida"><span class="glyphicon glyphicon-arrow-up"></span><img src="../imagenes/salida.png"/></a></td>';
            echo '<td>' . $registro["nombre"] . '</td>';
            echo '<td>' . $registro["unidad"] . '</td>';
            echo '<td>' . $registro["cantidad"] . '</td>';
            echo '<td>' . $registro["tipo"] . '</td>';
            echo '</tr>';
        }
        echo '                              ';
    }
        

    }
    
?>