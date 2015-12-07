<?php
    class Sesion{
        
        private static $user;
        private static $pass;
        

        public function IniciaSesion($usu, $pass) {
            $sesion=0;
            require_once 'clsConexion.php';
            $objConexion= new Conexion();
            $sql="  select 
                        u.id_usu as id,
                        u.nombre_usu as usuario,
                        u.clave_usu as pass,
                        u.permisos_usu as permisos,
                        u.almacen_id_alm as almacen,
                        u.area_id_are as area
                    from usuario u where u.nombre_usu='".$usu."'";
        
            
            //resultado almacena la tabla obtenida de la consulta
            $resultado=$objConexion->Consultar($sql)->fetch();

            //cadena para insertar en la tabla registro
            //$sql2="insert into registro (id_usu_reg,fecha_reg,hora_reg,acceso_reg) values(".$resultado["id"].",'". date("Y-m-d")."','". date("h:i:s")."',now())";
            $sql2="insert into registro (id_usu_reg,acceso_reg) values(".$resultado["id"].",now())";

            if( ($resultado['pass']==md5($pass)) )
            {
                    session_name("SGI");
                    session_start();
                    $_SESSION['usuario']=$resultado['usuario'];
                    $_SESSION['permisos']=$resultado['permisos'];
                    $_SESSION['id_almacen']=$resultado['almacen'];
                    $_SESSION['id_area']=$resultado['area'];
                    $_SESSION['id']=$resultado['id'];
                    $sesion=1;
               $objConexion->Consultar($sql2) ;  
                    
            }
                return $sesion;
        }

    function PosiblesOrdenesDeCompra
        ($dp,$resto,$proveedor,$solicitante,$cant_prov,$art,
            $alm_dest,$cant_solic) 
    {
        require_once  'clsConexion.php';
        
        $objCon = new Conexion();
        
        $sql="
            select nombre_alm as proveedor,
                    (select  
                        nombre_art 
                     from 
                        articulo 
                     where id_art=".$art.") as articulo 
            from 
                almacen  
            where id_alm=".$proveedor;
        
        $titulo='
                <div class="panel panel-warning">
                        <div class="panel-heading"><b>Posibles Ordenes de Compra</b></div>
                            <div class="panel-body">
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
                </div>';

        $resul='';
        $mostrar='';
        
        while($registro=$resultado->fetch())
        {

            $resul.=    '<div class="col-xs-12 ">';
            $resul.=        '<div class="col-xs-2"><p class="text-center">' . $registro["articulo"] . '</p></div>';
            $resul.=        '<div class="col-xs-2"><p class="text-center">' . $registro["proveedor"] . '</p></div>';
            $resul.=        '<div class="col-xs-2"><p class="text-center">' . $cant_prov . '</p></div>';
            $resul.=        '<div class="col-xs-2"><p class="text-center">' . $resto.'</p>'
                            .'</div>';

            $resul.=    '</div>';                   
        }

               $cierre= '</div>';
            $cierre.= '</div>';
        $cierre.= '</div>';
        /* Variable vacía, se genera orden de compra */
        if($resul!='')
        {
            $mostrar.=$titulo.$resul.$cierre;
        }
        
        echo  $mostrar;        
    }    
        
        
    }
?>