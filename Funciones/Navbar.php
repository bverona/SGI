<?php    
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }
    class NavBar{

        public function DefineNavBar() {

       if($_SESSION["permisos"]==8) {
       echo ' 
       <!-- Static navbar Gerente -->
         <div class="navbar navbar-default" role="navigation">
           <div class="container-fluid">
             <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                 <span class="sr-only">Toggle navigation</span>
                 <span class="glyphicon glyphicon-chevron-down"></span>
               </button>
                 <a class="navbar-brand" href="Gerente.php">Gestión de Módulos</a>
             </div>
             <div class="navbar-collapse collapse">
               <ul class="nav navbar-nav">
                 <li><a href="Usuarios.php">Usuarios</a></li>
                 <li><a href="#">Reportes</a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
                 <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown">'. $_SESSION["usuario" ].'<span class="caret"></span></a>
                   <ul class="dropdown-menu" role="menu">
                     <li><a href="#">Modificar Datos</a></li>
                     <li><a href="../Funciones/cerrarSesion.php">Cerrar Sesión</a></li>
                   </ul>
                 </li>
               </ul>
             </div><!--/.nav-collapse -->
           </div><!--/.container-fluid -->
         </div>

               ';
       }        
       else 
           if($_SESSION["permisos"]==5)
           {
            echo'  
      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">NavBar</span>
              <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
            <a class="navbar-brand" href="../Presentacion/Almacen.php">Almacén General</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Artículos<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#" data-toggle="modal" data-target="#NuevoArticulo">Nuevo Artículo</a></li>
                    <li><a href="ListarArticulos.php">Listar Artículos</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$_SESSION['usuario'].'<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="ActualizarDatos.php">Modificar Datos</a></li>
                    <li><a href="../Funciones/cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
      <!--/Static navbar -->

                ';
           }
           else 
           {
               echo '
       <!--navbar area-->
         <div class="navbar navbar-default" role="navigation">
           <div class="container-fluid">
             <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                 <span class="sr-only"></span>
                 <span class="glyphicon glyphicon-chevron-down"></span>
               </button>
                 <a type="button" class="navbar-brand btn btn-default" href="RealizarPedidos.php">Realizar Pedido</a>
             </div>
             <div class="navbar-collapse collapse">
               <ul class="nav navbar-nav navbar-right">
                   <li class="navbar-brand">'.date('d/m/Y').'</li>
                   <li class="dropdown">                
                   <a href="#" class="dropdown-toggle " data-toggle="dropdown">'. $_SESSION['usuario'].'<span class="caret"></span></a>
                   <ul class="dropdown-menu" role="menu">
                       <li><a href="ActualizarDatos.php">Modificar Datos</a></li>
                       <li><a href="../Funciones/CerrarSesion.php">Cerrar Sesión</a></li>
                   </ul>
                 </li>
               </ul>
             </div><!--/.nav-collapse -->
           </div><!--/.container-fluid -->
         </div>

                   ';

           }
   }
    }
?>