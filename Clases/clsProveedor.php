<?php

class Proveedor {

    public function NuevoProveedor($nombre, $direccion, $ruc)
    {
        require_once 'clsConexion.php';

        $objCon = new Conexion();
        $sql = "insert into proveedor "
                . "(nombre_proveedor,direccion_proveedor,ruc_proveedor)"
                . "values "
                . "('" . $nombre . "','" . $direccion . "','" . $ruc . "')";

        echo $sql;

        if ($objCon->Consultar($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function BuscarProveedor($proveedor) 
    {
        require 'clsConexion.php';
        $objCon = new Conexion();
        
        $sql="
            select 
                id_proveedor as id,
                nombre_proveedor as nombre 
            from proveedor
            where nombre_proveedor like '%".$proveedor."%'";

        $resultado=$objCon->Consultar($sql);
        $i=0;
        $retorno=null;
        
        while($registro=$resultado->fetch())
        {
            $retorno[$i]["id"]=$registro["id"];
            $retorno[$i]["proveedor"]=$registro["nombre"];
            $i++;
        }

        return $retorno;                
    }
    
    public function EditarProveedor($id, $nombre, $direccion, $ruc) 
    {
        $correcto = false;
        require_once 'clsConexion.php';
        $obj = new Conexion();
        $sql = "update proveedor set nombre_proveedor='" . $nombre . 
                "', direccion_proveedor='" . $direccion . "', "
                . " ruc_proveedor='" . $ruc . "'where id_proveedor=" . $id;


        echo $sql;
        if (($obj->Consultar($sql)) == !0) {
            $correcto = true;
        }

        return $correcto;
    }

    public function ListarProveedores() {

        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = 
            "select "
                . "id_proveedor as id, nombre_proveedor as nombre, "
                . "direccion_proveedor as direccion, ruc_proveedor as ruc "
            . "from proveedor;";
        $resultado = $objCon->consultar($sql);

        echo '
        <div class="panel panel-success">
            <div class="panel-heading"><b>Listado de Proveedores</b></div>
                <div class="panel-body">
                    <div class="table-responsive table-hover">
                        <table class="table">
                          <thead>
                            <tr>
                              <th class="text-center">Editar</th>
                              <th class="text-center">Eliminar</th>
                              <th class="text-center">Nombre</th>
                              <th class="text-center">Direccion</th>
                              <th class="text-center">RUC</th>
                              <th class="text-center">Añadir Artículo</th>
                              <th class="text-center">Articulos Registrados</th>
                            </tr>
                          </thead>
                          <tbody>
                          ';

        while ($registro = $resultado->fetch()) 
        {
            echo '<tr>';
            echo '<td><a href="#" onclick="leerDatos(' . $registro["id"] . ')" '
                    . 'data-toggle="modal" data-target="#ActualizaProveedor">'
                    . '<img src="../../imagenes/editar.png"/></a></td>';
            echo '<td><a href="#" onclick="eliminar(\''.$registro["id"].'\')">'
                    . '<img src="../../imagenes/eliminar.png"/></a></td>';
            echo '<td>' . $registro["nombre"] . '</td>';
            echo '<td>' . $registro["direccion"] . '</td>';
            echo '<td>' . $registro["ruc"] . '</td>';
            echo '<td> <button class="btn btn-success" data-toggle="modal" '
            . 'data-target="#GestionaArticulo" onclick="SeleccionarProveedor('.$registro["id"].')">Gestionar</button></td>';
            echo '<td> <button class="btn btn-info" data-toggle="modal" '
            . 'data-target="#ArticulosxProveedor" onclick="SeleccionarProveedor('.$registro["id"].');MostrarArticulosPorProveedor()">Articulos Registrados</button></td>';
            echo '</tr>';
            echo '<div  id="prov'.$registro["id"].'">';
                //$this->ListarArticulosPorProveedor($registro["id"]);
            echo '</div>';
        }
        echo '
                        </tbody>
                  </table>
            </div>
        </div>
    </div>
                ';
    }
    
    public function ListarProveedores2() {

        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = 
            "select "
                . "id_proveedor as id, nombre_proveedor as nombre, "
                . "direccion_proveedor as direccion, ruc_proveedor as ruc "
            . "from proveedor;";
        $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) 
        {
        echo'<div class="row">';
            echo'<div class="col-xs-12">';
                echo'
                    <div class="col-xs-1 ">'.
                        '<p class="text-center"><a href="#" onclick="leerDatos(' . $registro["id"] . ')" '
                            . 'data-toggle="modal" data-target="#ActualizaProveedor">'
                            . '<img src="../../imagenes/editar.png"/></a></td>
                        </p>       
                        </div>';    
                echo'
                    <div class="col-xs-1 ">
                        <p class="text-center"><a href="#" onclick="eliminar(\''.$registro["id"].'\')">'
                            . '<img src="../../imagenes/eliminar.png"/></a> 
                        </p>
                    </div>';
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["nombre"].'</p> 
                    </div>';
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["direccion"].'</p> 
                    </div>';
                echo'            
                    <div class="col-xs-2">
                        <p class="text-center">'.$registro["ruc"].'</p> 
                         <p>&nbsp</p>           
                    </div>';

                echo'    
                    <div class="col-xs-1">
                        <button class="btn btn-success" data-toggle="modal" '
                    . 'data-target="#GestionaArticulo" onclick="SeleccionarProveedor('.$registro["id"].')">Gestionar</button>
                    </div>';
                echo'
                    <div class="col-xs-1">
                    <a class="btn btn-success" data-toggle="collapse" href="#proveedor'.$registro["id"].'" 
                        onclick="SeleccionarProveedor('.$registro["id"].');MostrarArticulosPorProveedor()" aria-expanded="false" aria-controls="#proveedor'.$registro["id"].'"> 
                    Articulos Registrados</a>
                    </div>';            
            echo'</div>';
        echo'</div >';

        echo'<div class="row collapse" aria-expanded="false" id="proveedor'.$registro["id"].'">

        </div>';

        }

    }

    public function ListarProveedoresSimple() {

        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "select id_proveedor as id, nombre_proveedor as nombre, "
                . "direccion_proveedor as direccion, ruc_proveedor as ruc "
                . "from proveedor;";
        $resultado = $objCon->consultar($sql);

        echo '
        <div class="panel panel-success">
            <div class="panel-heading"><b>Listado de Proveedores</b></div>
                <div class="panel-body">
                    <div class="table-responsive table-hover table-bordered">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Proveedor</th>
                              <th>Agregar Artículo</th>
                            </tr>
                          </thead>
                          <tbody>
                          ';

        while ($registro = $resultado->fetch()) {
            echo '<tr>';
            echo '<td>' . $registro["nombre"] . '</td>';
            echo '<td> <button class="btn btn-success" data-toggle="modal" '
            . 'data-target="#AnhadeArticulo">Añadir</button></td>';
            echo '</tr>';
        }
        echo '</tbody>
                  </table>
            </div>
        </div>
    </div>
                ';
    }

    public function ListarProveedoresModal($articulo) {

        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "select  
                        ap.proveedor_id_proveedor as id, 
                        a.nombre_art as articulo, 
                        ap.articulo_proveedor_pre as precio, 
                        p.nombre_proveedor as proveedor, 
                        ap.articulo_proveedor_cant as cantidad
                from    
                        articulo_proveedor ap  inner join
                        proveedor p on ap.proveedor_id_proveedor=p.id_proveedor
                        inner join articulo a on a.id_art=ap.articulo_id_art
                        where a.id_art=" . $articulo;
        $resultado = $objCon->consultar($sql);


        $resul = "";
        while ($registro = $resultado->fetch()) {

            $resul.= '<tr>';
            $resul.= '<td>' . $registro["proveedor"] . '</td>';
            $resul.= '<td>' . $registro["articulo"] . '</td>';
            $resul.= '<td>' . $registro["cantidad"] . '</td>';
            $resul.= '<td>' . $registro["precio"] . '</td>';
            $resul.= '<td> <input type="text" id="cantidadreq" '
                   . 'onKeyUp="VerificaCantidad(' . $registro["cantidad"] . ')"'
                   . '  class="form-control"> </td>';
            $resul.= '<td> <button class="btn btn-success" data-dismiss="modal"'
                    . 'onclick="AsignaArticulo(' . $registro["precio"] . ",'" 
                    . $registro["proveedor"] . '\',' . $registro["id"] . ');">'
                    . 'Gestionar</button></td>';
            $resul.= '</tr>';
        }
        if ($resul != '') {
            echo $resul;
        } else {
            $resul.='<tr><td colspan="3">No existen Proveedores para este '
                    . 'artículo</td>';
            $resul.= '<td><button class="btn btn-success" '
                    . 'onclick="AsignaArticulo(-1,-1);" data-dismiss="modal" >'
                    . 'Gestionar</button></td></tr>';
            echo $resul;
        }
    }

    public function AñadirArticuloProveedor($articulo, $proveedor, $cantidad,$precio)
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql=" 
                select id_art_prov as id from 
                    articulo_proveedor 
                where 
                    proveedor_id_proveedor=".$proveedor." and
                    articulo_id_art=".$articulo." and 
                    articulo_proveedor_pre=".$precio." and     
                    vigenci_art_prov=1";
        
        $resultado=$objCon->Consultar($sql);
        
        
        if(!$registro=$resultado->fetch())
        {
            
        $sql2 = "insert into articulo_has_proveedor "
                . "(articulo_id_art,proveedor_id_proveedor,"
                . "articulo_proveedor_cant,articulo_proveedor_pre) "
                . "values (" . $articulo . "," . $proveedor . "," . $cantidad 
                . "," . $precio . ")";
        }else
            {
                $sql2=" 
                        update  
                            articulo_proveedor 
                        set     
                            articulo_proveedor_cant=".$cantidad."+ articulo_proveedor_cant 
                        where 
                                proveedor_id_proveedor=".$proveedor." and
                                articulo_id_art=".$articulo." and 
                                articulo_proveedor_pre=".$precio;
            }
    }

    public function CambiarEstadoArticuloProveedor($id)
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();

        $sql=" 
            update  
                articulo_proveedor 
            set     
                vigenci_art_prov=0
            where 
                articulo_id_art=".$id;        
        $objCon->Consultar($sql);
    }    
    
    public function ListarArticulosPorProveedor($proveedor)
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = " 
                select 
                    a.nombre_art as articulo,
                    ap.proveedor_id_proveedor as proveedor,
                    ap.articulo_proveedor_cant as cantidad,
                    ap.articulo_proveedor_pre as precio,
                    ap.vigenci_art_prov as vigencia
                from
                    articulo_proveedor ap inner join proveedor p
                    on ap.proveedor_id_proveedor= p.id_proveedor  
                    inner join articulo a 
                    on a.id_art = ap.articulo_id_art
                where
                    ap.proveedor_id_proveedor=".$proveedor;
                   
        $resultado=$objCon->Consultar($sql);

            echo'
                <div class="panel panel-info">
                        <div class="panel-heading"><b>Listado de Proveedores</b></div>
                            <div class="panel-body">';
            echo'
                <div class="col-xs-12 ">    
                    <div class="col-xs-2">
                        <p class="text-center"><b>Articulo</b></p>
                    </div>    
                    <div class="col-xs-2 ">
                        <p class="text-center"><b>Cantidad</b></p>
                    </div>    
                    <div class="col-xs-2 ">
                        <p class="text-center"><b>Precio</b></p>
                    </div>                            
                    <div class="col-xs-2 ">
                        <p class="text-center"><b>Estado</b></p>
                    </div>                            
                    <div class="col-xs-2 ">
                        <p class="text-center"><b>Cambiar Estado</b></p>
                    </div>                            
                </div>';
        while($registro=$resultado->fetch())
        {

            echo    '<div class="col-xs-12 ">';
            echo        '<div class="col-xs-2"><p class="text-center">' . $registro["articulo"] . '</p></div>';
            echo        '<div class="col-xs-2"><p class="text-center">' . $registro["cantidad"] . '</p></div>';
            echo        '<div class="col-xs-2"><p class="text-center">' . $registro["precio"] . '</p></div>';
            echo        '<div class="col-xs-2"><p class="text-center">' . ($registro["vigencia"]==1?'Vigente':'No Vigente') . '</p>
                        <input type="hidden" value="'.$registro["vigencia"].'"> </div>';
            echo        '<div class="col-xs-2"><p class="text-center"><a href="#" onclick="CambiarEstado('.$registro["proveedor"].')"><img src="../../Imagenes/cambiarEstado.ico"></a></p></div>';
            echo    '</div>';                   
        }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
    
    public function ListarProveedoresCombo() {
        
        require 'clsConexion.php';
    
        $objCon= new Conexion();
                
        $sql="select 
                id_proveedor as id,
                nombre_proveedor as nombre,             
                ruc_proveedor as ruc
            from proveedor";
        $resultado=$objCon->Consultar($sql);
        
        while($registro=$resultado->fetch())
        {
            echo '<option  value="'.$registro["id"].'">'.$registro["nombre"]
                    .'----'.$registro["ruc"].'</option>';
        }
        
    }

    
    
        }

?>