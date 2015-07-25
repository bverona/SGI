<?php
  class Conexion {
    
    public function Conecta() {
    
       $host="mysql:host=localhost;port=3307;dbname=SGI";
       $usuario="root";
       $clave="bruno";

       $dblink=new PDO($host, $usuario, $clave);
       $dblink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
       return $dblink;
    }
    
    public function Consultar($sql) {
        $resultado=0;//si devuelve 0, operación errónea
        try {
            $conexion= $this->Conecta();
            $resultado=$conexion->query($sql);

            } 
            catch (Exception $exc) {
            $resultado=0;
            echo $exc->getMessage();
            exit();
            }
         return $resultado;   
        }
                    
}
?>
