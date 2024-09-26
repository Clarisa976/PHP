<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 17</title>
</head>

<body>
    <?php
    echo "<h1>Familias</h1>";
    $familias["Los Simpsons"]["Padre"] = "Homer";
    $familias["Los Simpsons"]["Madre"] = "Marge";
    $familias["Los Simpsons"]["Hijo1"] = "Bart";
    $familias["Los Simpsons"]["Hijo2"] = "Lisa";
    $familias["Los Simpsons"]["Hijo3"] = "Maggie";

    $familias["Los Griffin"]["Padre"] = "Peter";
    $familias["Los Griffin"]["Madre"] = "Lois";
    $familias["Los Griffin"]["Hijo1"] = "Chris";
    $familias["Los Griffin"]["Hijo2"] = "Meg";
    $familias["Los Griffin"]["Hijo3"] = "Stewie";

    //muestra los valores de las dos familias en una lista no enumerada
    echo "<ul>";
    foreach ($familias as $familia => $miembros) {
        echo "<li>" . $familia; //mostramos la familia
        echo "<ul>";
        foreach ($miembros as $tipo => $nombre) {
            if (is_array($nombre)) {//si no es un array
                echo "<ul>";
                foreach ($nombre as $hijo => $nombre_crio) {
                    echo "<li>$hijo: $nombre_crio</li>";
                }
                echo "</ul></li>";
            } else {
                echo "<li>$tipo: $nombre</li>";
            }
        }
        echo "</ul>
    </li>";
    }
    echo "</ul>";
    ?>
</body>

</html>