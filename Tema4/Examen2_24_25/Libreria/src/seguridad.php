<?php

/// Control de Baneo

try
{
    $consulta="select * from usuarios where usuario=? AND clave=?";
    $sentencia=$conexion->prepare($consulta);
    $sentencia->execute([$_SESSION["usuario"],$_SESSION["clave"]]);
}
catch(PDOException $e)
{
    $sentencia=null;
    $conexion=null;
    session_destroy();
    die(error_page("Primer Login b","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
}

if($sentencia->rowCount()<=0)
{
    $sentencia=null;
    $conexion=null;
    session_unset();
    $_SESSION["seguridad"]="Usted ya no se encuentra registrado en la BD";
    header("Location:".$salto_seg);
    exit;
}

$datos_lector_log=$sentencia->fetchAll(PDO::FETCH_ASSOC);
$sentencia=null;


//He pasado el baneo 
//Ahora el control de tiempo

if(time()-$_SESSION["ultima_accion"]>INACTIVIDAD*60)
{
    session_unset();
    $_SESSION["seguridad"]="Su tiempo de sesión ha expirado";
    mysqli_close($conexion);
    header("Location:".$salto_seg);
    exit;
}

$_SESSION["ultima_accion"]=time();

?>