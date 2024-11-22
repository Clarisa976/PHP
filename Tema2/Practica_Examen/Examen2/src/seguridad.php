<?php
//conexión
try{
    @$conexion=mysqli_connect("SERVIDOR_BD","USUARIO_BD","CLAVE_BD","NOMBRE_BD");
    //cambiamos el charset
    mysqli_set_charset($conexion,"utf8");
}catch(Exception $e){
    //si no se ha podido conectar cerramos la sesión
    session_destroy();
    die("Examen2,<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>");
}
//si hay conexisón hace la consulta
try {
    $consulta="select * from usuarios";
    $datos= mysqli_query($conexion, $consulta);
} catch(Exception $e){
    //cerramos la sesión
    mysqli_close($conexion);
    session_destroy();
    die("Examen2,<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>");
}

?>