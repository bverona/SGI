<?php   
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }
    $almacen=($_SESSION["id_almacen"]);
    ?>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Bruno Verona">
    <link rel="icon" href="../Imagenes/logo muni motupe.png">

    <title>Movimientos Por Almacén</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- MetisMenu CSS -->
    <link href="../../bootstrap/bower_components/metisMenu/src/metisMenu.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">
  </head>

  <body onload="LlenaSelect();LlenaArticulo();Filtro();">

    <div id="wrapper">

        <?php
        /*
         *  Define el Tipo de NavBar a Usar
        */
           require_once '../../Clases/clsNavbar.php';
           $objNavBar= new NavBar();
           $objNavBar->DefineNavBar();
        ?>
        
             <div id="page-wrapper">
                <br>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">                            
                            <div class=" col-xs-12 ">
                                <div class="col-xs-12 col-sm-3">
                                    <br><b>Listado de Artículos</b>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <br>
                                    <select class="form-control" id="cbTipoArticulo" name="cbTipoArticulo" onchange="Filtro();">
                                    <option value="0">Todos Almacenes</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <br>
                                    <select class="form-control" id="cbArticulo" name="cbArticulo" onchange="Filtro();">
                                    <option value="0">Todos Articulo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
            </div>
                        <div class="panel-body">
                            <div class="table-responsive table-hover">
                                <table class="table table-striped table-hover">
                                  <thead>
                                    <tr>
                                        <th>Almacen</th>
                                        <th>Fecha</th>
                                        <th>Artículo</th>
                                        <th>Entrada</th>
                                        <th>Salida</th>
                                        <th>Saldo</th>
                                    </tr>
                                  </thead>
                                  <tbody id="tbody">
                                      
                                  </tbody>
                          </table>
                    </div>
                </div>

        </div>

        </div>
          <!-- /container -->
    </div>      
            <!--Modal Movimiento Entrada -->
            <form name="frmgrabar" id="frmgrabar" method="post" action="../../Funciones/RegistraMovimientoEntrada.php">
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
                                    <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nombre de Artículo">
                                </div>
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="text" class="form-control" name="cantidad" id="cantidad" required placeholder="Ingrese cantidad">
                                </div>
                                <input type="hidden" name="saldo" id="saldo" value="">
                                <input type="hidden" name="id" id="id" value="">
                                <input type="hidden" name="almacen" id="almacen" <?php echo 'value="'.$almacen.'"'?> >
                            </div>
                            <div class="modal-footer">
                                <button type="submit"  class="btn btn-danger " aria-hidden="true">Registrar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>    
            <!-- Fin Modal Movimiento Entrada-->
                    
            <!--Modal Movimiento Salida -->
            <form name="frmgrabar" id="frmgrabar" method="post" action="../../Funciones/RegistraMovimientoSalida.php">
                <div class="modal fade" id="ModalSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Movimiento Salida</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="nombresalida">Artículo</label>
                                    <input type="text" class="form-control" name="nombresalida" id="nombresalida" readonly>
                                </div>
                                <div class="form-group" onclick="">
                                    <label class="radio-inline">
                                        <input type="radio" name="RadioInline" id="area"  onclick="DefineSalida(1);"  value="1"> 
                                        Salida
                                    </label>
                                    <label class="radio-inline" required>
                                        <input type="radio" name="RadioInline" id="almacen" value="2" onclick="DefineSalida(2);"> 
                                        Transferencia
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="cantidadsalida">Cantidad</label>
                                    <input type="text" class="form-control" name="cantidadsalida" id="cantidadsalida" required>
                                </div>
                                <div class="form-group" id="divmodulos" hidden="true">
                                    <label>Almacen</label>
                                    <select class="form-control" id="cbModulos" name="cbModulos" >
                                        <?php 
                                            require_once '../../Clases/clsAlmacen.php';
                                            $objAlmacen= new Almacen();                                            
                                            $objAlmacen->ListarAlmacenOption();
                                        ?>
                                    </select>
                                </div>
                                <input type="hidden" name="saldosalida" id="saldosalida" value="">
                                <input type="hidden" name="idsalida" id="idsalida" value="">
                                <input type="hidden" name="almacensalida" id="almacensalida" <?php echo 'value="'.$almacen.'"'?> >

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger " aria-hidden="true">Aceptar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>    
            <!-- Fin Modal Movimiento Salida -->
          

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
            $.post("../../Funciones/DatosArticulo.php", {id: id_})
                    .done(function(data) {
                        data = $.parseJSON(data);
                        $("#nombre").val(data.nombre);
                        $("#saldo").val(data.cantidad);
                        $("#id").val(data.id);
                    }, "json");                    
        }
    
       function leerDatosSalida(id_) 
        {
            $.post("../../Funciones/DatosArticulo.php", {id: id_})
                    .done(function(data) {
                        data = $.parseJSON(data);
                        $("#nombresalida").val(data.nombre);
                        $("#saldosalida").val(data.cantidad);
                        $("#idsalida").val(data.id);
                    }, "json");                    
        }
    
        function LlenaSelect() {
            $.post("../../Funciones/llenarSelect.php",{valor_Rb:5})
                    .done(function(data) {
                         $("#cbTipoArticulo").append(data);
                    });
        }
        
        function LlenaArticulo() {
            $.post("../../Funciones/llenarArticulo.php",{tipo_articulo:0})
                    .done(function(data) {
                         $("#cbArticulo").append(data);
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
            var id = $("#cbTipoArticulo").val();
            var art = $("#cbArticulo").val();
            $.post("../../Funciones/MuestraMovimientos.php",{id:id,articulo:art})
                    .done(function(data) 
                    {
                        if(data=="")
                        {
                        $("#tbody").html(
                        "<label class='lead'>No Hay ningún Movimiento de este artículo </label>");
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
