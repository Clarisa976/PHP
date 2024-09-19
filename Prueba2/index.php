<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba con elementos php</title>
</head>
<body>
<!-- A continuación agregamos donde irá el código php que se tiene que indicar
 con la etiqueta < ?php ?> y seguido de la sentencia echo "" terminado con ;-->
    <?php
        $texto1="Juan";
        $texto2="María";
        $a=8;
        $b=10;
        echo "<h1>Mi primera web PHP</h1>";
        echo "<p>".$texto1." y ".$texto2."</p>";
        echo "<p>El resultado de sumar ".$a." + ".$b." es: ".($a+$b). "</p>";
    ?>
    <!-- En PHP no hace falta declarar una variable, para ponerla hay que usar siempre $
     para concatenar se usa el operador punto(.)-->
</body>
</html>