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
        require_once 'clsConexion.php';
        $obj = new Conexion();
        $sql1 = "insert into almacen(nombre_alm) values('" . $nombre . "')";

        if ((($obj->Consultar($sql1)) == !0)) {
            $correcto = true;
        }

        return $correcto;
    }

    public function EditarAlmacen($id, $nombreNuevo) {
        $correcto = false;
        require_once 'clsConexion.php';
        $obj = new Conexion();
        $sql = "update almacen set nombre_alm='" . $nombreNuevo . "' where id_alm=" . $id;

        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }

        return $correcto;
    }

    public function EliminarAlmacen($id) {

        
        require_once 'clsConexion.php';
        require_once 'clsArticulo.php';
        require_once 'clsMovimiento.php';

        $objCon = new Conexion();
        $objArticulo = new Articulo();
        $objMovimiento = new Movimiento();

        $sql = "update almacen set estado_alm=0 where id_alm=" . $id;

        $correcto = false;
        $arreglo = $objArticulo->DatosArticulosxSubAlmacen($id);
        $break=true;
        $aux;

        for ($i = 0; $i < count($arreglo); $i++) {
            echo $arreglo[$i]["id"]." artículo <br>";
            echo $arreglo[$i]["cantidad"]." cantidad <br>";
            echo $arreglo[$i]["almacen"]." almacen <br><br>";
            $objMovimiento->AgregaMovimientoTrasferencia($arreglo[$i]["id"], $arreglo[$i]["cantidad"], $descripcion, $arreglo[$i]["almacen"],1);
                $aux.=$arreglo["id"]." transferido correctamente <br>";
            }            

            if ($objCon->Consultar($sql) ==!0) {
                $correcto = true;                
            }
        

        echo$aux;
    }

    public function ObtenerAlmacen($id) {

        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "select  nombre_alm from almacen where id_alm=" . $id;

        $resultado = $objCon->consultar($sql);
        $registro = $resultado->fetch();

        $retorno = $registro["nombre_alm"];

        return $retorno;
    }

    //para agregar al select cuando se hace un editar usuario
    public function ListarAlmacenOption() {

        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "
                select id_alm, nombre_alm from almacen";
        $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) {
            $almacenes .= '<option value="' . $registro["id_alm"] . '">' . $registro["nombre_alm"] . '</option>';
        }

        echo $almacenes;
    }

    public function ListarAlmacenSinFiltro($almacen) {

        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "
                select id_alm, nombre_alm from almacen where general_alm=0 and asignado_alm=0 
                union
                select id_alm, nombre_alm from almacen where id_alm =" . $almacen;
        $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) {

            $almacenes .= '<option value="' . $registro["id_alm"] . '">' . $registro["nombre_alm"] . '</option>';
        }

        echo $almacenes;
    }

    //para agregar al select cuando se hace un nuevo usuario
    public function ListarAlmacenConFiltro() {

        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "select id_alm, nombre_alm from almacen where asignado_alm=0 and general_alm=0 order by 1;";
        $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) {

            $almacenes .= '<option value="' . $registro["id_alm"] . '">' . $registro["nombre_alm"] . '</option>';
        }

        echo $almacenes;
    }

    public function ListarTodosAlmacenes() {

        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "select id_alm, nombre_alm from almacen where id_alm>0 order by 1";
        $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) {

            $almacenes .= '<option value="' . $registro["id_alm"] . '">' . $registro["nombre_alm"] . '</option>';
        }

        echo $almacenes;
    }

    //para Listar todos los almacenes
    public function ListarAlmacenes() {

        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "select 
                    id_alm,
                    nombre_alm,
                    asignado_alm as asignado,
                    case
                    when estado_alm =1 then 'Activo' 
                    when estado_alm =0 then 'Inactivo'
                    end as estado
                from
                    almacen
                where
                    id_alm <> 0 and general_alm = 0
                order by 1;";
        $aux;
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
                                      <th>Estado</th>
                                    </tr>
                                  </thead>
                                  <tbody>';
        while ($registro = $resultado->fetch()) {
            $registro["estado"]=="Inactivo"?
            $aux='<td> Elminado </td>':
            $aux='<td><a href="#" onclick="eliminar(\'' . $registro["id_alm"] . '\')"><img src="../../imagenes/eliminar.png"/></a></td> ';
            
            echo '<tr>';
            echo '<td><a href="#" onclick="leerDatos(' . $registro["id_alm"] . ',\'' . $registro["nombre_alm"] . '\')" data-toggle="modal" data-target="#EditarAlmacen"><img src="../../imagenes/editar.png"/></a></td>';
            echo $aux;
            echo '<td>' . $registro["nombre_alm"] . '</td>';
            echo '<td>' . $registro["estado"] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
                ';
    }

}

?>