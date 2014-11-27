<?php

class Almacen {

    private $id;
    private $nombre;

    public function SetId($id) {
        $this->id = $id;
    }

    public function GetId() {
        return $this->id;
    }

    public function GetNombre() {
        return $this->nombre;
    }

    public function SetNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function AgregarAlmacen($nombre) {
        $correcto = false;
        require_once '../Clases/clsConexion.php';
        $obj = new Conexion();
        $sql1 = "insert into almacen(nombre_alm) values('" . $nombre . "')";
        $sqlmax="select MAX(id_alm) as maximo from almacen";
        
        if ( (($obj->Consultar($sql1)) == !0)) 
        {
            $resultado=$obj->Consultar($sqlmax);
            $registro=$resultado->fetch();
            
            //movimiento de entrada = 0
            $sql2 = "insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(0,".$registro["maximo"] .",'".date('Y-m-d')."')";

            //movimiento de salida = 1
            $sql3 = "insert into movimiento (tipo_mov, almacen_id_alm,fecha_det_mov) values(1,".$registro["maximo"] .",'".date('Y-m-d')."')";
            if((($obj->Consultar($sql2)) == !0) && (($obj->Consultar($sql3)) == !0))
            {
                $correcto= true;
            }
        }

        return $correcto;
    }

    public function EditarAlmacen($id, $nombreNuevo) {
        $correcto = false;
        require_once '../Clases/clsConexion.php';
        $obj = new Conexion();
        $sql = "update almacen set nombre_alm='" . $nombreNuevo . "' where id_alm=" . $id ;

        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }

        return $correcto;
    }

    public function EliminarAlmacen($nombre) {
        $correcto = false;
        require_once '../Clases/clsConexion.php';
        $obj = new Conexion();
        //antes de eliminar tiene que verificarse que no tenga ningún artículo
        //$sql = "delete from almacen where nombre_alm='" . $nombre . "'";

        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }

        return $correcto;
    }

    public function ObtenerAlmacen($id) {

        require_once '../datos/accesodatos.php';
        $objCon = new Conexion();
        $sql = "select  nombre_alm from almacen where id_alm=" . $id . "order by 1;";

        $resultado = $objCon->consultar($sql);
        $registro = $resulatdo->fetch();

        $retorno = $registro["nombre_alm"];

        return $retorno;
    }

    //para agregar al select cuando se hace un editar usuario
    public function ListarAlmacenSinFiltro() {

        require_once '../Clases/clsConexion.php';
        $objCon = new Conexion();
        $sql = "select id_alm, nombre_alm from almacen  order by 1;";
        $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) {

            $almacenes .= '<option value="' . $registro["id_alm"] . '">' . $registro["nombre_alm"] . '</option>';
        }

        echo $almacenes;
    }

    //para agregar al select cuando se hace un nuevo usuario
    public function ListarAlmacenConFiltro() {

        require_once '../Clases/clsConexion.php';
        $objCon = new Conexion();
        $sql = "select id_alm, nombre_alm from almacen where asignado_alm=0 order by 1;";
        $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) {

            $almacenes .= '<option value="' . $registro["id_alm"] . '">' . $registro["nombre_alm"] . '</option>';
        }

        echo $almacenes;
    }

    //para Listar todos los almacenes
    public function ListarAlmacenes() 
    {

        require_once '../Clases/clsConexion.php';
        $objCon = new Conexion();
        $sql = "select id_alm, nombre_alm from almacen where id_alm <> 0 order by 1;";
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
                                      <th>Almacén</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                ';

                            while ($registro = $resultado->fetch()) {

                                echo '<tr>';
                                echo '<td><a href="#" onclick="leerDatos(' . $registro["id_alm"] . ' )" data-toggle="modal" data-target="#myModal"><img src="../imagenes/editar.png"/></a></td>';
                                echo '<td><a href="#" onclick="eliminar(\'' . $registro["id_alm"] . '\')"><img src="../imagenes/eliminar.png"/></a></td>';
                                echo '<td>' . $registro["nombre_alm"] . '</td>';
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