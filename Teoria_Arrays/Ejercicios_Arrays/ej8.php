<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
</head>
<body>
<?php
        $personas[]="Pedro";
        $personas[]="Ismael";
        $personas[]="Sonia";
        $personas[]="Clara";
        $personas[]="Susana";
        $personas[]="Alfonso";
        $personas[]="Teresa";

        echo "<h1> El array tiene ".count($personas)." elementos</h1>";
        echo "<ul>";
        foreach ($personas as $key) {
            echo "<li>".$key."</li>";
        }
        echo "</ul>";
    ?>
</body>
</html>