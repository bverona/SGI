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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SGI">
    <meta name="author" content="Bruno Verona">

    <title>Plantilla</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../bootstrap/bower_components/metisMenu/src/metisMenu.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../../bootstrap/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../bootstrap/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../../bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<body>
 
    <div id="wrapper">


        <!-- Nav Bar -->
        <?php
            require_once '../../Clases/clsNavbar2.php';
            $obj= new NavBar2();
            $obj->DefineNavBar();
        ?>
        <!-- Nav Bar -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sistema Gestor de Compras</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->     
            
            <div class="row">

                <div class="col-xs-12 col-lg-offset-2 col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-envelope-o fa-fw"></i> Solicitudes de Compra
                                                        
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">
                            <p>
                                <b>Requiere:</b>
                            </p>
                            <p>
                                10 tn Piedra chancada de 1/2
                            </p>
                            <p>
                                <b>Prioridad</b> Alta
                            </p>
                            <p>
                                <b>Obra:</b> Pavimientación calle El Carmen
                            </p>
                            <p>
                                <b>Días a Esperar</b> 03
                            </p>
                            <p>
                                <b>Horas a Esperar</b> 04 
                            </p>
                            
                            <p>
                                <a href="#" class="btn btn-outline btn-lg btn-primary" data-toggle="modal" data-target="#Proveedores">Cotizaciones</a>
                            </p>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->                    
                </div>
                <!-- /.col-lg-8 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

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
                                    require_once '../Clases/clsAlmacen.php';
                                    $objAlmacen= new Almacen();                                            
                                    $objAlmacen->ListarAlmacenSinFiltro();
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
    <form name="frmgrabarArticulo" id="frmgrabarArticulo" method="post" action="../../Funciones/NuevoArticulo.php">
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
                                        require_once '../Clases/clsTipo.php';
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
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">

    $('#NuevoArticulo').on('shown.bs.modal', function () {
        $('#nombre').focus();
    });
    // solo números
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
    
        function LlenaTipo() {
            $.post("../../Funciones/llenarTipo.php")
                    .done(function(data) {
                         $("#cbTipo").append(data);
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
            $.post("../../Funciones/MuestraArticulos.php",{id:id})
                    .done(function(data) {
                        $("#tbody").html(data);
                    });
         
        }

    </script>
  </body>
</html>
