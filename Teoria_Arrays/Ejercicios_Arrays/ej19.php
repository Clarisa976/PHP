<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 19</title>
</head>

<body>
    <?php

    $amigos = [
        "Madrid" => [
            [
                "Nombre" => "Pedro",
                "Edad" => 32,
                "Teléfono" => "99-999.99.99"
            ],
            [
                "Nombre" => "Juan",
                "Edad" => 29,
                "Teléfono" => "99-888.88.88"
            ]
        ],
        "Barcelona" => [
            [
                "Nombre" => "Susana",
                "Edad" => 34,
                "Teléfono" => "93-000.00.00"
            ],
            [
                "Nombre" => "Víctorkun",
                "Edad" => 300,
                "Teléfono" => "93-111.11.11"
            ]
        ],
        "Toledo" => [
            [
                "Nombre" => "Sonia",
                "Edad" => 42,
                "Teléfono" => "925-09.09.09"
            ],
            [
                "Nombre" => "Samuchan",
                "Edad" => 33,
                "Teléfono" => "925-10.10.10"
            ]
        ]
    ];

    //haz un recorrido del array multidimensional mostrando los valores
    //de tal manera que nos muestre en cada ciudad qué amigos tiene
    foreach ($amigos as $ciudad => $personas_en_ciudad) {
        echo "<p>Amigos en ".$ciudad."</p>";
        echo "<ul>";
            foreach ($personas_en_ciudad as $persona => $datos) {
                echo "<li>";
                foreach ($datos as $key => $value) {
                    echo "<span>".$key.": ".$value.". </span>";
                }
                echo "</li>";
            }
        echo "</ul>";
    }
    ?>
</body>

</html>