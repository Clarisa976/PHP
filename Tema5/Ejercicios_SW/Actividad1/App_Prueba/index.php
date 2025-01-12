<?php
function consumir_servicios_REST($url, $metodo, $datos = null)
{
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
define("DIR_SERV", "http://localhost/Proyectos/PHP/Tema5/Ejercicios_SW/Actividad1/servicios_rest");

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de los servicios de la Actividad1</title>
</head>

<body>
    <h1>Productos de la tienda</h1>
    <?php
    $datos["codigo"] = "ABCDEFG";
    $datos["nombre"] = "nose";
    $datos["nombre_corto"] = "ns";
    $datos["descripcion"] = "fdsafafafa";
    $datos["PVP"] = 3.4;
    $datos["familia"] = "Consolas";

    $url1 = DIR_SERV . "/producto/insertar";
    $respuesta = consumir_servicios_REST($url1, "POST", $datos);
    $obj = json_decode($respuesta);
    if (!$obj)
        die("<p>Error consumiendo el servicio: " . $url1 . "</p>" . $respuesta);

    if (isset($obj->error))
        die("<p>" . $obj->error . "</p></body></html>");

    echo "<p>" . $obj->mensaje . "</p>";


    $url = DIR_SERV . "/productos";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta, true);
    if (!$obj) {
        die("<p>Error consumiendo el servicio web <strong>" . $url . "</strong></p></body></html>");
    }
    if (isset($obj["error"])) {
        die("<p>" . $obj["error"] . "</p></body></html>");
    }
    //si hay productos los mostramos en una tabla
    echo "<table>";
    echo "<tr><th>Código</th><th>Nombre corto</th><th>Precio</th></tr>";
    foreach ($obj["productos"] as $tupla) {
        echo "<tr>";
        echo "<td>" . $tupla["cod"] . "</td>";
        echo "<td>" . $tupla["nombre_corto"] . "</td>";
        echo "<td>" . $tupla["PVP"] . "</td>";
        echo "</tr>";
        /*
             foreach ($obj->productos as $tupla) {
            echo "<tr>";
            echo "<td>".$tupla->cod."</td>";
            echo "<td>".$tupla->nombre_corto."</td>";
            echo "<td>".$tupla->PVP."</td>";
            echo "</tr>";
            */
    }
    echo "</table>";
    ?>
</body>

</html>