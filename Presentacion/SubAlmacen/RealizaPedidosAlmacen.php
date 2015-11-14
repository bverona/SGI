<?php   
    session_name("SGI");
    session_start();
    
    if ( (!isset($_SESSION["usuario"])) || ($_SESSION["permisos"]!=4)){
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

    <title>Realizar Pedidos</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- MetisMenu CSS -->
    <link href="../../bootstrap/bower_components/metisMenu/src/metisMenu.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

  </head>

  <body onload="llenarArticulo();" >

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
            <div class="row">
                <div class="col-xs-12 col-md-offset-2 col-md-6 col-lg-offset-2 col-lg-6">		
                    <form action="../../Funciones/InsertaPedidos.php" method="POST" role="form">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="cbtipo">Tipo Artículo</label>
                                <select class="form-control" id="cbtipo" name="cbtipo" onchange="llenarArticulo();"onload="Unidad();" >
                                    <?php
                                        require_once '../../Clases/clsTipo.php';
                                        $objTipo = new TipoArticulo();
                                        $objTipo->SelectTipoArticulo();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">                        
                            <div class="form-group">
                                <label for="cbarticulo">Artículo</label>

                                <select class="form-control" id="cbarticulo" name="cbarticulo" onchange="Unidad()" >

                                </select>
                            </div>    
                        </div>    
                        
                        <div class="form-group">
                            <div class="col-xs-8">
                                <label for="cantidad">Cantidad</label>
                                <input type="text" id="cantidad" data-toggle="tooltip" data-placement="bottom" title="Solo Números" name="cantidad" class="form-control">
                            </div>    
                            <div class="col-xs-4">
                                <label for="unidad">Unidad</label>
                                <input type="text" id="unidad" readonly name="unidad" class="form-control">
                            </div>    
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label for="Descripción del Pedido">Descripción del pedido</label>
                                <textarea type="textarea" id="comentario" name="comentario" rows="2" placeholder="Este campo es opcional" class="form-control"></textarea>
                            </div>    
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-12">    
                                <div class="col-xs-5">
                                <br>    
                                <button class="btn btn-primary" type="button" id="añade" value="Añadir Artículo" onclick="AñadePedido();">Añadir Articulo</button>
                                </div>
                                <div class="col-xs-offset-3 col-xs-2 ">    
                                <br>
                                <input type="button" class="btn btn-primary btn-success" onclick="EnviaPedido();"  value="Enviar Pedidos">
                                </div>
                                <input type="hidden" value="" name="arreglo" id="arreglo">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
      <br>
            <div class="row">
              <div class="table-responsive">          
                <div class="col-xs-12 col-md-offset-2 col-md-6 col-lg-offset-2 col-lg-6">
                    <table class="table table-striped table-condensed table-hover" id="tabla">
			<thead>
				<tr>
					<th>Tipo Artículo</th>
					<th>Artículo</th>
					<th>Cantidad</th>
				</tr>
			</thead>
			<tbody id="bodytabla">

			</tbody>
                    </table>

                </div>
              </div>
            </div>
      </div>


    </div> <!-- /container -->

    
    <!-- jQuery -->
    <script src="../../bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../bootstrap/dist/js/sb-admin-2.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <script type="text/javascript">

 
        var arreglo= new Array(); 

        $(document).ready(function (){
          $('#cantidad').tooltip();
          $('#cantidad').keyup(function (){
            this.value =(this.value + '').replace(/[^0-9]/,'');
            Unidad();
        });
        });
        
        function PedidoTabla(){
        var html ="<tr><td>"+$("#cbtipo option:selected").html()+"</td><td>"+$("#cbarticulo option:selected").html()+"</td><td>"+$("#cantidad").val()+"</td><td>"+$("#unidad").val()+"</td></tr>";
        $("#bodytabla").append(html);
            $("#cbtipo").val("");
            $("#cbarticulo").val("");
            $("#cantidad").val("");
            $("#comentario").val("");        
        };
        

        function EnviaPedido()
        {       
            $.post("../../Funciones/InsertaPedidosAlmacen.php",{arreglo:arreglo})
            .done(function(data)
            {
                $("#cbtipo").val("");
                $("#cbarticulo").val("");
                $("#cantidad").val("");
                $("#cantidad").val("");
                $("#comentario").val("");
                $("#bodytabla").html("");
                alert("Pedido Enviado");
                arreglo=new Array();
            });
        }
        
        
        function AñadePedido()
        {
          
            if(($("#cbtipo").val()===null))
            {
                $('#cbtipo').focus();
                $('#cbtipo').tooltip('show');                
            }
            else 
                if($("#cbarticulo").val()===null)
                {
                    $('#cbarticulo').focus();
                    $('#cbarticulo').tooltip('show');                
                }
                else 
                    if(($("#cantidad").val()==="")){
                        $('#cantidad').focus();
                        $('#cantidad').tooltip('show');
                    }
                    else 
                        if(isNaN($("#cantidad").val()))
                    {                                
                        $("#cantidad").val("");
                        $("#cantidad").focus();
                    }
                    else
                    {
                        arreglo.push([$("#cbarticulo").val(),$("#cantidad").val()]); //funciona
                        PedidoTabla();
                    }
            //alert(arreglo[arreglo.length-1][0]+" "+arreglo[arreglo.length-1][1]+" "+arreglo[arreglo.length-1][2]);
            
    }    
       
        function Unidad()
        {
            var id = $("#cbarticulo").val();
            $.post("../../Funciones/DatosArticulo.php",{id:id})
            .done(function(data)
            {
     
                data = $.parseJSON(data);
                $("#unidad").val(data.unidad)
            });
    
        }
        
        function llenarArticulo(){
        var tipoArticulo = $("#cbtipo").val();
        $("#cbarticulo").html("");
        
        $.post("../../Funciones/llenarArticulo.php",{tipo_articulo:tipoArticulo})
            .done(function( data ) {
                $("#cbarticulo").html(data);
                Unidad();
        });
            
        }
        
        
        
        
    </script>
  </body>
</html>
