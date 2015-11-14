<?php   
    session_name("SGI");
    session_start();
    
    $almacen=$_SESSION["id_almacen"];
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }
?>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Bruno Verona">
    <link rel="icon" href="../Imagenes/logo muni motupe.png">

    <title>Registrar Entrada</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- MetisMenu CSS -->
    <link href="../../bootstrap/bower_components/metisMenu/src/metisMenu.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

  </head>

  <body onload="Filtro();">

    <div id="wrapper">

        <?php
        /*
         *  Define el Tipo de NavBar a Usar
        */
           require_once '../../Clases/clsNavbar.php';
           $objNavBar= new NavBar();
           $objNavBar->DefineNavBar();
        ?>
        
          <!-- Container -->
        <div id="page-wrapper">
            <br>
            <div class="panel panel-info">
                <div class="panel-heading"><b>Listado de Artículos</b></div>
                    <div class="panel-body panel-info">
                        <div class="table-responsive ">
                            <table class="table table-hover table-condensed">
                              <thead>
                                <tr>
                                    <th>Entrada</th>
                                    <th>Artículo</th>
                                    <th>Unidad</th>
                                    <th>Codigo</th>
                                    <th>Tipo</th>
                                </tr>
                              </thead>
                              <tbody id="tbody">

                              </tbody>
                            </table>
                        </div>
                    </div>
                
            </div>
        </div>

    </div> 

             <!--Modal Movimiento Entrada -->
            <form name="frmgrabar" id="frmgrabar" method="post" action="#">
                <div class="modal fade" id="ModalEntrada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Movimiento Entrada </h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="nombre">Artículo</label>
                                    <input type="text" class="form-control" name="nombreEntrada" id="nombreEntrada" readonly required placeholder="Nombre de Artículo">
                                </div>
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="text" class="form-control" name="cantidadentrada" id="cantidadentrada" required placeholder="Ingrese cantidad">
                                </div>
                                    <label>Descripción</label> 
                                    <input type="text" class="form-control" name="descripcion" id="descripcion">                                
                                <input type="hidden" name="id" id="id" value="">
                                <input type="hidden" name="almacen" id="almacen" <?php echo 'value="'.$almacen.'"'?> >
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-danger" onclick="RegistrarDatosEntrada()" aria-hidden="true">Registrar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>    
            <!-- Fin Modal Movimiento Entrada-->

    <!-- jQuery -->
    <script src="../../bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../bootstrap/dist/js/sb-admin-2.js"></script>


    <script type="text/javascript">

    $('#NuevoArticulo').on('shown.bs.modal', function () {
        $('#nombre').focus();
    });

    $(document).ready(function (){        
          $('#cantidad').keyup(function (){
            this.value =(this.value + '').replace(/[^0-9]/,'');
           
            });
          $('#cantidadsalida').keyup(function (){
            this.value =(this.value + '').replace(/[^0-9]/,'');
           
            });
     });

       function leerDatosEntrada(id_)
        {
            $.post("../../Funciones/DatosArticulo.php", {id:id_})
                    .done(function(data) {
                        data = $.parseJSON(data);
                        $("#nombreEntrada").val(data.nombre);
                        $("#id").val(data.id);
                    }, "json");
        }
    
         function RegistrarDatosEntrada()
        {
                alert($("#cantidadentrada").val());
            $.post("../../Funciones/RegistraMovimientoEntrada.php",
            {
                id:$("#id").val(),
                cantidad:$("#cantidadentrada").val(),
                descripcion:$("#descripcion").val(),
                almacen:$("#almacen").val()
                
            })
            .done(function(data) 
            {
                alert("Realizado Correctamente");
                location.reload();
            });            
        }
 
        //llena el textarea #codigo con el POSIBLE código a generar
       function PosibleCodigo(){
            $.post("../../Funciones/PosibleId.php")
                    .done(function (data){
                        $("#codigo").val(data);
            });
        }

        function RegistraTipo()
        {
            var nombre = $("#nombreTipo").val();
            $.post("../../Funciones/nuevoTipo.php",{nombre:nombre})
                    .done(function(data){
                        LlenaTipo();
                    });
        }

        function LlenaTipo() {
            $.post("../../Funciones/llenarTipo.php")
                    .done(function(data) {
                         $("#cbTipo").html("");
                         $("#cbTipo").append('<option value="0">Seleccione tipo</option>');
                         $("#cbTipo").append(data);
                         $("#nombreTipo").val("");
                    });
        }

        function DefineSalida(val)
        {

            if (val===2)
            {
                $("#divmodulos").prop("hidden",false);
            }else
                {
                    $("#divmodulos").prop("hidden",true);
                }
                
        }

        function Filtro()
        {
            $.post("../../Funciones/MuestraTodosArticulos.php")
                    .done(function(data) 
            {   
                if(data=="")
                {
                $("#tbody").html(
                "<label class='lead'>No Hay ningún artículo, por favor registre lo artículos</label>");
                }
                else
                {
                    $("#tbody").html(data);
                }   

            });
         
        }

    </script>
  </body>
</html>
