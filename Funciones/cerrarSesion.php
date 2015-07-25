<?php

    session_name("SGI");
    session_start();
    
    unset($_SESSION["usuario"]);
    unset($_SESSION["permisos"]);

    session_destroy();
    
    
    header("location:../index.php");

?>
