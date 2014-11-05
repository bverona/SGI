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

    <title>Listar Usuarios</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="../bootstrap/css/Jumbotron.css" rel="stylesheet">

  </head>

  <body onload="ValorArea();ValorAlmacen();LlenaSelect()">

    <div class="container">

      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
              <a class="navbar-brand" href="Gerente.php">Inicio</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="Usuarios.php">Nuevo Usuario</a></li>
            </ul>            
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['usuario'];?><span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="ActualizarDatos.php">Modificar Datos</a></li>
                    <li><a href="../Funciones/CerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
              </li>
              <li><a href="Reportes.php">Reportes</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>

      <!-- Componente para Mostrar los usuarios -->
      <div class="container">
          <div class="row">
            <div class="col-xs-12">
      <!-- Listar Usuarios-->         
        <?php
            require_once '../Clases/ClsUsuario.php';
            $objusuario = new Usuario();
                        
            $objusuario->ListarUsuarios();
        ?>
            </div>
          </div>
      </div>

      <form name="frmgrabar" id="frmgrabar" method="post" action="../Funciones/ActualizaDatos.php">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Editar Datos</h4>
                  </div>
                  <div class="modal-body">

                            <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nombre Usuario">
                            </div>
                            <div class="form-group">
                                    <label for="pass">Contraseña</label>
                                    <input type="password" class="form-control" name="pass" id="pass" required placeholder="Contraseña">
                            </div>
                            <div class="form-group" onclick="">
                            <label class="radio-inline">
                                <input type="radio" name="RadioInline" id="area"  onclick="ValorArea();LlenaSelect();"  value="2"> Área
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="RadioInline" id="almacen" value="4" onclick="ValorAlmacen();LlenaSelect();"> Almacén
                            </label>
                            </div>

                            <div class="form-group">
                                <select class="form-control" id="cbModulos" name="cbModulos">

                                </select>
                            </div>                                                            

                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-danger" aria-hidden="true">Aceptar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
      </form>    
      
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../Jquery/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        
        $('#myModal').on('shown.bs.modal', function () {
            $('#nombre').focus();
        });
    
        function leerDatosPersonal(p_dni){
        $.post( "../Funciones/BuscarUsuario.php", { id_usu: p_dni })
            .done(function( data ) {
                data = $.parseJSON(data);
                $("#nombre").val(data.nombre);
                $("#id").val(data.id);
                $("#select").val($("#cbModulos").val());
                (data.idAlmacen=='-')?Select(2,data.idArea):Select(4,data.idAlmacen);                
        },"json");
        
    }

        function eliminar(p_dni){

        if (confirm("Esta seguro de eliminar")){
                $.post( "../Funciones/EliminaUsuario.php", { id_usu: p_dni })
                .done(function( data ) {
                    alert(data);
                document.location.href="ListarUsuarios.php";
                });
            }
            
        }                

    </script>
 
    <script type="text/javascript">        
        var valorrb ;
        
        function ValorArea(){
        valorrb = $('#area').val();
        }        
        
        function ValorAlmacen(){
        valorrb = $('#almacen').val();
        }      
        function LlenaSelect(){
        $.post( "../Funciones/llenarSelect.php", { valor_Rb: valorrb})
        .done(function( data ) {
            $("#cbModulos").html(data);
        });
    }
        function Select(valor,id){
        //(valor===4)? $("#area").attr("checked":"true"):$("#almacen").attr("checked":"true");
        $.post( "../Funciones/llenarSelect.php", { valor_Rb: valor})
        .done(function( data ) {
            $("#cbModulos").html(data);
            $("#cbModulos").val(id);
        });
    }

    </script>

  </body>
</html>
