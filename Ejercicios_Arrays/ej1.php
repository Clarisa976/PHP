<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 1 de arrays</title>
</head>

<body>
    <?php
    /*Almacena en un array los 10 primeros números pares.
    Imprímelos cada uno en una línea*/

    //formas de hacer una constante:
    define("N_PARES", 10); //hay que darle el nombre y el valor para la consante
    //const N_PARES = 30;

    echo "<h1>Los" . N_PARES . "primeros números pares</h1>";
    for ($i = 0; $i < N_PARES; $i++)
        $pares[] = $i * 2;

    //se podría hacer del tirón
    for ($i = 0; $i < N_PARES; $i++)
        echo "<p>" . $pares[$i] . "</p>";
    ?>
</body>

</html>