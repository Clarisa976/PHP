<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10</title>
</head>

<body>
    <!-- rellena un array de 10 enteros, con los 10 primeros números naturales.
 calcula la media de los que están en posiciones pares
 y muestra los impares por pantalla  -->
</body>
    <?php
        $numeros = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        $resultadoSumaPares = 0;
        $contador = 0;

        echo "<p>Números impares:</p>";
        echo"<ul>";
        //recorremos el array para mostrar los impares
        foreach ($numeros as $indice => $numero) {
            if ($numero % 2 != 0) {//si es impar
                echo "<li>".$numero."</li>";//se muestra
            }
       
       
            if ($indice % 2 == 0) {
                $resultadoSumaPares += $numero;
                $contador++;
            }
        } 
        echo "</ul>";
        $resultadoSumaPares /= $contador;
        echo "La media de los que están en posiciones pares es: " . $resultadoSumaPares;
    ?>

</html>