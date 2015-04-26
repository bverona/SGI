<?php

    class Proveedor {

        public function NuevoProveedor($nombre,$direccion,$ruc) 
        {
            require_once 'clsConexion.php';
            
            $objCon= new Conexion();
            $sql="insert into proveedor (nombre_proveedor,direccion_proveedor,ruc_proveedor)"
                    . "values ('".$nombre."','".$direccion."','".$ruc."')";
            
            echo $sql;
            
            if($objCon->Consultar($sql))
            {                
                return true;
            } 
            else
                {
                    return false;
                }
            
        }
        
        public  function EditarProveedor($id,$nombre,$direccion,$ruc)
        {
            $correcto=false;
            require_once 'clsConexion.php';
            $obj= new Conexion();
            $sql="update proveedor set nombre_proveedor='".$nombre."', direccion_proveedor='".$direccion."', "
                    . " ruc_proveedor='".$ruc."'where id_proveedor=".$id;

            
            echo $sql;
            if(($obj->Consultar($sql))==!0)
            {
                $correcto=true;
            }

            return $correcto;
        }

        public function ListarProveedores(){
            
        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "select id_proveedor as id, nombre_proveedor as nombre, direccion_proveedor as direccion, ruc_proveedor as ruc from proveedor;";
        $resultado = $objCon->consultar($sql);
            
        echo '
        <div class="panel panel-success">
            <div class="panel-heading"><b>Listado de Proveedores</b></div>
                <div class="panel-body">
                    <div class="table-responsive table-hover">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Editar</th>
                              <th>Eliminar</th>
                              <th>Nombre</th>
                              <th>Direccion</th>
                              <th>RUC</th>
                              <th>Añadir Artículo</th>
                            </tr>
                          </thead>
                          <tbody>
                          ';

            while ($registro = $resultado->fetch()) 
            {
                echo '<tr>';
                echo '<td><a href="#" onclick="leerDatos(' . $registro["id"] . ')" data-toggle="modal" data-target="#ActualizaProveedor"><img src="../../imagenes/editar.png"/></a></td>';
                echo '<td><a href="#" onclick="eliminar(\'' . $registro["id"] . '\')"><img src="../../imagenes/eliminar.png"/></a></td>';
                echo '<td>' . $registro["nombre"] . '</td>';
                echo '<td>' . $registro["direccion"] . '</td>';
                echo '<td>' . $registro["ruc"] . '</td>';
                echo '<td> <button class="btn btn-success" data-toggle="modal" data-target="#GestionaArticulo">Gestionar</button></td>';                
                echo '</tr>';
            }
                echo '</tbody>
                  </table>
            </div>
        </div>
    </div>
                ';

        }

        public function ListarProveedoresModal($articulo)
        {

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
                        where a.id_art=".$articulo;
        $resultado = $objCon->consultar($sql);

        
        $resul="";
            while ($registro = $resultado->fetch()) {

                $resul.= '<tr>';
                $resul.= '<td>' . $registro["proveedor"] . '</td>';
                $resul.= '<td>' . $registro["articulo"] . '</td>';
                $resul.= '<td>' . $registro["cantidad"] . '</td>';
                $resul.= '<td>' . $registro["precio"] . '</td>';
                $resul.= '<td> <input type="text" id="cantidadreq" onKeyUp="VerificaCantidad('.$registro["cantidad"].')"  class="form-control"> </td>';
                $resul.= '<td> <button class="btn btn-success" data-dismiss="modal" onclick="AsignaArticulo('.$registro["precio"].",'".$registro["proveedor"].'\','.$registro["id"].');">Gestionar</button></td>';                
                $resul.= '</tr>';
            }
            if($resul!='')
            {
                echo $resul;
            }else
            {
                $resul.='<tr><td colspan="3">No existen Proveedores para este artículo</td>';
                $resul.= '<td><button class="btn btn-success" onclick="AsignaArticulo(-1,-1);" data-dismiss="modal" >Gestionar</button></td></tr>';                
                echo $resul;
            }
        }
        
        public function AñadirArticuloProveedor($articulo,$proveedor,$cantidad,$precio) 
        {
            require_once 'clsConexion.php';
            $objCon= new Conexion();
            $sql="insert into articulo_has_proveedor (articulo_id_art,proveedor_id_proveedor,articulo_proveedor_cant,articulo_proveedor_pre) "
                    . "values (".$articulo.",".$proveedor.",".$cantidad.",".$precio.")";
            
            if($objCon->Consultar($sql))
            {
                return true;
            }else
            {
                return false;
            }
            
            
        }

}

?>