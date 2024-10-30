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
    $familia = [
        "Los Simpson" => [
            "Padre" => "Homer",
            "Madre" => "Marge",
            "Hijos" =>
            [
                "Hijo1" => "Bart",
                "Hijo2" => "Lisa",
                "Hijo3" => "Maggie"
            ]
        ],
        "Los Griffing" => [
            "Padre" => "Peter",
            "Madre" => "Lois",
            "Hijos" =>
            [
                "Hijo1" => "Chris",
                "Hijo2" => "Meg",
                "Hijo3" => "Stewie"
            ]
        ]
    ];
    echo "<ul>";

    foreach ($familia as $familia_miembros => $miembros) {
        echo "<li>" . $familia_miembros . "<ul>";

        foreach ($miembros as $parentesco => $nombre_padres) {

            if (is_array($nombre_padres)) { //verificamos si es un array
                echo "<li>" . $parentesco . ": <ul>";
                foreach ($nombre_padres as $hijo => $nombre_hijo) {
                    echo "<li>" . $hijo . ": " . $nombre_hijo . "</li>";
                }
                echo "</ul>";
                echo "</li>";
            } else {
                //sino el resto
                echo "<li>" . $parentesco . ": " . $nombre_padres . "</li>";
            }
        }

        echo "</ul>";
        echo "</li>";
    }

    echo "</ul>";
    ?>
</body>

</html>