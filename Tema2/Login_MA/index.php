<?php
session_name("PLogin");
session_start();
require "src/funciones_ctes.php";

if(isset($_POST["btnCerrarSession"]))
{
    session_destroy();
    header("Location:index.php");
    exit;
}

if(isset($_SESSION["usuario"]))
{
    //Control de baneo  
    //consulta a la BD y si está inicio sesión y salto a index
    require "src/seguridad.php";

    // Muestro vista después de Login
    if($datos_usuario_log["tipo"]=="normal"){
        require "vistas/vista_normal.php";
    }else{
        require "vistas/vista_admin.php";

    }
    
    mysqli_close($conexion);
}
else
{
    require "vistas/vista_login.php";
}


