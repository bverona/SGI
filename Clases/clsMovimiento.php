<?php
    
    class Movimiento{
        
        private $id;
        private $tipo;
        private $almacen;
        
        
        public function SetId($id) {
            $this->id=$id;
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
            return $this->tipo=$tipo;
        }        
        public function SetAlmacen($almacen) {
            return $this->almacen=$almacen;
        }        

        public function AgregaMovimiento($tipo_mov,$almacen_id,$fecha)
        {           
            $correcto=false; 
            require_once 'clsConexion.php';
            
            $obj= new Conexion();
            $sql="  insert into movimiento (
                        tipo_mov, 
                        almacen_id_alm,
                        fecha_det_mov) 
                    values(".
                        $tipo_mov.",".
                        $almacen_id.",".
                        "'".$fecha."')";
   
 
            if($obj->Consultar($sql)!=0)
            {
                $correcto=true;
            }
         
            return $correcto;

        }
    
        public function EditaMovimiento($id,$tipo_mov,$almacen_id)
        {
            $correcto=false; 
            require_once 'clsConexion.php';
            
            $obj= new Conexion();
            $sql="update 
                    movimiento 
                    set 
                    tipo_mov=".$tipo_mov.",
                    almacen_id_alm=".$almacen_id."
                    where id_mov=";
            
            if($obj->Consultar($sql)!=0)
            {
                $correcto=true;
            }
            return $correcto;
           
        }        
               
        //solo para el almacén general
        public function AgregaDetalleMovimientoEntrada($id_art,$cantidad,$saldo,$descripcion) 
        {
            $correcto=false; 
            require_once 'clsConexion.php';
            
            $obj= new Conexion();
            
            $sql="select MAX(id_mov)as maximo from movimiento";
            
            $resultado = $obj->Consultar($sql);
            $registro = $resultado->fetch();
           
            $sql="insert into detalle_movimiento (
                        movimiento_id_mov,
                        articulo_id_art,
                        cantidad_det_mov,
                        saldo_det_mov,
                        descripcion_det_mov)
                  values(".$registro["maximo"].",".$id_art .",".$cantidad.",".$saldo.",'".$descripcion."')";
            $sqlSuma="update articulo set cantidad_art=cantidad_art+".$cantidad." where id_art=".$id_art;
            echo $sql;       
            if($obj->Consultar($sql)!=0)
            {
                if($obj->Consultar($sqlSuma)!=0)
                {
                    $correcto=true;
                }
            }
            return $correcto;
        }
        public function AgregaDetalleMovimientoEntradaNuevo($id_art,$cantidad,$saldo,$descripcion) 
        {
            $correcto=false; 
            require_once 'clsConexion.php';
            
            $obj= new Conexion();
            $sql="select MAX(id_mov)as maximo from movimiento";
            
            $resultado = $obj->Consultar($sql);
            $registro = $resultado->fetch();
            //Hasta arriba ok
           
            $sql="insert into detalle_movimiento (
                        movimiento_id_mov,
                        articulo_id_art,
                        cantidad_det_mov,
                        saldo_det_mov,
                        descripcion_det_mov)
                  values(".$registro["maximo"].",".$id_art .",".$cantidad.",".$saldo.",'".$descripcion."')";
            //hasta aquí agrega el registro del detalle del artículo
//            $sqlSuma="update articulo set cantidad_art=cantidad_art+".$cantidad." where id_art=".$id_art;
            echo $sql;       
            if($obj->Consultar($sql)!=0)
            {
                    $correcto=true;
  
            }
            return $correcto;
        }

        public function AgregaDetalleMovimientoEntradaxAlmacen($id_art,$cantidad,$saldo,$descripcion) 
        {
            $correcto=false; 
            require_once 'clsConexion.php';
            
            $obj= new Conexion();
            
            $sql="select MAX(id_mov)as maximo from movimiento";
            
            $resultado = $obj->Consultar($sql);
            $registro = $resultado->fetch();

            
            $sql="insert into detalle_movimiento (
                        movimiento_id_mov,
                        articulo_id_art,
                        cantidad_det_mov,
                        saldo_det_mov,
                        descripcion_det_mov)
                  values(".$registro["maximo"].",".$id_art .",".$cantidad.",".$saldo.",'".$descripcion."')";

            if($obj->Consultar($sql)!=0)
            {
                    $correcto=true;   
            }
            return $correcto;
        }
        
        public function AgregaDetalleMovimientoSalida($id_art,$cantidad,$saldo,$descripcion) 
        {
            $correcto=false; 
            require_once 'clsConexion.php';
            
            $obj= new Conexion();
            
            $sql="select MAX(id_mov)as maximo from movimiento";
            
            $resultado = $obj->Consultar($sql);
            $registro = $resultado->fetch();

            
            $sql="insert into detalle_movimiento (
                        movimiento_id_mov,
                        articulo_id_art,
                        cantidad_det_mov,
                        saldo_det_mov,
                        descripcion_det_mov)
                  values(".$registro["maximo"].",".$id_art .",".$cantidad.",".$saldo.",'".$descripcion."')";
            $sqlResta="update articulo set cantidad_art=cantidad_art-".$cantidad." where id_art=".$id_art;

            if($obj->Consultar($sql)!=0)
            {
                if($obj->Consultar($sqlResta)!=0)
                {
                    $correcto=true;
                }
            }
            return $correcto;
              
        }
        
        public function BuscaArticuloDetalle($almacen,$articulo) 
        {
            require_once 'clsConexion.php';
           $objCon = new Conexion();
           //Va a mostrar todos los usuarios a excepción de los que tienen privilegios          
            $sql = "SELECT 
                        coalesce(det.saldo_det_mov,'0') as saldo
                    from 
                        movimiento mov inner join detalle_movimiento det
                        on mov.id_mov=det.id_det_mov
                        where mov.almacen_id_alm=".$almacen." and "
                        . "det.articulo_id_art=".$articulo;

           $resultado = $objCon->consultar($sql);
           $i=0;
           while($registro = $resultado->fetch())
           {               
                $i=$registro["saldo"];
           }
           return $i;
        }
        
        public function definecant($almacen,$articulo) 
        {
            require_once 'clsConexion.php';
           $objCon = new Conexion();
           //Va a mostrar todos los usuarios a excepción de los que tienen privilegios
            $sql = "select  
                            coalesce(dm.cantidad_det_mov,'-') as cantidad
                    from almacen a inner join movimiento m 
                            on a.id_alm=m.almacen_id_alm 
                            inner join detalle_movimiento dm
                            on m.id_mov=dm.movimiento_id_mov
                    where m.almacen_id_alm =".$almacen." and dm.articulo_id_art=".$articulo;

           $resultado = $objCon->consultar($sql);
           $i=null;
           while($registro = $resultado->fetch())
           {               
                $i=$registro["cantidad"];
           }
           return $i;
        }
        
        public function ListarEntradas() 
        {
             require_once 'clsConexion.php';

             $objCon = new Conexion();

              $sql = "select    
                            a.nombre_alm as almacen,
                            m.fecha_det_mov as fecha,
                            art.nombre_art as articulo,
                            dm.cantidad_det_mov as cantidad,
                            dm.saldo_det_mov as saldo
                     from almacen a inner join movimiento m 
                            on a.id_alm=m.almacen_id_alm 
                            inner join detalle_movimiento dm
                            on m.id_mov=dm.movimiento_id_mov 
                            inner join articulo art 
                            on dm.articulo_id_art= art.id_art
                            where m.tipo_mov=0;";

                 $resultado = $objCon->consultar($sql);

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
         
        public function ListarSalidas() 
        {
             require_once 'clsConexion.php';

             $objCon = new Conexion();

              $sql = "select    
                            a.nombre_alm as almacen,
                            m.fecha_det_mov as fecha,
                            art.nombre_art as articulo,
                            dm.cantidad_det_mov as cantidad,
                            dm.saldo_det_mov as saldo
                     from almacen a inner join movimiento m 
                            on a.id_alm=m.almacen_id_alm 
                            inner join detalle_movimiento dm
                            on m.id_mov=dm.movimiento_id_mov 
                            inner join articulo art 
                            on dm.articulo_id_art= art.id_art
                            where m.tipo_mov=1;";

                 $resultado = $objCon->consultar($sql);

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
        
        public function ListarMovimientos($id) 
        {
        require_once 'clsConexion.php';

        $objCon = new Conexion();
        
        $sql = " select    
                        a.nombre_alm as almacen,
                        m.fecha_det_mov as fecha,
                        art.nombre_art as articulo,
                        dm.cantidad_det_mov as cantidad,
                        art.unidad_art as unidad,
                        dm.saldo_det_mov as saldo,
                        m.tipo_mov as movimiento
                 from almacen a inner join movimiento m 
                        on a.id_alm=m.almacen_id_alm 
                        inner join detalle_movimiento dm
                        on m.id_mov=dm.movimiento_id_mov 
                        inner join articulo art 
                        on dm.articulo_id_art= art.id_art";

        $sql2=  "select    
                        a.nombre_alm as almacen,
                        m.fecha_det_mov as fecha,
                        art.nombre_art as articulo,
                        dm.cantidad_det_mov as cantidad,
                        art.unidad_art as unidad,
                        dm.saldo_det_mov as saldo,
                        m.tipo_mov as movimiento                        
                 from almacen a inner join movimiento m 
                        on a.id_alm=m.almacen_id_alm 
                        inner join detalle_movimiento dm
                        on m.id_mov=dm.movimiento_id_mov 
                        inner join articulo art 
                        on dm.articulo_id_art= art.id_art
                         where a.id_alm=".$id;
            ($id=='0')?
            $resultado = $objCon->consultar($sql):
            $resultado = $objCon->consultar($sql2);

            
              while ($registro = $resultado->fetch()) {

                ($registro["movimiento"]=='0')?
                $movimiento = "Entrada":
                $movimiento= "Salida";

                 echo '<tr>';

                 echo '<td>' . $registro["almacen"] . '</td>';
                 echo '<td>' . $registro["fecha"] . '</td>';
                 echo '<td>' . $registro["articulo"] . '</td>';
                 echo '<td>' . $registro["unidad"] . '</td>';
                 echo '<td>' . $registro["cantidad"] . '</td>';
                 echo '<td>' . $registro["saldo"] . '</td>';
                 echo '<td>' . $movimiento . '</td>';
                 echo '</tr>';
             }
        }

        public function ListarMovimientosPorAlmacen($id) 
        {
        require_once 'clsConexion.php';

        $objCon = new Conexion();
        
        $sql = " select    
                        a.nombre_alm as almacen,
                        m.fecha_det_mov as fecha,
                        art.nombre_art as articulo,
                        dm.cantidad_det_mov as cantidad,
                        art.unidad_art as unidad,
                        dm.saldo_det_mov as saldo
                 from almacen a inner join movimiento m 
                        on a.id_alm=m.almacen_id_alm 
                        inner join detalle_movimiento dm
                        on m.id_mov=dm.movimiento_id_mov 
                        inner join articulo art 
                        on dm.articulo_id_art= art.id_art";

        $sql2=  "select    
                        a.nombre_alm as almacen,
                        m.fecha_det_mov as fecha,
                        art.nombre_art as articulo,
                        dm.cantidad_det_mov as cantidad,
                        art.unidad_art as unidad,
                        dm.saldo_det_mov as saldo
                 from almacen a inner join movimiento m 
                        on a.id_alm=m.almacen_id_alm 
                        inner join detalle_movimiento dm
                        on m.id_mov=dm.movimiento_id_mov 
                        inner join articulo art 
                        on dm.articulo_id_art= art.id_art
                         where a.id_alm=".$id;
            ($id=='0')?
            $resultado = $objCon->consultar($sql):
            $resultado = $objCon->consultar($sql2);

            
              while ($registro = $resultado->fetch()) {

                 echo '<tr>';

                 echo '<td>' . $registro["almacen"] . '</td>';
                 echo '<td>' . $registro["fecha"] . '</td>';
                 echo '<td>' . $registro["articulo"] . '</td>';
                 echo '<td>' . $registro["unidad"] . '</td>';
                 echo '<td>' . $registro["cantidad"] . '</td>';
                 echo '<td>' . $registro["saldo"] . '</td>';
                 echo '</tr>';
             }
        }
             
        
        
    }
?>
