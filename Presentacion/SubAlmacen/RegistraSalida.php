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

    <title>Registrar Salida</title>

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

        

    <div class="wrapper">
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
            <div class="panel-heading"><b>Listado de Artículos</b></div>
                <div class="panel-body panel-info">
                    <div class="table-responsive table-hover">
                        <table class="table table-condensed table-hover">
                          <thead>
                            <tr>
                                <th>Salida</th>
                                <th>Artículo</th>
                                <th>Unidad</th>
                                <th>Cantidad</th>
                                <th>Tipo</th>
                                <th>Almacén</th>
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
          <!-- /container -->


    <!--Modal Movimiento Salida 
    ../../Funciones/RegistraMovimientoSalida.php
    -->
    <form name="frmgrabar" id="frmgrabar" method="post" action="#">
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
                                <input type="radio" name="RadioInline" id="RadioInline"  onclick="DefineSalida(1);"  value="1"> 
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
                            <select class="form-control" id="cbModulos" name="almacenDestino" >
                                <?php 
                                    require_once '../../Clases/clsAlmacen.php';
                                    $objAlmacen= new Almacen();                                            
                                    $objAlmacen->ListarAlmacenOption();
                                ?>
                            </select>
                            <label>Descripción</label> 
                            <input type="text" class="form-control" name="descripcion" id="descripcion">                                
                        </div>
                        <input type="hidden" name="saldosalida" id="saldosalida" value="">
                        <input type="hidden" name="idsalida" id="idsalida" value="">
                        <input type="hidden" name="almacensalida" id="almacensalida" <?php echo 'value="'.$almacen.'"'?> >

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="ValidarDatos();" aria-hidden="true">Aceptar</button>
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
    
       function leerDatosSalida(articulo,almacen) {
        
            $.post("../../Funciones/DatosArticuloSubAlmacen.php", 
                {articulo:articulo, almacen:almacen})
                    .done(function(data) {
                        data = $.parseJSON(data);
                        $("#nombresalida").val(data.nombre);
                        $("#saldosalida").val(data.cantidad);
                        $("#idsalida").val(data.id);
                    }, "json");                    
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

        function LlenaAlmacen() {
            $.post("../../Funciones/llenarSelect.php",{valor_Rb:5})
                    .done(function(data) {
                         $("#cbAlmacen").append(data);
                    });        }

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
            $.post("../../Funciones/MuestraArticulos.php")
                    .done(function(data) 
            {

                if(data=="")
                {
                $("#tbody").html(
                "<label class='lead'>No Hay ningún artículo de este tipo en este almacen</label>");
                }
                else
                {
                    $("#tbody").html(data);
                }   

            });
         
        }

        function RegistrarDatosSalida()
        {
            $.post("../../Funciones/RegistraMovimientoSalida.php",
            {
                idsalida:$("#idsalida").val(),
                cantidadsalida:$("#cantidadsalida").val(),
                saldosalida:$("#saldosalida").val(),
                almacenOrigen:$("#almacensalida").val(),
                RadioInline:$("#RadioInline").val(),
                almacenDestino:$("#cbModulos").val(),
                descripcion:$("#descripcion").val()
                
            })
            .done(function(data) 
            {
                alert(data);    
                alert("Realizado Correctamente");
                location.reload();
            });
            
        }

        function ValidarDatos()
        {   
          
               if( parseInt($("#cantidadsalida").val())>parseInt($("#Saldo".concat($("#idsalida").val())).html()))
            {
                alert("No se puede sacar más de "+ $("#Saldo".concat($("#idsalida").val())).html());
                
                $("#cantidadsalida").val($("#Saldo".concat($("#idsalida").val())).html());
                $("#cantidadsalida").focus();
                
            }else
            {
                RegistrarDatosSalida();
            }
        }


    </script>
</html>
