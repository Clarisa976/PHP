<?php
if (isset($_POST["comparar"]) && !$error_form) {
    $numeros_romanos = array(
        "M" => 1000,
        "CM" => 900,
        "D" => 500,
        "CD" => 400,
        "C" => 100,
        "XC" => 90,
        "L" => 50,
        "XL" => 40,
        "X" => 10,
        "IX" => 9,
        "V" => 5,
        "VI" => 4,
        "I" => 1

    );

    $resultado = 0;
    for ($i = 0; $i < $longitud_texto; $i++) {
        //si la letra anterior es menor que la actual, resta, si es mayor suma
        if ($i + 1 < $longitud_texto && $numeros_romanos[$texto_m[$i]] < $numeros_romanos[$texto_m[$i + 1]]) {

            $resultado -= $numeros_romanos[$texto_m[$i]];
        } else {
            $resultado += $numeros_romanos[$texto_m[$i]];
        }
    }
    if ($resultado < 1 || $resultado > 5000) {
        echo "<div class='respuesta' >";
        echo "<h2 class='centro'>Romanos a árabes - Resultados</h2>";
        echo "<p> >el número debe estar entre 1 y 5000 </p>";
        echo "</div>";
    } else {

        echo "<div class='respuesta' >";
        echo "<h2 class='centro'>Romanos a árabes - Resultados</h2>";
        echo "<p> el número $texto_m se escribe en cifras árabes como $resultado . </p>";
        echo "</div>";
    }
}
