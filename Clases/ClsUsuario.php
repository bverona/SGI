<?php

class Usuario {

    private $id;
    private $nombre;
    private $clave;
    private $permisos;
    private $area;
    private $almacen;

 
    public function AgregarUsuario($nombre, $contrasenha, $permisos) {
        $correcto = false;
        require_once '../Clases/clsConexion.php';
        $obj = new Conexion();
        $sql = "insert into usuario (nombre_usu,clave_usu,permisos_usu) 
                  values(
                    '" . $nombre . "'," .
                "'" . md5($contrasenha) . "'," .
                $permisos . ")";
        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }

        return $correcto;
    }

    public function EditarUsuario($id,$nombre, $contrasenha) {
        require_once '../Clases/clsConexion.php';
        $obj = new Conexion();
        $sql = "update usuario set " .
                "nombre_usu='" . $nombre . "', " .
                "clave_usu='" . $contrasenha . "' " .
                "where id_usu='" . $id . "';";
        
        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }

        return $correcto;
    }

    public function ActualizaUsuario($nombreNuevo, $contrasenha, $almacen, $area, $permisos, $id) {
        require_once '../Clases/clsConexion.php';
        $obj = new Conexion();
        $sql = "update usuario set " .
                "nombre_usu='" . $nombreNuevo . "', " .
                "permisos_usu=" . $permisos . ", " .
                "almacen_id_alm=" . $almacen . ", " .
                "area_id_are=" . $area . ", " .
                "clave_usu='" . $contrasenha . "' " .
                "where id_usu=" . $id;
        
        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }

        return $correcto;
    }

    public function EliminarUsuario($id) {
        $correcto = false;
        require_once '../Clases/clsConexion.php';
        $obj = new Conexion();
        $sql = "delete from usuario where id_usu=" . $id;

        if (($obj->Consultar($sql)) == !0) {
            return 1;
        }

        return 0;
    }

    public function AsignaArea($area, $nombre) {
        require_once '../Clases/clsConexion.php';
        $obj = new Conexion();
        $sql = "update usuario set " .
                "area_id_are=" . $area .
                " where nombre_usu='" . $nombre . "'";
        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }
        return $correcto;
    }

    public function AsignaAlmacen($almacen, $nombre) {
        require_once '../Clases/clsConexion.php';
        $obj = new Conexion();
        $sql = "update usuario set " .
                "almacen_id_alm=" . $almacen .
                " where nombre_usu='" . $nombre . "'";
        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }
        return $correcto;
    }

    public function buscar($id) {
        require_once '../Clases/clsConexion.php';
        $objCon = new Conexion();
        $sql = "select id_usu, nombre_usu, coalesce(almacen_id_alm,'-') as almacen,coalesce(area_id_are,'-')as area 
                 from usuario where id_usu=" . $id;

        $resultdo = $objCon->consultar($sql);
        $registro = $resultdo->fetch();

        $retorno = array(
            "id" => $registro["id_usu"],
            "nombre" => $registro["nombre_usu"],
            "idAlmacen" => $registro["almacen"],
            "idArea" => $registro["area"]
        );

        return ($retorno);
    }

    public function ListarUsuarios() {
        require_once '../Clases/clsConexion.php';
        $objCon = new Conexion();

        $sql = "select 
                        u.id_usu as id,
                        u.nombre_usu as usuario,
                        COALESCE(a.nombre_alm,' ') as almacen,
                        coalesce(ar.nombre_are,' ') as area,
                        u.permisos_usu 
                    from usuario u left outer join almacen a on a.id_alm=u.almacen_id_alm 
                        left outer join area ar on ar.id_are=u.area_id_are
                    where permisos_usu<>8
                    order by 1";

        $resultado = $objCon->consultar($sql);

        echo '
                <div class="panel panel-success">
                    <div class="panel-heading"><b>Listado de Usuarios</b></div>
                        <div class="panel-body">
                            <div class="table-responsive table-hover">
                                <table class="table table-striped table-hover">
                                  <thead>
                                    <tr>
                                      <th>Editar</th>
                                      <th>Eliminar</th>
                                      <th>Usuario</th>
                                      <th>Área/Almacén</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                ';

        while ($registro = $resultado->fetch()) {

            echo '<tr>';
            echo '<td><a href="#" onclick="leerDatos(' . $registro["id"] . ')" data-toggle="modal" data-target="#myModal"><img src="../imagenes/editar.png"/></a></td>';
            echo '<td><a href="#" onclick="eliminar(\'' . $registro["id"] . '\')"><img src="../imagenes/eliminar.png"/></a></td>';
            echo '<td>' . $registro["usuario"] . '</td>';
            echo '<td>' . $registro["area"] . "" . $registro["almacen"] . '</td>';
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