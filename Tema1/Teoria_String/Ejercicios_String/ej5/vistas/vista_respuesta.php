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

    $numero_arabe = intval($texto); // Convertir el texto a un número entero
        $resultado = "";

        // Convertir el número árabe a romano
        foreach ($numeros_romanos as $romano => $valor) {
            while ($numero_arabe >= $valor) {
                $resultado .= $romano;
                $numero_arabe -= $valor;
            }
        }
        echo "<div class='respuesta' >";
        echo "<h2 class='centro'>Árabes a romanos - Resultados</h2>";
        echo "<p> el número $texto se escribe en cifras romanas como $resultado . </p>";
        echo "</div>";
        
    
}
