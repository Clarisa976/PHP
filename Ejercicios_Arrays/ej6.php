<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>

<body>
    <?php
    $ciudades[] = "Madrid";
    $ciudades[] = "Barcelona";
    $ciudades[] = "Londres";
    $ciudades[] = "New York";
    $ciudades[] = "Los Ángeles";
    $ciudades[] = "Chicago";

    echo "<h1> Ciuades</h1>";
    for ($i = 0; $i < count($ciudades); $i++)
        echo "<p>La ciudad con el índice " . $i . " tiene el nombre " . $ciudades[$i] . "</p>";
    ?>
</body>

</html>