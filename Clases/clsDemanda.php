<?php

class Demanda {

    public function NuevaDemanda($demanda, $costo_preparacion,$costo_almacenamiento,$id_art)
    {
        require_once 'clsConexion.php';
        
        $objCon = new Conexion();
        /**
         * estado = 0 demanda no atendida,
         * estado = 1 demanda atendida
        */        
        $sql = "INSERT INTO demanda 
                (
                    demanda_dem, 
                    costo_preparacion_dem, 
                    costo_almacenamiento_dem,
                    total_dem,
                    articulo_id_art, 
                    estado_dem
                )
                values  
                ('" . 
                    $demanda . "','" . 
                    $costo_preparacion . "','" . 
                    $costo_almacenamiento. "','" .
                    //aquí se aplica la fórmula
                    sqrt((2*$costo_preparacion*$demanda)/($costo_almacenamiento)). "','" . 
                    $id_art . "'," . 
                    0 . ")";

        if ($objCon->Consultar($sql)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function ListarDemandas()
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();
        //Listará acceso de los usuarios
        $sql = "SELECT 
                        d.id_dem AS id,
                    art.nombre_art AS articulo,
                    case
                    when d.estado_dem=0 then 'No atendido'
                        when d.estado_dem=1 then 'Atendido'
                    end as estado,
                    d.total_dem as total
                FROM 
                        demanda d 
                    inner join 
                    articulo art 
                    on 
                    art.id_art=d.articulo_id_art
                where d.estado_dem=0;";

        $resultado = $objCon->consultar($sql);

        while ($registro = $resultado->fetch()) {

            echo '<tr>';
            echo '<td><p class="text-center">' . $registro["articulo"] . '</p></td>';
            echo '<td><p class="text-center">' . $registro["total"] . '</p></td>';
            echo '<td><p class="text-center">' . $registro["estado"] . '</p></td>';
            echo '</tr>';
        }

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