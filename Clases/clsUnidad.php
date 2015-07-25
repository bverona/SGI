<?php

    class Unidad {
    
        
    public function NuevaUnidad($nombre)
    {
        require 'clsConexion.php';
        $objCon = new Conexion();       
        
        $sql="Insert into  unidad_de_medida (nombre_um) values ('".$nombre."')";
        
        $objCon->Consultar($sql);
    }

    public function SelectUnidad() 
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "select id_um as id, nombre_um as nombre from unidad_de_medida order by 1";
        $resultado = $objCon->consultar($sql);
        while ($registro = $resultado->fetch()) {

            echo '<option value="' . $registro["id"] . '">' . $registro["nombre"] . '</option>';
        }

    }          
    
    
}


?>