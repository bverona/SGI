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
                                <meta HTTP-EQUIV="refresh" CONTENT="4; URL='.$direccion.'">
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
        static function mensaje2($texto, $direccion, $tipo){
            
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
                                <meta HTTP-EQUIV="refresh" CONTENT="3; URL='.$direccion.'">
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

        static function Modal($texto,  $tipo){
            
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
                                <meta HTTP-EQUIV="refresh" CONTENT="3; URL='.$direccion.'">
                                <meta charset="utf-8">
                                <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
                            </head>
                            <body>
                            <div class="modal fade" id="miventana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                            <div class="modal-content">

                                                    <div class="modal-header">
                                                            <h4>Aviso</h4>
                                                    </div>

                                                    <div class="modal-body">
                                                    
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger btn-primary">Crear Almacén</button>
                                                        <button class="btn btn-danger btn-primary" data-dismiss="modal">Cerrar</button>
                                                    </div>

                                            </div>
                                    </div>
                            </div>
                            </body>
                        </html>
                ';
            
            echo $mensaje;
        }
        
    }
?>
