<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 13</title>
</head>
<body>
    <?php
        echo "<h1>Rejuntar y hacerlo reverse </h1>";
        $animales = array("Lagartija", "Araña", "Perro", "Gato", "Ratón");
        $numeros = array("12", "34", "45", "52", "12");
        $varios = array("Sauce", "Pino", "Naranjo", "Chopo", "Perro", "34");
        $rejuntado = array();

        array_push($rejuntado, $animales);
        array_push($rejuntado, $numeros);
        array_push($rejuntado, $varios);

        print_r(array_reverse($rejuntado));
    ?>
</body>
</html>