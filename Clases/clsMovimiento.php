<?php

class Movimiento {

    private $id;
    private $tipo;
    private $almacen;

    public function SetId($id) {
        $this->id = $id;
    }

    public function GetId() {
        return $this->id;
    }

    public function GetTipo() {
        return $this->tipo;
    }

    public function GetAlmacen() {
        return $this->almacen;
    }

    public function SetTipo($tipo) {
        return $this->tipo = $tipo;
    }

    public function SetAlmacen($almacen) {
        return $this->almacen = $almacen;
    }

    public function AgregaMovimientoEntrada($cantidad, $descripcion, $almacen_id, $articulo) 
    {
        $correcto = false;
        require_once 'clsConexion.php';
        require_once 'clsArticulo.php';

        $obj = new Conexion();
        $objArticulo = new Articulo();


        $sql = "  insert into movimiento 
                    (
                        tipo_mov,
                        fecha_mov,
                        cantidad_mov,
                        saldo_movimiento,
                        descripcion_mov,
                        almacen_id_alm,
                        articulo_id_art
                    )
                    values( 0," .
                "'" . date("Y-m-d") . "'," .
                $cantidad . "," .
                ($objArticulo->SaldoArticulo($articulo, $almacen_id) + $cantidad) . "," .
                "'" . $descripcion . "'," .
                $almacen_id . "," .
                $articulo . ")";

        if ($obj->Consultar($sql) != 0) {
            $correcto = true;
        }

        return $correcto;
    }

    //falta aplicar verificación para que salida no sea mayor al stock del artículo
    public function AgregaMovimientoSalida($cantidad, $descripcion, $almacen_id, $articulo) 
    {
        require_once 'clsConexion.php';
        require_once 'clsArticulo.php';
    
        $obj = new Conexion();
        $objArticulo = new Articulo();

        $correcto = false;

        $sql = "  insert into movimiento 
                    (
                        tipo_mov,
                        fecha_mov,
                        cantidad_mov,
                        saldo_movimiento,
                        descripcion_mov,
                        almacen_id_alm,
                        articulo_id_art
                    )
                    values( 1," .
                "'" . date("Y-m-d") . "'," .
                $cantidad . "," .
                ($objArticulo->SaldoArticulo($articulo, $almacen_id) - $cantidad) . "," .
                "'" . $descripcion . "'," .
                $almacen_id . "," .
                $articulo . ")";

        if ($obj->Consultar($sql) != 0) {
            $correcto = true;
        }

        return $correcto;
    }

    //pasar una cantidad de artículo desde un almacen X a otro Y
    public function AgregaMovimientoTrasferencia($id_art, $cantidad, $descripcion, $almacenOrigen, $almacenDestino) 
    {
        require_once 'clsConexion.php';
        $obj = new Conexion();

        $correcto = false;
        
        if (
                ($this->AgregaMovimientoSalida($cantidad, $descripcion, $almacenOrigen, $id_art)) 
                    && 
                ($this->AgregaMovimientoEntrada($cantidad, $descripcion, $almacenDestino, $id_art))
           ) 
            {
                    echo"trasferencia Realizado Correctamente \n";
                    $correcto = true;
            }
            else
                {
                    echo "trasferencia No Realizado \n";
            }
        return $correcto;
    }

    public function BuscaArticuloDetalle($almacen, $articulo) {
        require_once 'clsConexion.php';
        $objCon = new Conexion();
        //Va a mostrar todos los usuarios a excepción de los que tienen privilegios          
        $sql = "SELECT 
                        coalesce(det.saldo_det_mov,'0') as saldo
                    from 
                        movimiento mov inner join detalle_movimiento det
                        on mov.id_mov=det.id_det_mov
                        where mov.almacen_id_alm=" . $almacen . " and "
                . "det.articulo_id_art=" . $articulo;
        
        $resultado = $objCon->consultar($sql);
        $i = 0;
        while ($registro = $resultado->fetch()) {
            $i = $registro["saldo"];
        }
        return $i;
    }

    public function definecant($almacen, $articulo) {

        require_once 'clsConexion.php';
        $objCon = new Conexion();
        
        //Va a mostrar todos los usuarios a excepción de los que tienen privilegios
        $sql = "select  
                            coalesce(dm.cantidad_det_mov,'-') as cantidad
                    from almacen a inner join movimiento m 
                            on a.id_alm=m.almacen_id_alm 
                            inner join detalle_movimiento dm
                            on m.id_mov=dm.movimiento_id_mov
                    where m.almacen_id_alm =" . $almacen . " and dm.articulo_id_art=" . $articulo;

        $resultado = $objCon->consultar($sql);
        $i = null;
        
        while ($registro = $resultado->fetch()) {
            $i = $registro["cantidad"];
        }
        return $i;
    }

    public function ListarEntradas($almacen) {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = "select 
                        a.nombre_alm as almacen,
                        m.fecha_mov as fecha,
                        art.nombre_art as articulo,
                        m.cantidad_mov as cantidad,
                        m.saldo_movimiento as saldo
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
                        m.almacen_id_alm=" . $almacen . "
                        and 
                        m.tipo_mov=0
                    order by 2";

        $sql2 = "select 
                        a.nombre_alm as almacen,
                        m.fecha_mov as fecha,
                        art.nombre_art as articulo,
                        m.cantidad_mov as cantidad,
                        m.saldo_movimiento as saldo
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
                        m.tipo_mov=0
                    order by 1";

        ($almacen != 0) ?
                        $resultado = $objCon->consultar($sql) :
                        $resultado = $objCon->consultar($sql2);

        while ($registro = $resultado->fetch()) {

            echo '<tr>';

            echo '<td>' . $registro["almacen"] . '</td>';
            echo '<td>' . $registro["fecha"] . '</td>';
            echo '<td>' . $registro["articulo"] . '</td>';
            echo '<td>' . $registro["cantidad"] . '</td>';
            echo '<td>' . $registro["saldo"] . '</td>';
            echo '</tr>';
        }
    }

    public function ListarSalidas($almacen) {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = "select 
                        a.nombre_alm as almacen,
                        m.fecha_mov as fecha,
                        art.nombre_art as articulo,
                        m.cantidad_mov as cantidad,
                        m.saldo_movimiento as saldo
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
                        m.almacen_id_alm=" . $almacen . "
                        and 
                        m.tipo_mov=1
                    order by 2";

        $sql2 = "select 
                        a.nombre_alm as almacen,
                        m.fecha_mov as fecha,
                        art.nombre_art as articulo,
                        m.cantidad_mov as cantidad,
                        m.saldo_movimiento as saldo
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
                        m.tipo_mov=1
                    order by 1";

        ($almacen != 0) ?
                        $resultado = $objCon->consultar($sql) :
                        $resultado = $objCon->consultar($sql2);

        while ($registro = $resultado->fetch()) {

            echo '<tr>';

            echo '<td>' . $registro["almacen"] . '</td>';
            echo '<td>' . $registro["fecha"] . '</td>';
            echo '<td>' . $registro["articulo"] . '</td>';
            echo '<td>' . $registro["cantidad"] . '</td>';
            echo '<td>' . $registro["saldo"] . '</td>';
            echo '</tr>';
        }
    }

    public function ListarMovimientos($almacen) {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = "select 
                        a.nombre_alm as almacen,
                        m.fecha_mov as fecha,
                        case
                        when m.tipo_mov=0 then 'Entrada' 
                        when m.tipo_mov=1 then 'Salida' 
                        end as movimiento, 
                        art.nombre_art as articulo,
                        art.unidad_art as unidad,
                        m.cantidad_mov as cantidad,
                        m.saldo_movimiento as saldo
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
                        m.almacen_id_alm=" . $almacen . "
                    order by 2";

        $sql2 = "select 
                        a.nombre_alm as almacen,
                        m.fecha_mov as fecha,
                        case
                        when m.tipo_mov=0 then 'Entrada' 
                        when m.tipo_mov=1 then 'Salida' 
                        end as movimiento,
                        art.unidad_art as unidad, 
                        art.nombre_art as articulo,
                        m.cantidad_mov as cantidad,
                        m.saldo_movimiento as saldo
                    from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                    order by 1";

        ($almacen != 0) ?
        $resultado = $objCon->consultar($sql) :
        $resultado = $objCon->consultar($sql2);


        while ($registro = $resultado->fetch()) {

            echo '<tr>';

            echo '<td>' . $registro["almacen"] . '</td>';
            echo '<td>' . $registro["fecha"] . '</td>';
            echo '<td>' . $registro["articulo"] . '</td>';
            echo '<td>' . $registro["unidad"] . '</td>';
            echo '<td>' . $registro["cantidad"] . '</td>';
            echo '<td>' . $registro["saldo"] . '</td>';
            echo '<td>' . $registro["movimiento"] . '</td>';
            echo '</tr>';
        }
    }

    public function ListarMovimientosPorAlmacen($almacen, $articulo) {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = "select 
                        a.nombre_alm as almacen,
                        m.fecha_mov as fecha,
                        case
                        when m.tipo_mov=0 then 'Entrada' 
                        when m.tipo_mov=1 then 'Salida' 
                        end as movimiento, 
                        art.nombre_art as articulo,
                        m.cantidad_mov as cantidad,
                        m.saldo_movimiento as saldo
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
                        m.almacen_id_alm=" . $almacen . "  
                        and art.id_art=" . $articulo . " 
                    order by 2";

        $sql2 = "select 
                        a.nombre_alm as almacen,
                        m.fecha_mov as fecha,
                        case
                        when m.tipo_mov=0 then 'Entrada' 
                        when m.tipo_mov=1 then 'Salida' 
                        end as movimiento, 
                        art.nombre_art as articulo,
                        m.cantidad_mov as cantidad,
                        m.saldo_movimiento as saldo
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
                        m.almacen_id_alm=" . $almacen . "  
                    order by 2";

        $sql3 = "select 
                        a.nombre_alm as almacen,
                        m.fecha_mov as fecha,
                        case
                        when m.tipo_mov=0 then 'Entrada' 
                        when m.tipo_mov=1 then 'Salida' 
                        end as movimiento, 
                        art.nombre_art as articulo,
                        m.cantidad_mov as cantidad,
                        m.saldo_movimiento as saldo
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
                        art.id_art=" . $articulo . " 
                    order by 2";

        $sql4 = "select 
                        a.nombre_alm as almacen,
                        m.fecha_mov as fecha,
                        case
                        when m.tipo_mov=0 then 'Entrada' 
                        when m.tipo_mov=1 then 'Salida' 
                        end as movimiento, 
                        art.nombre_art as articulo,
                        m.cantidad_mov as cantidad,
                        m.saldo_movimiento as saldo
                    from 
                        almacen a 
                        inner join 
                        movimiento m 
                        on a.id_alm=m.almacen_id_alm
                        inner join articulo art 
                        on m.articulo_id_art=art.id_art
                        inner join tipoarticulo t
                        on art.TipoArticulo_id_tip_art=t.idTipoArticulo
                    order by 2";
        
        
        if($articulo!=0 && $almacen!=0)
        {
            $resultado = $objCon->consultar($sql);
        }else
            if($articulo==0 && $almacen!=0)
            {
                $resultado = $objCon->consultar($sql2);
                
            }else if($articulo!=0 && $almacen==0)
                {            
                    $resultado = $objCon->consultar($sql3);
                }else
                    {
                        $resultado = $objCon->consultar($sql4);
                    }


        while ($registro = $resultado->fetch()) {

            echo '<tr>';

            echo '<td>' . $registro["almacen"] . '</td>';
            echo '<td>' . $registro["fecha"] . '</td>';
            echo '<td>' . $registro["articulo"] . '</td>';
            if($registro["movimiento"]=="Entrada")
            {
                echo '<td>' . $registro["cantidad"] . '</td>';
                echo '<td>' ."---". '</td>';
            }else
                {
                echo '<td>' ."---". '</td>';
                echo '<td>' . $registro["cantidad"] . '</td>';
                }
            
            echo '<td>' . $registro["saldo"] . '</td>';
            echo '</tr>';
        }
    }

}

?>
