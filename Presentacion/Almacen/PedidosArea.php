<?php   
    session_name("SGI");
    session_start();
    
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

    <title>Pedidos por Área</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- MetisMenu CSS -->
    <link href="../../bootstrap/bower_components/metisMenu/src/metisMenu.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">
  </head>

  <body>

    <div id="wrapper">
  
        <?php
        /*
         *  Define el Tipo de NavBar a Usar
        */
           require_once '../../Clases/clsNavbar.php';
           $objNavBar= new NavBar();
           $objNavBar->DefineNavBar();
        ?>

      <!-- Main component for a primary marketing message or call to action -->
             <div id="page-wrapper">
                 <br>
                <div class="panel panel-info">
                    <div class="panel-heading"><b>Listado de Pedidos</b></div
                        <div class="panel-body">
                            <div class="table-responsive table-hover">
                                <table class="table table-hover table-condensed">
                                  <thead>
                                    <tr>
                                        <th><p class="text-center">Artículo</p></th>
                                        <th><p class="text-center">Cantidad</p></th>
                                        <th><p class="text-center">Usuario</p></th>
                                        <th><p class="text-center">Area</p></th>
                                        <th><p class="text-center">Fecha</p></th>
                                        <th><p class="text-center">Estado</p></th>
                                    </tr>
                                  </thead>
                                  <tbody id="tbody">
                                  <?php 
                                  require_once '../../Clases/clsPedido.php';
                                  $objPed= new Pedido("","","");
                                  $objPed->ListarPedidosArea();
                                  ?>
                                  </tbody>
                          </table>
                    </div>
                </div>
        </div>

        </div>

    </div> <!-- /container -->


            <!--Modal Movimiento Entrada -->
            <form name="frmgrabar" id="frmgrabar" method="post" action="../Funciones/RegistraMovimientoEntrada.php">
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
            <form name="frmgrabar" id="frmgrabar" method="post" action="../Funciones/RegistraMovimientoSalida.php">
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
                 
            <!-- Modal Nuevo Artículo-->
                <form name="frmgrabarArticulo" id="frmgrabarArticulo" method="post" action="../Funciones/NuevoArticulo.php">
                        <div class="modal fade" id="NuevoArticulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4>Nuevo Artículo</h4>
                                </div>

                                <div class="modal-body">
                                        <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nombre Artículo">
                                        </div>
                                        <div class="form-group">
                                                <label for="unidad">Unidad</label>
                                                <input type="text" class="form-control" name="unidad" id="unidad" required placeholder="Unidad de medida">
                                        </div>
                                        <div class="form-group">
                                                <label for="cantidad">Cantidad</label>
                                                <input type="text" class="form-control" name="cantidad" id="cantidad" required placeholder="Cantidad">
                                        </div>
                                        <div class="form-group">
                                            <label for="cbtipo">Tipo</label>
                                            <select class="form-control" id="cbtipo" name="cbtipo">
    <!--                                            <option value="0">Seleccione Tipo</option>-->
                                                <?php 
                                                require_once '../../Clases/clsTipo.php';
                                                $objTipo = new TipoArticulo();
                                                $objTipo->SelectTipoArticulo();
                                                ?>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                                <label for="codigo">Código </label>
                                                <input type="text" class="form-control" name="codigo" id="codigo" required placeholder="codigo">
                                        </div>
                                        <div class="form-group">
                                                <label for="precio">Precio </label>
                                                <input type="text" class="form-control" name="precio" id="precio" required placeholder="Precio Unitario">
                                        </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                                    <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                              </div>

                            </div>
                          </div>
                        </div>
                </form>        
            <!-- /Modal Nuevo Artículo-->


    <!-- jQuery -->
    <script src="../../bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../bootstrap/dist/js/sb-admin-2.js"></script>    <script type="text/javascript">

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
            $.post("../Funciones/DatosArticulo.php", {id: id_})
                    .done(function(data) {
                        data = $.parseJSON(data);
                        $("#nombre").val(data.nombre);
                        $("#saldo").val(data.cantidad);
                        $("#id").val(data.id);
                    }, "json");                    
        }
    
       function leerDatosSalida(id_) 
        {
            $.post("../Funciones/DatosArticulo.php", {id: id_})
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
            var id = $("#cbTipo").val();
            $.post("../Funciones/MuestraArticulos.php",{id:id})
                    .done(function(data) {
                        $("#tbody").html(data);
                    });
         
        }

    </script>
 
</html>
