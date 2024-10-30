<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>

<body>
    <?php
    $ciudades["MD"] = "Madrid";
    $ciudades["B"] = "Barcelona";
    $ciudades["LDN"] = "Londres";
    $ciudades["NY"] = "New York";
    $ciudades["LA"] = "Los Ángeles";
    $ciudades["CG"] = "Chicago";

    echo "<h1> Ciuades</h1>";
    foreach ($ciudades as $indice => $valor)
        echo "<p> El índice del array que contiene como valor " . $valor . " es " . $indice . "</p>";
    ?>
</body>

</html>