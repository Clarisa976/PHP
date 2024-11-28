<?php
session_name("P10B");
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
        //header("Location: usuario/index.php");
    
        require "usuario/index.php";
    }else{
        mysqli_close($conexion);
        header("Location: admin/index.php");
        exit;
        //require "admin/index.php";

    }
   
}else{
    require "vistas/vista_login.php";
}

 

?>