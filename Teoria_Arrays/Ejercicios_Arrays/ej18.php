<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 18</title>
</head>

<body>
    <?php
    echo "<h1>Deportes</h1>";
    $deportes= array(
        "Fútbol",
        "Baloncesto",
        "Natación",
        "Tenis"
    );
    for ($i=0; $i < count($deportes); $i++) { 
        echo"<p>".$deportes[$i]."</p>";
    }
    echo "<p>Total de valores que hay: ". count($deportes)."</p>";
    //situa el puntero en el primer elemento del array y muestra su valor actual
    echo "<p>Posición actual del puntero: ". current($deportes)."</p>";
    //avanza una posición
    echo "<p>Posición actual del puntero tras avanzar una posición: ". next($deportes)."</p>";
    //coloca el puntero en la última posición
    echo "<p>Valor actual al poner el puntero en la última posición: ". end($deportes)."</p>";
    //retrocede una posición
    echo "<p>Valor actual al poner el puntero en la última posición y retroceder una posición: ". prev($deportes)."</p>";


    ?>
</body>

</html>