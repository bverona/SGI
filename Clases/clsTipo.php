<?php

  class TipoArticulo
{
    private $nombre;
      
    public function setNombre($nombre)
    {
        $this->nombre=$nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function Buscar($id) 
    {
        
    }
      
    public function SelectTipoArticulo() 
    {

    require_once '../Clases/clsConexion.php';
    $objCon = new Conexion();
    $sql = "select idTipoArticulo,  nombre_tip from tipoarticulo order by 1";
    $resultado = $objCon->consultar($sql);
    while ($registro = $resultado->fetch()) {

        echo '<option value="' . $registro["idTipoArticulo"] . '">' . $registro["nombre_tip"] . '</option>';
    }


    }      

    
    
}  
    
?>