<?php

    $articulo=$_GET["term"];
    
    if(!$articulo){
        return;
    }
    
    require '../Clases/clsArticulo.php';
    
    $objArt= new Articulo();
    
    $resultado=$objArt->BuscarArticulo($articulo);
    

    
    echo"[";
    
    for($i=0;$i<count($resultado);$i++){
        $id=$resultado[$i]["id"];
        $articulo=$resultado[$i]["articulo"];
        $unidad=$resultado[$i]["unidad"];
        echo '  
             {
                "label" :"'.$articulo.'",
                "value" :
                    {
                        "id" : "'.$id.'",
                        "unidad" : "'.$unidad.'",
                        "art" : "'.$articulo.'"
                    }    
                    
             }
         ';

        if($i<count($resultado)-1)
        {
            echo ',';
        }
    }
        echo"]";
    ?>