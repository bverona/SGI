<?php
    if (isset($_COOKIE["usuario"])){
        $usuario = $_COOKIE["usuario"];
        echo $usuario ;
        
    }else{
        $usuario = "";
    }
?>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="SGI">
    <meta name="author" content="Bruno Verona">

    <title>SGI - Inicio Sesión</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap/css/signin.css" rel="stylesheet">
    
    <style>
    body {
    background-image: url(../Imagenes/fondo1.jpg) ;
    -webkit-background-size: cover;
    background-size: cover;
    }
        
    #login {
        
        background-color: rgba(0, 0, 0, 0.2);
        margin-top: 15%;
        border-radius: 10px;
    }
    </style>
   
    <!-- Custom styles for this template -->
  </head>
    <body>
        <div class="container">

            <form class="form-signin" id="login" role="form" action="../Funciones/login.php" method="post">
                <div class="text-center">
                    <img id="avatar" src="../Imagenes/usuario2.png" alt="avatar">
                </div>
                <input type="input" class="form-control" placeholder="Usuario" name="txtusuario" value="<?php echo $usuario; ?>" required autofocus>
                <p></p>
                <input type="password" class="form-control" placeholder="Contraseña" name="txtpass" required>
                <button class="btn btn-lg btn btn-default btn-block" type="submit">Ingresar</button>
            </form>

            
        </div>
    </body>


</html>
