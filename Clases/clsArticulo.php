<?php

class Articulo {

    private $id;
    private $nombre;
    private $unidad;
    private $cantidad;

    public function SetId($id) {
        return $this->id = $id;
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

    public function AgregarArticulo($nombre, $unidad, $tipo, $codigo, $precio, $almacen) 
    {
        $correcto = false;
        require_once 'clsConexion.php';
        require_once '../Clases/clsMovimiento.php';
        $obj = new Conexion();
        $objMovimiento = new Movimiento();



        $sql = "
            insert into articulo(
                nombre_art,
                unidad_art,
                TipoArticulo_id_tip_art,
                codigo_art,
                precio_art) 
            values(
                    '" . $nombre . "'," .
                "'" . $unidad . "'," .
                $tipo . ","
                . "'" . $codigo . "',"
                . $precio . ")";

        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }

        return $correcto;
    }

    public function EditarArticulo($nombre, $unidad, $cantidad) 
    {
        $correcto = false;
        require_once 'clsConexion.php';
        $obj = new Conexion();
        $sql = "update articulo 
                  set 
                    nombre_art='" . $nombreNuevo . "',
                    unidad_art='" . $unidad . "',
                    cantidad=" . $cantidad .
                "where
                    nombre_art='" . $nombre . "'";

        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }

        return $correcto;
    }

    public function EliminarArticulo($nombre) 
    {
        $correcto = false;
        require_once 'clsConexion.php';
        $obj = new Conexion();
        $sql = "delete from articulo where nombre_art='" . $nombre . "'";

        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
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

    public function BuscarArticulo($articulo) 
    {
        require 'clsConexion.php';
        $objCon = new Conexion();
        
        $sql="
            select 
                    a.id_art  as id,
                    a.nombre_art as nombre,
                    um.nombre_um as unidad
            from articulo a inner join unidad_de_Medida um 
                on a.id_um=um.id_um
            where nombre_art like '%".$articulo."%'";

        $resultado=$objCon->Consultar($sql);
        $i=0;
        $retorno=null;
        
        while($registro=$resultado->fetch())
        {
            $retorno[$i]["id"]=$registro["id"];
            $retorno[$i]["articulo"]=$registro["nombre"];
            $retorno[$i]["unidad"]=$registro["unidad"];
            $i++;
        }

        return $retorno;                
    }    
    
    public function SelectArticulo($id) 
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "select id_art as id, nombre_art as nombre from articulo where TipoArticulo_id_tip_art ='" . $id . "' order by 1";
        $sql2 = "select id_art as id, nombre_art as nombre from articulo order by 1";

        if ($id == 0) {
            $resultado = $objCon->consultar($sql2);
        } else {
            $resultado = $objCon->consultar($sql);
        }

        while ($registro = $resultado->fetch()) {
            echo'<option value="' . $registro["id"] . '">' . $registro["nombre"] . '</option>';
        }
    }

    public function BuscaArticulo($id) 
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "select 
                    id_art as id,
                    nombre_art as nombre,
                    unidad_art as unidad
                from 
                articulo where id_art =" . $id ;
        $resultado = $objCon->consultar($sql);
        $retorno;
        while ($registro = $resultado->fetch()) {
            $retorno = array(
                "id" => $registro["id"],
                "nombre" => $registro["nombre"],
                "unidad" => $registro["unidad"]
            );
        }
        return $retorno;
    }

    public function DatosArticulo($Articulo) {
        
    }
    
    
    /* 
     *  Lista todos los artículos disponibles en todos los almacenes 
     *  Este procedimiento devuelve un arreglo con el id del artículo,
     *  la cantidad que hay en almacén, el id del almacen en el que se
     *  encuentra y el nombre de este últim. 
     *  [articulo][cantidad][almacen][nombre_almacen]
     */
    public function ArregloArticulos() 
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql = "select 
                        art.id_art as articulo,
                        art.nombre_art as nombre,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
                        a.nombre_alm as nombre_almacen,
                        a.id_alm as almacen
                   from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        group by art.nombre_art, almacen
                        order by 2";

        $resultado = $objCon->consultar($sql);
        $retorno=null;
        $i = 0;
        
        //
        while ($registro = $resultado->fetch()) {
            $retorno[$i]["articulo"] = $registro["articulo"];
            $retorno[$i]["cantidad"] = $registro["saldo"];
            $retorno[$i]["almacen"] = $registro["almacen"];
            $retorno[$i]["nombre_almacen"] = $registro["nombre_almacen"];
            $i++;
        }
        return $retorno;
    }

    public function ListarArticulosPorAlmacen($almacen)
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql = "select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        um.nombre_um as unidad,
                      (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,                        
                        t.nombre_tip as tipo,
                        a.nombre_alm as almacen,
                        a.id_alm as idAlm
                    from 
                        almacen a 
                        inner join 
                        movimiento m 
                            on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                            on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                            on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        inner join unidad_de_medida um 
                            on art.id_um=um.id_um                         where m.almacen_id_alm=" . $almacen . "
                        group by art.nombre_art
                   order by 1;";

        $sql2 = "select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        um.nombre_um as unidad,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
                        t.nombre_tip as tipo,
                        a.nombre_alm as almacen,
                        a.id_alm as idAlm
                   from 
                        almacen a 
                        inner join 
                        movimiento m 
                            on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                            on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                            on art.TipoArticulo_id_tip_art=t.idTipoArticulo 
                        inner join unidad_de_medida um 
                            on art.id_um=um.id_um 
                        group by art.nombre_art, almacen
                        order by 5";

        if ($almacen != 0) {
            $resultado = $objCon->consultar($sql);
        } else {
            $resultado = $objCon->consultar($sql2);
        }

        while ($registro = $resultado->fetch()) {

            if ($registro["saldo"]>0) {
                echo '<tr>';
                if ($almacen != 0) {
                    echo '<td><a href="#" onclick="leerDatosSalida(' . $registro["id_art"] . ','.$registro["idAlm"] .')" data-toggle="modal" data-target="#ModalSalida"><span class="glyphicon glyphicon-arrow-up"></span><img src="../../imagenes/salida.png"/></a></td>';
                }
                echo '<td>' . $registro["nombre"] . '</td>';
                echo '<td>' . $registro["unidad"] . '</td>';
                echo '<td id="Saldo'.$registro["id_art"].'">' . $registro["saldo"] . '</td>';
                echo '<td>' . $registro["tipo"] . '</td>';
                echo '<td>' . $registro["almacen"] . '</td>';
                echo '</tr>';
            }
        }
    }
    
    /*
     * 0 para almacén general
     * cualquier otro número para otros almacenes
    */
    public function ListarArticulosxSubAlmacen($almacen)
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql = "select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        art.unidad_art as unidad,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
                        t.nombre_tip as tipo,
                        a.nombre_alm as almacen,
                        a.id_alm as idAlm
                    from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        where m.almacen_id_alm=" . $almacen . "
                        group by art.nombre_art
                   order by 2;";

        $sql2 = "select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        art.unidad_art as unidad,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
                        t.nombre_tip as tipo,
                        a.nombre_alm as almacen,
                        a.id_alm as idAlm
                   from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        group by art.nombre_art, almacen
                        order by 2";

        if ($almacen != 0) {
            $resultado = $objCon->consultar($sql);

            } else {
            $resultado = $objCon->consultar($sql2);
        }

        while ($registro = $resultado->fetch()) {

            if ($registro["saldo"]>0) {
                echo '<tr>';
                echo '<td>' . $registro["nombre"] . '</td>';
                echo '<td>' . $registro["unidad"] . '</td>';
                echo '<td>' . $registro["saldo"].'</td>';
                echo '<td>' . $registro["tipo"] . '</td>';
                echo '<td>' . $registro["almacen"] . '</td>';
                echo '</tr>';
            }
        }
    }

    /*
     * Lista los datos de los artículos según el id del almacen
     */
    public function DatosArticulosxSubAlmacen($almacen)
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql = "select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        art.unidad_art as unidad,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
                        t.nombre_tip as tipo,
                        a.nombre_alm as almacen,
                        a.id_alm as idAlm
                    from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        where m.almacen_id_alm=" . $almacen . "
                        group by art.nombre_art
                   order by 1;";

            $resultado = $objCon->consultar($sql);

        $retorno=null;  
        $i=0;
        while ($registro = $resultado->fetch()) {

            if ($registro["saldo"]>0) {                    
            //echo $i;
                $retorno[$i]["id"]= $registro["id_art"] ;
                $retorno[$i]["cantidad"]=  $registro["saldo"];
                $retorno[$i]["almacen"]=  $registro["idAlm"] ;
                $i++;                
            }
        }
        return $retorno;
    }
    
    /*
     * Lista los datos de un artículo en específico 
     * según el id del almacen y el artículo
     */
    public function DatosArticuloxSubAlmacen($almacen,$articulo)
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql = "select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        art.unidad_art as unidad,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
                        t.nombre_tip as tipo,
                        a.nombre_alm as almacen,
                        a.id_alm as idAlm
                    from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                    where 
                        m.almacen_id_alm=" . $almacen . " and
                        m.articulo_id_art=".$articulo.'                        
                    group by art.nombre_art';

            $resultado = $objCon->consultar($sql);

        $retorno=null;  

        while ($registro = $resultado->fetch()) {

            if ($registro["saldo"]>0) {                    

                $retorno["id"]= $registro["id_art"] ;
                $retorno["nombre"]= $registro["nombre"] ;
                $retorno["cantidad"]=  $registro["saldo"];
                $retorno["almacen"]=  $registro["idAlm"] ;
                
            }
        }
        return $retorno;
    }
    
    public function ListarArticulosModal()
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql = "select 
                        id_art as id,
                        nombre_art as nombre
                from 
                        articulo;";

            $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) {
            if ($registro=!null) {                
                echo '<tr>';

                echo '<td>' . $registro["nombre"] . '</td>';
                echo '<td><input type="text" class="form-control" id="cantidad'.$id.'"></td>';
                echo '<td><input type="text" class="form-control" id="precio'.$id.'"></td>';
                echo '<td><button class="btn btn-success" type="text" onclick="Actualiza()">Actualizar</button></td>';
                echo '</tr>';
            }
        }
    }  
    
    public function ListarArticulosPorTipo($tipo, $almacen) 
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql = "select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        art.unidad_art as unidad,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
                        t.nombre_tip as tipo,
                        a.nombre_alm as almacen,
                        a.id_alm as idAlm
                    from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        where m.almacen_id_alm=" . $almacen . "
                        group by art.nombre_art
                   order by 1;";

        $sql2 = "select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        art.unidad_art as unidad,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
                        t.nombre_tip as tipo,
                        a.nombre_alm as almacen,
                        a.id_alm as idAlm
                    from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                    where 
                        art.TipoArticulo_id_tip_art=" . $tipo . "
                        group by art.nombre_art
                    order by 1;";

        $sql3 = "select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        art.unidad_art as unidad,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
                        t.nombre_tip as tipo,
                        a.nombre_alm as almacen,
                        a.id_alm as idAlm
                   from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        where m.almacen_id_alm=" . $almacen . "
                        and art.TipoArticulo_id_tip_art=" . $tipo . "
                        group by art.nombre_art
                   order by 1;";

        $sql4 = "select 
                        art.id_art,
                        (art.nombre_art) as nombre,
                        art.unidad_art as unidad,
                        (select 
                            saldo_movimiento
                         from movimiento 
                         where id_mov=(select 
                                            MAX(id_mov) as maximo 
                                       from movimiento 
                                       where almacen_id_alm= a.id_alm
                                       and 
                                        articulo_id_art= art.id_art)) as saldo,
                        t.nombre_tip as tipo,
                        a.nombre_alm as almacen,
                        a.id_alm as idAlm
                   from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                        group by art.nombre_art, almacen
                        order by 5";

        if ($tipo == '0' && $almacen != '0') {
            $resultado = $objCon->consultar($sql);
        } else if ($almacen == '0' && $tipo != '0') {
            $resultado = $objCon->consultar($sql2);
        } else if ($almacen != '0' && $tipo != '0') {
            $resultado = $objCon->consultar($sql3);
        } else if ($almacen == '0' && $tipo == '0') {
            $resultado = $objCon->consultar($sql4);
        }

        while ($registro = $resultado->fetch()) {
            
            if ($registro["saldo"]>0) {
                echo '<tr>';
                echo '<td><a href="#" onclick="leerDatosSalida(' . $registro["id_art"] . ')" data-toggle="modal" data-target="#ModalSalida"><span class="glyphicon glyphicon-arrow-up"></span><img src="../../imagenes/salida.png"/></a></td>';
                echo '<td>' . $registro["nombre"] . '</td>';
                echo '<td>' . $registro["unidad"] . '</td>';
                echo '<td>' . $re . '</td>';
                echo '<td>' . $registro["tipo"] . '</td>';
                echo '<td>' . $registro["almacen"] . '</td>';
                echo '</tr>';
            }
        }
    }

    public function ListarTodosArticulos($foco)
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql = "select 
                        a.id_art,
                        a.nombre_art as nombre,
                        um.nombre_um as unidad,
                        t.nombre_tip as tipo
                   from 
                        articulo a inner join tipoarticulo t
                        on a.TipoArticulo_id_tip_art=t.idTipoArticulo
                        inner join unidad_de_medida um 
                        on a.id_um=um.id_um
                        order by 2";

        $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) {
            if ($registro!=null) {
                echo '<tr>';
                if($foco==1)
                {
                    echo '<td><a href="#" onclick="leerDatosEntrada(' . $registro["id_art"] . ')" data-toggle="modal" data-target="#ModalEntrada"><span class="glyphicon glyphicon-arrow-down"></span><img src="../../imagenes/entrada.png"/></a></td>';
                }
                echo '<td>' . $registro["nombre"] . '</td>';
                echo '<td>' . $registro["unidad"] . '</td>';
                echo '<td>' . $registro["id_art"] . '</td>';
                echo '<td>' . $registro["tipo"] . '</td>';
                echo '</tr>';
            }
        }
    }
    
    public function MaxIdArticulo() 
    {
        
        require_once 'clsConexion.php';
        $objCon = new Conexion();
        
        $sql = "select (max(id_art)+1) as posibleId from articulo";
        
        $resultado = $objCon->consultar($sql);
        
        $registro = $resultado->fetch();

        echo $registro["posibleId"];
    }
    
    public function RegistrarArticuloProveedor($proveedor,$articulo,$cantidad,$precio) 
    {
        require 'clsConexion.php';
        
        $objCon= new Conexion();
        
        $sql = "
            INSERT INTO `articulo_proveedor`
                (`proveedor_id_proveedor`,
                `articulo_id_art`,
                `articulo_proveedor_cant`,
                `articulo_proveedor_pre`)
            VALUES
                (".$proveedor.",".$articulo.",".$cantidad.",".$precio.")";
        
            $objCon->Consultar($sql);
        
    }

    public function SaldoArticulo($articulo,$almacen) {
        
        require_once 'clsConexion.php';
        $objCon = new Conexion();
        
        $sql ='
                select 
                    MAX(id_mov) as maximo 
                from 
                    movimiento
                    where almacen_id_alm='.$almacen.
                    ' and 
                    articulo_id_art='.$articulo;
        
        $resultado= $objCon->Consultar($sql);
        $registro = $resultado->fetch();
        
        $aux=0;
        if($registro["maximo"]!="")
        {
            $sql='
                select 
                    saldo_movimiento as saldo 
                from 
                    movimiento
                    where id_mov='.$registro["maximo"];
            
            $resultado = $objCon->Consultar($sql);
            $registro = $resultado->fetch();
            
            $aux=$registro["saldo"];
        }
        else
        {
            $aux=0;
        }
        
        return $aux;
    }
    
    
}

?>