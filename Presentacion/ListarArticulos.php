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

    <title>Listar Artículo</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="../bootstrap/css/Jumbotron.css" rel="stylesheet">

  </head>

  <body onload="LlenaTipo();Filtro();">

    <div class="container">

      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Navbar </span>
              <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
              <a class="navbar-brand" href="Almacen.php">Almacén General</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="#" data-toggle="modal" data-target="#NuevoArticulo">Nuevo Artículo</a></li>
              <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="../Presentacion/ListadoEntradas.php">Listar Pedidos de Área</a></li>
                        <li><a href="">Reporte 2</a></li>
                    </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['usuario'];?><span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="ActualizarDatos.php">Modificar Datos</a></li>
                    <li><a href="../Funciones/CerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>

          <!-- Main component for a primary marketing message or call to action -->
             <div class="container">
                <div class="panel panel-success">
                    <div class="panel-heading"><b>Listado de Artículos</b>
                        <div class="panel-body">
                            <div class="table-responsive table-hover">
                                <table class="table table-striped table-hover">
                                  <thead>
                                    <tr>
                                        <th colspan="2">Movimientos</th>
                                        <th>Artículo</th>
                                        <th>Unidad</th>
                                        <th>Cantidad</th>
                                        <th>
                                        <select class="form-control" id="cbTipo" name="cbTipo" onchange="Filtro();">
                                                <option value=0>Todos</option>
                                        </select>
                                        </th>
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


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
    <script src="../Jquery/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
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
    
        function LlenaTipo() {
            $.post("../Funciones/llenarTipo.php")
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
            $.post("../Funciones/MuestraArticulos.php",{id:id})
                    .done(function(data) {
                        $("#tbody").html(data);
                    });
         
        }

    </script>
</html>
