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
        
        /*
         * Al registrar un artículo debe registrarse también la entrada de este
         * al Almacén General, ya que solo este es quien puede realizar registros
         * de artículos nuevos
         */        
        public  function AgregarArticulo($nombre,$unidad,$tipo,$codigo,$precio,$almacen)
        {
            $correcto=false;
            require_once 'clsConexion.php';
            require_once '../Clases/clsMovimiento.php'; 
            $obj= new Conexion();
            $objMovimiento = new Movimiento();



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
                if(($objMovimiento->AgregaMovimiento(0, $almacen,date('Y-m-d'))))
                {
                    $sql="select MAX(id_art) as articulo from articulo";
                    $id_art=$obj->Consultar($sql)->fetch();
                    
                    $descripcion="Primer Ingreso";
                    //saldo es 0 porque al ser un artículo nievo no hay saldo
                    if($objMovimiento->AgregaDetalleMovimientoEntrada($id_art["articulo"], $cantidad, 0,$descripcion))
                    {
                        $correcto=true;
                    }
                    else
                        {
                            $correcto=true;
                        }
                }
            }

            return $correcto;
        }      
        
        public  function EditarArticulo($nombre,$unidad,$cantidad)
        {
            $correcto=false;
            require_once 'clsConexion.php';
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
            require_once 'clsConexion.php';
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
            require_once 'clsConexion.php';
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
            require_once 'clsConexion.php';
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
            require_once 'clsConexion.php';
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
        
        public function ListarArticulos($id) 
        {
            require_once 'clsConexion.php';
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
                    where TipoArticulo_id_tip_art='".$id." and
                        '
                    order by 1";

                ($id=='0')?
                $resultado = $objCon->consultar($sql):
                $resultado = $objCon->consultar($sql2);

            while ($registro = $resultado->fetch()) {

                echo '<tr>';
                echo '<td><a href="#" onclick="leerDatosEntrada(' . $registro["id"] . ')" data-toggle="modal" data-target="#ModalEntrada"><span class="glyphicon glyphicon-arrow-down"></span><img src="../../imagenes/entrada.png"/></a></td>';
                echo '<td><a href="#" onclick="leerDatosSalida(' . $registro["id"] . ')" data-toggle="modal" data-target="#ModalSalida"><span class="glyphicon glyphicon-arrow-up"></span><img src="../../imagenes/salida.png"/></a></td>';
                echo '<td>' . $registro["nombre"] . '</td>';
                echo '<td>' . $registro["unidad"] . '</td>';
                echo '<td>' . $registro["cantidad"] . '</td>';
                echo '<td>' . $registro["tipo"] . '</td>';
                echo '</tr>';
            }
            echo '                              ';
        }

        public function ListarArticulosxSubAlmacen($id,$Almacen) 
        {
            require_once 'clsConexion.php';

            $objCon = new Conexion();

            $sql = "select 
                        *                        
                    from
                        almacen a
                            inner join
                        movimiento m ON a.id_alm = m.almacen_id_alm
                            inner join
                        detalle_movimiento dm ON m.id_mov = dm.movimiento_id_mov
                            inner join
                        articulo art ON dm.articulo_id_art= art.id_art
                         
                    order by 1";

            $sql2=  "select 
                        art.nombre_art,
                        art.unidad_art,
                        dm.cantidad_det_mov,
                        dm.saldo_det_mov
                        
                    from
                        almacen a
                            inner join
                        movimiento m ON a.id_alm = m.almacen_id_alm
                            inner join
                        detalle_movimiento dm ON m.id_mov = dm.movimiento_id_mov
                            inner join
                        articulo art ON dm.articulo_id_art= art.id_art
                        where a.id_alm='".$Almacen."' order by 1";

                ($id=='0')?
                $resultado = $objCon->consultar($sql):
                $resultado = $objCon->consultar($sql2);

            while ($registro = $resultado->fetch()) {

                echo '<tr>';
                echo '<td><a href="#" onclick="leerDatosEntrada(' . $registro["id"] . ')" data-toggle="modal" data-target="#ModalEntrada"><span class="glyphicon glyphicon-arrow-down"></span><img src="../../imagenes/entrada.png"/></a></td>';
                echo '<td><a href="#" onclick="leerDatosSalida(' . $registro["id"] . ')" data-toggle="modal" data-target="#ModalSalida"><span class="glyphicon glyphicon-arrow-up"></span><img src="../../imagenes/salida.png"/></a></td>';
                echo '<td>' . $registro["nombre"] . '</td>';
                echo '<td>' . $registro["unidad"] . '</td>';
                echo '<td>' . $registro["cantidad"] . '</td>';
                echo '<td>' . $registro["tipo"] . '</td>';
                echo '</tr>';
            }
        
            
            
            }
        

    }
    
?>