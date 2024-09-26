<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>

<body>
   
    <?php
    /*Crea un array asociativa para introducir los datos de una persona. Al acabar muestralos por pantalla */
    $persona["nombre"] = "Pedro Torres";
    $persona["direccion"] = "C/ Mayor 37";
    $persona["telefono"] = 952635898;
    echo "<h1> Datos de la persona </h1>";
    foreach ($persona as $indice => $valor)
        echo "<p>" . $indice . " - " . $valor . "</p>";

    ?>
</body>

</html>