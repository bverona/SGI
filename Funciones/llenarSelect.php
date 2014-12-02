<?php

    $valorRb = $_POST["valor_Rb"];
    
    require_once '../Clases/clsArea.php';
    require_once '../Clases/clsAlmacen.php';
    $objArea = new Area();
    $objAlmacen = new Almacen();

    if($valorRb==2)
    {
        $objArea->ListarArea();
    }
    else if($valorRb==5)
        {
            $objAlmacen->ListarTodosAlmacenes();        
        }
        else 
            {
                $objAlmacen->ListarAlmacenSinFiltro();        
            }

?>
