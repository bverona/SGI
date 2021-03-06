<?php
session_name("SGI");
session_start();

if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
}
?>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Bruno Verona">

    <title>Gestión Compras</title>

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

    <!-- wrapper -->    
    <div id="wrapper">


        <!-- Nav Bar -->
        <?php
            require_once '../../Clases/clsNavbar.php';
            $obj= new NavBar();
            $obj->DefineNavBar();
        ?>
        <!-- Nav Bar -->

        <!-- page-wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sistema Gestor de Compras</h1>
                </div>
            </div>
            
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
                                500 bolsas Cemento azul tipo portland 
                            </p>
                            <p>
                                <b>Prioridad</b> Alta
                            </p>
                            <p>
                                <b>Obra:</b> Parque Urbanización Sanchez Cerro
                            </p>
                            <p>
                                <b>Días a Esperar</b> 02
                            </p>
                            <p>
                                <b>Horas a Esperar</b> 06 
                            </p>
                            
                            <p>
                                <a href="#" class="btn btn-outline btn-lg btn-primary" data-toggle="modal" data-target="#Proveedores">Cotizaciones</a>
                            </p>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->                    
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Modal Proveedor-->
            <form name="frmgrabarAlmacen" id="frmgrabarAlmacen" method="post" action="../../Funciones/NuevoAlmacen.php">
                <div class="modal fade" id="Proveedores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4>Proveedores</h4>
                            </div>

                            <div class="modal-body">
                                
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Proveedor</th>
                                            <th>Artículo</th>
                                            <th>Precio</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Inversones Falla</td>
                                            <td>Cemento azul tipo portland</td>
                                            <td>17.2</td>
                                            <td><a href="#" class="btn btn-outline btn-primary">Comprar</a></td>
                                        </tr>
                                        <tr>
                                            <td>Ferretería Tumi E.I.R.L</td>
                                            <td>Cemento azul tipo portland</td>
                                            <td>16.5</td>
                                            <td><a href="#" class="btn btn-outline btn-primary">Comprar</a></td>
                                        </tr>
                                        <tr>
                                            <td>Ferretería Marañon</td>
                                            <td>Cemento azul tipo portland</td>
                                            <td>17.5</td>
                                            <td><a href="#" class="btn btn-outline btn-primary">Comprar</a></td>
                                        </tr>
                                        <tr>
                                            <td>Ferretería Mi Jesus</td>
                                            <td>Cemento azul tipo portland</td>
                                            <td>16.8</td>
                                            <td><a href="#" class="btn btn-outline btn-primary">Comprar</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
    <!-- /Modal Proveedor-->    
    
    <!-- jQuery -->
    <script src="../../bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../bootstrap/dist/js/sb-admin-2.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <script type="text/javascript">
        var valorrb;

        $('#myModal').on('shown.bs.modal', function()
        {
            $('#nombre').focus();
        });

        function Verifica()
        {
            
            if($('#cbModulosNuevo').val()!=0)
            {
                $('#btnNuevoUsuario').prop("disabled",false);
            }else 
            {
                $('#btnNuevoUsuario').prop("disabled",true);
            }
        }

        function leerDatos(id_)
        {
            $.post("../../Funciones/BuscarUsuario.php", {id: id_})
                    .done(function(data) {
                        data = $.parseJSON(data);
                        $("#nombre").val(data.nombre);
                        $("#id").val(data.id);
                        if (data.idArea == '-' || data.idArea == '0')
                        {
                            //alert("almacen "+data.idAlmacen);
                            SelectAlmacen();

                            $("#antiguo").val(data.idAlmacen);
                            $("#cbModulos").val(data.idAlmacen);
                        } else
                        {
                            //alert("area "+data.idArea);
                            SelectArea();
                            $("#antiguo").val(data.idArea);
                            $("#cbModulos").val(data.idAlmacen);
                        }

                    }, "json");
        }

        function eliminar(p_dni)
        {

            if (confirm("Esta seguro de eliminar")) {
                $.post("../../Funciones/EliminaUsuario.php", {id_usu: p_dni})
                        .done(function(data) {
                            document.location.href = "ListarUsuarios.php";
                        });
            }

        }

        function SelectAlmacen()
        {
            $("#area").prop("checked", false);
            $("#almacen").prop("checked", true);
            $.post("../../Funciones/llenarSelect.php", {valor_Rb: 4})
                    .done(function(data) {
                        $("#cbModulos").html(data);
                        $("#cbModulos").val(valor);
                    });
        }

        function SelectArea()
        {
            $("#almacen").prop("checked", false);
            $("#area").prop("checked", true);
            $.post("../../Funciones/llenarSelect.php", {valor_Rb: 2})
                    .done(function(data) {
                        $("#cbModulos").html(data);
                        $("#cbModulos").val(valor);
                    });
        }


        function ValorArea() {
            valorrb = $('#area').val();
        }

        function ValorAlmacen() {
            valorrb = $('#almacen').val();
        }

        function LlenaSelect(val) {
            $.post("../../Funciones/llenarSelect.php", {valor_Rb: val})
                    .done(function(data) {

                        $("#cbModulos").html(data);
                    });
        }

        function LlenaSelectNuevo(val) {

            $.post("../../Funciones/llenarSelectNuevo.php", {valor_Rb: val})
                    .done(function(data) {

                        $("#cbModulosNuevo").html(data);
                    });
        }
</script>
</body>
</html>