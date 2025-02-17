<?php
$url = DIR_SERV . "/logueado";
$datos_env["usuario"] = $_SESSION["usuario"];
$datos_env["clave"] = $_SESSION["clave"];
$header[] = 'Autorization: Bearer ' . $_SESSION["token"];//los espacios son importantes
$respuesta = consumir_servicios_REST_Login_protec($url, "GET", $header);
$json_login = json_decode($respuesta, true);
if (!$json_login) {
    session_destroy();
    die(error_page("Examen3_24_25", "<p>Error consumiendo el Servicio Web: <strong>" . $url . "</strong></p>"));
}

if (isset($json_login["no_auth"])) {
    session_unset();
    $_SESSION["mensaje_seguridad"] = "El tiempo de sesión de la API ha caducado";
    header("Location:index.php");
    exit;
}

if (isset($json_login["error"])) {
    session_destroy();
    die(error_page("Examen3_24_25", "<p>" . $json_login["error"] . "</p>"));
}


if (isset($json_login["mensaje"])) {
    session_unset(); //Me deslogueo
    $_SESSION["mensaje_seguridad"] = "Usted ya no se encuentra registrado en la BD";
    header("Location:index.php");
    exit;
}


// He pasado el control de baneo
// Dejo la conexión abierta y aprovecho para coger datos del usuario logueado

$datos_usuario_log = $json_login["usuario"];
$_SESSION["token"] = $json_login["token"];


// Ahora controlo el tiempo de inactividad

if (time() - $_SESSION["ultm_accion"] > INACTIVIDAD * 60) {
    session_unset(); //Me deslogueo
    $_SESSION["mensaje_seguridad"] = "Su tiempo de sesión ha expirado. Por favor, vuelva a loguearse";
    header("Location:index.php");
    exit;
}

$_SESSION["ultm_accion"] = time();
