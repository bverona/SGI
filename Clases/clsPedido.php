<?php

class Pedido {

    private $id;
    private $idArea;
    private $idAlmacen;
    private $fecha;
    private $descripcion;

    function __construct($idArea, $idAlmacen, $fecha) {
        $this->fecha = $fecha;
        $this->idArea = $idArea;
        $this->idAlmacen = $idAlmacen;
        $this->descripcion = "";
    }

    public function SetId($id) {
        $this->id = $id;
    }

    public function GetId() {
        return $this->id;
    }

    public function GetIdArea() {
        return $this->idArea;
    }

    public function SetDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function GetDescripcion() {
        return $this->descripcion;
    }

    public function GetIdAlmacen() {
        return $this->idAlmacen;
    }

    public function GetFecha() {
        return $this->fecha;
    }

    public function AgregarPedido($usuario, $foco) 
    {

        $correcto = false;
        require_once 'clsConexion.php';
        $obj = new Conexion();

        ($foco == 0) ?
                        $sql = "insert into pedido (area_id_are,fecha_ped,id_usu_ped,descripcion_ped)
                    values(" . $this->GetIdArea() . ",'" . $this->GetFecha() . "'," . $usuario . ",'" . $this->GetDescripcion() . "');" :
                        $sql = "insert into pedido (almacen_id_alm,fecha_ped,id_usu_ped,descripcion_ped)
                    values(" . $this->GetIdAlmacen() . ",'" . $this->GetFecha() . "'," . $usuario . ",'" . $this->GetDescripcion() . "');";

        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }

        return $correcto;
    }

    public function EditarPedido($id, $area, $fecha) 
    {
        $correcto = false;
        require_once 'clsConexion.php';
        $obj = new Conexion();
        $sql = "update pedido 
                    set 
                    fecha_ped='" . $fecha . "'
                    area_id_are" . $area . "
                    where 
                        id_ped='" . $id . "';";

        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }

        return $correcto;
    }

    public function CancelarPedido($dp) 
    {
        $correcto = false;
        require_once 'clsConexion.php';
        $obj = new Conexion();
        $sql = "update 
                    detalle_pedido 
                set atendido_det_ped=1,
                    comentario_det_ped='Pedido Cancelado porque en almacén solicitante había suficiente stock para que este sea satisfecho' 
                where id_det_ped=".$dp;
        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }

        return $correcto;
    }

    public function VerificarPedido($almacen,$articulo,$cantidad)
    {
        
        require_once 'clsArticulo.php';

        $objArt = new Articulo();
        
        $articulos=$objArt->ArregloArticulos();

        $texto="";
        for ($i = 0; $i < count($articulos); $i++) {

            /*
             * primero verifica que el artículo solicitado coincida con el artículo buscado
             * luego valida que la busqueda no se realice en el mismo almacen
            */
            if (($articulo == $articulos[$i]["articulo"]) && ($almacen == $articulos[$i]["almacen"]) && ((($articulos[$i]["cantidad"]) - ($cantidad)) >= 0)) 
            {
                $texto='data-toggle="popover" data-placement="top" title="AVISO" data-content="Hay stock suficiente en el mismo Almacén.
                        Puede cancelar el requerimiento o atenderlo normalmente"';
                $texto='data-toggle="tooltip" data-placement="top" title="Hay stock suficiente en el mismo Almacén.
                        Puede cancelar el requerimiento o atenderlo normalmente"';
            } 

        }
        return $texto;
                        
    }
    
    public function AgregarDetallePedido($id_art, $cant) 
    {
        $correcto = false;
        require_once 'clsConexion.php';
        $obj = new Conexion();
        //para obtener el indice del último pedido agregado
        $sql = "select MAX(id_ped)as maximo from pedido;";
        echo $sql;
        $resultado = $obj->Consultar($sql);
        $registro = $resultado->fetch();

        $sql = "insert into detalle_pedido(Pedido_id_ped,articulo_id_art,cantidad_art)"
                . "values(" . $registro["maximo"] . "," . $id_art . "," . $cant . ")";
        echo $sql;
        
        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }
        return $correcto;
    }

    public function ListarPedidosArea() {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = 'select 
                        a.nombre_are as area,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha,
                        case
                            when dp.atendido_det_ped=1 then "Atendido"
                            when dp.atendido_det_ped=0 then "No Atendido"
                        end as atendido    
                    from
                        area a
                            inner join
                        pedido p ON a.id_are = p.Area_id_are
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                        where p.Area_id_are<>0 ';

        $resultado = $objCon->consultar($sql);

        
        while ($registro = $resultado->fetch()) {


            echo '<tr>';

            echo '<td><p class="text-center">'.$registro["articulo"] .'</p></td>';
            echo '<td><p class="text-center">'.$registro["cantidad"] .'</p></td>';
            echo '<td><p class="text-center">'.$registro["usuario"] .'</p></td>';
            echo '<td><p class="text-center">'.$registro["area"] .'</p></td>';
            echo '<td><p class="text-center">'. $registro["fecha"] .'</p></td>';
            echo '<td><p class="text-center">'. $registro["atendido"] .'</p></td>';
            echo '</tr>';
        }
    }

    public function ListarPedidosPorArea($area)
    {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = "select 
                        a.nombre_are as area,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha,
                        dp.atendido_det_ped as atendido
                    from
                        area a
                            inner join
                        pedido p ON a.id_are = p.Area_id_are
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                        where p.Area_id_are=" . $area;

        $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) {

            ($registro["atendido"] == 1) ? $aux = "Atendido" : $aux = "No Atendido";

            echo '<tr>';

            echo '<td>' . $registro["articulo"] . '</td>';
            echo '<td>' . $registro["cantidad"] . '</td>';
            echo '<td>' . $registro["usuario"] . '</td>';
            echo '<td>' . $registro["area"] . '</td>';
            echo '<td>' . $registro["fecha"] . '</td>';
            echo '<td>' . $aux . '</td>';
            echo '</tr>';
        }
    }

    public function ListarPedidosAlmacen()
    {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = "select 
                        art.id_art as id_art,
                        a.nombre_alm as almacen,
                        a.id_alm as id_alm,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        dp.id_det_ped as dp,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha,
                        p.almacen_id_alm as destino,
                        coalesce(art.precio_art,2) as precio,
                        case
                        when dp.atendido_det_ped = 0 then 'No atendido'
                        when dp.atendido_det_ped = 1 then 'Atendido' 
                        end
                        as atendido
                    from
                        almacen a
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                    where 
                        
                        dp.atendido_det_ped=0";
        
    // almacén general debería realizar Pedidos?? de ser así borrar primera condición del where

        $resultado = $objCon->consultar($sql);


        
        while ($registro = $resultado->fetch()) {

        echo'<div class="row">';
            echo'<div class="col-xs-12">';
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["articulo"].'</p> 
                    </div>';     
                echo'            
                    <div class="col-xs-1">
                        <p class="text-center">'.$registro["cantidad"].'</p> 
                    </div>';
                echo'            
                    <div class="col-xs-1">
                        <p class="text-center">'.$registro["usuario"].'</p> 
                    </div>';     
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["almacen"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-1">
                        <p class="text-center">'.$registro["fecha"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["atendido"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-2">
                        <div '.$this->VerificarPedido($registro["id_alm"], $registro["id_art"], $registro["cantidad"]).'><a class="btn btn-info " data-toggle="collapse" href="#pedido'.$registro["dp"].'" 
                            onclick="MostrarPosiblesSoluciones('
                            .$registro["dp"].','.$registro["id_art"].','
                            ."'".$registro["articulo"]."'".','.$registro["precio"].','
                            .$registro["destino"].','.$registro["cantidad"].
                            ')" aria-expanded="false" aria-controls="#pedido'.$registro["dp"].'"> 
                        Posibles Soluciones</a>
                        </div>
                     </div>';  
                echo    
                    '<div class="col-xs-1"><p class="text-center">
                                <a  href="#" id="CancelarPedido'.$registro["dp"].'" onclick="AsignaDP('.$registro["dp"].');CancelaPedido('.$registro["dp"].');">                               
                                <img src="../../Imagenes/Cancelar Pedido.png" > </a>
                                </p>'
                            .'</div>';
                
            echo'</div>';
        echo'</div >';
        
        echo' <br><div class=" collapse" aria-expanded="false" id="pedido'.$registro["dp"].'">
                        
        </div>';
        }
    }
    
    public function ListarSumaPedidos()
    {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = "select 
                        art.nombre_art as articulo,
                        sum(dp.cantidad_art) as cantidad,
                        round(art.precio_art,2) as precio,
                        round((sum(dp.cantidad_art)*art.precio_art),2) as costo
                    from
                        almacen a 
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                    where 
                        dp.atendido_det_ped=0
                    group by art.id_art;";
        

        $resultado = $objCon->consultar($sql);


        
        while ($registro = $resultado->fetch()) {

        echo'<div class="row">';
            echo'<div class="col-xs-12">';
                echo'            
                    <div class="col-xs-3">
                        <p class="text-center">'.$registro["articulo"].'</p> 
                    </div>';     
                echo'            
                    <div class="col-xs-3">
                        <p class="text-center">'.$registro["cantidad"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-3" >
                        <p class="text-center">'.$registro["precio"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-3">
                        <p class="text-center">'.$registro["costo"].'</p> 
                    </div>';                 
                
            echo'</div>';
        echo'</div >';
        
        }
    }

    public function ListarDemandaPedidos()
    {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        //devuelve el saldo total de un artículo en todos los almacenesewq
        $sql = "SELECT 
                    a.id,
                    a.articulo,
                    a.cantidad,
                    a.precio,
                    a.costo,
                    COALESCE(b.saldo, 0) as saldo
                FROM
                    (SELECT 
                        art.id_art AS id,
                            art.nombre_art AS articulo,
                            SUM(dp.cantidad_art) AS cantidad,
                            ROUND(art.precio_art, 2) AS precio,
                            ROUND((SUM(dp.cantidad_art) * art.precio_art), 2) AS costo
                    FROM
                        almacen a
                    INNER JOIN pedido p ON a.id_alm = p.almacen_id_alm
                    INNER JOIN detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                    INNER JOIN articulo art ON dp.articulo_id_art = art.id_art
                    INNER JOIN usuario u ON p.id_usu_ped = u.id_usu
                    WHERE
                        dp.atendido_det_ped = 0
                    GROUP BY art.id_art) a
                        LEFT JOIN
                    (SELECT 
                        a.articulo, a.nombre, SUM(a.saldo) AS saldo
                    FROM
                        (SELECT 
                        (art.id_art) AS articulo,
                            (art.nombre_art) AS nombre,
                            a.nombre_alm AS almacen,
                            ((SELECT 
                                    (saldo_movimiento)
                                FROM
                                    movimiento
                                WHERE
                                    id_mov = (SELECT 
                                            MAX(id_mov) AS maximo
                                        FROM
                                            movimiento m
                                        WHERE
                                            m.almacen_id_alm = a.id_alm
                                                AND articulo_id_art = art.id_art))) AS saldo
                    FROM
                        almacen a
                    INNER JOIN movimiento m ON a.id_alm = m.almacen_id_alm
                    INNER JOIN articulo art ON m.articulo_id_art = art.id_art
                    INNER JOIN tipoarticulo t ON art.TipoArticulo_id_tip_art = t.idTipoArticulo
                    WHERE
                        (SELECT 
                                saldo_movimiento
                            FROM
                                movimiento
                            WHERE
                                id_mov = (SELECT 
                                        MAX(id_mov) AS maximo
                                    FROM
                                        movimiento
                                    WHERE
                                        almacen_id_alm = a.id_alm
                                            AND articulo_id_art = art.id_art)) > 0
                    GROUP BY articulo , almacen , saldo
                    ORDER BY 2) a
                    GROUP BY a.articulo) b ON (a.id = b.articulo) 
                UNION SELECT 
                    a.id,
                    a.articulo,
                    a.cantidad,
                    a.precio,
                    a.costo,
                    COALESCE(b.saldo, 0) AS saldo
                FROM
                    (SELECT 
                        art.id_art AS id,
                            art.nombre_art AS articulo,
                            SUM(dp.cantidad_art) AS cantidad,
                            ROUND(art.precio_art, 2) AS precio,
                            ROUND((SUM(dp.cantidad_art) * art.precio_art), 2) AS costo
                    FROM
                        almacen a
                    INNER JOIN pedido p ON a.id_alm = p.almacen_id_alm
                    INNER JOIN detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                    INNER JOIN articulo art ON dp.articulo_id_art = art.id_art
                    INNER JOIN usuario u ON p.id_usu_ped = u.id_usu
                    WHERE
                        dp.atendido_det_ped = 0
                    GROUP BY art.id_art) a
                        RIGHT JOIN
                    (SELECT 
                        a.articulo, a.nombre, SUM(a.saldo) AS saldo
                    FROM
                        (SELECT 
                        (art.id_art) AS articulo,
                            (art.nombre_art) AS nombre,
                            a.nombre_alm AS almacen,
                            ((SELECT 
                                    (saldo_movimiento)
                                FROM
                                    movimiento
                                WHERE
                                    id_mov = (SELECT 
                                            MAX(id_mov) AS maximo
                                        FROM
                                            movimiento m
                                        WHERE
                                            m.almacen_id_alm = a.id_alm
                                                AND articulo_id_art = art.id_art))) AS saldo
                    FROM
                        almacen a
                    INNER JOIN movimiento m ON a.id_alm = m.almacen_id_alm
                    INNER JOIN articulo art ON m.articulo_id_art = art.id_art
                    INNER JOIN tipoarticulo t ON art.TipoArticulo_id_tip_art = t.idTipoArticulo
                    WHERE
                        (SELECT 
                                saldo_movimiento
                            FROM
                                movimiento
                            WHERE
                                id_mov = (SELECT 
                                        MAX(id_mov) AS maximo
                                    FROM
                                        movimiento
                                    WHERE
                                        almacen_id_alm = a.id_alm
                                            AND articulo_id_art = art.id_art)) > 0
                    GROUP BY articulo , almacen , saldo
                    ORDER BY 2) a
                    GROUP BY a.articulo) b ON (a.id = b.articulo)
                WHERE
                    a.id IS NOT NULL;";
        

        $resultado = $objCon->consultar($sql);


        
        while ($registro = $resultado->fetch()) {


            echo'<div class="col-xs-12">';
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center" id="art'.$registro["id"].'">'.$registro["articulo"].'</p> 
                    </div>';     
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center" id="cant'.$registro["id"].'">'.$registro["cantidad"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center" id="stock'.$registro["id"].'">'.$registro["saldo"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-2" >
                        <p class="text-center" id="proy'.$registro["id"].'">'.($registro["cantidad"]+$registro["cantidad"])*.15.'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center" id="dem'.$registro["id"].'">'.((($registro["cantidad"]+$registro["cantidad"])*.15)+$registro["cantidad"]+$registro["saldo"]).'</p> 
                    </div>';                                 
                echo'
                    <div class="col-xs-2">
                        <button class="btn  btn-success" data-toggle="modal" data-target="#CalculaDemanda" onclick="leerDatosDemanda('.$registro["id"].');">Calcular</button>
                    </div>';
            echo'</div><br>';
            echo'<div><br></div>';
        }
    }
    
    public function ListarPedidosAlmacenGerente()
    {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = "select 
                        art.id_art as id_art,
                        a.nombre_alm as almacen,
                        a.id_alm as id_alm,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        dp.id_det_ped as dp,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha,
                        p.almacen_id_alm as destino,
                        coalesce(art.precio_art,2) as precio,
                        case
                        when dp.atendido_det_ped = 0 then 'No atendido'
                        when dp.atendido_det_ped = 1 then 'Atendido' 
                        end
                        as atendido
                    from
                        almacen a
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                    where 
                        
                        dp.atendido_det_ped=0";
        
    // almacén general debería realizar Pedidos?? de ser así borrar primera condición del where

        $resultado = $objCon->consultar($sql);

        
        while ($registro = $resultado->fetch()) {

        echo'<div class="row">';
            echo'<div class="col-xs-12">';
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["articulo"].'</p> 
                    </div>';     
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["cantidad"].'</p> 
                    </div>';
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["usuario"].'</p> 
                    </div>';     
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["almacen"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["fecha"].'</p> 
                    </div>';                 
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["atendido"].'</p> 
                    </div>';                 

        }
    }

    public function LimpiaSoluciones() 
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql = "delete from soluciones_det_ped";

        $objCon->Consultar($sql);
    }

    /* 
     * Registra las posibles soluciones para un pedido realizado
     * en la tabla soluciones_det_ped
     */
    public function RegistraSoluciones($detalle_ped, $proveedor, $articulo, $cantidad_art_disp,$tipo,$diferencia) 
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql = "
            insert INTO soluciones_det_ped 
            (
                detalle_pedido_id_det_ped,
                soluciones_det_pro,
                articulo_id_art,
                soluciones_det_cant_art,
                diferencia_sol_det_ped,
                tipo_sol_det_ped
            )    
            VALUES (" . $detalle_ped . "," . $proveedor . "," . $articulo . "," . $cantidad_art_disp . "," . $diferencia .",".$tipo.")";

        $objCon->Consultar($sql);
    }
    
    /*
     * Función que lista las soluciones para los pedidos realizaos
     * 1 Que haga el pedido a un subalmacén, que tiene la capacidad para abastcerlo.
     * 2 Que haga el pedido a un subalmacén, que tiene la capacicad para abastecerlo parcialmente,
     *   y que generará una orden de compra para lo faltante.
     * 3 Que Genere una orden de compra con lo requerido por el subalmacén.
     */
        //  12-41-'piedra de media'-2-5-4   
    public function PosiblesSoluciones($detalle_ped, $id_art,$nombre_articulo,$precio, $destino,$cantidad) 
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $this->ProcesaPedidos();
        
        $sql = "
                select 
                    a.nombre_alm as proveedor,
                    a.id_alm as id_pro,
                    s.detalle_pedido_id_det_ped as dp,
                    s.soluciones_det_cant_art as disponible,
                    s.articulo_id_art as articulo,
                    s.diferencia_sol_det_ped as diferencia
                from
                    soluciones_det_ped s
                        inner join
                    almacen a ON s.soluciones_det_pro = a.id_alm 
                where
                    s.detalle_pedido_id_det_ped = " . $detalle_ped . " and " .
                "s.articulo_id_art = " . $id_art." and ".
                "s.tipo_sol_det_ped=0 ";

        $sql2 = "
                select 
                    a.nombre_alm as proveedor,
                    a.id_alm as id_pro,
                    s.detalle_pedido_id_det_ped as dp,
                    s.soluciones_det_cant_art as disponible,
                    s.articulo_id_art as articulo,
                    s.diferencia_sol_det_ped as diferencia
                from
                    soluciones_det_ped s
                        inner join
                    almacen a ON s.soluciones_det_pro = a.id_alm 
                where
                    s.detalle_pedido_id_det_ped = " . $detalle_ped . " and " .
                "s.articulo_id_art = " . $id_art." and ".
                "s.tipo_sol_det_ped=1 and s.soluciones_det_cant_art>0";
        
        $resultado = $objCon->Consultar($sql);
        $mostrar='';    
        $resultado2=$objCon->Consultar($sql2);

        /* $resul
         * Variable que contiene las soluciones halladas en ProcesaPedidos().
         * Si está vacía entonces se genera una orden de compra
         */

        $resul = "";

            $cabecera='
                <div class="panel panel-info">
                        <div class="panel-heading"><b>Listado de Soluciones</b></div>
                            <div class="panel-body">';
            $titulo='
                <div class="col-xs-12 ">    
                    <div class="col-xs-2">
                        <p class="text-center"><b>Almacen</b></p>
                    </div>
                    <div class="col-xs-2 ">
                        <p class="text-center"><b>Articulo</b></p>
                    </div>    
                    <div class="col-xs-2 ">
                        <p class="text-center"><b>Disponibilidad</b></p>
                    </div>
                    <div class="col-xs-2 ">
                        <p class="text-center"><b>Transferir</b></p>
                    </div>
                </div>';
            while($registro=$resultado->fetch())
        {

            $mostrar.=    '<div class="col-xs-12 ">';
            $mostrar.=        '<div class="col-xs-2"><p class="text-center">' . $registro["proveedor"] . '</p></div>';
            $mostrar.=        '<div class="col-xs-2"><p class="text-center">' . $nombre_articulo . '</p></div>';
            $mostrar.=        '<div class="col-xs-2"><p class="text-center">' . $registro["disponible"] . '</p></div>';
            $mostrar.=        '<div class="col-xs-2"><p class="text-center">'
                            . '<a class="btn btn-info" href="#" '
                            . 'onclick="ProcesaPedido('.$registro["id_pro"].','
                            .$destino.','.$registro["articulo"].','
                            .$cantidad.','.$detalle_ped.')">                               
                            Realizar Trasferencia</a></p>'
                            .'</div>';

            $mostrar.=    '</div>';                   
        }

        /* Variable vacía, se genera orden de compra */

        if($mostrar=='')
        {
            $registro=$resultado2->fetch();
            $cabecera='
                <div class="panel panel-warning">
                        <div class="panel-heading"><b>Posibles Órdenes de Compra</b></div>
                            <div class="panel-body">';
            $titulo='';
            $mostrar=$this->PosiblesOrdenesDeCompra($detalle_ped, $id_art,$precio, $registro["id_pro"], $registro["disponible"], $registro["diferencia"]);
            if($mostrar=='')
            {

                $titulo='
                    <div class="col-xs-12 ">    
                        <div class="col-xs-4">
                            <p class="text-center"><b>Generar Órden de Compra</b></p>
                        </div>
                    </div>';
                
                $resul.=$this->GeneraOrdenDeCompra($detalle_ped, $id_art,  $nombre_articulo,$precio, $destino,$cantidad);

                $mostrar.=$titulo.$resul;
                $titulo='';
            }
        }
               $mostrar.= '</div>';
            $mostrar.= '</div>';
        $mostrar.= '</div>';        
        echo  $cabecera.$titulo.$mostrar;
    }        

    function PosiblesOrdenesDeCompra($detalle_ped,$articulo,$precio,$proveedor,$cant_prov,$resto) 
    {
        require_once  'clsConexion.php';
        
        $objCon = new Conexion();
        
        $sql="
            select 
                a.nombre_alm as proveedor,
                art.nombre_art as articulo,
                dp.cantidad_art as cantidad
            from
                soluciones_det_ped s
                    inner join
                almacen a ON s.soluciones_det_pro = a.id_alm 
                inner join articulo art
                on art.id_art=s.articulo_id_art 
                inner join detalle_pedido dp
                on s.detalle_pedido_id_det_ped=dp.id_det_ped
            where
                s.detalle_pedido_id_det_ped = " . $detalle_ped . " and " .
            "s.articulo_id_art = " . $articulo." and ".
                "s. tipo_sol_det_ped=1 and s.soluciones_det_cant_art>0";

        $resultado=$objCon->Consultar($sql);
        $resul='';
        $titulo='

                <div class="col-xs-12 ">    
                    <div class="col-xs-2">
                        <p class="text-center"><b>Articulo</b></p>
                    </div>
                    <div class="col-xs-2 ">
                        <p class="text-center"><b>Proveedor</b></p>
                    </div>    
                    <div class="col-xs-2 ">
                        <p class="text-center"><b>Disponibilidad</b></p>
                    </div>
                    <div class="col-xs-2 ">
                        <p class="text-center"><b>Cantida Requerida</b></p>
                    </div>
                    <div class="col-xs-2 ">
                        <p class="text-center"><b>Cantidad A Ordenar</b></p>
                    </div>
                    <div class="col-xs-2 ">
                        <p class="text-center"><b>Transferir y Ordenar</b></p>
                    </div>
                </div>';

        $mostrar='';

        while($registro=$resultado->fetch())
        {

            $resul.=    '<div class="col-xs-12 ">';
            $resul.=        '<div class="col-xs-2"><p class="text-center">' . $registro["articulo"] . '</p></div>';
            $resul.=        '<div class="col-xs-2"><p class="text-center">' . $registro["proveedor"] . '</p></div>';
            $resul.=        '<div class="col-xs-2"><p class="text-center">' . $cant_prov . '</p></div>';
            $resul.=        '<div class="col-xs-2"><p class="text-center">' . $registro["cantidad"] . '</p></div>';
            $resul.=        '<div class="col-xs-2"><p class="text-center">' . $resto.'</p>'.'</div>';
            $resul.=        '<div class="col-xs-2"><p class="text-center">'
                                . '<a class="btn btn-success" data-target="#OrdenCompraFaltante" '
                                . ' data-toggle="modal" href="#" '
                                . 'onclick="LeerOrdenCompraFaltante('.$detalle_ped.','
                                .$articulo.",'".$registro["articulo"]."',"
                                .$precio.','.$proveedor.','
                                .$registro["cantidad"].','.$resto.')">                               
                                Realizar Trasferencia</a></p>'
                            .'</div>';;                   
            $resul.=    '</div>';                   
        }

        //echo "resul:".$resul;
        /* Variable vacía, se genera orden de compra */
        if($resul!='')
        {
            $mostrar.=$titulo.$resul;
        }

        return  $mostrar;        
    }
    
    public function GeneraOrdenDeCompra($det_ped,$id_art,$nombre_art, $precio,$almacen,$cantidad) 
    {
        $resul = ' 
                <div class="col-xs-12">
                    <div class="col-xs-4">
                        <p class="text-center"><a class="btn btn-md btn-warning" data-toggle="modal" data-target="#OrdenCompra" href="#"
                        onclick="ParametrosModal('.$det_ped.','.$id_art.',\''
                        .$nombre_art.'\','.$precio.','.$almacen.','.$cantidad.')">
                        <b>Genera Orden de Compra</b>
                        </a></p>
                     </div>                  
                </div> ';
        return $resul;
    }
    
    public function ProcesaPedidos() 
    {
        require_once 'clsConexion.php';
        require_once 'clsArticulo.php';

        $objCon = new Conexion();
        $objArt = new Articulo();
     
        $this->LimpiaSoluciones();
        
        /* INICIO Consulta los pedidos que no han sido atendidos*/
        $sql = "select 
                        dp.id_det_ped as id_dp,
                        art.id_art as articulo,
                        art.nombre_art as nombre,
                        a.id_alm as almacen,
                        a.nombre_alm as nombre_almacen,
                        dp.cantidad_art as cantidad,
                        dp.atendido_det_ped
                    from
                        almacen a
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                        where dp.atendido_det_ped=0";
        /* FIN Consulta los pedidos que no han sido atendidos*/

        
        /*
         * Contiene las posibles ubicaciones de donde usar los articulos
         *  [dp][art][cant_ped][alm_dest][alm_prov][cant_prod]
         */
        $resultado = $objCon->Consultar($sql);
        
        /*
         * Contiene todos los artículos existentes en todos los almacenes 
         * bajo la siguiente estructura:
         * [articulo][cantidad][almacen][nombre_almacen]
        */        
        $arregloProductos = $objArt->ArregloArticulos();

        $arregloSoluciones;
        $j = 0;
        $k = 0;

        /*
         * toma el pedido y verifica el artículo solicitado 
         * en toda la lista de artículos disponibles
        */
        while ($registro = $resultado->fetch()) {
           //print_r($registro);echo"<br><br>";
            /* 
            * De este algoritmo se determinará también si se genera 
            * orden de compra, ya que al no encontrar ninguna solución 
            * registrada, se va a generar la orden de compra con la 
            * información del pedido (en procedimiento )
            */
            for ($i = 0; $i < count($arregloProductos); $i++) {
                
                /*
                 * primero verifica que el artículo solicitado coincida con el artículo buscado
                 * luego valida que la busqueda no se realice en el mismo almacen
                */
                if (($registro["articulo"] == $arregloProductos[$i]["articulo"]) && ($registro["almacen"] <> $arregloProductos[$i]["almacen"])) {

                    /*
                     * si la cantidad requerida es abastecida por un subalmacen
                     * se registra en un arreglo que guardará el almacén con
                     * que abastecerá el pedido
                    */

                    if ((($arregloProductos[$i]["cantidad"]) - ($registro["cantidad"])) >= 0)
                        {
                        /*
                            Registra los almacenes que pueden dar abasto al requerimiento
                        */
                        
                        $this->RegistraSoluciones($registro["id_dp"], $arregloProductos[$i]["almacen"], 
                                $registro["articulo"], $arregloProductos[$i]["cantidad"],0,0);
                        //$j++;
                    } else
                        if ((($arregloProductos[$i]["cantidad"]) - ($registro["cantidad"])) < 0) 
                        {

                            //$arregloSoluciones[$j]["dp"] = $registro["id_dp"];
                            //$arregloSoluciones[$j]["resto"] = ($arregloProductos[$i]["cantidad"]) - ($registro["cantidad"]);
                            //$arregloSoluciones[$j]["proveedor"] = $arregloProductos[$i]["almacen"];
                            //$arregloSoluciones[$j]["solicitante"] = $registro["almacen"];
                            //$arregloSoluciones[$j]["cant_prov"] = $arregloProductos[$i]["cantidad"];
                            //$arregloSoluciones[$j]["articulo"] = $arregloProductos[$i]["articulo"];
                            //$arregloSoluciones[$j]["alm_dest"] = $registro["almacen"];
                            //$arregloSoluciones[$j]["cant_solic"] = $registro["cantidad"];
                            $this->RegistraSoluciones($registro["id_dp"], $arregloProductos[$i]["almacen"], 
                                    $registro["articulo"], $arregloProductos[$i]["cantidad"],
                                    1,(($registro["cantidad"]) - ($arregloProductos[$i]["cantidad"])));
                        }
                    } 
                } 
                
            }

    }    

    public function PedidoAtendido($dp) 
    {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = "update detalle_pedido set  atendido_det_ped=1 "
                . "where id_det_ped=" . $dp;

        $objCon->Consultar($sql);
    }

    public function ListarPedidosAlmacenAtendidos() 
    {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = "select 
                        art.id_art as id_articulo,
                        a.nombre_alm as almacen,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha,
                        case
                        when dp.atendido_det_ped = 1 then 'Atendido' 
                        end
                        as atendido
                    from
                        almacen a
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                        where p.almacen_id_alm<>0 
                        and
                        dp.atendido_det_ped=1
                        order by 6 asc";

        $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) {

            echo '<tr>';
            echo '<td>' . $registro["articulo"] . '</td>';
            echo '<td>' . $registro["cantidad"] . '</td>';
            echo '<td>' . $registro["usuario"] . '</td>';
            echo '<td>' . $registro["almacen"] . '</td>';
            echo '<td>' . $registro["fecha"] . '</td>';
            echo '<td>' . $registro["atendido"] . '</td>';
            echo '</tr>';
        }
    }

    public function ListarPedidosSubAlmacenAtendidos($almacen) 
    {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = "select 
                        art.id_art as id_articulo,
                        a.nombre_alm as almacen,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha,
                        case
                        when dp.atendido_det_ped = 0 then 'No atendido'
                        when dp.atendido_det_ped = 1 then 'Atendido' 
                        end
                        as atendido
                    from
                        almacen a
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                        where p.almacen_id_alm<>0 
                        and 
                        p.almacen_id_alm=" . $almacen."
                        and 
                        dp.atendido_det_ped =1 
                        order by 5 desc ";

        $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) {

            echo '<tr>';
            echo '<td>' . $registro["articulo"] . '</td>';
            echo '<td>' . $registro["cantidad"] . '</td>';
            echo '<td>' . $registro["usuario"] . '</td>';
            echo '<td>' . $registro["almacen"] . '</td>';
            echo '<td>' . $registro["fecha"] . '</td>';
            echo '<td>' . $registro["atendido"] . '</td>';
            echo '</tr>';
        }
    }
    public function ListarPedidosSubAlmacenNoAtendidos($almacen) 
    {
        require_once 'clsConexion.php';

        $objCon = new Conexion();

        $sql = "select 
                        art.id_art as id_articulo,
                        a.nombre_alm as almacen,
                        art.nombre_art as articulo,
                        dp.cantidad_art as cantidad,
                        u.nombre_usu as usuario,
                        p.fecha_ped as fecha,
                        case
                        when dp.atendido_det_ped = 0 then 'No atendido'
                        when dp.atendido_det_ped = 1 then 'Atendido' 
                        end
                        as atendido
                    from
                        almacen a
                            inner join
                        pedido p ON a.id_alm = p.almacen_id_alm
                            inner join
                        detalle_pedido dp ON p.id_ped = dp.Pedido_id_ped
                            inner join
                        articulo art ON dp.articulo_id_art = art.id_art
                            inner join
                        usuario u ON p.id_usu_ped = u.id_usu
                        where p.almacen_id_alm<>0 
                        and 
                        p.almacen_id_alm=" . $almacen."
                        and 
                        dp.atendido_det_ped =0                         
                        order by 5 desc ";

        $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) {

            echo '<tr>';
            echo '<td>' . $registro["articulo"] . '</td>';
            echo '<td>' . $registro["cantidad"] . '</td>';
            echo '<td>' . $registro["usuario"] . '</td>';
            echo '<td>' . $registro["almacen"] . '</td>';
            echo '<td>' . $registro["fecha"] . '</td>';
            echo '<td>' . $registro["atendido"] . '</td>';
            echo '</tr>';
        }
    }

}

?>