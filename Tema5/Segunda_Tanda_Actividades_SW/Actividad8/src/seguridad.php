<?php
$url=DIR_SERV."/logueado";
$headers[]="Authorization: Bearer ".$_SESSION["token"];
$respuesta=consumir_servicios_JWT_REST($url,"GET",$headers);
$json_login=json_encode($respuesta,true);
//si no hay respuesta 
if (!$json_login) {
    session_destroy();
    die(error_page("Actividad8","<p>Error consumiendo el Servicio Web: <strong>".$url."</strong></p>"));
}
//si no está autorizado porque se le ha pasado el tiempo
if (isset($json_login["no_auth"])) {
    session_unset();
    $_SESSION["mensaje_seguridad"]="El tiempo de sesión de la API ha caducado";
    header("Location: index.php");
    exit;
}
//si hay mensaje de error
if (isset($json_login["error"])) {
    session_destroy();
    die(error_page("Actividad8","<p>".$json_login["error"]."</p>"));
}
//si está baneado
if (isset($json_login["mensaje_baneo"])) {
    session_unset();
    $_SESSION["mensaje_seguridad"]="Usted ya no se encuentra en la BD";
    header("Location: index.php");
    exit;
}
//si todo va bien dejamos la conexión abierta y guardamos los datos del usuario y el token
$datos_usuario_log=$json_login["usuario"];
$_SESSION["token"]=$json_login["token"];

//inactividad
if (time()-$_SESSION["ultm_accion"]>INACTIVIDAD*60) {
    session_unset();
    $_SESSION["mensaje_seguridad"]="Su tiempo de sesión ha expirado";
    header("Location: index.php");
    exit;
}
?>