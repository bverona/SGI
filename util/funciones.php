<?php
    class Funciones {

        static function mensaje($texto, $direccion, $tipo){
            
            switch ($tipo) {
                case 's': //satisfactorio
                        $tipoMensaje = "alert alert-success";
                        $preMensaje = "¡Bien hecho!";
                    break;
                
                case 'i': //informacion
                        $tipoMensaje = "alert alert-info";
                        $preMensaje = "¡Atento!";
                    break;
                
                case 'a': //advertencia  - alerta
                        $tipoMensaje = "alert alert-warning";
                        $preMensaje = "¡Cuidado!";
                    break;
                
                case 'e': //error
                        $tipoMensaje = "alert alert-danger";
                        $preMensaje = "¡Error!";
                    break;
                
                default:
                        $tipoMensaje = "alert alert-info";
                        $preMensaje = "¡Atento!";
                    break;
            }
                            
            $mensaje = '
                        <html>
                            <head>
                                <title>Mensaje del sistema</title>
                                <meta HTTP-EQUIV="refresh" CONTENT="5; URL='.$direccion.'">
                                <meta charset="utf-8">
                                <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
                            </head>
                            <body>
                                 <div class="'.$tipoMensaje.'">
                                     '.$texto.' 
                                     <a href="'.$direccion.'" class="alert-link">&nbsp;Regresar</a>
                                 </div>
                            </body>
                        </html>
                ';
            
            echo $mensaje;
        }
    
        

        
    }
?>
