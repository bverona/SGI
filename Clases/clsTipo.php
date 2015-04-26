<?php

  class TipoArticulo
{

    public function AgregarTipo($nombre) 
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "insert INTO tipoarticulo (nombre_tip) values('".$nombre."')";
        $resultado = $objCon->consultar($sql);
        
    }
      
    public function SelectTipoArticulo() 
    {
        require_once 'clsConexion.php';
        $objCon = new Conexion();
        $sql = "select idTipoArticulo,  nombre_tip from tipoarticulo order by 1";
        $resultado = $objCon->consultar($sql);
        while ($registro = $resultado->fetch()) {

            echo '<option value="' . $registro["idTipoArticulo"] . '">' . $registro["nombre_tip"] . '</option>';
        }

    }      

    
    
}  
    
?>