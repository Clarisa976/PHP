<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación Web (uso de API)</title>
</head>

<body>
    <h1>Aplicación para usar/probar mi primera API</h1>
    <?php
    function consumir_servicios_REST($url, $metodo, $datos = null){
        $llamada = curl_init();
        curl_setopt($llamada, CURLOPT_URL, $url);
        curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
        if (isset($datos))
            curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
        $respuesta = curl_exec($llamada);
        curl_close($llamada);
        return $respuesta;
    }
    //declaramos el enlace
    define("DIR_SERV", "http://localhost/Proyectos/PHP/Tema5/Teoria_SW/API");
    //método get simple
    $url = DIR_SERV . "/saludo";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);
    if (!$obj)
        die("<p>Error consumiendo el servicio: " . $url . "<p></body></html>");

    echo "<p>El mensaje recibido tras llamar al servicio web: <strong>'" . $url . "'</strong> ha sido: " . $obj->mensaje . "</p>";

    //método get con el nombre en un urlencode por si queremos poner nombres con tildes y demás
    $url = DIR_SERV . "/saludo/" . urlencode("María del Carmen");
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);
    if (!$obj)
        die("<p>Error consumiendo el servicio: " . $url . "<p></body></html>");

    echo "<p>El mensaje recibido tras llamar al servicio web: <strong>'" . $url . "'</strong> ha sido: " . $obj->mensaje . "</p>";

    //método post con los datos enviados
    $url = DIR_SERV . "/saludo";
    $datos_env["nombre"] = "María del Carmen";
    $respuesta = consumir_servicios_REST($url, "POST", $datos_env);
    $obj = json_decode($respuesta);
    if (!$obj)
        die("<p>Error consumiendo el servicio: " . $url . "<p></body></html>");

    echo "<p>El mensaje recibido tras llamar al servicio web: <strong>'" . $url . "'</strong> ha sido: " . $obj->mensaje . "</p>";
    
    //método para borrar con un id
    $url = DIR_SERV . "/borrar_saludo/3";
    $respuesta = consumir_servicios_REST($url, "DELETE");
    $obj = json_decode($respuesta);
    if (!$obj)
        die("<p>Error consumiendo el servicio: " . $url . "<p></body></html>");

    echo "<p>El mensaje recibido tras llamar al servicio web: <strong>'" . $url . "'</strong> ha sido: " . $obj->mensaje . "</p>";

    //método para cambiar un saludo con id con put y cambiando los datos enviados
    $url = DIR_SERV . "/cambiar_saludo/5";
    $datos_env["nombre"] = "Carmencita";
    $respuesta = consumir_servicios_REST($url, "PUT", $datos_env);
    $obj = json_decode($respuesta);
    if (!$obj)
        die("<p>Error consumiendo el servicio: " . $url . "<p></body></html>");

    echo "<p>El mensaje recibido tras llamar al servicio web: <strong>'" . $url . "'</strong> ha sido: " . $obj->mensaje . "</p>";






    ?>
</body>

</html>