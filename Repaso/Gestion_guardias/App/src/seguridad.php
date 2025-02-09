<?php

$url=DIR_SERV."/logueado";
$headers[] = 'Authorization: Bearer '.$_SESSION["token"];
$respuesta=consumir_servicios_JWT_REST($url,"GET",$headers);
$json=json_decode($respuesta,true);
if(!$json)
{
    session_destroy();
    die(error_page("Examen","<h1>Notas de los alumnos</h1><p>Sin respuesta oportuna de la API</p>"));  
}
if(isset($json["error"]))
{
    session_destroy();
    die(error_page("Examen","<h1>Notas de los alumnos</h1><p>".$json["error"]."</p>"));
}

if(isset($json["no_auth"]))
{
   session_unset();
   $_SESSION["seguridad"]="Usted ha dejado de tener acceso a la API. Por favor vuelva a loguearse.";
   header("Location:".$salto);
   exit();
}

if(isset($json["mensaje"]))
{
   session_unset();
   $_SESSION["seguridad"]="Usted ya no se encuentra registrado en la BD";
   header("Location:".$salto);
   exit();
}

// He pasado el control de baneo
// Dejo la conexión abierta y aprovecho para coger datos del usuario logueado

$datos_usuario_log=$json["usuario"];
$_SESSION["token"]=$json["token"];



//Ahora paso el control de tiempo

if(time()-$_SESSION["ult_accion"]>INACTIVIDAD*60)
{
   session_unset();
   $_SESSION["mensaje_seguridad"]="Su tiempo de sesión ha expirado. Por favor, vuelva a loguearse";
    header("Location:index.php");
    exit;
}
// Paso el control de tiempo y lo renuevo
$_SESSION["ult_accion"]=time();
?>
