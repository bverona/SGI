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
                                <meta HTTP-EQUIV="refresh" CONTENT="3; URL='.$direccion.'">
                                <meta charset="utf-8">
                                <link href="../bs/css/bootstrap.css" rel="stylesheet">
                                <link href="../bs/ico/favicon.ico" rel="shortcut icon">
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
        
        public static function generaPDF($file='', $html='', $paper='a4', $download=false) {
            require_once '../dompdf/dompdf_config.inc.php';
            
            $dompdf = new DOMPDF();
            $dompdf->set_paper($paper);
            $dompdf->load_html(utf8_encode($html));
            ini_set("memory_limit","32M");
            $dompdf->render();
            file_put_contents($file, $dompdf->output());
     
            if ($download){
                    $dompdf->stream($file);
            }
	}

    }
?>
