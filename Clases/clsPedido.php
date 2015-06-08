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

    public function AgregarPedido($usuario, $foco) {

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

    public function EditarPedido($id, $area, $fecha) {
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

    public function EliminarPedido($id) {
        $correcto = false;
        require_once 'clsConexion.php';
        $obj = new Conexion();
        $sql = "delete from pedido where id_ped=" . $id;
        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }

        return $correcto;
    }

    public function AgregarDetallePedido($id_art, $cant) {
        $correcto = false;
        require_once 'clsConexion.php';
        $obj = new Conexion();
        //para obtener el indice del último pedido agregado
        $sql = "select MAX(id_ped)as maximo from pedido;";

        $resultado = $obj->Consultar($sql);
        $registro = $resultado->fetch();

        $sql = "insert into detalle_pedido(Pedido_id_ped,articulo_id_art,cantidad_art)"
                . "values(" . $registro["maximo"] . "," . $id_art . "," . $cant . ")";

        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }
        return $correcto;
    }

    public function ListarPedidosArea() {
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
                        where p.Area_id_are<>0 ";

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

    public function ListarPedidosPorArea($area) {
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
                        art.id_art as id_articulo,
                        a.id_alm as id_alm,
                        a.nombre_alm as almacen,
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
                        where p.almacen_id_alm<>0 
                        and
                        dp.atendido_det_ped=0";

        $resultado = $objCon->consultar($sql);

        //funcion que procesa los pedidos de los almacenes
        $this->ProcesaPedidos();
        
        while ($registro = $resultado->fetch()) {

            echo '<tr>';
            echo '<td>' . $registro["articulo"] . '</td>';
            echo '<td>' . $registro["cantidad"] . '</td>';
            echo '<td>' . $registro["usuario"] . '</td>';
            echo '<td>' . $registro["almacen"] . '</td>';
            echo '<td>' . $registro["fecha"] . '</td>';
            echo '<td>' . $registro["atendido"] . '</td>';
            echo '<td>' .
            '<div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                          Soluciones
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">' .
                    
                    $this->PosiblesSoluciones($registro["dp"], $registro["id_articulo"],
                    $registro["articulo"], $registro["precio"],$registro["destino"], $registro["cantidad"],$registro["id_alm"])
            . ' </ul>
                    </div>' .
            '</td>';
            echo '</tr>';
        }
    }

    /* 
     * Registra las posibles soluciones para un pedido realizado
     */
    public function RegistraSoluciones($detalle_ped, $proveedor, $articulo, $cantidad_art_disp) 
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql = "
            insert INTO soluciones_det_ped 
            (
                detalle_pedido_id_det_ped,
                soluciones_det_pro,
                articulo_id_art,
                soluciones_det_cant_art
            )    
            VALUES (" . $detalle_ped . "," . $proveedor . "," . $articulo . "," . $cantidad_art_disp . ")";

        $objCon->Consultar($sql);

        $sql = "update detalle_pedido set procesado_det=1 "
                . "where id_det_ped=" . $detalle_ped;

        $objCon->Consultar($sql);
    }
    
    /*
     * Función que lista las soluciones para los pedidos realizaos
     * 1 Que haga el pedido a un subalmacén, que tiene la capacidad para abastcerlo.
     * 2 Que haga el pedido a un subalmacén, que tiene la capacicad para abastecerlo parcialmente,
     *   y que generará una orden de compra para lo faltante.
     * 3 Que Genere una orden de compra con lo requerido por el subalmacén.
     */
    public function PosiblesSoluciones($detalle_ped, $articulo,$nombre_articulo,$precio, $destino, $cant,$origen) 
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql = "
                select 
                    a.nombre_alm as pro,
                    a.id_alm as id_pro,
                    s.detalle_pedido_id_det_ped as dp,
                    s.soluciones_det_cant_art as disponible,
                    s.articulo_id_art as articulo
                from
                    soluciones_det_ped s
                        inner join
                    almacen a ON s.soluciones_det_pro = a.id_alm
                where
                    s.detalle_pedido_id_det_ped = " . $detalle_ped . " and " .
                "s.articulo_id_art = " . $articulo;

        $resultado = $objCon->Consultar($sql);

        /* $resul
         * Variable que contiene las soluciones halladas en ProcesaPedidos().
         * Si está vacía entonces se genera una orden de compra
         */
        $resul = "";
        while ($registro = $resultado->fetch()) 
        {
            $resul .= ' <li role="presentation">' .
                    ' <button role="menuitem" type="button" tabindex="-1" class="btn btn-link" '
                    . 'onclick="ProcesaPedido('
                    . $registro["id_pro"] . ','
                    . $destino . ','
                    . $articulo . ','
                    . $cant . ','
                    . $detalle_ped . ')" >' .
                    $registro["pro"] . " -- " . $registro["disponible"] .
                    ' </button> </li> ';
        }
        
        /* Variable vacía, se genera orden de compra */
        if($resul=='')
        {
            $resul=  $this->GeneraOrdenDeCompra($detalle_ped, $articulo,  $nombre_articulo,$precio, $destino);
            return $resul;
        }
        
        return $resul;
    }
    
    public function GeneraOrdenDeCompra($det_ped,$id_prod,$nombre_prod, $precio,$almacen) 
    {
        $resul = ' <li role="presentation"> ' .
                ' <a data-toggle="modal" data-target="#OrdenCompra" href="#" onclick="ParametrosModal('.$det_ped.','.$id_prod.',\''. $nombre_prod.'\','.$precio.','.$almacen.')">
                  <b>Genera Orden de Compra</b>
                 </a> ' .
                '  </li> ';
        return $resul;
    }
    
    public function ProcesaPedidos() {
        require_once 'clsConexion.php';
        require_once 'clsArticulo.php';

        $objCon = new Conexion();
        $objArt = new Articulo();

        /* INICIO Consulta los pedidos que no han sido atendidos*/
        $sql = "select 
                        dp.id_det_ped as id_dp,
                        art.id_art as articulo,
                        art.nombre_art as nombre,
                        a.id_alm as almacen,
                        a.nombre_alm as nombre_almacen,
                        dp.cantidad_art as cantidad
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
                        dp.atendido_det_ped=0
                        and 
                        dp.procesado_det=0";
        /* Consulta los pedidos que no han sido atendidos FIN*/

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
                     * 
                     * De este algoritmo se determinará también si se genera 
                     * orden de compra, ya que al no encontrar ninguna solución 
                     * registrada, se va a generar la orden de compra con la 
                     * información del pedido (en procedimiento )
                    */

                    if ((($arregloProductos[$i]["cantidad"]) - ($registro["cantidad"])) >= 0)
                        {
                        /*
                          echo "el almacen ".$arregloProductos[$i]["nombre_almacen"] ." : ".($arregloProductos[$i]["cantidad"] - $registro["cantidad"])."<br>";
                          echo "<br>Entro al primero ".$i."<br>";
                          $arregloSoluciones[$j]["id_det_ped"] = $registro["id_dp"];
                          $arregloSoluciones[$j]["articulo"] = $registro["articulo"];
                          $arregloSoluciones[$j]["nombre"] = $registro["nombre"];
                          $arregloSoluciones[$j]["cant_ped"] = $registro["cantidad"];
                          $arregloSoluciones[$j]["alm_dest"] = $registro["almacen"];
                          $arregloSoluciones[$j]["alm_prov"] = $arregloProductos[$i]["almacen"];
                          $arregloSoluciones[$j]["cant_prod"] = $arregloProductos[$i]["cantidad"];
                         */
                        
                        $this->RegistraSoluciones($registro["id_dp"], $arregloProductos[$i]["almacen"], $registro["articulo"], $arregloProductos[$i]["cantidad"]);
                        $j++;
                    } else
                        if ((($arregloProductos[$i]["cantidad"]) - ($registro["cantidad"])) < 0) 
                        {
                            //echo "diferencia: ".($arregloProductos[$i]["cantidad"] - $registro["cantidad"])."<br>";
                            //echo "<br>Entro al segundo ".$i."<br>";
                            //echo $registro["articulo"]."-->".$arregloProductos[$i]["articulo"]."<br>";

                            $arregloSoluciones[$j]["id_det_ped"] = $registro["id_dp"];
                            $arregloSoluciones[$j]["articulo"] = $registro["articulo"];
                            $arregloSoluciones[$j]["cant_ped"] = $registro["cantidad"];
                            $arregloSoluciones[$j]["alm_dest"] = $registro["almacen"];
                            $arregloSoluciones[$j]["alm_prov"] = $arregloProductos[$i]["almacen"];
                            $arregloSoluciones[$j]["cant_prod"] = $arregloProductos[$i]["cantidad"];
                            $j++;
                        }
                } 
                
            }

            /*
              echo "<br>"." ------- <br>Articulo :" . $registro["nombre"] . "--Cantidad :" . $registro["cantidad"]."<br>**Posibles Soluciones**<br><br>";
              $a++;

              if(count($arregloSoluciones)>0)

              {
              for (; $k < count($arregloSoluciones); $k++)
              {
              echo "*************************<br>";
              echo "id detalle pedido :".$arregloSoluciones[$k]["id_det_ped"]."<br>";
              echo "articulo :".$arregloSoluciones[$k]["nombre"]."<br>";
              echo "Cantidad pedida :".$arregloSoluciones[$k]["cant_ped"]."<br>";
              echo "Almacen Destino:".$arregloSoluciones[$k]["alm_dest"]."<br>";
              echo "Almace Proveedor:".$arregloSoluciones[$k]["alm_prov"]."<br>";
              echo "Cantidad Producto:".$arregloSoluciones[$k]["cant_prod"]."<br>";
              }
              }
              else
              {
              echo "no existen almacenes que puedan abastecerlo, se genera orden de compra <br><br>";
              }
             */
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
                        dp.atendido_det_ped=1;";

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

    public function ListarPedidosSubAlmacen($almacen) {
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
                        dp.atendido_det_ped=0
                        and 
                        p.almacen_id_alm=" . $almacen;

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